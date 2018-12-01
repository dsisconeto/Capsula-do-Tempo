<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/04/16
 * Time: 16:31
 */
sysLoadClass("ModelCompanySocialNetwork");

class ActionCompanySocialNetwork extends ModelCompanySocialNetwork
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("company_social_network");

        $sql->setRowData("company_id_fk", $this->getCompanyIdFk());
        $sql->setRowData("system_social_network_id_fk", $this->getSystemSocialNetworkIdFk());
        $sql->setRowData("company_social_network_link", $this->getCompanySocialNetworkLink());
        $sql->setRowData("company_social_network_date_insert", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('company_social_network');
        $criteria->add(New Filter('company_social_network_id', '=', "{$this->getCompanySocialNetworkId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_social_network_link", $this->getCompanySocialNetworkLink());
        $sql->setRowData("company_social_network_date_update", $this->currentTime());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {


        $sql = new SqlDelete();
        $sql->setEntity("company_social_network");
        $cri = new Criteria();
        $cri->add(New Filter('company_social_network_id', '=', $this->getCompanySocialNetworkId()));
        $sql->setCriteria($cri);

        return $this->runQuery($sql);


    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("company_social_network");
        $sql->addColumn($col);
        $sql->setJoin("company_social_network", "system_social_network", "system_social_network_id_fk", "system_social_network_id");

        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($companySocialNetworkId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('company_social_network_id', '=', $companySocialNetworkId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);

        if ($res):
            $res = $res[0];
            $this->setCompanySocialNetworkId($res["company_social_network_id"]);
            $this->setCompanyIdFk($res["company_id_fk"]);
            $this->setSystemSocialNetworkIdFk($res["system_social_network_id_fk"]);
            $this->setCompanySocialNetworkLink($res["company_social_network_link"]);
            $this->setCompanySocialNetworkDateInsert($res["company_social_network_date_insert"]);
            $this->setCompanySocialNetworkDateUpdate($res["company_social_network_date_update"]);

        endif;

        return $res;
    }


}