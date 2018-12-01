<?php

namespace App\Controllers\Services\Admin;

use App\Models\Event\Event;
use App\Models\Geo\RegionUserPermission;
use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;


class ServicesEvent
{

    public function __construct()
    {


        Login::validateServices(Request::cookie("jwt"), array(4));
        $eventId = Request::get("event_id", "int", 0);
        if ($eventId) {
            $event = new Event();
            Login::exitServices($event->validateByUser($eventId));
        }
    }

    public function search()
    {


        $result["pageNumber"] = 0;
        $result["items"] = null;

        $event = new Event();
        $regionPermission = new RegionUserPermission();
        $eventName = Request::get("event_name", "");
        $eventStatus = Request::get("event_status", 0);
        $order = Request::get("order", "int", 0);
        $orderBy = Request::get("order_by", 0);
        $page = Request::get("page", "int", 1);
        $limitByPage = Request::get("limit_by_page", "int", 10);


        $orderArray[0] = "DESC";
        $orderArray[1] = "ASC";

        $orderByArray[0] = "event_name";
        $orderByArray[1] = "event_date";
        $orderByArray[2] = "event_date_insert";
        $orderByArray[3] = "event_date_update";


        $statusArray[1] = 1;
        $statusArray[2] = 2;
        $statusArray[3] = 3;
        $cri0 = $regionPermission->createCriteria("event", "event_relationship_geo_region.geo_region_id_fk");
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        // filtrando por usario


        // filtrando por status
        if (isset($statusArray[$eventStatus])) {
            $cri->add(new Filter("event_status", "=", $eventStatus));
        }
        // filtrndo por nome do evento ou nome da categoria
        if ($eventName) {
            $cri2->add(new Filter("event_category_name", "LIKE", "%$eventName%"), Filter::OR_OPERATOR);
            $cri2->add(new Filter("event_name", "LIKE", "%$eventName%"), Filter::OR_OPERATOR);
            $cri3->add($cri2);
        }
        // definindo a ordem
        if (isset($orderByArray[$orderBy]) && isset($orderArray[$order])) {
            $cri3->setProperty("order", "{$orderByArray[$orderBy]} {$orderArray[$order]}");
        }
        // setando primeiro creterio
        $cri3->add($cri0);
        $cri3->add($cri);

        // dados que retornaram
        $col[] = "event_id";
        $col[] = "event_name";
        $col[] = "event_date";
        $col[] = "event_status";
        $col[] = "event_cover";
        $col[] = "event_date_insert";
        $col[] = "event_date_update";
        $col[] = "event_category_name";
        $col[] = "system_url_url";
        // sistema de pagaginacao

        $resultEvent = $event->selectMix($cri3, "COUNT(DISTINCT event_id) as count");

        $pageNumber = ceil($resultEvent[0]["count"] / $limitByPage);


        $cri3->setProperty("limit", DataFormat::paginate($page, $limitByPage));

        $resultEvent = $event->selectMix($cri3, $col);

        $result["items"] = $resultEvent;
        $result["pageNumber"] = $pageNumber;

        return $result;
    }


    public function cover()
    {
        $event = new Event();
        $event->load(Request::get("event_id"));

        if ($event->getCover()) {

            $res[0]["event_cover"] = $event->getImgFolderLg() . $event->getCover();
            return $res;
        } else {
            return false;
        }
    }


}