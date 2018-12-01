<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 23/06/17
 * Time: 02:45
 */

namespace App\Controllers\Views\Site;


use App\Models\Traffic\ClickAds;
use DSisconeto\Simple\Request;
use Respect\Validation\Validator as respect;


class ViewAds
{

    public function redirect()
    {


        $url = Request::get("url", "str", "");
        $adsId = Request::get("ads_id", "int", 0);
        $continue = Request::get("continue", "str", 0);

        $click = new ClickAds();
        $click->ads()->setId($adsId);
        $click->setUrl($url);

        $click->register();

        if (respect::url()->validate($continue)) {
            header("location:$continue");
            exit();
        }

    }
}