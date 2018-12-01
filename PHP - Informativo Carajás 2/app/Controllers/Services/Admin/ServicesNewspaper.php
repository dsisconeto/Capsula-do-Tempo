<?php

namespace App\Controllers\Services\Admin;

use App\Models\Newspaper\Newspaper;
use App\Models\Newspaper\Page;
use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;

class ServicesNewspaper
{

    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"), array(10));
        $newspaperId = Request::get("newspaper_id", "=", 0);
        if ($newspaperId) {
            $newspaper = new Newspaper();
            Login::exitServices(!$newspaper->validateByUser($newspaperId));

        }
    }


    public function search()
    {

        $newspaper = new Newspaper();
        $page = new Page();
        $geoRegionId = Request::get("geo_region_id", "int", 0);
        $pages = $page->selectCovers($geoRegionId);
        $cri = new Criteria();

        $cri->add(new Filter("geo_region_id_fk", "=", $geoRegionId));


        $cri->setProperty("order", "newspaper_date_insert DESC");

        $res = $newspaper->select($cri);
        $result = array();
        $count = 0;

        if ($res) {

            foreach ($res as $item) {

                $result[$count]["newspaper_id"] = $item["newspaper_id"];
                $result[$count]["newspaper_publication_date"] = DataFormat::dateToBr($item["newspaper_publication_date"], false);
                $result[$count]["newspaper_number_of_pages"] = $item["newspaper_number_of_pages"];
                $result[$count]["newspaper_drawing"] = $item["newspaper_drawing"];
                $result[$count]["newspaper_edition"] = $item["newspaper_edition"];
                $result[$count]["newspaper_status"] = $item["newspaper_status"];
                $result[$count]["newspaper_description"] = $item["newspaper_description"];

                $result[$count]["newspaper_cover"] = $pages[$item["newspaper_id"]];
                $count++;
            }


        }

        return $result;

    }

    public function date()
    {
        $newspaperId = Request::get("newspaper_id", "int", 0);
        $column = Request::get("column", "array", array());

        $newspaper = new Newspaper();

        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id", "int", $newspaperId));
        $result = $newspaper->select($cri, $column);

        $result = $result ? $result[0] : $result;

        return $result;
    }


}