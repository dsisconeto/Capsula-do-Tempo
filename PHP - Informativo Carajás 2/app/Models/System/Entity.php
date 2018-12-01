<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 13/06/17
 * Time: 09:40
 */

namespace App\Models\System;


use DSisconeto\Simple\Model;

class Entity extends Model
{

    private $name;

    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}