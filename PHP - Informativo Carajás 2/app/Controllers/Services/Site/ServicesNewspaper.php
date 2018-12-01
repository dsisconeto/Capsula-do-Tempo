<?php
namespace App\Controllers\Services\Site;

use App\Models\Geo\Region;
use App\Models\Newspaper\Newspaper;
use App\Models\Newspaper\Page;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;

class ServicesNewspaper
{


    public function featAll()
    {
        $newspaper = new Newspaper();

        return $newspaper->search(Region::define());

    }

    public function allPagesByNewspaper()
    {

        $page = new Page();
        return $page->selectByNewspaper(Request::get("newspaper_id", "int", 0));


    }

    public function page()
    {
        $newapeprId = Request::get("newspaper_id", "int", 0);
        $pageNumber = Request::get("newspaper_page_number", "int", 0);
        $page =new Page();

        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id", "=",$newapeprId));
        $cri->add(new Filter("newspaper_page_number", "=",$pageNumber));

        return $page->select($cri);
    }


}