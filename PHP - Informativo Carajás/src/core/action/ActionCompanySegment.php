<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 16:25
 */
sysLoadClass("ModelCompanySegment");

class ActionCompanySegment extends ModelCompanySegment
{
    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_segment");

        $sql->setRowData("company_segment_name", $this->getCompanySegmentName());
        $sql->setRowData("company_segment_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('company_segment');
        $criteria->add(New Filter('company_segment_id', '=', "{$this->getCompanySegmentId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_segment_name", $this->getCompanySegmentName());
        $sql->setRowData("company_segment_date_update", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {


        $sql = new SqlDelete();
        $sql->setEntity("company_segment");
        $cri = new Criteria();
        $cri->add(New Filter('company_segment_id', '=', $this->getCompanySegmentId()));
        $sql->setCriteria($cri);

        return $this->runSelect($sql);


    }

    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_segment");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($companySegmentId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_segment_id', '=', $companySegmentId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        if ($res):
            $res = $res[0];
            $this->setCompanySegmentId($res["company_segment_id"]);
            $this->setCompanySegmentName($res["company_segment_name"]);
            $this->setCompanySegmentDateInsert($res["company_segment_date_insert"]);
            $this->setCompanySegmentDateUpdate($res["company_segment_date_update"]);
        endif;

        return $res;
    }


}