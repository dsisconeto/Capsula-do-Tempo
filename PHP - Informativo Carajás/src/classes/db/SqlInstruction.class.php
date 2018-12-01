<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 06/04/16
 * Time: 13:07
 */
abstract class SqlInstruction
{

    protected $sql;
    protected $criteria;
    protected $entity;


    final public function setEntity($entity)
    {
        $this->entity = $entity;
    }


    final public function getEntity()
    {
        return $this->entity;
    }


    public function setCriteria(Criteria $criteria)
    {
        
        $this->criteria = $criteria;
    }


    public abstract function getInstruction();

    public function __toString()
    {
        return $this->getInstruction();

    }

}