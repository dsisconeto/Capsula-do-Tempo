<?php

namespace App\Models\Event;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\Geo\RegionUserPermission;
use App\Models\System\SystemUrl;
use App\Models\User\User;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class Event extends Model
{

    private $name;
    private $description;
    private $local;
    private $date;
    private $roof;
    private $roofCover;
    private $cover;
    private $category;
    private $address;
    private $addressMaps;
    private $status;
    private $user;
    private $url;
    private $systemUserIdPermission;
    private $dateInsert;
    private $dateUpdate;
    private $counterView;
    private $session;
    private $region;


    public function __construct()
    {

        $this->setTable("event");
        $this->setImgFolder("event_cover");
        $this->setPrimaryKey("event_id");
        $this->url = new SystemUrl();
        $this->url()->entity()->setId(3);

    }


    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("event_name", $this->getName());
        $sql->setRowData("event_description", $this->getDescription());
        $sql->setRowData("event_local", $this->getLocal());
        $sql->setRowData("event_date", $this->getDate());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("event_address", $this->getAddress());
        $sql->setRowData("event_address_maps", $this->getAddressMaps());
        $sql->setRowData("event_status", $this->getStatus());
        $sql->setRowData("system_user_id", $this->user()->getId());
        $sql->setRowData("system_user_id_permission", $this->getSystemUserIdPermission());
        $sql->setRowData("event_date_insert", GetData::getCurrentTime());
        $sql->setRowData("event_category_id_fk", $this->category()->getId());
        $sql->setRowData("system_url_id_fk", $this->url()->getId());
        $sql->setRowData("event_roof", $this->getRoof());
        $sql->setRowData("session", session_id());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('event_id', '=', "{$this->getId()}"));

        $sql->setRowData("event_name", $this->getName());
        $sql->setRowData("event_description", $this->getDescription());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("event_local", $this->getLocal());
        $sql->setRowData("event_date", $this->getDate());
        $sql->setRowData("event_cover", $this->getCover());
        $sql->setRowData("event_address", $this->getAddress());
        $sql->setRowData("event_address_maps", $this->getAddressMaps());
        $sql->setRowData("event_category_id_fk", $this->category()->getId());
        $sql->setRowData("event_roof", $this->getRoof());
        $sql->setRowData("event_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function editRoof($galleryId)
    {

        $gal = new Gallery();
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $gal->load($galleryId);
        $criteria->add($this->filter('event_id', '=', "{$gal->event()->getId()}"));

        $sql->setRowData("event_roof_cover", $gal->getFile());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function editCounterVIew($systemUrl)
    {

        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $this->loadUrl($systemUrl);
        $this->setCounterView($this->getCounterView() + 1);


        $criteria->add($this->filter('event_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_counter_view", $this->getCounterView());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function editCover()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('event_id', '=', "{$this->getId()}"));
        $sql->setRowData("event_cover", $this->getCover());


        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function editStatus()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('event_id', '=', "{$this->getId()}"));

        $sql->setRowData("event_status", $this->getStatus());
        $sql->setRowData("system_user_id_permission", $this->getSystemUserIdPermission());

        $sql->setCriteria($criteria);

        return $sql->execute();
    }


    public function select($criteria = null, $col = null)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");

        return $sql->execute();
    }

    public function selectMix($criteria = null, $col = null)
    {

        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk", "left");

        return $sql->execute();

    }

    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('event_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);
        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");


        $sql->addColumn("*");
        $res = $sql->execute();

        $this->carregar($res);


        return $res;
    }


    public function loadDisplay($url)
    {

        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('system_url_url', '=', $url));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");


        $sql->addColumn("*");
        $res = $sql->execute();
        $this->carregar($res);

        if ($this->getStatus() != 3) {

            if ($this->validateByUser($this->getId())) {
                return true;

            }

        } else {

            return true;
        }


        return $res;
    }


    public function loadUrl($systemUrl)
    {

        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('system_url_url', '=', $systemUrl));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");


        $sql->addColumn("*");
        $this->carregar($sql->execute());

        if ($this->getStatus() != 3) {

            $this->validateByUser($this->getId());

        }


    }

    public function carregar($res)
    {
        if ($res) {

            $res = $res[0];

            if (isset($res["event_id"]))
                $this->setId($res["event_id"]);

            if (isset($res["event_name"]))
                $this->setName($res["event_name"]);

            if (isset($res["event_description"]))
                $this->setDescription($res["event_description"]);

            if (isset($res["event_local"]))
                $this->setLocal($res["event_local"]);

            if (isset($res["event_date"]))
                $this->setDate($res["event_date"]);

            if (isset($res["event_cover"]))
                $this->setCover($res["event_cover"]);

            if (isset($res["geo_region_name"]))
                $this->region()->setName($res["geo_region_name"]);

            if (isset($res["geo_region_id"]))
                $this->region()->setId($res["geo_region_id"]);

            if (isset($res["event_address"]))
                $this->setAddress($res["event_address"]);
            if (isset($res["event_address_maps"]))
                $this->setAddressMaps($res["event_address_maps"]);

            if (isset($res["event_status"]))
                $this->setStatus($res["event_status"]);

            if (isset($res["event_counter_view"]))
                $this->setCounterView($res["event_counter_view"]);

            if (isset($res["event_date_insert"]))
                $this->setDateInsert($res["event_date_insert"]);

            if (isset($res["event_date_update"]))
                $this->setDateUpdate($res["event_date_update"]);

            if (isset($res["event_category_id"]))
                $this->category()->setId($res["event_category_id"]);

            if (isset($res["event_category_name"]))
                $this->category()->setName($res["event_category_name"]);

            if (isset($res["event_roof"]))
                $this->setRoof($res["event_roof"]);

            if (isset($res["event_roof_cover"]))
                $this->setRoofCover($res["event_roof_cover"]);

            if (isset($res["system_url_id"]))
                $this->url()->setId($res["system_url_id"]);

            if (isset($res["system_url_url"]))
                $this->url()->setUrl($res["system_url_url"]);

            if (isset($res["system_url_url"]))
                $this->user()->setId($res["system_url_url"]);

            if (isset($res["system_user_id_permission"]))
                $this->setSystemUserIdPermission($res["system_user_id_permission"]);
        }
    }

    public function validateByUser($eventId)
    {
        $this->setId($eventId);
        $sql = $this->sqlSelect();
        $regionUser = new RegionUserPermission();
        $criteria1 = $this->criteria();
        $criRegion = $regionUser->createCriteria("event", "event_relationship_geo_region.geo_region_id_fk");
        $criteria2 = $this->criteria();

        $criteria1->add($this->filter("event.event_id", "=", $this->getId()));
        $criteria2->setProperty("limit", "1");
        $criteria2->add($criteria1);
        $criteria2->add($criRegion);

        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk");

        $sql->addColumn("event_id");

        $sql->setCriteria($criteria2);

        $result = $sql->execute();

        if ($result) {
            $this->load($result[0]["event_id"]);
        }
        return $result;
    }


    public function search($arg)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $cri4 = $this->criteria();
        $geoRegion = new RegionRelationshipParent();

        $cri->add($this->filter("event_status", "=", 3));

        $cri2->add($this->filter("event_category_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);
        $cri2->add($this->filter("event_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);

        $cri3 = $geoRegion->createCriteriaByRegion(Region::define(), "event_relationship_geo_region.geo_region_id_fk");

        $cri4->add($cri);
        $cri4->add($cri2);
        $cri4->add($cri3);
        $cri4->setProperty("order", "event_date DESC");
        $sql->setCriteria($cri4);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk", "left");


        return $sql->execute();
    }


    public function eventWeek($col)
    {

        $sql = $this->sqlSelect();

        $geoRegionRelationParent = new RegionRelationshipParent();

        $cri = $geoRegionRelationParent->createCriteriaByRegion(Region::define(), "event_relationship_geo_region.geo_region_id_fk");

        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $cri2->add($this->filter("event_status", "=", 3));
        $cri2->add($this->filter("event_date", "<=", DataFormat::dateAdvanced(GetData::getCurrentTime(), 7)));
        $cri2->add($this->filter("event_date", ">=", DataFormat::dateAdvanced(GetData::getCurrentStartDay(), 1)));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");
        $sql->setCriteria($cri3);

        $sql->addColumn($col);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk", "left");
        return $sql->execute();


    }

    public function eventsDay($col)
    {

        $sql = $this->sqlSelect();

        $geoRegionRelationParent = new RegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(Region::define(), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $cri2->add($this->filter("event_status", "=", 3));
        $cri2->add($this->filter("event_date", ">=", GetData::getCurrentUrl()));
        $cri2->add($this->filter("event_date", "<=", GetData::getCurrentTime()));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");

        $sql->setCriteria($cri3);
        $sql->addColumn($col);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk", "left");
        return $sql->execute();

    }

    public function eventsRoof($col)
    {
        $sql = $this->sqlSelect();
        $geoRegionRelationParent = new RegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(Region::define(), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $cri2->add($this->filter("event_status", "=", 3));
        $cri2->add($this->filter("event_roof", "=", 1));
        $cri2->add($this->filter("event_date", "<=", DataFormat::dateAdvanced(GetData::getCurrentStartDay(), 1)));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");
        $cri3->setProperty("limit", "9");


        $sql->addColumn($col);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk", "left");
        $sql->setCriteria($cri3);

        return $sql->execute();
    }

    public function eventNext($col)
    {
        $sql = $this->sqlSelect();
        $geoRegionRelationParent = new RegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(Region::define(), "event_relationship_geo_region.geo_region_id_fk");
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $cri2->add($this->filter("event_status", "=", 3));
        $cri2->add($this->filter("event_date", ">=", DataFormat::dateAdvanced(GetData::getCurrentStartDay(), 8)));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("order", "event_date DESC");
        $sql->setCriteria($cri3);
        $sql->addColumn($col);

        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event", "event_relationship_geo_region", "event_id", "event_id_fk", "left");
        return $sql->execute();
    }


    /**
     * @return SystemUrl
     */
    public function url()
    {
        $this->url = $this->url ? $this->url : new SystemUrl();


        return $this->url;
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
     * @param mixed $geoCity
     */

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getRoofCover()
    {
        return $this->roofCover;
    }

    /**
     * @param mixed $roofCover
     */
    public function setRoofCover($roofCover)
    {
        $this->roofCover = $roofCover;
    }


    /**
     * @return mixed
     */
    public function getRoof()
    {
        return $this->roof;
    }

    /**
     * @param mixed $roof
     */
    public function setRoof($roof)
    {
        $this->roof = $roof;
    }

    /**
     * @return mixed
     */
    public function getCounterView()
    {
        return $this->counterView;
    }

    /**
     * @param mixed $counterView
     */
    public function setCounterView($counterView)
    {
        $this->counterView = $counterView;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param mixed $local
     */
    public function setLocal($local)
    {
        $this->local = $local;
    }


    public function getDate($addT = false)
    {

        if ($addT) {

            return $this->date = str_replace(" ", "T", $this->date);

        } else {
            return $this->date;
        }

    }

    public function setDate($eventDate, $removeT = false)
    {
        if ($removeT) {
            $this->date = str_replace("T", " ", $eventDate);
            if (strlen($this->date) == 16) {

                $this->date .= ":00";
            }


        } else {
            $this->date = $eventDate;
        }
    }

    /**
     * @return Category
     */
    public function category()
    {
        $this->category = $this->category ? $this->category : new Category();

        return $this->category;
    }


    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddressMaps()
    {
        return $this->addressMaps;
    }

    /**
     * @param mixed $addressMaps
     */
    public function setAddressMaps($addressMaps)
    {
        $this->addressMaps = $addressMaps;
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
    public function getSystemUserIdPermission()
    {
        return $this->systemUserIdPermission;
    }

    /**
     * @param mixed $systemUserIdPermission
     */
    public function setSystemUserIdPermission($systemUserIdPermission)
    {
        $this->systemUserIdPermission = $systemUserIdPermission;
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