<?php
namespace App\Model;


use DSisconeto\Simple\DataBase\Connection;
use DSisconeto\Simple\Model;

class User extends Model
{
    private $pass;
    private $user;


    public function __construct()
    {
        $this->setTable("");
        $this->setPrimaryKey("");
        $this->setImgFolder("");

    }

    public function register()
    {
        $sql = $this->sqlInsert();


        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter("{$this->getPrimaryKey()}", '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;


        return $sql->execute();
    }

    public function load($id = false)
    {
        $id ? $this->setId($id) : NUll;

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];
            // carregar dados

        }

        return $res;
    }


    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}