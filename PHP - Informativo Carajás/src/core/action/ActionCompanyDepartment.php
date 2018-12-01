<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 14:59
 */
sysLoadClass("ModelCompanyDepartment");

class ActionCompanyDepartment extends ModelCompanyDepartment
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_department");


        $sql->setRowData("company_id_fk", $this->getCompanyIdFk());

        $sql->setRowData("company_department_name", $this->getCompanyDepartmentName());
        $sql->setRowData("company_department_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('company_department');
        $criteria->add(New Filter('company_department_id', '=', "{$this->getCompanyDepartmentId()}"));
        $sql->setCriteria($criteria);

        $sql->setRowData("company_department_name", $this->getCompanyDepartmentName());
        $sql->setRowData("company_department_date_update", $this->currentTime());

        return $this->runQuery($sql);

    }


    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();
        $sql->setEntity('company_department');

        $criteria->add(New Filter('company_department_id', '=', "{$this->getCompanyDepartmentId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);


    }

    public function sqlSelect(Criteria $criteria, $column = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_department");

        $sql->addColumn($column);

        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");

        $sql->setCriteria($criteria);

        return $this->runSelect($sql);
    }

    public function sqlLoad($companyDepartmentId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_department_id', '=', $companyDepartmentId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setCompanyDepartmentId($res["company_department_id"]);
            $this->setCompanyIdFk($res["company_id_fk"]);
            $this->setCompanyDepartmentName($res["company_department_name"]);
            $this->setCompanyDepartmentDateInsert($res["company_department_date_insert"]);
            $this->setCompanyDepartmentDateUpdate($res["company_department_date_update"]);

        endif;

        return $res;
    }


}