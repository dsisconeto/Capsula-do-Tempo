<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 06/04/16
 * Time: 13:10
 * Classe abstrata para genreciar expressões
 */
abstract class Expression
{

    const AND_OPERATOR = " AND ";
    const OR_OPERATOR = " OR ";


    abstract public function dump();

    

}