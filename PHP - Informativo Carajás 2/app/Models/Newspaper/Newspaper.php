<?php

namespace App\Models\Newspaper;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\User;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;

class Newspaper extends Model
{

    private $id;
    private $description;
    private $publicationDate;
    private $numberOfPages;
    private $drawing;
    private $edition;
    private $region;
    private $dateInsert;
    private $dateUpdate;
    private $status;
    private $user;

    public function __construct()
    {
        $this->setTable("newspaper");
        $this->setPrimaryKey("newspaper_id");
        $this->setImgFolder("");

    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("newspaper_id", $this->getId());
        $sql->setRowData("newspaper_description", $this->getDescription());
        $sql->setRowData("newspaper_publication_date", $this->getPublicationDate());
        $sql->setRowData("newspaper_number_of_pages", $this->getNumberOfPages());
        $sql->setRowData("newspaper_drawing", $this->getDrawing());
        $sql->setRowData("newspaper_edition", $this->getEdition());
        $sql->setRowData("newspaper_date_insert", GetData::getCurrentTime());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("system_user_id_fk", $this->user()->getId());
        $sql->setRowData("newspaper_status", 1);

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));
        $sql->setRowData("newspaper_description", $this->getDescription());
        $sql->setRowData("newspaper_number_of_pages", $this->getNumberOfPages());
        $sql->setRowData("newspaper_publication_date", $this->getPublicationDate());
        $sql->setRowData("newspaper_number_of_pages", $this->getNumberOfPages());
        $sql->setRowData("newspaper_drawing", $this->getDrawing());
        $sql->setRowData("newspaper_edition", $this->getEdition());
        $sql->setRowData("newspaper_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function editStatus()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));
        $sql->setRowData("newspaper_status", $this->getStatus());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        $sql->setJoin("newspaper", "geo_region", "geo_region_id_fk", "geo_region_id");
        return $sql->execute();
    }

    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];

            $this->setId($res["newspaper_id"]);
            $this->setDescription($res["newspaper_description"]);
            $this->setPublicationDate($res["newspaper_publication_date"]);
            $this->setNumberOfPages($res["newspaper_number_of_pages"]);
            $this->setDrawing($res["newspaper_drawing"]);
            $this->setEdition($res["newspaper_edition"]);
            $this->region()->setId($res["geo_region_id_fk"]);
            $this->setDateInsert($res["newspaper_date_insert"]);
            $this->setDateUpdate($res["newspaper_date_update"]);
            $this->setStatus($res["newspaper_status"]);
            $this->user()->setId($res["system_user_id_fk"]);

        }

        return $res;
    }

    public function validateByUser($newspaperId)
    {
        $relationUserRegion = new RegionUserPermission();
        $this->load($newspaperId);
        return ($relationUserRegion->validatePermission($this->region()->getId(), "newspaper"));
    }


    public function search($geoRegionId)
    {
        $parent = new RegionRelationshipParent();

        $page = new Page();
        $pages = $page->selectCovers($geoRegionId);
        $cri = $this->criteria();
        $cri2 = $parent->createCriteriaByRegion($geoRegionId, "geo_region_id_fk");
        $cri3 = $this->criteria();

        $cri->add($this->filter("newspaper_status", "=", 3));
        $cri->setProperty("order", "newspaper_publication_date ASC");

        $cri3->add($cri);
        $cri3->add($cri2);

        $res = $this->select($cri3);
        $result = array();
        $count = 0;

        if ($res) {

            foreach ($res as $item) {
                $result[$count]["newspaper_id"] = $item["newspaper_id"];
                $result[$count]["newspaper_publication_date"] = DataFormat::dateToBr($item["newspaper_publication_date"], false);
                $result[$count]["newspaper_number_of_pages"] = $item["newspaper_number_of_pages"];
                $result[$count]["newspaper_drawing"] = $item["newspaper_drawing"];
                $result[$count]["newspaper_edition"] = $item["newspaper_edition"];
                $result[$count]["newspaper_description"] = $item["newspaper_description"];
                $result[$count]["newspaper_cover"] = $pages[$item["newspaper_id"]];
                $count++;
            }


        }

        return $result;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate =$publicationDate;
    }

    /**
     * @return mixed
     */
    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }

    /**
     * @param mixed $numberOfPages
     */
    public function setNumberOfPages($numberOfPages)
    {
        $this->numberOfPages = $numberOfPages;
    }

    /**
     * @return mixed
     */
    public function getDrawing()
    {

        return $this->drawing;
    }

    /**
     * @param mixed $drawing
     */
    public function setDrawing($drawing)
    {
        $this->drawing = $drawing;
    }

    /**
     * @return mixed
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * @param mixed $edition
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;
    }

    /**
     * @return Region
     */
    public function region()
    {
        $this->region = $this->region ? $this->region : new Region();

        return $this->region;
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