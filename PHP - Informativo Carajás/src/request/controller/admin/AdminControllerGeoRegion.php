<?php

sysLoadClass("GeoRegion");
sysLoadClass("SystemConfigGeoRegion");

class AdminControllerGeoRegion extends DjView
{

    public function config()
    {


        $geoRegion = new GeoRegion();
        $system = new SystemConfigGeoRegion();

        if (($geoRegion->sqlLoad(DjRequest::get("geo_region_id", "int")))) {

            $this->setDate("geoRegionId", $geoRegion->getId());
            $this->setDate("geoRegionName", $geoRegion->getName());

            if ($system->sqlLoadByGeoRegion($geoRegion->getId())) {

                $this->setDate("companyView", $system->getCompanyView());
                $this->setDate("eventView", $system->getEventView());
                $this->setDate("newspaperView", $system->getNewspaperView());

            } else {

                $this->setDate("companyView", 0);
                $this->setDate("eventView", 0);
                $this->setDate("newspaperView", 0);
            }

            $this->view("admin.geoRegion@config");

        } else {
            $this->location("admin/");
        }

    }


    public function addRelationship()
    {
        $geoRegion = new GeoRegion();
        if (($geoRegion->sqlLoad(DjRequest::get("geo_region_id"))) && $geoRegion->getLevel() >= 2) {

            $this->setDate("geoRegionId", $geoRegion->getId());
            $this->setDate("geoRegionName", $geoRegion->getName());
            $this->setDate("select2", true);

            $this->view("admin.geoRegion@relationshipParentAdd");

        } else {

            $this->location("admin/regiao/todas/");

        }


    }

    public function displayTable()
    {


        $this->view("admin.geoRegion@displayTable");

    }
}