<?php

namespace App\Models\Company;

use App\Models\Geo\Region;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Model;

class RelationshipRegion extends Model
{

    private $region;
    private $company;

    public function __construct()
    {
        $this->setTable("company_relationship_geo_region");
    }


    public function edit()
    {
    }


    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_id_fk", $this->company()->getId());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());

        return $sql->execute();
    }


    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();


        $criteria->add($this->filter("company_id_fk", "=", $this->company()->getId()));
        $criteria->add($this->filter("geo_region_id_fk", "=", $this->region()->getId()));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function select($criteria = NULL, $col = NULL)
    {

        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;


        $sql->setJoin("company_relationship_geo_region", "geo_region", "geo_region_id_fk", "geo_region_id");

        return $sql->execute();


    }

    public function selectByCompany()
    {
        $cri = new Criteria();
        $cri->add(new Filter("company_id_fk", "=", $this->company()->getId()));

        $col = array("geo_region.geo_region_id", "geo_region.geo_region_name");
        $result = $this->select($cri, $col);

        return $result;
    }


    public function issetRelationship($geoRegionId, $companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->add($this->filter("company_id_fk", "=", $companyId));
        $cri->add($this->filter("geo_region_Id_fk", "=", $geoRegionId));

        $sql->setCriteria($cri);
        return $sql->execute();
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
     * @return Company
     */
    public function company()
    {
        $this->company = $this->company ? $this->company : new Company();

        return $this->company;
    }


}