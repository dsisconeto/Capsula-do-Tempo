<?php

namespace App\Models\Company;

use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;

class Gallery extends Model
{

    private $id;
    private $file;
    private $company;
    private $dataInsert;
    private $order;

    public function __construct()
    {
        $this->setTable("company_gallery");
        $this->setImgFolder("company_gallery");
        $this->setPrimaryKey("company_gallery_id");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_gallery_file", $this->getFile());
        $sql->setRowData("company_id_fk", $this->company()->getId());
        $sql->setRowData("company_gallery_order", $this->getOrder());
        $sql->setRowData("company_gallery_date_insert", GetData::getCurrentTime());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('company_gallery_id', '=', "{$this->getId()}"));

        $sql->setRowData("company_gallery_order", $this->getOrder());

        return $sql->execute();
    }


    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");
        return $sql->execute();
    }

    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_gallery_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);
        $sql->addColumn("*");


        $res = $sql->execute();
        if ($res):
            $res = $res[0];
            $this->setId($res["company_gallery_id"]);
            $this->setFile($res["company_gallery_file"]);
            $this->company()->setId($res["company_id_fk"]);
            $this->setDataInsert($res["company_gallery_date_insert"]);
            $this->setOrder($res["company_gallery_order"]);
        endif;

        return $res;
    }


    public function selectBycCompany($companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->add($this->filter("company_id_fk", "=", $companyId));
        $cri->setProperty("order", "company_gallery_order ASC");
        $sql->addColumn("company_gallery_id");
        $sql->addColumn("company_gallery_file");
        $sql->setCriteria($cri);

        return $sql->execute();
    }


    public function validateByUser($companyGalleryId)
    {
        $this->load($companyGalleryId);
        return $this->company()->validateByUser($this->company()->getId());
    }

    public function lastOrder($companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->add($this->filter("company_id_fk", "=", $companyId));
        $cri->setProperty("order", "company_gallery_order");
        $cri->setProperty("limit", "1");
        $sql->addColumn("*");
        $sql->setCriteria($cri);

        $res = $sql->execute();

        if (isset($res[0])) {

            return ($res[0]["company_gallery_order"]++);

        } else {
            return 1;
        }

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
     * @return Company
     */
    public function company()
    {

        $this->company = $this->company ? $this->company : new Company();

        return $this->company;
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

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }


}