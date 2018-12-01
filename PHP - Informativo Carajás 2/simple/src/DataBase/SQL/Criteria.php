<?php
namespace DSisconeto\Simple\DataBase\SQL;

class Criteria extends Expression
{
    private $expressions;
    private $operators;
    private $properties;

    public function __construct()
    {

        $this->expressions = array();
        $this->operators = array();
    }

    public function add(Expression $expression, $operator = self::AND_OPERATOR)
    {
        if (strlen($expression) > 2) {

            // na primeira vez não precisamos de operador lógico para concatenar

            if (empty($this->expressions)):

                $operator = NULL;

            endif;

            // agrega o resultado da expressão a lista de empressões

            $this->expressions[] = $expression;
            $this->operators[] = $operator;
        }
    }

    public function __toString()
    {
        return $this->dump();
    }

    public function dump()
    {
        // concatena a lista expressões
        if (is_array($this->expressions)) {

            if (count($this->expressions) > 0) {

                $res = '';

                foreach ($this->expressions as $key => $expression):
                    $operator = $this->operators[$key];
                    $res .= $operator . $expression->dump();
                endforeach;

                $res = trim($res);
                return "({$res})";
            }
        }

        return "";
    }


    public function setProperty($property, $value)
    {
        if (isset($value)):

            $this->properties[$property] = $value;
        else:
            $this->properties[$property] = NULL;
        endif;

    }

    public function getProperty($property)
    {
        if (isset($this->properties[$property])):
            return $this->properties[$property];
        endif;
    }


}