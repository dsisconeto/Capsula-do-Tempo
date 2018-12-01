<?php

namespace App\Models\Geo;


use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\Request;

class Region extends Model
{

    private $id;
    private $name;
    private $level;
    private static $regionId = null;


    public function __construct()
    {
        $this->setTable("geo_region");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("geo_region_id", $this->getId());
        $sql->setRowData("geo_region_name", $this->getName());
        $sql->setRowData("geo_region_level", $this->getLevel());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('geo_region_id', '=', "{$this->getId()}"));

        $sql->setRowData("geo_region_name", $this->getName());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('geo_region_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");

        return $sql->execute();
    }


    public function selectConfig($criteria)
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");
        $sql->setJoin("geo_region", "system_config_geo_region", "geo_region_id", "geo_region_id_fk");
        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function load($id = false)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();
        if ($id) {
            $criteria->add($this->filter('geo_region_id', '=', $id));
        } else {
            $criteria->add($this->filter('geo_region_id', '=', $this->getId()));
        }
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();
        if ($res):
            $res = $res[0];

            $this->setId($res["geo_region_id"]);
            $this->setName($res["geo_region_name"]);
            $this->setLevel($res["geo_region_level"]);
        endif;
        return $res;
    }


    public function issetRegion($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();
        $criteria->add($this->filter('geo_region_id', '=', $id));
        $sql->setCriteria($criteria);
        $criteria->setProperty("limit", "1");
        $sql->addColumn("COUNT(geo_region_id) as count");

        $res = $sql->execute();


        return $res[0]["count"];
    }


    public function regionLevel($id = false)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        if ($id) {
            $cri->add($this->filter("geo_region_id", "=", $id));
        } else {
            $cri->add($this->filter("geo_region_id", "=", $this->getId()));
        }
        $cri->setProperty("limit", "1");
        $sql->addColumn("geo_region_level");
        $sql->setCriteria($cri);
        $res = $sql->execute();

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
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->setProperty("order", "geo_region_name " . $order);

        $sql->setCriteria($cri);
        $sql->addColumn("*");
        return $sql->execute();
    }


    public static function define()
    {
        if (!self::$regionId) {

            $region = new Region();

            self::$regionId = Request::cookie("geo_region_id", "int", 0);

            if (!$region->issetRegion(self::$regionId)) {

                self::$regionId = Request::get("regiao", "int", 0);

                if (!$region->issetRegion(self::$regionId)) {
                    self::$regionId = 6002;
                } else {

                    $region->load(self::$regionId);
                    Request::setCookie("geo_region_name", $region->getName(), time() + (9460800000));
                    Request::setCookie("geo_region_id", self::$regionId, time() + (9460800000));
                }

            }
        }

        return self::$regionId;
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
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }


}