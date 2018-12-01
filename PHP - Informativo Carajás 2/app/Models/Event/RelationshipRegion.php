<?php

namespace App\Models\Event;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\Geo\RegionUserPermission;
use DSisconeto\Simple\Model;

class RelationshipRegion extends Model
{

    private $event;
    private $region;

    public function __construct()
    {
        $this->setTable("event_relationship_geo_region");
        $this->event = new Event();
        $this->region = new Region();
    }


    public function register($eventId, $regions)
    {

        $geoRegion = new RegionRelationshipParent();
        $regionUser = new RegionUserPermission();
        $count = 0;
        $this->event()->setId($eventId);

        $regions = $geoRegion->validateRegion($regions);

        if (($regions)) {

            $this->beginTransaction();
            $this->deleteByEvent($this->event()->getId());
            try {
                foreach ($regions as $key) {

                    $this->region()->setId($key["geo_region_id"]);
                    if ($regionUser->validatePermission($this->region()->getId(), "event")) {

                        $sql = $this->sqlInsert();
                        $sql->setRowData("event_id_fk", $this->event()->getId());
                        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
                        if ($sql->execute()) $count++;
                    }
                }
                if ($count > 0) {
                    $this->commit();
                }
            } catch (\Exception $e) {

                if ($count > 0) {

                    return true;

                } else {

                    $this->rollBack();

                    return false;
                }
            }

        } else {
            $this->rollBack();
            return false;
        }


        if ($count > 0) {
            return true;
        } else {
            $this->rollBack();
            return false;
        }

    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter("event_category_id_fk", "=", $this->region()->getId()));
        $criteria->add($this->filter("event_id_fk", "=", $this->event()->getId()));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }


    public function deleteByEvent($eventId)
    {
        if ($this->event()->validateByUser($eventId)) {

            $sql = $this->sqlDelete();
            $criteria = $this->criteria();

            $criteria->add($this->filter("event_id_fk", "=", $this->event()->getId()));

            $sql->setCriteria($criteria);

            return $sql->execute();
        }

        return false;

    }


    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");

        $sql->setJoin("event_relationship_geo_region", "geo_region", "geo_region_id_fk", "geo_region_id");
        $sql->setJoin("event_relationship_geo_region", "event", "event_id_fk", "event_id");
        $sql->setJoin("event", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("event", "event_category", "event_category_id_fk", "event_category_id");


        return $sql->execute();
    }


    public function selectByEvent($eventId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri->add($this->filter("event_id_fk", "=", $eventId));
        $cri->setProperty("order", "geo_region_name ASC");

        $sql->setCriteria($cri);

        $sql->addColumn("geo_region_id");
        $sql->addColumn("geo_region_name");

        $sql->setJoin("event_relationship_geo_region", "geo_region", "geo_region_id_fk", "geo_region_id");


        return $sql->execute();
    }


    /**
     * @return Event
     */
    public function event()
    {


        return $this->event;
    }


    /**
     * @return Region
     */
    public function region()
    {
        return $this->region;
    }

}