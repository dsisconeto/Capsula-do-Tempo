<?php

namespace DSisconeto\Simple\DataBase\SQL;

use  DSisconeto\Simple\DataBase\Connection;

class Select extends Instruction
{
    private $column;
    private $join;
    private $double;

    public function setDouble($double)
    {
        $this->double = $double;
    }

    public function addColumn($column)
    {

        if (is_array($column)) {

            foreach ($column as $key) {

                $this->column[] = $key;
            }

        } elseif (is_string($column) && strlen($column) > 1) {

            $this->column[] = $column;

        }


    }


    public function getInstruction()
    {
        if (!$this->double) {
            $this->sql = "SELECT DISTINCT ";
        } else {
            $this->sql = "SELECT  ";
        }

        if (!$this->column) {
            $this->column[] = "*";
        }

        $this->sql .= implode(', ', $this->column);

        $this->sql .= ' FROM ' . $this->getEntity();

        if ($this->getJoin()):
            $this->sql .= $this->getJoin();
        endif;

        if ($this->criteria):
            $expression = $this->criteria->dump();
            if ($expression):
                $this->sql .= ' WHERE ' . $expression;
            endif;

            $order = $this->criteria->getProperty('order');
            $limit = $this->criteria->getProperty('limit');
            $offset = $this->criteria->getProperty('offset');

            if ($order):
                $this->sql .= ' ORDER BY ' . $order;

            endif;

            if ($limit):
                $this->sql .= ' LIMIT ' . $limit;

            endif;

            if ($offset):

                $this->sql .= ' OFFSET ' . $offset;

            endif;

        endif;


        return $this->sql;
    }


    public function setJoin($entity, $entity2, $param, $param2, $join = "INNER")
    {

        $join = strtolower($join);

        switch ($join) {

            case "left":
                $join = "LEFT";
                break;

            case "right":
                $join = "RIGHT";
                break;

            case "full":
                $join = "FULL";
                break;

            default:
                $join = "INNER";
                break;
        }

        $join = strtoupper($join);

        $this->join[] = " $join JOIN `$entity2` ON  (`$entity`.`$param` = `$entity2`.`$param2`)  ";
    }

    private function getJoin()
    {

        $count = count($this->join);
        $res = "";
        if ($count):

            $count = ($count - 1);

            for ($i = 0; $count >= $i; $i++):
                $res .= $this->join[$i];
            endfor;

        endif;

        return $res;
    }

    public function execute()
    {
        return Connection::select($this->getInstruction());
    }

}