<?php

namespace App\Models\Company;


use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class SocialNetwork extends Model
{

    private $id;
    private $company;
    private $systemSocial;
    private $link;
    private $dataInsert;
    private $dataUpdate;

    public function __construct()
    {
        $this->setTable("company_social_network");
        $this->setPrimaryKey("company_social_network_id");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_id_fk", $this->company()->getId());
        $sql->setRowData("system_social_network_id_fk", $this->socialNetwork()->getId());
        $sql->setRowData("company_social_network_link", $this->getLink());
        $sql->setRowData("company_social_network_date_insert", GetData::getCurrentTime());


        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('company_social_network_id', '=', "{$this->getId()}"));

        $sql->setRowData("company_social_network_link", $this->getLink());
        $sql->setRowData("company_social_network_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_social_network_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function selectAll()
    {
        $sql = $this->sqlSelect();

        $sql->addColumn("*");
        $sql->setJoin("company_social_network", "system_social_network", "system_social_network_id_fk", "system_social_network_id");


        return $sql->execute();
    }

    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_social_network_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);
        $sql->setJoin("company_social_network", "system_social_network", "system_social_network_id_fk", "system_social_network_id");

        $sql->addColumn("*");
        $res = $sql->execute();


        if ($res):
            $res = $res[0];
            $this->setId($res["company_social_network_id"]);
            $this->company()->setId($res["company_id_fk"]);
            $this->socialNetwork()->setId($res["system_social_network_id_fk"]);
            $this->setLink($res["company_social_network_link"]);
            $this->setDataInsert($res["company_social_network_date_insert"]);
            $this->setDataUpdate($res["company_social_network_date_update"]);

        endif;

        return $res;
    }

    public function selectByView($companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->add($this->filter("company_id_fk", "=", $companyId));

        $cri->setProperty("order", "system_social_network_name ASC");
        $sql->setJoin("company_social_network", "system_social_network", "system_social_network_id_fk", "system_social_network_id");

        $sql->addColumn("company_social_network_id");
        $sql->addColumn("system_social_network_name");
        $sql->addColumn("company_social_network_link");
        $sql->addColumn("system_social_network_icon");
        $sql->addColumn("system_social_network_color");

        $sql->setCriteria($cri);

        return $sql->execute();

    }


    public function validateByUser($companySocialNetworkId)
    {
        $this->load($companySocialNetworkId);
        return $this->company()->validateByUser($this->company()->getId());
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
     * @return Company
     */
    public function company()
    {

        $this->company = $this->company ? $this->company : new Company();

        return $this->company;
    }

    /**
     * @param mixed $company
     */


    /**
     * @return \App\Models\System\SocialNetwork
     */
    public function socialNetwork()
    {
        $this->systemSocial = $this->systemSocial ? $this->systemSocial : new \App\Models\System\SocialNetwork();

        return $this->systemSocial;
    }


    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
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
    public function getDataUpdate()
    {
        return $this->dataUpdate;
    }

    /**
     * @param mixed $dataUpdate
     */
    public function setDataUpdate($dataUpdate)
    {
        $this->dataUpdate = $dataUpdate;
    }

}