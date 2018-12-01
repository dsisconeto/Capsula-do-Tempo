<?php
namespace DSisconeto\Simple\DataBase\SQL;

use  DSisconeto\Simple\DataBase\Connection;

class Update extends Instruction
{
    private $columnValues;

    public function setRowData($column, $values)

    {
        if (is_scalar($values)):

            if (is_string($values)):
                $values = addslashes($values);
                $this->columnValues[$column] = "'$values'";

            elseif (is_bool($values)):
                $this->columnValues[$column] = $values ? 'TRUE' : 'FALSE';
            elseif ($values !== ""):
                $this->columnValues[$column] = $values;
            else:
                $this->columnValues[$column] = "NULL";
            endif;

        endif;

    }

    public function getInstruction()
    {
        $this->sql = "UPDATE {$this->entity}";

        if ($this->columnValues):

            foreach ($this->columnValues as $col => $value):
                $set[] = "{$col} = {$value}";
            endforeach;

            $this->sql .= ' SET ' . implode(', ', $set);

            if ($this->criteria):
                $this->sql .= ' WHERE ' . $this->criteria->dump();
            endif;

        endif;
        $this->sql .= " ;";
        return $this->sql;
    }


    public function __toString()
    {
        return $this->getInstruction();
    }

    public function execute()
    {
        return Connection::query($this->getInstruction());

    }


}