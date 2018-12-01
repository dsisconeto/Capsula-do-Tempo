<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/05/16
 * Time: 21:29
 */
sysLoadClass("ActionGeoRegion");

/**
 * Class GeoRegion
 */
class GeoRegion extends ActionGeoRegion

{


    public function __construct()
    {


    }


    public function regionLevel($id)
    {

        $cri = new Criteria();
        $cri->add(new Filter("geo_region_id", "=", $id));
        $cri->setProperty("limit", "1");
        $col[] = "geo_region_level";
        $res = $this->sqlSelect($cri, $col);

        if ($res) {
            return $res[0]["geo_region_level"];
        } else {
            return 0;

        }
    }


    /**
     * @param string $order
     * @return array
     */
    public function selectOrderByName($order = "ASC")
    {
        if ($order != "DESC"):
        else:
            $order = "ASC";
        endif;

        $cri = new Criteria();
        $cri->setProperty("order", "geo_region_name " . $order);

        return $this->sqlSelect($cri);
    }


}