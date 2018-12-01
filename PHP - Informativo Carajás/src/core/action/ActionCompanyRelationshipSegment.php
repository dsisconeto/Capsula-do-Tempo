<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 16:22
 */
sysLoadClass("ModelCompanyRelationshipSegment");

class ActionCompanyRelationshipSegment extends ModelCompanyRelationshipSegment
{


    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_relationship_segment");

        $sql->setRowData("company_id_fk", $this->getCompanyIdFk());
        $sql->setRowData("company_segment_id_fk", $this->getCompanySegmentIdFk());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("company_relationship_segment");
        $cri = new Criteria();

        $cri->add(New Filter('company_id_fk', '=', $this->getCompanyIdFk()));
        $cri->add(New Filter('company_segment_id_fk', '=', $this->getCompanySegmentIdFk()));

        $sql->setCriteria($cri);

        return $this->runQuery($sql);


    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_relationship_segment");
        $sql->addColumn($col);

        $sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id");

        $sql->setCriteria($criteria);

        return $this->runSelect($sql);
    }


}