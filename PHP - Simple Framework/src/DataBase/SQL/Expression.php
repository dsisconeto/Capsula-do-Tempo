<?php
namespace DSisconeto\Simple\DataBase\SQL;

abstract class Expression
{

    const AND_OPERATOR = " AND ";
    const OR_OPERATOR = " OR ";


    abstract public function dump();

    

}