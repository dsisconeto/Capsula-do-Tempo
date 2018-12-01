<?php

sysLoadClass("ActionGeoRegionUserPermission");

class GeoRegionUserPermission extends ActionGeoRegionUserPermission
{


    public function selectByUserLogin()
    {
        $login = SystemLogin::getLogin();
        $cri = new Criteria();
        $col[] = "geo_region_id";
        $col[] = "geo_region_name";
        $col[] = "event";
        $col[] = "news";
        $col[] = "company";
        $col[] = "newspaper";
        $col[] = "ads";

        $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserLogin()));


        return $this->sqlSelect($cri, $col);
    }


    public function createCriteria($permissionName, $name = "geo_region_id")
    {


        $login = SystemLogin::getLogin();
        $cri2 = new Criteria();
        $cri1 = new Criteria();
        $permission = new GeoRegionUserPermission();

        $cri1->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));
        $cri1->add(new Filter($this->getPermission($permissionName), "=", 1));
        $res = $permission->sqlSelect($cri1);
        if ($res) {
            foreach ($res as $key) {
                $cri2->add(new Filter($name, "=", $key["geo_region_id_fk"]), Filter::OR_OPERATOR);
            }
        }

        return $cri2;

    }


    public
    function selectOneRegion()
    {


        $cri = new Criteria();
        $login = SystemLogin::getLogin();

        $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));


        $res = $this->sqlSelect($cri);

        if (count($res) == 1) {

            return $res[0]["geo_region_id_fk"];

        } else {

            return false;

        }
    }

    public
    function selectPermission($userId)
    {

        $cri = new Criteria();
        $col[] = "geo_region_id";
        $col[] = "event";
        $col[] = "news";
        $col[] = "company";
        $col[] = "newspaper";
        $col[] = "ads";

        $cri->add(new Filter("system_user_id_fk", "=", $userId));


        $res = $this->sqlSelect($cri, $col);

        $result = array();

        if ($res) {
            foreach ($res as $item) {
                $result[$item["geo_region_id"]]["event"] = $item["event"];
                $result[$item["geo_region_id"]]["news"] = $item["news"];
                $result[$item["geo_region_id"]]["company"] = $item["company"];
                $result[$item["geo_region_id"]]["newspaper"] = $item["newspaper"];
                $result[$item["geo_region_id"]]["ads"] = $item["ads"];
            }

        }

        return $result;
    }


    public
    function selectPermissionByUser($userId, $regionName = "")
    {
        $login = SystemLogin::getLogin();
        $cri = new Criteria();
        $cri2 = New Criteria();
        $result = array();

        $col = array(0 => "geo_region_id", 1 => "geo_region_name", 2 => "event", 3 => "news", 4 => "company", 5 => "newspaper", 6 => "ads");

        //  pegando permissions do usuario logado
        $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));
        $cri->setProperty("order", "geo_region_name ASC");

        if ($regionName) {
            $cri->add(new Filter("geo_region_name", "LIKE", "%$regionName%"));
        }

        $result["user_login"] = $this->sqlSelect($cri, $col);

        // pegando informações do usuario que vai ser editado
        $cri2->add(new Filter("system_user_id_fk", "=", $userId));
        $res = $this->sqlSelect($cri2, $col);
        $result["user"] = array();
        if ($res) {

            foreach ($res as $key) {
                $result["user"][$key["geo_region_id"]]["event"] = $key["event"];
                $result["user"][$key["geo_region_id"]]["news"] = $key["news"];
                $result["user"][$key["geo_region_id"]]["company"] = $key["company"];
                $result["user"][$key["geo_region_id"]]["newspaper"] = $key["newspaper"];
                $result["user"][$key["geo_region_id"]]["ads"] = $key["ads"];
            }

        }

        return $result;
    }


    public
    function issetPermissionRegion($geoRegionId, $userId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("system_user_id_fk", "=", $userId));
        $cri->add(new Filter("geo_region_id", "=", $geoRegionId));


        $col[] = "geo_region_id";
        return boolval($this->sqlSelect($cri, $col));
    }

    public
    function validatePermission($geoRegionId, $permission)
    {
        $cri = new Criteria();
        $login = SystemLogin::getLogin();

        $permission = $this->getPermission($permission);

        if ($permission) {

            $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));
            $cri->add(new Filter("geo_region_id_fk", "=", $geoRegionId));

            $cri->add(new Filter("$permission", "=", 1));

            $col[] = "geo_region_id";

            return boolval($this->sqlSelect($cri, $col));

        } else {
            return false;
        }
    }


    public
    function searchRegion($geoRegionName, $permission, $level = 0)
    {
        // essa função procura as regiões que usuario de permissão por entidade
        $permission = $this->getPermission($permission);
        $cri = new Criteria();
        $login = SystemLogin::getLogin();
        if ($permission && strlen($geoRegionName) > 1) {

            $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));
            $cri->add(new Filter("geo_region_name", "LIKE", "%$geoRegionName%"));
            if ($level) {
                $cri->add(new Filter("geo_region_level", "=", $level));
            }
            $cri->add(new Filter("$permission", "=", 1));
            $col[] = "geo_region_id";
            $col[] = "geo_region_name";
            $cri->setProperty("order", "geo_region_name");
            return $this->sqlSelect($cri, $col);
        } else {
            return array();
        }


    }

    private
    function getPermission($permission)
    {
        switch ($permission) {
            case "event":
                break;
            case "news":
                break;
            case "newspaper":
                break;
            case "company":
                break;
            case "ads":
                break;
            default:
                $permission = false;
        }

        return $permission;
    }


}