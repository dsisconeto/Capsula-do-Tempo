<?php

namespace App\Models\Company;

use App\Models\Geo\City;
use DSisconeto\Simple\Model;

class Featured extends Model
{


    private $id;
    private $segment;
    private $company;
    private $city;
    private $companyFeaturedOrder;



    public function __construct()
    {
        $this->setTable("company_featured");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_segment_id_fk", $this->company()->getId());
        $sql->setRowData("geo_city_id_fk", $this->city()->getId());
        $sql->setRowData("company_id_fk", $this->company()->getId());
        $sql->setRowData("company_featured_order", $this->getCompanyFeaturedOrder());


        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_featured_id', '=', "{$this->getId()}"));

        $sql->setRowData("company_featured_order", $this->getCompanyFeaturedOrder());

        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");
        $criteria = $this->criteria();
        $criteria->setProperty("order", "company_featured_name ASC");

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_featured_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();


        if ($res):
            $res = $res[0];
            $this->setId($res["company_featured_id"]);
            $this->segment()->setId($res["company_segment_id"]);
            $this->city()->setId($res["geo_city_id"]);
            $this->company()->setId($res["company_id"]);
            $this->setCompanyFeaturedOrder($res["company_featured_order"]);
        endif;

        return $res;
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
     * @return Segment
     */
    public function segment()
    {
        $this->segment = $this->segment ? $this->segment : new Segment();

        return $this->segment;
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
     * @return City
     */
    public function city()
    {
        $this->city = $this->city ? $this->city : new City();

        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getCompanyFeaturedOrder()
    {
        return $this->companyFeaturedOrder;
    }

    /**
     * @param mixed $companyFeaturedOrder
     */
    public function setCompanyFeaturedOrder($companyFeaturedOrder)
    {
        $this->companyFeaturedOrder = $companyFeaturedOrder;
    }

}