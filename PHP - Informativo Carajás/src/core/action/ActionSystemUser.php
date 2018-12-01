<?php

sysLoadClass("ModelSystemUser");

class ActionSystemUser extends ModelSystemUser
{
    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("system_user");

        $sql->setRowData("partner_id", $this->getPartnerId());
        $sql->setRowData("system_user_name", $this->getSystemUserName());
        $sql->setRowData("system_user_email", $this->getSystemUserEmail());
        $sql->setRowData("system_user_login", md5($this->getSystemUserLogin()));
        $sql->setRowData("system_user_password", md5($this->getSystemUserPassword()));

        $sql->setRowData("system_user_phone_number", $this->getSystemUserPhoneNumber());
        $sql->setRowData("system_user_description", $this->getSystemUserDescription());

        $sql->setRowData("system_user_permission_event", $this->getSystemUserPermissionEvent());
        $sql->setRowData("system_user_permission_event_category", $this->getSystemUserPermissionEventCategory());
        $sql->setRowData("system_user_permission_event_super", $this->getSystemUserPermissionEventSuper());
        $sql->setRowData("system_user_permission_news", $this->getSystemUserPermissionNews());
        $sql->setRowData("system_user_permission_news_category", $this->getSystemUserPermissionNewsCategory());
        $sql->setRowData("system_user_permission_news_super", $this->getSystemUserPermissionNewsSuper());
        $sql->setRowData("system_user_permission_partner", $this->getSystemUserPermissionPartner());
        $sql->setRowData("system_user_permission_partner_region", $this->getSystemUserPermissionPartnerRegion());
        $sql->setRowData("system_user_permission_user_register", $this->getSystemUserPermissionUserRegister());
        $sql->setRowData("system_user_permission_company", $this->getSystemUserPermissionCompany());
        $sql->setRowData("system_user_permission_geo", $this->getSystemUserPermissionGeo());
        $sql->setRowData("system_user_permission_ads", $this->getSystemUserPermissionAds());
        $sql->setRowData("system_user_permission_newspaper", $this->getSystemUserPermissionNewspaper());
        $sql->setRowData("system_user_id_register", $this->getSystemUserIdRegister());
        $sql->setRowData("system_user_status", $this->getSystemUserStatus());
        $sql->setRowData("system_user_date_insert", $this->currentTime());

