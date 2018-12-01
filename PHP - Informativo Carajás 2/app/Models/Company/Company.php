<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 05/05/16
 * Time: 20:27
 */

namespace App\Models\Company;

use App\Models\Geo\Region;
use App\Models\Geo\RegionUserPermission;
use App\Models\System\SystemUrl;
use App\Models\User\Login;
use App\Models\User\User;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;


/**
 * Class Company
 */
class Company extends Model
{


    private $id;
    private $name;
    private $fantasyName;
    private $logo;
    private $cover;
    private $CnpjOrCpf;
    private $level;
    private $address;
    private $embed;
    private $url;
    private $description;
    private $user;
    private $userRegister;
    private $status;
    private $dataInsert;
    private $dataUpdate;

    public function __construct()
    {
        $this->setTable("company");
        $this->setImgFolder("company_logo");
        $this->setImgFolder("company_cover", 2);
        $this->url = new SystemUrl();
        $this->user = new User();
        $this->userRegister = new User();

        $this->url()->entity()->setId(2);
    }


    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("company_name", $this->getName());
        $sql->setRowData("company_fantasy_name", $this->getFantasyName());
        $sql->setRowData("company_address", $this->getAddress());
        $sql->setRowData("company_address_embed", $this->getEmbed());

        $sql->setRowData("company_cnpj_or_cpf", $this->getCnpjOrCpf());
        $sql->setRowData("company_nivel", $this->getLevel());
        $sql->setRowData("company_description", $this->getDescription());
        $sql->setRowData("system_user_id_fk", $this->user()->getId());
        $sql->setRowData("system_user_id_register_fk", $this->userRegister()->getId());
        $sql->setRowData("system_url_id_fk", $this->url()->getId());
        $sql->setRowData("company_status", $this->getStatus());
        $sql->setRowData("company_date_insert", GetData::getCurrentTime());

