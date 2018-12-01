<?php

namespace DSisconeto\Simple\DataBase\SQL;

class Filter extends Expression
{

    private $variable;
    private $operator;
    private $value;

    /**
     * @return mixed
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @param mixed $variable
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * SqlFilter constructor.
     * @param $variable = variavel
     * @param $operator = operador (<,>,=)
     * @param $value = Valor
     */
    public function __construct($variable, $operator, $value)
    {

        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->transform($value);


    }


    public function transform($value)
    {
        // caso seja um array
        if (is_array($value)):

            foreach ($value as $key):

                // se for inteiro
                if (is_integer($key)):
                    $foo[] = $key;
                elseif (is_string($key)):
                    // se for string add aspas
                    $foo[] = "'$key'";
                endif;

            endforeach;

            $res = "(" . implode(',', $foo) . ")";

        elseif (is_string($value)):


            $res = "'$value'";


        elseif (is_null($value)):
            $res = "NULL";


        elseif (is_bool($value)):

            $res = $value ? 'TRUE' : 'FALSE';

        else:
            $res = $value;

        endif;


        return $res;

    }


    public function dump()
    {
        /// concatena a expressão

        return "{$this->variable} {$this->operator} {$this->value}";


    }

    public function __toString()
    {
        return $this->dump();
    }


}