        $sql->setRowData("system_user_id_register", $this->getSystemUserIdRegister());
        return $this->runQuery($sql);

    }

    public function sqlUpdate()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('system_user');

        $criteria->add(New Filter('system_user_id', '=', $this->getSystemUserId()));


        $sql->setRowData("system_user_name", $this->getSystemUserName());
        $sql->setRowData("system_user_email", $this->getSystemUserEmail());

        if (strlen($this->getSystemUserLogin()) > 1) {
            $sql->setRowData("system_user_login", md5($this->getSystemUserLogin()));
        }

        if (strlen($this->getSystemUserPassword()) > 1) {

            $sql->setRowData("system_user_password", md5($this->getSystemUserPassword()));
        }

        $sql->setRowData("system_user_phone_number", $this->getSystemUserPhoneNumber());
        $sql->setRowData("system_user_description", $this->getSystemUserDescription());

        $sql->setRowData("system_user_permission_event", $this->getSystemUserPermissionEvent());
        $sql->setRowData("system_user_permission_event_category", $this->getSystemUserPermissionEventCategory());
        $sql->setRowData("system_user_permission_event_super", $this->getSystemUserPermissionEventSuper());
        $sql->setRowData("system_user_permission_news", $this->getSystemUserPermissionNews());
        $sql->setRowData("system_user_permission_news_category", $this->getSystemUserPermissionNewsCategory());
        $sql->setRowData("system_user_permission_news_super", $this->getSystemUserPermissionNewsSuper());
        $sql->setRowData("system_user_permission_partner", $this->getSystemUserPermissionPartner());
        $sql->setRowData("system_user_permission_partner_region", $this->getSystemUserPermissionPartnerRegion());
        $sql->setRowData("system_user_permission_user_register", $this->getSystemUserPermissionUserRegister());
        $sql->setRowData("system_user_permission_company", $this->getSystemUserPermissionCompany());
        $sql->setRowData("system_user_permission_geo", $this->getSystemUserPermissionGeo());
        $sql->setRowData("system_user_permission_ads", $this->getSystemUserPermissionAds());
        $sql->setRowData("system_user_permission_newspaper", $this->getSystemUserPermissionNewspaper());

        $sql->setRowData("system_user_status", $this->getSystemUserStatus());
        $sql->setRowData("system_user_date_update", $this->currentTime());

        $sql->setCriteria($criteria);


        return $this->runQuery($sql);

    }

    public function sqlUpdatePhoto()
    {
        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('system_user');

        $criteria->add(New Filter('system_user_id', '=', $this->getSystemUserId()));


        $sql->setRowData("system_user_profile_photo", $this->getSystemUserProfilePhoto());

        $sql->setRowData("system_user_date_update", $this->currentTime());

        $sql->setCriteria($criteria);


        return $this->runQuery($sql);

    }


    public function sqlUpdatePassword()
    {

        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('system_user');

        $criteria->add(New Filter('system_user_id', '=', $this->getSystemUserId()));

        $sql->setRowData("system_user_password", md5($this->getSystemUserPassword()));
        $sql->setRowData("system_user_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }


    public function sqlUpdateLogin()
    {

        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('system_user');

        $criteria->add(New Filter('system_user_id', '=', $this->getSystemUserId()));

        $sql->setRowData("system_user_login", md5($this->getSystemUserLogin()));
        $sql->setRowData("system_user_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlUpdateProfilePhoto()
    {

        $sql = new SqlUpdate();
        $criteria = new Criteria();
        $sql->setEntity('system_user');

        $criteria->add(New Filter('system_user_id', '=', $this->getSystemUserId()));

        $sql->setRowData("system_user_profile_photo", $this->getSystemUserProfilePhoto());

        $sql->setRowData("system_user_date_update", $this->currentTime());

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);

    }

    public function sqlDelete()
    {

        $sql = new SqlDelete();
        $criteria = new Criteria();

        $sql->setEntity('system_user');

        $criteria->add(New Filter('system_user_id', '=', "{$this->getSystemUserId()}"));

        $sql->setCriteria($criteria);

        return $this->runQuery($sql);
    }


    public function sqlSelect(Criteria $criteria, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("system_user");
        $sql->addColumn($col);
        $sql->setCriteria($criteria);

        return $this->runSelect($sql);
    }

    public function sqlLoad($systemUserId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('system_user_id', '=', $systemUserId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setSystemUserId($res["system_user_id"]);
            $this->setPartnerId($res["partner_id"]);
            $this->setSystemUserName($res["system_user_name"]);
            $this->setSystemUserEmail($res["system_user_email"]);
            $this->setSystemUserLogin($res["system_user_login"]);
            $this->setSystemUserPassword($res["system_user_password"]);
            $this->setSystemUserPhoneNumber($res["system_user_phone_number"]);
            $this->setSystemUserProfilePhoto($res["system_user_profile_photo"]);
            $this->setSystemUserDescription($res["system_user_description"]);
            $this->setSystemUserPermissionAds($res["system_user_permission_ads"]);
            $this->setSystemUserPermissionEvent($res["system_user_permission_event"]);
            $this->setSystemUserPermissionEventCategory($res["system_user_permission_event_category"]);
            $this->setSystemUserPermissionEventSuper($res["system_user_permission_event_super"]);
            $this->setSystemUserPermissionNews($res["system_user_permission_news"]);
            $this->setSystemUserPermissionNewsCategory($res["system_user_permission_news_category"]);
            $this->setSystemUserPermissionNewsSuper($res["system_user_permission_news_super"]);
            $this->setSystemUserPermissionPartner($res["system_user_permission_partner"]);
            $this->setSystemUserPermissionPartnerRegion($res["system_user_permission_partner_region"]);
            $this->setSystemUserPermissionGeo($res["system_user_permission_geo"]);
            $this->setSystemUserPermissionCompany($res["system_user_permission_company"]);
            $this->setSystemUserPermissionUserRegister($res["system_user_permission_user_register"]);
            $this->setSystemUserPermissionNewspaper($res["system_user_permission_newspaper"]);
            $this->setSystemUserStatus($res["system_user_status"]);
            $this->setSystemUserDateInsert($res["system_user_date_insert"]);
            $this->setSystemUserDateUpdate($res["system_user_date_update"]);
            $this->setSystemUserIdRegister($res["system_user_id_register"]);
            $this->setSystemUserCompany($res["system_user_company"]);

        endif;

        return $res;
    }
}
