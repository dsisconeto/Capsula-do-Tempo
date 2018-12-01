<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 15:48
 */
sysLoadClass("ModelCompanyGallery");

class ActionCompanyGallery extends ModelCompanyGallery
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_gallery");

        $sql->setRowData("company_gallery_file", $this->getCompanyGalleryFile());
        $sql->setRowData("company_id_fk", $this->getCompanyIdFk());
        $sql->setRowData("company_gallery_order", $this->getCompanyGalleryOrder());
        $sql->setRowData("company_gallery_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $criteria = new Criteria();
        $sql->setEntity('company_gallery');
        $criteria->add(New Filter('company_gallery_id', '=', "{$this->getCompanyGalleryId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlUpdateOrder()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('company_gallery');
        $criteria->add(New Filter('company_gallery_id', '=', "{$this->getCompanyGalleryId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_gallery_order", $this->getCompanyGalleryOrder());


        return $this->runQuery($sql);

    }

    public function sqlSelect($criteria = false, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_gallery");
        $sql->addColumn($col);
        if ($criteria) {
            $sql->setCriteria($criteria);
        }
        return $this->runSelect($sql);
    }

    public function sqlLoad($companyGalleryIdImg)
    {

        $criteria = new Criteria();
        $criteria->add(New Filter('company_gallery_id', '=', $companyGalleryIdImg));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        if ($res):
            $res = $res[0];
            $this->setCompanyGalleryId($res["company_gallery_id"]);
            $this->setCompanyGalleryFile($res["company_gallery_file"]);
            $this->setCompanyIdFk($res["company_id_fk"]);
            $this->setCompanyGalleryDateInsert($res["company_gallery_date_insert"]);
            $this->setCompanyGalleryOrder($res["company_gallery_order"]);
        endif;

        return $res;
    }

}