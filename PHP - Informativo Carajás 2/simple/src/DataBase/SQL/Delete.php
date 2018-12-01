<?php

namespace DSisconeto\Simple\DataBase\SQL;

use DSisconeto\Simple\DataBase\Connection;

final class Delete extends Instruction
{


    public function getInstruction()
    {
        $this->sql = "DELETE FROM {$this->entity}";

        if ($this->criteria):
            $expression = $this->criteria->dump();
            if ($expression):
                $this->sql .= " WHERE " . $expression;
            endif;
        endif;

        return $this->sql;
    }


    public function execute()
    {

        return Connection::query($this->getInstruction());

    }


}