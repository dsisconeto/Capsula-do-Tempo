<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/04/16
 * Time: 17:21
 */
sysLoadClass("ModelSystemSocialNetwork");
class ActionSystemSocialNetwork extends ModelSystemSocialNetwork
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("system_social_network");

        $sql->setRowData("system_social_network_name", $this->getSystemSocialNetworkName());

        $sql->setRowData("system_social_network_icon", $this->getSystemSocialNetworkIcon());

        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('system_social_network');

        $criteria->add(New Filter('system_social_network_id', '=', "{$this->getSystemSocialNetworkId()}"));
        $sql->setRowData("system_social_network_name", $this->getSystemSocialNetworkName());

        $sql->setRowData("system_social_network_icon", $this->getSystemSocialNetworkIcon());
        $sql->setRowData("system_social_network_date_update", $this->getSystemSocialNetworkIcon());
        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();

        $sql->setEntity('system_social_network');
        $criteria->add(New Filter('system_social_network_id', '=', "{$this->getSystemSocialNetworkId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }

    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("system_social_network");
        $sql->addColumn($col);
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }

    public function sqlLoad($systemSocialNetworkId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('system_social_network_id', '=', $systemSocialNetworkId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setSystemSocialNetworkId($res["system_social_network_id"]);
            $this->setSystemSocialNetworkName($res["system_social_network_name"]);

            $this->setSystemSocialNetworkIcon($res["system_social_network_icon"]);
            $this->setSystemSocialNetworkDateInsert($res["system_social_network_date_insert"]);
            $this->setSystemSocialNetworkDateUpdate($res["system_social_network_date_update"]);

        endif;

        return $res;
    }


}