<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 06/04/16
 * Time: 13:09
 */
final class SqlDelete extends SqlInstruction
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
    
    
}