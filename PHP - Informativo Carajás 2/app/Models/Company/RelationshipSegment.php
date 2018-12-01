<?php

namespace App\Models\Company;

use DSisconeto\Simple\Model;

class RelationshipSegment extends Model
{

    private $company;
    private $segment;


    public function __construct()
    {
        $this->setTable("company_relationship_segment");
    }



    public function edit(){}


    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_id_fk", $this->company()->getId());
        $sql->setRowData("company_segment_id_fk", $this->segment()->getId());


        return $sql->execute();
    }


    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_id_fk', '=', $this->company()->getId()));
        $criteria->add($this->filter('company_segment_id_fk', '=', $this->segment()->getId()));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function selectAll()
    {
        $sql = $this->sqlSelect();
        $sql->addColumn("*");
        $sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id");

        return $sql->execute();
    }


    public function selectByCompany($companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();

        $cri->add($this->filter("company_id_fk", "=", $companyId));

        $sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id");

        $sql->addColumn("company_segment_name");
        $sql->addColumn("company_segment_id");
        $sql->addColumn("company_id_fk");

        $sql->setCriteria($cri);
        return $sql->execute();

    }


    public function issetRelation($companySegmentId, $companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri->add($this->filter("company_id_fk", "=", $companyId));
        $cri->add($this->filter("company_segment_id_fk", "=", $companySegmentId));
        $cri->setProperty("limit", "1");
        $sql->setCriteria($cri);

        return $sql->execute();
    }


    public function validateByUser($companyId)
    {
        return $this->company()->validateByUser($companyId);
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
     * @return Segment
     */
    public function segment()
    {

        $this->segment = $this->segment ? $this->segment : new Segment();

        return $this->segment;
    }

}