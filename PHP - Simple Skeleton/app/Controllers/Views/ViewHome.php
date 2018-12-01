<?php

namespace App\Controllers\Views;

use DSisconeto\Simple\View;


class ViewHome extends View
{


    public function index()
    {
        $this->setData("title", "Hello World Simple :)");

        $this->view("home");
    }

}