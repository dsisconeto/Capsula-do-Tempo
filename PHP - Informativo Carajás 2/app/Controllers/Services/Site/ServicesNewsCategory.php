<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 06/05/17
 * Time: 11:28
 */

namespace App\Controllers\Services\Site;


use App\Models\News\Category;

class ServicesNewsCategory
{

    public function byName()
    {
        $category = new Category();
        return $category->selectAllByName();
    }

}