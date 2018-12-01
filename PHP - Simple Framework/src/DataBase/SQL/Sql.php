<?php

namespace DSisconeto\Simple\DataBase\SQL;


class Sql
{
    const AND_OPERATOR = " AND ";
    const OR_OPERATOR = " OR ";
    private $column = null;
    private $tableName = "";
    private $join = null;
    private $where;


    public function select()
    {
        $column = "";
        // definindo colunas
        if (!$this->column) {
            $column = "*";
        } else {
            $column = implode(', ', $this->column);
        }


    }


    public function where($name, $operator, $value)
    {



    }

}