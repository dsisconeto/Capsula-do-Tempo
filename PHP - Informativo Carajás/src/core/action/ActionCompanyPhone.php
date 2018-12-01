<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 15:56
 */
sysLoadClass("ModelCompanyPhone");

class ActionCompanyPhone extends ModelCompanyPhone
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_phone");

        $sql->setRowData("company_department_id_fk", $this->getCompanyDepartmentIdFk());
        $sql->setRowData("company_phone", $this->getCompanyPhone());
        $sql->setRowData("company_phone_dd", $this->getCompanyPhoneDd());
        $sql->setRowData("company_phone_type", $this->getCompanyPhoneType());
        $sql->setRowData("company_phone_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('company_phone');
        $criteria->add(New Filter('company_phone_id', '=', "{$this->getCompanyPhoneId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_phone", $this->getCompanyPhone());
        $sql->setRowData("company_department_id_fk", $this->getCompanyDepartmentIdFk());
        $sql->setRowData("company_phone_date_update", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $sql->setEntity("company_phone");
        $cri = new Criteria();
        $cri->add(New Filter('company_phone_id', '=', $this->getCompanyPhoneId()));
        
        $sql->setCriteria($cri);
        return $this->runQuery($sql);


    }

    public function sqlSelect($criteria = null, $column = false)
    {
        $sql = new SqlSelect();
        
        $sql->setEntity("company_phone");
        $sql->addColumn($column);

        $sql->setJoin("company_phone", "company_department", "company_department_id_fk", "company_department_id");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");

        if ($criteria):

            $sql->setCriteria($criteria);

        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($companyPhoneId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_phone_id', '=', $companyPhoneId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        if ($res):
            $res = $res[0];
            $this->setCompanyPhoneId($res["company_phone_id"]);
            $this->setCompanyDepartmentIdFk($res["company_department_id_fk"]);
            $this->setCompanyPhone($res["company_phone"]);
            $this->setCompanyPhoneDateInsert($res["company_phone_date_insert"]);
            $this->setCompanyPhoneDateUpdate($res["company_phone_date_update"]);
        endif;

        return $res;
    }


}