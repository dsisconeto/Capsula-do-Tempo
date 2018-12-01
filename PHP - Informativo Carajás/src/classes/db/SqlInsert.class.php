<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 06/04/16
 * Time: 13:08
 */
final class SqlInsert extends SqlInstruction
{
    private $columnValues;


    public function setRowData($column, $value)
    {
        if (is_scalar($value)):

            if (is_string($value) && (!empty($value))):
                $value = addslashes($value);
                // caso seja uma string
                $this->columnValues[$column] = "'$value'";

            elseif (is_numeric($value)):

                $this->columnValues[$column] = $value;

            elseif (is_bool($value)):

                $this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';

            elseif ($value != ''):

                $this->columnValues[$column] = $value;
            else:
                $this->columnValues[$column] = "''";
            endif;


        endif;


    }

    public function setCriteria(Criteria $criteria)
    {
        throw  new Exception("Cannot call setCriteria from" . __CLASS__);

    }


    public function getInstruction()
    {
        $this->sql = "INSERT INTO {$this->entity} (";

        /// monta uma string contendo os nomes do colunas
        $columns = implode(', ', array_keys($this->columnValues));
        $values = implode(', ', array_values($this->columnValues));

        $this->sql .= $columns . ')';
        $this->sql .= " VALUES ({$values})";

        return $this->sql;


    }


    public function __toString()
    {
        return $this->getInstruction();
    }


}