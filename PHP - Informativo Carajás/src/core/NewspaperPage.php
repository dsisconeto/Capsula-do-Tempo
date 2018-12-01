<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 15/09/16
 * Time: 22:15
 */
sysLoadClass("ActionNewspaperPage");
sysLoadClass("Newspaper");
sysLoadClass("GeoRegionRelationshipParent");

class NewspaperPage extends ActionNewspaperPage
{

    public function __construct()
    {
        $this->setImgFolder("newspaper_page");

    }


    public function selectByNewspaper($newspaperId, $col = false)
    {

        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id_fk", "=", $newspaperId));
        $cri->setProperty("order", "newspaper_page_number ASC");

        return $this->sqlSelect($cri, $col);
    }


    public function findCover($newspaperId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id_fk", "=", $newspaperId));
        $cri->setProperty("order", "newspaper_page_number ASC");
        $cri->setProperty("limit", "1");
        $col[] = "newspaper_page_file";
        $res = $this->sqlSelect($cri, $col);

        if (isset($res[0])) {


            return $res[0]["newspaper_page_file"];

        } else {

            return false;

        }

    }

    public function selectCovers($geoRegionId)
    {
        $cri = new Criteria();
        $cri3 = new Criteria();
        $parent = new GeoRegionRelationshipParent();

        $cri2 = $parent->createCriteriaByRegion($geoRegionId, "newspaper.geo_region_id_fk");
        $cri->add(new Filter("newspaper_page_number", "<=", 1));


        $cri3->add($cri2);
        $cri3->add($cri);

        $col[] = "newspaper_page_file";
        $col[] = "newspaper_id_fk";

        $res = $this->sqlSelect($cri3, $col);


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

        $newspaper = new Newspaper();


        $this->sqlLoad($newspaperPageId);

        return $newspaper->validateByUser($this->getNewspaperIdFk());

    }


    public function lastPage($newsPaperId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id_fk", "=", $newsPaperId));
        $cri->setProperty("order", "newspaper_page_number DESC");
        $cri->setProperty("limit", 1);

        $col[] = "newspaper_page_number";

        $res = $this->sqlSelect($cri, $col);


        if ($res) {
            return ($res[0]["newspaper_page_number"] + 1);
        } else {
            return 1;
        }


    }

}