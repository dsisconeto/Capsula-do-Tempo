<?php

namespace App\Models\Ads;

use DSisconeto\Simple\GetData;
use App\Models\Company\Company;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\User;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Model;


class Ads extends Model
{

    private $id;
    private $file;
    private $link;
    private $StartDisplay;
    private $EndDisplay;
    private $local;
    private $company;
    private $user;
    private $dateInsert;
    private $dateUpdate;
    private $status;
    private $turnover;


    public function __construct()
    {
        $this->setImgFolder("ads_banner");
        $this->setPrimaryKey("ads_id");
        $this->setTable("ads");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("ads_file", $this->getFile());
        $sql->setRowData("ads_link", $this->getLink());
        $sql->setRowData("ads_start_display", $this->getStartDisplay());
        $sql->setRowData("ads_end_display", $this->getEndDisplay());
        $sql->setRowData("ads_local_id", $this->local()->getId());
        $sql->setRowData("company_id", $this->company()->getId());
        $sql->setRowData("system_user_id", $this->user()->getId());
        $sql->setRowData("ads_status", $this->getStatus());
        $sql->setRowData("ads_date_insert", GetData::getCurrentTime());
        $sql->setRowData("ads_date_update", GetData::getCurrentTime());


        return $sql->execute();

    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('ads_id', '=', "{$this->getId()}"));

        $sql->setRowData("ads_file", $this->getFile());
        $sql->setRowData("ads_link", $this->getLink());
        $sql->setRowData("ads_start_display", $this->getStartDisplay());
        $sql->setRowData("ads_end_display", $this->getEndDisplay());
        $sql->setRowData("ads_local_id", $this->local()->getId());
        $sql->setRowData('ads_date_update', GetData::getCurrentTime());

        $sql->setCriteria($criteria);

        return $sql->execute();

    }


    public function updateTurnover($adsId, $regionId, $adsLocalId)
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $this->setId($adsId);

        $adsRelationshipRegion = new RelationshipRegion();
        $lastTurnover = $adsRelationshipRegion->selectLastTurnoverByRegion($regionId, $adsLocalId);
        $this->setTurnover(($lastTurnover + 1));

        $criteria->add($this->filter('ads_id', '=', "{$this->getId()}"));
        $sql->setRowData("ads_turnover", $this->getTurnover());
        $sql->setCriteria($criteria);

        return $sql->execute();
    }


    public function validateByUser($adsId)
    {

        $this->setId($adsId);
        $sql = $this->sqlSelect();
        $regionUser = new RegionUserPermission();
        $criteriaRegion = $regionUser->createCriteria("ads", "ads_relationship_region.geo_region_id_fk");
        $criteria1 = $this->criteria();
        $criteria2 = $this->criteria();
        $criteria1->add(new Filter("ads.ads_id", "=", $this->getId()));
        $criteria2->setProperty("limit", 1);

        $criteria2->add($criteria1);
        $criteria2->add($criteriaRegion);

        $sql->setCriteria($criteria2);

        $sql->addColumn("ads.ads_id");

        $sql->setJoin("ads", "ads_relationship_region", "ads_id", "ads_id_fk");

        $result = $sql->execute();

        if ($result) {
            $this->load($result[0]["ads_id"]);
        }

        return $result;
    }


    public function editStatus()
    {

        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('ads_id', '=', "{$this->getId()}"));
        $sql->setRowData("ads_status", $this->getStatus());
        $sql->setCriteria($criteria);
        return $sql->execute();


    }


    public function select($criteria = null, $col = false)
    {
        $sql = $this->sqlSelect();

        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");
        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;


        return $sql->execute();
    }

    public function selectAllByCompany($criteria = null, $col = false)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();
        $criteria2 = $this->criteria();

        $criteria->add($this->filter("company_id", "=", $this->company()->getId()));

        $criteria2->add($criteria);

        $criteria ? $criteria2->add($criteria) : NULL;
        $col ? $sql->addColumn($col) : $sql->addColumn("*");

        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");
        $sql->setCriteria($criteria2);

        return $sql->execute();

    }

    public function selectWithCompany($criteria = null, $col = false)
    {
        $sql = $this->sqlSelect();

        $sql->setJoin("ads", "ads_local", "ads_local_id", "ads_local_id");
        $sql->setJoin("ads", "company", "company_id_fk", "company_id");

        $sql->addColumn($col);
        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $sql->execute();
    }

    public function load($AdsId)
    {
        $criteria = $this->criteria();
        $criteria->add($this->filter('ads_id', '=', $AdsId));
        $criteria->setProperty("limit", 1);
        $res = $this->select($criteria);
        if ($res):
            $res = $res[0];

            $this->setId($res["ads_id"]);
            $this->setFile($res["ads_file"]);
            $this->setLink($res["ads_link"]);
            $this->setStartDisplay($res["ads_start_display"]);
            $this->setEndDisplay($res["ads_end_display"]);
            $this->local()->setId($res["ads_local_id"]);
            $this->company()->setId($res["company_id"]);
            $this->user()->setId($res["system_user_id"]);
            $this->setDateInsert($res["ads_date_insert"]);
            $this->setDateUpdate($res["ads_date_update"]);
            $this->setStatus($res["ads_status"]);
            $this->setTurnover($res["ads_turnover"]);

        endif;

        return $res;
    }


    /**
     * @return mixed
     */
    public function getTurnover()
    {
        return $this->turnover;
    }

    /**
     * @param mixed $turnover
     */
    public function setTurnover($turnover)
    {
        $this->turnover = $turnover;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
    public function getStartDisplay()
    {
        return $this->StartDisplay;
    }

    /**
     * @param mixed $StartDisplay
     */
    public function setStartDisplay($StartDisplay)
    {
        $this->StartDisplay = $StartDisplay;
    }

    /**
     * @return mixed
     */
    public function getEndDisplay()
    {
        return $this->EndDisplay;
    }

    /**
     * @param mixed $EndDisplay
     */
    public function setEndDisplay($EndDisplay)
    {
        $this->EndDisplay = $EndDisplay;
    }

    /**
     * @return Local
     */
    public function local()
    {

        $this->local = $this->local ? $this->local : new Local();

        return $this->local;
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
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * @param mixed $dateInsert
     */
    public function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }


}