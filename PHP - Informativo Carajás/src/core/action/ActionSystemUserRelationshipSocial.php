<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 09/04/16
 * Time: 19:22
 */
class ActionSystemUserRelationshipSocial extends ModelSystemUserRelationshipSocial
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("system_user_relationship_social");

        $sql->setRowData("system_user_id", $this->getSystemUserId());
        $sql->setRowData("system_social_network_id", $this->getSystemSocialNetworkId());

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("system_user_relationship_social");
        $cri = new Criteria();
        $cri->add(new Filter("system_user_id", "=", $this->getSystemUserId()));
        $cri->add(new Filter("system_social_network_id", "=", $this->getSystemSocialNetworkId()));
        $sql->setCriteria($cri);

        return $this->runQuery($sql);
    }


    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("system_user_relationship_social");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        return $this->runSelect($sql);
    }


}