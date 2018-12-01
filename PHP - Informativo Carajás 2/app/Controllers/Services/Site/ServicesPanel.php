<?php

namespace App\Controllers\Services\Site;


use App\Models\Geo\Region;
use App\Models\News\Panel;

class ServicesPanel
{


    public function show()
    {
        $panel = new Panel();

        $panel->region()->setId(Region::define());

        $col = array("news_id", "news_title", "news_cover", "system_url_url", "news_category_color", "news_tag_name");

        return ($panel->loadTotal($col, true));
    }


    public function content()
    {
        $panel = new Panel();
        $panel->region()->setId(Region::define());
        $col = array("news_id", "news_title", "news_cover");

        $result = ($panel->loadTotal($col));

        if ($result) {
            return $result;
        } elseif ($panel->region()->issetRegion(Region::define())) {

            for ($i = 1; $i <= $panel->getNumberLocal(); $i++) {
                $panel->local($i)->setId(0);
            }

            $panel->register();
            return ($panel->loadTotal($col));
        }
        return false;
    }
}