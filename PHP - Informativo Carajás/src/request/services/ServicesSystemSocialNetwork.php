<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 31/08/16
 * Time: 15:02
 */

sysLoadClass("SystemSocialNetwork");


class ServicesSystemSocialNetwork
{

    public function selectOrderByName()
    {

        $social = new SystemSocialNetwork();

        $cri = new Criteria();
        $cri->setProperty("order", "system_social_network_name ASC");
        $col[] = "system_social_network_name";
        $col[] = "system_social_network_id";
        $col[] = "system_social_network_icon";
        $col[] = "system_social_network_color";

        return $social->sqlSelect($cri, $col);

    }


}