<?php

namespace App\Models\Geo;

use App\Models\User\Login;
use App\Models\User\User;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Model;

class RegionUserPermission extends Model
{
    private $user;
    private $region;
    private $news;
    private $newspaper;
    private $event;
    private $company;
    private $ads;


    public function __construct()
    {
        $this->setTable("geo_region_user_permission");
    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("system_user_id_fk", $this->user()->getId());
        $sql->setRowData("geo_region_id_fk", $this->region()->getId());
        $sql->setRowData("news", $this->getNews());
        $sql->setRowData("newspaper", $this->getNewspaper());
        $sql->setRowData("event", $this->getEvent());
        $sql->setRowData("company", $this->getCompany());
        $sql->setRowData("ads", $this->getAds());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('system_user_id_fk', '=', "{$this->user()->getId()}"));
        $criteria->add($this->filter('geo_region_id_fk', '=', "{$this->region()->getId()}"));
        $sql->setRowData("news", $this->getNews());
        $sql->setRowData("newspaper", $this->getNewspaper());
        $sql->setRowData("event", $this->getEvent());
        $sql->setRowData("company", $this->getCompany());
        $sql->setRowData("ads", $this->getAds());

        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function delete()
    {
        $sql = $this->sqlDelete();
        $criteria = $this->criteria();
        $criteria->add($this->filter('system_user_id_fk', '=', "{$this->user()->getId()}"));
        $criteria->add($this->filter('geo_region_id_fk', '=', "{$this->region()->getId()}"));

        $sql->setCriteria($criteria);

        return $sql->execute();
    }

    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;
        $sql->setJoin("geo_region_user_permission", "geo_region", "geo_region_id_fk", "geo_region_id");
        return $sql->execute();
    }


    public function load($userId, $geoRegionId)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('system_user_id_fk', '=', $userId));
        $criteria->add($this->filter('geo_region_id_fk', '=', $geoRegionId));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");
        $res = $sql->execute();


        if ($res):

            $res = $res[0];
            $this->user()->setId($res["system_user_id_fk"]);
            $this->region()->setId($res["geo_region_id_fk"]);
            $this->setNews($res["news"]);
            $this->setNewspaper($res["newspaper"]);
            $this->setEvent($res["event"]);
            $this->setCompany($res["company"]);
            $this->setAds($res["ads"]);


        endif;

        return $res;
    }


    public function selectByUserLogin()
    {
        $cri = $this->criteria();
        $col = array("geo_region_id", "geo_region_name", "event", "news", "company", "newspaper", "ads");

        $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));


        return $this->select($cri, $col);
    }


    public function selectOneRegion()
    {
        $cri = $this->criteria();
        $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));
        $res = $this->select($cri);

        if (count($res) == 1) {
            return $res[0]["geo_region_id_fk"];
        } else {

            return false;
        }
    }

    public function selectPermission($userId)
    {
        $cri = $this->criteria();
        $col[] = "geo_region_id";
        $col[] = "event";
        $col[] = "news";
        $col[] = "company";
        $col[] = "newspaper";
        $col[] = "ads";

        $cri->add($this->filter("system_user_id_fk", "=", $userId));
        $res = $this->select($cri, $col);

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


    public function selectPermissionByUser($userId, $regionName = "")
    {
        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $result = array();
        $col = array("geo_region_id", "geo_region_name", "event", "news", "company", "newspaper", "ads");

        //  pegando permissions do usuario logado
        $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));
        $cri->setProperty("order", "geo_region_name ASC");

        if ($regionName) {
            $cri->add($this->filter("geo_region_name", "LIKE", "%$regionName%"));
        }

        $result["user_login"] = $this->select($cri, $col);

        // pegando informações do usuario que vai ser editado
        $cri2->add($this->filter("system_user_id_fk", "=", $userId));
        $res = $this->select($cri2, $col);
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


    public function createCriteria($permission, $name = "geo_region_id")
    {
        $cri2 = $this->criteria();
        $cri1 = $this->criteria();

            $cri1->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));
            $cri1->add($this->filter($this->getPermission($permission), "=", 1));
            $res = $this->select($cri1);
            if ($res) {
                foreach ($res as $key) {
                    $cri2->add($this->filter($name, "=", $key["geo_region_id_fk"]), Filter::OR_OPERATOR);
                }
            }

        return $cri2;

    }


    public function issetPermission($geoRegionId, $userId = false)
    {
        $this->region()->setId($geoRegionId);

        $userId ? $this->user()->setId($userId) : $this->user()->setId(Login::user()->getId());

        $cri = $this->criteria();
        $cri->add($this->filter("system_user_id_fk", "=", $this->user()->getId()));
        $cri->add($this->filter("geo_region_id_fk", "=", $this->region()->getId()));

        $col[] = "geo_region_id";
        return boolval($this->select($cri, $col));
    }

    public function validatePermission($geoRegionId, $permission)
    {
        $cri = $this->criteria();
        $permission = $this->getPermission($permission);
        if ($permission) {

            $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));
            $cri->add($this->filter("geo_region_id_fk", "=", $geoRegionId));

            $cri->add($this->filter("$permission", "=", 1));

            $col[] = "geo_region_id";

            return boolval($this->select($cri, $col));

        } else {
            return false;
        }
    }


    public function searchRegion($geoRegionName, $permission, $level = 0)
    {
        // essa função procura as regiões que usuario de permissão por entidade
        $permission = $this->getPermission($permission);
        $cri = $this->criteria();
        if ($permission && strlen($geoRegionName) > 1) {

            $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));
            $cri->add($this->filter("geo_region_name", "LIKE", "%$geoRegionName%"));
            if ($level) {
                $cri->add($this->filter("geo_region_level", "=", $level));
            }
            $cri->add($this->filter("$permission", "=", 1));
            $col[] = "geo_region_id";
            $col[] = "geo_region_name";
            $cri->setProperty("order", "geo_region_name");

            return $this->select($cri, $col);
        }

        return array();

    }

    private function getPermission($permission)
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


    /**
     * @return User
     */
    public function user()
    {

        $this->user = $this->user ? $this->user : new User();

        return $this->user;
    }


    /**
     * @return Region
     */
    public function region()
    {

        $this->region = $this->region ? $this->region : new Region();

        return $this->region;
    }


    /**
     * @return mixed
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @param mixed $news
     */
    public function setNews($news)
    {
        $this->news = $news;
    }

    /**
     * @return mixed
     */
    public function getNewspaper()
    {
        return $this->newspaper;
    }

    /**
     * @param mixed $newspaper
     */
    public function setNewspaper($newspaper)
    {
        $this->newspaper = $newspaper;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param mixed $ads
     */
    public function setAds($ads)
    {
        $this->ads = $ads;
    }


}