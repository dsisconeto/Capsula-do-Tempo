<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 05/05/16
 * Time: 20:27
 */

sysLoadClass("ActionCompany");
sysLoadClass("CompanyEmail");
sysLoadClass("CompanyGallery");
sysLoadClass("CompanyPhone");
sysLoadClass("CompanyRelationshipSegment");
sysLoadClass("SystemUrl");
sysLoadClass("CompanySocialNetwork");


use Respect\Validation\Validator as respect;

/**
 * Class Company
 */
class Company extends ActionCompany
{

    /**
     * Company constructor.
     */
    public function __construct()
    {

        $this->setImgFolder("company_logo");
        $this->setImgFolder("company_cover", 2);

    }

    /**
     * @param $companyId
     * @return bool
     */
    public function validateByUser($companyId)
    {
        $cri = new Criteria();
        $login = SystemLogin::getLogin();
        $cri->add(new Filter("company_id", "=", $companyId));
        $cri->setProperty("limit", "1");
        $col[] = "system_user_id_fk";
        $col[] = "system_user_id_register_fk";
        $col[] = "company_id";
        $col[] = "company_fantasy_name";
        $col[] = "system_url_id_fk";

        $res = $this->sqlSelect($cri, $col);


        if ($res) {
            $this->setCompanyFantasyName($res[0]["company_fantasy_name"]);
            $this->setCompanyId($res[0]["company_id"]);
            $this->setCompanySystemUserIdFk($res[0]["system_user_id_fk"]);
            $this->setCompanySystemUserIdRegisterFk($res[0]["system_user_id_register_fk"]);
            $this->setSystemUrlIdFk($res[0]["system_url_id_fk"]);
            return ($login->validateLogIn() && ($login->getSystemUserCompany() || $login->getSystemUserPermissionCompany()) && ($login->getSystemUserId() == $this->getCompanySystemUserIdFk() || $login->getSystemUserId() == $this->getCompanySystemUserIdRegisterFk()));
        } else {
            return false;
        }
    }


    /**
     * @param $url
     * @return array|bool
     */
    public function showDisplay($url)
    {
        $companyEmail = new CompanyEmail();
        $companyGallery = new CompanyGallery();
        $companyPhone = new CompanyPhone();
        $companySegment = new CompanyRelationshipSegment();
        $companySocial = new CompanySocialNetwork();
        $login = SystemLogin::getLogin();

        $cri = new Criteria();
        $cri1 = new Criteria();
        $cri2 = new Criteria();


        $cri1->add(new Filter("company_status", "=", 1), Criteria::OR_OPERATOR);
        $cri1->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()), Criteria::OR_OPERATOR);
        $cri1->add(new Filter("system_user_id_register_fk", "=", $login->getSystemUserId()), Criteria::OR_OPERATOR);

        $cri2->add(new Filter("system_url_url", "=", $url));

        $cri->setProperty("limit", "1");

        $cri->add($cri1);
        $cri->add($cri2);

        $resCompany = $this->sqlSelect($cri);
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
        $login = SystemLogin::getLogin();

        $cri = new Criteria();
        $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));
        $cri->setProperty("limit", "1");
        $res = $this->sqlSelect($cri);

        if ($res) {
            return $res[0];
        } else {
            return array();
        }
    }


    public function search($arg)
    {

        $company = new Company();
        $cri = new Criteria();
        $cri2 = new Criteria();
        $cri3 = new Criteria();

        $companyPhone = new CompanyPhone();

        $cri->add(new Filter("company_fantasy_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
        $cri->add(new Filter("company_segment_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
        $cri2->add(new Filter("company_status", "=", "1"));
        $cri2->add(new Filter("company_relationship_geo_region.geo_region_id_fk", "=", DjRequest::cookie("geo_region_id")));

        $cri3->setProperty("order", "company_nivel DESC");
        $cri3->add($cri);
        $cri3->add($cri2);

        $res = $company->sqlSelectSearch($cri3);

        $index = array();
        $result = array();
        $count = 0;
        $resPhone = $companyPhone->sqlSelect();

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
                            $result[$count]["company_phone"] = $company->formatPhone($keyPho["company_phone_dd"], $keyPho["company_phone"]);
                            break;
                        }
                    }

                    $count++;
                }

            endforeach;

        }

        return $result;
    }


}