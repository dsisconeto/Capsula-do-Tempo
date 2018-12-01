<?php
namespace DSisconeto\Simple\DataBase\SQL;

abstract class Instruction
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