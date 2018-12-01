<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/04/16
 * Time: 16:31
 */
class ActionPartner extends ModelPartner
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("partner");


        $sql->setRowData("partner_name", $this->getPartnerName());
        $sql->setRowData("partner_cpf_cnpj", $this->getPartnerCpfOrCnpj());
        $sql->setRowData("system_user_id", $this->getSystemUserId());
        $sql->setRowData("system_user_id_register", $this->getSystemUserIdRegister());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('partner');
        $criteria->add(New Filter('partner_id', '=', "{$this->getPartnerId()}"));

        $sql->setRowData("partner_name", $this->getPartnerName());
        $sql->setRowData("partner_cpf_cnpj", $this->getPartnerCpfOrCnpj());
        $sql->setRowData("partner_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("partner");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($partnerId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('partner_id', '=', $partnerId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];

            $this->setPartnerId($res["partner_id"]);
            $this->setPartnerName($res["partner_name"]);
            $this->setPartnerCpfOrCnpj($res["partner_cpf_cpnj"]);
            $this->setSystemUserId($res["system_user_id"]);
            $this->setSystemUserIdRegister($res["system_user_id_register"]);
            $this->setPartnerDateInsert($res["partner_date_insert"]);
            $this->setPartnerDateUpdate($res["partner_date_update"]);

        endif;

        return $res;
    }


}