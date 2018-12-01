<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 22/04/16
 * Time: 19:18
 */
sysLoadClass("ActionGeoState");
sysLoadClass("GeoCity");

class GeoState extends ActionGeoState
{

    public function __construct()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Lista de Estados Permitidos", true, 10);
    }


    public function selectForUserNews()
    {
        $login = new SystemLogin();

        if ($login->validateLogIn()):
            $geoCity = new GeoCity();

            $cri = new Criteria();
            $cri->setProperty("order", "geo_city_name");
            $resCity = $geoCity->sqlSelect($cri);

            $cri = new Criteria();
            $cri->setProperty("order", "geo_state_name");
            $resState = $this->sqlSelect($cri);

            $userCity = new NewsRelationshipUserGeoCity();
            $cri = new Criteria();
            $cri->add(new Filter("system_user_id", "=", $login->getSystemUserId()));
            $resRelation = $userCity->sqlSelect($cri);
            $count = 0;
            foreach ($resState as $keyState):
                foreach ($resCity as $keyCity):

                    if ($keyCity["geo_state_id"] == $keyState["geo_state_id"]):

                        foreach ($resRelation as $keyRelation):

                            if ($keyCity["geo_city_id"] == $keyRelation["geo_city_id"]):

                                if (!isset($index[$keyState["geo_state_id"]])):
                                    $res[$count]["geo_state_id"] = $keyState["geo_state_id"];
                                    $res[$count]["geo_state_name"] = $keyState["geo_state_name"];
                                    $index[$keyState["geo_state_id"]] = true;
                                    $count++;
                                endif;

                            endif;
                        endforeach;

                    endif;

                endforeach;

            endforeach;


            if (isset($res)):
                $this->setReturn(10, $res);
            else:
                $this->setReturn(1);
            endif;
        else:
            $this->setReturn(1);
        endif;

        return $this->getReturn();
    }

    
    public function searchNameBy($geoStateName)
    {
        $cri = new Criteria();
        $cri->setProperty("order", "geo_state_name ASC");
        $cri->add(New Filter("geo_state_name", "like", "%{$geoStateName}%"));
        return $this->sqlSelect($cri);
    }

}