        return $sql->execute();

    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('company_id', '=', "{$this->getId()}"));
        $sql->setCriteria($criteria);
        $sql->setRowData("company_name", $this->getName());
        $sql->setRowData("company_fantasy_name", $this->getFantasyName());
        $sql->setRowData("company_address", $this->getAddress());
        $sql->setRowData("company_address_embed", $this->getEmbed());
        $sql->setRowData("company_logo", $this->getLogo());
        $sql->setRowData("company_cover", $this->getCover());
        $sql->setRowData("company_cnpj_or_cpf", $this->getCnpjOrCpf());
        $sql->setRowData("company_nivel", $this->getLevel());
        $sql->setRowData("company_description", $this->getDescription());
        $sql->setRowData("company_date_update", GetData::getCurrentTime());


        return $sql->execute();
    }


    public function editLogo()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_id', '=', "{$this->getId()}"));
        $sql->setRowData("company_logo", $this->getLogo());

        $sql->setCriteria($criteria);
        return $sql->execute();

    }

    public function editCover()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('company_id', '=', "{$this->getId()}"));
        $sql->setRowData("company_cover", $this->getCover());

        $sql->setCriteria($criteria);
        return $sql->execute();

    }

    public function editStatus()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_id', '=', "{$this->getId()}"));
        $sql->setRowData("company_status", $this->getStatus());
        $sql->setCriteria($criteria);
        return $sql->execute();

    }

    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setCriteria($criteria);

        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");

        return $sql->execute();
    }

    public function selectMix($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setCriteria($criteria);

        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("company", "company_relationship_segment", "company_id", "company_id_fk", "left");
        $sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id", "left");

        return $sql->execute();
    }

    public function selectMixRegion($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setCriteria($criteria);

        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("company", "company_relationship_segment", "company_id", "company_id_fk", "left");
        $sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id", "left");
        $sql->setJoin("company", "company_relationship_geo_region", "company_id", "company_id_fk", "left");

        return $sql->execute();
    }


    public function searchAdmin($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setCriteria($criteria);
        $sql->setJoin("company", "company_relationship_geo_region", "company_id", "company_id_fk");
        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("company", "company_relationship_segment", "company_id", "company_id_fk", "left");
        $sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id", "left");


        return $sql->execute();
    }


    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");

        $sql->addColumn("*");
        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["company_id"]);
            $this->setName($res["company_name"]);
            $this->setFantasyName($res["company_fantasy_name"]);
            $this->setLogo($res["company_logo"]);
            $this->setCover($res["company_cover"]);
            $this->setAddress($res["company_address"]);
            $this->setEmbed($res["company_address_embed"]);
            $this->url()->setId($res["system_url_id_fk"]);
            $this->url()->setUrl($res["system_url_url"]);
            $this->setCnpjOrCpf($res["company_cnpj_or_cpf"]);
            $this->setLevel($res["company_nivel"]);
            $this->setDescription($res["company_description"]);
            $this->user()->setId($res["system_user_id_fk"]);
            $this->userRegister()->setId($res["system_user_id_register_fk"]);
            $this->setDataInsert($res["company_date_insert"]);
            $this->setDataUpdate($res["company_date_update"]);
            $this->setStatus($res["company_status"]);

        endif;


        return $res;
    }


    public function validateByUser($companyId)
    {
        $sql = $this->sqlSelect();
        $userRegion = new RegionUserPermission();
        $cri2 = $userRegion->createCriteria("company", "company_relationship_geo_region.geo_region_id_fk");
        $cri3 = $this->criteria();

        $cri3->add($cri2);
        $cri3->add($this->filter("company_id", "=", $companyId));
        $cri3->setProperty("limit", "1");
        $sql->addColumn("company_id");

        $sql->setJoin("company", "company_relationship_geo_region", "company_id", "company_id_fk");

        $sql->setCriteria($cri3);
        $result = $sql->execute();
        if ($result) {
            $this->load($result[0]["company_id"]);
        }

        return $result;
    }


    /**
     * @param $url
     * @return array|bool
     */
    public function showDisplay($url)
    {
        $sql = $this->sqlSelect();
        $companyEmail = new Email();
        $companyGallery = new Gallery();
        $companyPhone = new Phone();
        $companySegment = new RelationshipSegment();
        $companySocial = new SocialNetwork();


        $cri = $this->criteria();
        $cri1 = $this->criteria();
        $cri2 = $this->criteria();


        $cri1->add($this->filter("company_status", "=", 1), Criteria::OR_OPERATOR);
        $cri1->add($this->filter("system_user_id_fk", "=", Login::user()->getId()), Criteria::OR_OPERATOR);
        $cri1->add($this->filter("system_user_id_register_fk", "=", Login::user()->getId()), Criteria::OR_OPERATOR);
        $cri2->add($this->filter("system_url_url", "=", $url));
        $cri->setProperty("limit", "1");

        $cri->add($cri1);
        $cri->add($cri2);

        $sql->setCriteria($cri);
        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");

        $resCompany = $sql->execute();


        if ($resCompany):

            $resCompany = $resCompany[0];
            $resCompany["company_email"] = $companyEmail->selectByCompany($resCompany["company_id"]);
            $resCompany["company_gallery"] = $companyGallery->selectBycCompany($resCompany["company_id"]);
            $resCompany["company_phone"] = $companyPhone->selectByCompany($resCompany["company_id"]);
            $resCompany["company_segment"] = $companySegment->selectByCompany($resCompany["company_id"]);
            $resCompany["company_social"] = $companySocial->selectByView($resCompany["company_id"]);

            return $resCompany;
        else:
            return false;
        endif;

    }

    public function companyUser()
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri->add($this->filter("system_user_id_fk", "=", Login::user()->getId()));
        $cri->setProperty("limit", "1");
        $sql->setCriteria($cri);
        $res = $sql->execute();

        if ($res) {
            return $res[0];
        } else {
            return array();
        }
    }


    public function search($arg)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $companyPhone = new Phone();

        $cri->add($this->filter("company_fantasy_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);
        $cri->add($this->filter("company_segment_name", "LIKE", "%$arg%"), Criteria::OR_OPERATOR);
        $cri2->add($this->filter("company_status", "=", "1"));
        $cri2->add($this->filter("company_relationship_geo_region.geo_region_id_fk", "=", Region::define()));

        $cri3->setProperty("order", "company_nivel DESC");
        $cri3->add($cri);
        $cri3->add($cri2);

        $sql->setCriteria($cri3);

        $sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("company", "company_relationship_segment", "company_id", "company_id_fk", "left");
        $sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id", "left");
        $sql->setJoin("company", "company_relationship_geo_region", "company_id", "company_id_fk", "left");

        $sql->setDouble(false);
        $res = $sql->execute();

        $index = array();
        $result = array();
        $count = 0;
        $resPhone = $companyPhone->selectAll();

        if ($res) {

            foreach ($res as $key):

                if (!isset($index[$key["company_id"]])) {

                    $index[$key["company_id"]] = true;
                    $result[$count]["company_id"] = $key["company_id"];
                    $result[$count]["company_address"] = $key["company_address"];
                    $result[$count]["company_fantasy_name"] = $key["company_fantasy_name"];

                    $result[$count]["company_logo"] = $key["company_logo"];
                    $result[$count]["company_nivel"] = $key["company_nivel"];
                    $result[$count]["system_url_url"] = $key["system_url_url"];
                    // pegar o fone da empresa

                    foreach ($resPhone as $keyPho) {
                        if ($keyPho["company_id_fk"] == $key["company_id"]) {
                            $result[$count]["company_phone"] = DataFormat::phone($keyPho["company_phone_dd"], $keyPho["company_phone"]);
                            break;
                        }
                    }

                    $count++;
                }

            endforeach;

        }

        return $result;
    }


    /**
     *
     * /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @param mixed $embed
     */
    public function setEmbed($embed)
    {
        $this->embed = $embed;
    }

    /**
     * @return SystemUrl
     */
    public function url()
    {
        return $this->url;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getFantasyName()
    {
        return $this->fantasyName;
    }

    /**
     * @param mixed $fantasyName
     */
    public function setFantasyName($fantasyName)
    {
        $this->fantasyName = $fantasyName;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return mixed
     */
    public function getCnpjOrCpf()
    {
        return $this->CnpjOrCpf;
    }

    /**
     * @param mixed $CnpjOrCpf
     */
    public function setCnpjOrCpf($CnpjOrCpf)
    {
        $this->CnpjOrCpf = $CnpjOrCpf;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return User
     */
    public function user()
    {

        return $this->user;
    }


    /**
     * @return User
     */
    public function userRegister()
    {
        return $this->userRegister;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDataInsert()
    {
        return $this->dataInsert;
    }

    /**
     * @param mixed $dataInsert
     */
    public function setDataInsert($dataInsert)
    {
        $this->dataInsert = $dataInsert;
    }

    /**
     * @return mixed
     */
    public function getDataUpdate()
    {
        return $this->dataUpdate;
    }

    /**
     * @param mixed $dataUpdate
     */
    public function setDataUpdate($dataUpdate)
    {
        $this->dataUpdate = $dataUpdate;
    }


}