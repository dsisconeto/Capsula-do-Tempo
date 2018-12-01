<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 20/07/2016
 * Time: 14:15
 */
sysLoadClass("ModelSystem");

class ActionSystem extends ModelSystem
{


    public function sqlSelect(Criteria $criteria)
    {
        $sql = new SqlSelect();
        $sql->setEntity("system");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        
        return $this->runSelect($sql);
    }


}