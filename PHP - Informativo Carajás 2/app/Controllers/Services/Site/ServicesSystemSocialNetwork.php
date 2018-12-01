<?php
namespace App\Controllers\Services\Site;

use App\Models\System\SocialNetwork;
use DSisconeto\Simple\DataBase\SQL\Criteria;

class ServicesSystemSocialNetwork
{

    public function selectOrderByName()
    {

        $social = new SocialNetwork();

        $cri = new Criteria();
        $cri->setProperty("order", "system_social_network_name ASC");
        $col[] = "system_social_network_name";
        $col[] = "system_social_network_id";
        $col[] = "system_social_network_icon";
        $col[] = "system_social_network_color";

        return $social->select($cri, $col);

    }


}