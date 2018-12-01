<?php

namespace App\Controllers\Services\Admin;

use App\Models\Newspaper\Newspaper;
use App\Models\Newspaper\Page;
use App\Models\User\Login;
use DSisconeto\Simple\Request;

class ServicesNewspaperPage
{



    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"), array(10));
    }

    public function selectAllPagesByNewspaper()
    {
        $page = new Page();
        $newspaper = new Newspaper();
        $id = Request::get("newspaper_id", "int", 0);

        if($newspaper->validateByUser($id)) {


            $col[] = "newspaper_page_id";
            $col[] = "newspaper_page_file";
            $col[] = "newspaper_page_number";


            return $page->selectByNewspaper($id);

        } else {

            return array();
        }
    }


}