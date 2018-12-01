<?php

namespace App\Models\Newspaper;

use App\Models\Geo\RegionRelationshipParent;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;

class Page extends Model
{


    private $id;
    private $newspaper;
    private $number;
    private $file;
    private $dateInsert;
    private $newspaperPageDateUpdate;

    public function __construct()
    {
        $this->setTable("newspaper_page");
        $this->setPrimaryKey("newspaper_page_id");
        $this->setImgFolder("newspaper_page");

    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("newspaper_id_fk", $this->newspaper()->getId());
        $sql->setRowData("newspaper_page_number", $this->getNumber());
        $sql->setRowData("newspaper_page_file", $this->getFile());
        $sql->setRowData("newspaper_page_date_insert", GetData::getCurrentTime());


        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));
        $sql->setRowData("newspaper_page_number", $this->getNumber());
        $sql->setRowData("newspaper_page_date_update", $this->getNewspaperPageDateUpdate());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        $sql->setJoin("newspaper_page", "newspaper", "newspaper_id_fk", "newspaper_id");


        return $sql->execute();
    }

    public function load($id)
    {
        $this->setId($id);

        $res = $this->selectPrimaryKey();

        if ($res) {
            $res = $res[0];
            $this->setId($res["newspaper_page_id"]);
            $this->newspaper()->setId($res["newspaper_id_fk"]);
            $this->setNumber($res["newspaper_page_number"]);
            $this->setFile($res["newspaper_page_file"]);
            $this->setDateInsert($res["newspaper_page_date_insert"]);
            $this->setNewspaperPageDateUpdate($res["newspaper_page_date_update"]);


        }

        return $res;
    }


    public function selectByNewspaper($newspaperId, $col = false)
    {

        $cri = $this->criteria();
        $cri->add($this->filter("newspaper_id_fk", "=", $newspaperId));
        $cri->setProperty("order", "newspaper_page_number ASC");

        return $this->select($cri, $col);
    }


    public function findCover($newspaperId)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("newspaper_id_fk", "=", $newspaperId));
        $cri->setProperty("order", "newspaper_page_number ASC");
        $cri->setProperty("limit", "1");
        $col[] = "newspaper_page_file";
        $res = $this->select($cri, $col);

        if (isset($res[0])) {


            return $res[0]["newspaper_page_file"];

        } else {

            return false;

        }

    }

    public function selectCovers($geoRegionId)
    {
        $cri = $this->criteria();
        $cri3 = $this->criteria();
        $parent = new RegionRelationshipParent();

        $cri2 = $parent->createCriteriaByRegion($geoRegionId, "newspaper.geo_region_id_fk");
        $cri->add($this->filter("newspaper_page_number", "<=", 1));


        $cri3->add($cri2);
        $cri3->add($cri);

        $col[] = "newspaper_page_file";
        $col[] = "newspaper_id_fk";

        $res = $this->select($cri3, $col);


        $result = array();
        if ($res) {

            foreach ($res as $key) {

                $result[$key["newspaper_id_fk"]] = $key["newspaper_page_file"];

            }
        }

        return $result;
    }


    public function deleteByNewspaper($newspaperId)
    {
        // está função só serve para deletar os arquivos

        $newspaper = new Newspaper();
        $res = $this->selectByNewspaper($newspaperId);

        if ($res && $newspaper->validateByUser($newspaperId)) {


            foreach ($res as $item) {

                $this->imgDelete($item["newspaper_page_file"]);

            }

            return true;
        } else {

            return false;

        }

    }

    public function validateByUser($newspaperPageId)
    {
        $this->load($newspaperPageId);
        return $this->newspaper()->validateByUser($this->newspaper()->getId());
    }


    public function lastPage($newsPaperId)
    {
        $cri = $this->criteria();
        $cri->add($this->filter("newspaper_id_fk", "=", $newsPaperId));
        $cri->setProperty("order", "newspaper_page_number DESC");
        $cri->setProperty("limit", 1);

        $col[] = "newspaper_page_number";

        $res = $this->select($cri, $col);


        if ($res) {
            return ($res[0]["newspaper_page_number"] + 1);
        } else {
            return 1;
        }


    }


    /**
     * @return mixed
     */
    public function getNewspaperPageDateUpdate()
    {
        return $this->newspaperPageDateUpdate;
    }

    /**
     * @param mixed $newspaperPageDateUpdate
     */
    public function setNewspaperPageDateUpdate($newspaperPageDateUpdate)
    {
        $this->newspaperPageDateUpdate = $newspaperPageDateUpdate;
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
     * @return Newspaper
     */
    public function newspaper()
    {

        $this->newspaper = $this->newspaper ? $this->newspaper : new Newspaper();

        return $this->newspaper;
    }


    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = DataFilter::filter($number, array("type" => "int"));
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


}