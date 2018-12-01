<?php

namespace App\Models\Company;

use App\Models\Geo\Region;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;

class RelationshipFeatured extends Model
{
    private $id;
    private $company;
    private $featured;
    private $region;
    private $order;

    public function __construct()
    {
        $this->setTable("company_relationship_featured");
        $this->setPrimaryKey("company_relationship_featured_id");
    }


    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_id_fk", $this->company()->getId());
        $sql->setRowData("company_featured_id_fk", $this->featured()->getId());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("company_relationship_featured_order", $this->getOrder());


        return $sql->execute();
    }

    public function edit()
    {

    }

    public function editSerialize()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('company_relationship_featured_id', '=', "{$this->getId()}"));

        $sql->setRowData("company_relationship_featured_order", $this->getOrder());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->setJoin("company_relationship_featured", "company", "company_id_fk", "company_id");
        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
        $sql->addColumn("*");

        return $sql->execute();

    }


    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();

        return $res;
    }


    public function selectRegion($geoRegion, $companyFeaturedIdFk)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $result = array();
        $count = 0;
        //
        $cri->add($this->filter("company_relationship_featured.geo_region_id_fk", "=", $geoRegion));
        $cri->add($this->filter("company_featured_id_fk", "=", $companyFeaturedIdFk));
        $cri->add($this->filter("company_status", "=", "1"));
        $cri->add($this->filter("company_nivel", ">=", "2"));

        $cri->setProperty("order", "company_relationship_featured_order	ASC");
        $sql->addColumn("*");

        $sql->setJoin("company_relationship_featured", "company", "company_id_fk", "company_id");
        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");

        $sql->setCriteria($cri);
        $res = $sql->execute();
        $phone = new Phone();
        $resPhones = $phone->selectAll();


        if ($res) {

            foreach ($res as $key) {
                $result[$count]["company_relationship_featured_id"] = $key["company_relationship_featured_id"];
                $result[$count]["company_id"] = $key["company_id"];
                $result[$count]["system_url_url"] = $key["system_url_url"];
                $result[$count]["company_fantasy_name"] = $key["company_fantasy_name"];
                $result[$count]["company_address"] = $key["company_address"];
                $result[$count]["company_logo"] = $key["company_logo"];
                foreach ($resPhones as $keyPhone) {

                    if ($keyPhone["company_id_fk"] == $key["company_id"]) {
                        $result[$count]["company_phone"] = DataFormat::phone($keyPhone["company_phone_dd"], $keyPhone["company_phone"]);
                        break;
                    }

                }
                $count++;
            }

        }

        return $result;
    }


    public function issetRelation($geoRegionId, $companyId, $companyFeatured)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $sql->addColumn("company_id_fk");
        $cri->add($this->filter("geo_region_id_fk", "=", $geoRegionId));
        $cri->add($this->filter("company_id_fk", "=", $companyId));
        $cri->add($this->filter("company_featured_id_fk", "=", $companyFeatured));

        $cri->setProperty("order", "company_relationship_featured_order DESC");
        $cri->setProperty("limit", "1");
        $sql->setCriteria($cri);

        return $sql->execute();
    }


    public function lastOrder($geoRegionId, $companyFeatured)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->add($this->filter("geo_region_id_fk", "=", $geoRegionId));
        $cri->add($this->filter("	company_featured_id_fk", "=", $companyFeatured));

        $cri->setProperty("order", "company_relationship_featured_order DESC");
        $cri->setProperty("limit", "1");
        $sql->addColumn("company_relationship_featured_order");

        $sql->setCriteria($cri);

        $rs = $sql->execute();

        if ($rs) {
            return ($rs[0]["company_relationship_featured_order"] + 1);
        } else {
            return 1;
        }

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
     * @return Featured
     */


    public function featured()
    {
        $this->featured = $this->featured ? $this->featured : new Featured();
        return $this->featured;
    }


    /**
     * @return Company
     */
    public function company()
    {
        $this->company = $this->company ? $this->company : new Company();
        return $this->company;
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
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }


}