<?php

namespace App\Models\News;

use App\Models\User\Login;
use App\Models\User\User;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class ContentImg extends Model
{
    private $id;
    private $user;
    private $file;
    private $dataInsert;

    public function __construct()
    {
        $this->setTable("news_content_img");
        $this->setPrimaryKey("news_content_img_id");
        $this->setImgFolder("news_content");

    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("system_user_id_fk", $this->user()->getId());
        $sql->setRowData("news_content_img_file", $this->getFile());
        $sql->setRowData("news_content_img_date_insert", GetData::getCurrentTime());

        return $sql->execute();
    }

    public function edit()
    {
    }


    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];
            $this->setId($res["news_content_img_id"]);
            $this->user()->setId($res["system_user_id_fk"]);
            $this->setFile($res["news_content_img_file"]);
            $this->setDataInsert($res["news_content_img_date_insert"]);

        }

        return $res;
    }


    public function selectByUser()
    {



            $cri = $this->criteria();
            $cri->setProperty("order", "news_content_img_id DESC");
            $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));

            return $this->selectBasic($cri);


    }


    public function validateUser($id)
    {
        $this->load($id);
        return (Login::status() && Login::user()->getId() == $this->user()->getId());
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

    /**
     * @return User
     */
    public function user()
    {
        $this->user = $this->user ? $this->user : new User();

        return $this->user;
    }


    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getDataInsert()
    {
        return $this->dataInsert;
    }

    /**
     * @param mixed $dataInsert
     */
    public function setDataInsert($dataInsert)
    {
        $this->dataInsert = $dataInsert;
    }


}