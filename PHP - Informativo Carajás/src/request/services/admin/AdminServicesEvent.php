<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 27/08/16
 * Time: 19:01
 */
sysLoadClass("Event");
sysLoadClass("GeoRegionUserPermission");

class AdminServicesEvent
{

    public function __construct()
    {
        $login = SystemLogin::getLogin();
        if (!$login->validateLogIn() || !$login->getSystemUserPermissionEvent()) {
            exit();
        }
    }

    public function search()
    {
        $result["pageNumber"] = 0;
        $result["items"] = null;

        $event = new Event();
        $regionPermission = new GeoRegionUserPermission();
        $eventName = DjRequest::get("event_name", "");
        $eventStatus = DjRequest::get("event_status", 0);
        $order = DjRequest::get("order", 0);
        $orderBy = DjRequest::get("order_by", 0);
        $page = DjRequest::get("page", "int", 1);
        $limitByPage = DjRequest::get("limit_by_page", "int", 10);

        $orderByArray[0] = "event_name";
        $orderByArray[1] = "event_date";
        $orderByArray[2] = "event_date_insert";
        $orderByArray[3] = "event_date_update";

        $orderArray[0] = "ASC";
        $orderArray[1] = "DESC";

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
        if (!isset($_COOKIE[md5("search_event" . $cri3)])) {
            // cookie para não ficar repedindo a buscar o tempo momento
            $resultEvent = $event->searchAdmin($cri3, $col);
            $pageNumber = ceil(count($resultEvent) / $limitByPage);
            setcookie(md5("search_event" . $cri3), $pageNumber, 60);
        } else {
            $pageNumber = $_COOKIE[md5("search_event" . $cri)];
        }

        $cri3->setProperty("limit", DjWork::paginate($page, $limitByPage));
        $resultEvent = $event->searchAdmin($cri3, $col);

        $result["items"] = $resultEvent;
        $result["pageNumber"] = $pageNumber;

        return $result;
    }


    public function cover()
    {
        $event = new Event();
        $event->sqlLoad(DjRequest::get("event_id"));

        if ($event->getCover()) {

            $res[0]["event_cover"] = DjWork::getHost() . $event->getImgFolder() . $event->getCover();
            return $res;
        } else {
            return false;
        }
    }
}