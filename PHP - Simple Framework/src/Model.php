<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 20/04/17
 * Time: 21:41
 */

namespace DSisconeto\Simple;


use DSisconeto\Simple\DataBase\Connection;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Delete;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataBase\SQL\Insert;
use DSisconeto\Simple\DataBase\SQL\Select;
use DSisconeto\Simple\DataBase\SQL\Update;

abstract class Model
{

    private $table;
    private $imgFolder;
    private $primaryKey;
    private $id;


    public function rollBack()
    {
        return Connection::PDO()->rollBack();

    }

    public function commit()
    {

        return Connection::PDO()->commit();

    }

    public function beginTransaction()
    {

        return Connection::PDO()->beginTransaction();
    }


    public function lastId()
    {
        $this->setId(Connection::PDO()->lastInsertId($this->getPrimaryKey()));

        return $this->getId();
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
        return $this->selectBasic($criteria, $col);
    }

    public function selectBasic($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        return $sql->execute();
    }

    public function selectPrimaryKey()
    {
        $criteria = $this->criteria();

        $criteria->add($this->filter("{$this->getPrimaryKey()}", "=", "{$this->getId()}"));


        return $this->select($criteria);
    }

    /**
     * @return mixed
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @param mixed $primaryKey
     */
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }


    protected function setTable($table)
    {
        $this->table = $table;
    }

    protected function sqlSelect()
    {
        $sql = new Select();
        $sql->setEntity($this->table);
        return $sql;

    }

    protected function sqlInsert()
    {
        $sql = new Insert();
        $sql->setEntity($this->table);
        return $sql;
    }

    protected function sqlDelete()
    {
        $sql = new Delete();

        $sql->setEntity($this->table);
        return $sql;
    }


    protected function sqlUpdate()
    {
        $sql = new Update();
        $sql->setEntity($this->table);
        return $sql;
    }

    protected function criteria()
    {
        return new Criteria();
    }

    protected function filter($variable, $operator, $value)
    {

        return new Filter($variable, $operator, $value);
    }


    public function setImgFolder($imgFolder, $folder = 1)
    {
        $this->imgFolder[$folder] = $imgFolder;
    }

    public function getImgFolderLg($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("lg", $img, $folder, $host);
    }

    public function getImgFolderMd($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("md", $img, $folder, $host);
    }

    public function getImgFolderSm($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("sm", $img, $folder, $host);
    }

    public function getImgFolderXs($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("xs", $img, $folder, $host);
    }

    public function getImgFolderXxs($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("xxs", $img, $folder, $host);
    }


    private function getImgFolderSize($size, $img = false, $folder = 1, $host = false)
    {
        $exp = $host ? GetData::getHostMain() : "";

        $folder = $this->imgFolder[$folder];
        $exp .= "img/$folder/$size/";
        if ($img) {
            $exp .= $img;
        }
        return $exp;
    }


    public function imgExists($img, $imgFolder = 1)
    {

        $lg = file_exists($this->getImgFolderLg($img, $imgFolder));
        $md = file_exists($this->getImgFolderMd($img, $imgFolder));
        $sm = file_exists($this->getImgFolderSm($img, $imgFolder));
        $xs = file_exists($this->getImgFolderXs($img, $imgFolder));
        $xxs = file_exists($this->getImgFolderXxs($img, $imgFolder));


        return (strlen($img) >= 1) && ($lg && $md && $sm && $xs && $xxs);
    }


    public function imgDelete($img, $imgFolder = 1)
    {

        $lg = (strlen($img) >= 1) && file_exists($this->getImgFolderLg($img, $imgFolder));
        $md = (strlen($img) >= 1) && file_exists($this->getImgFolderMd($img, $imgFolder));
        $sm = (strlen($img) >= 1) && file_exists($this->getImgFolderSm($img, $imgFolder));
        $xs = (strlen($img) >= 1) && file_exists($this->getImgFolderXs($img, $imgFolder));
        $xxs = (strlen($img) >= 1) && file_exists($this->getImgFolderXxs($img, $imgFolder));
        $lg ? unlink($this->getImgFolderLg($img, $imgFolder)) : false;
        $md ? unlink($this->getImgFolderMd($img, $imgFolder)) : false;
        $sm ? unlink($this->getImgFolderSm($img, $imgFolder)) : false;
        $xs ? unlink($this->getImgFolderXs($img, $imgFolder)) : false;
        $xxs ? unlink($this->getImgFolderXxs($img, $imgFolder)) : false;

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}