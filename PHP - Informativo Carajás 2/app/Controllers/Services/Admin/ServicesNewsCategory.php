<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 09/05/17
 * Time: 18:25
 */

namespace App\Controllers\Services\Admin;


use App\Models\News\RelationshipUserCategory;
use App\Models\User\Login;
use DSisconeto\Simple\Request;

class ServicesNewsCategory
{


    public function __construct()
    {

        Login::validateServices(Request::cookie("jwt"), array(1));
    }


    public function byUser()
    {

        $relation = new RelationshipUserCategory();

        return $relation->relatedToUser();
    }


}