<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 15:15
 */

sysLoadClass("ModelCompanyEmail");

class ActionCompanyEmail extends ModelCompanyEmail
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_email");
        $sql->setRowData("company_department_id_fk", $this->getCompanyDepartmentIdFk());
        $sql->setRowData("company_email", $this->getCompanyEmail());
        $sql->setRowData("company_email_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('company_email');
        $criteria->add(New Filter('company_email_id', '=', "{$this->getCompanyEmailId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_department_id_fk", $this->getCompanyDepartmentIdFk());
        $sql->setRowData("company_email", $this->getCompanyEmail());
        $sql->setRowData("company_email_date_update", $this->currentTime());
        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $cri = new Criteria();

        $cri->add(New Filter('company_email_id', '=', "{$this->getCompanyEmailId()}"));

        $sql->setEntity("company_email");
        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_email");

        $sql->setJoin("company_email", "company_department", "company_department_id_fk", "company_department_id");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");

        $sql->addColumn($col);
        $sql->setCriteria($criteria);

        return $this->runSelect($sql);
    }

    public function sqlLoad($companyEmailId)
    {

        $criteria = new Criteria();
        $criteria->add(New Filter('company_email_id', '=', $companyEmailId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        if ($res):
            $res = $res[0];
            $this->setCompanyEmailId($res["company_email_id"]);
            $this->setCompanyEmail($res["company_email"]);
            $this->setCompanyDepartmentIdFk($res["company_department_id_fk"]);
            $this->setCompanyEmailDateUpdate($res["company_email_date_update"]);
            $this->setCompanyEmailDateInsert($res["company_email_date_insert"]);

        endif;

        return $res;
    }


}