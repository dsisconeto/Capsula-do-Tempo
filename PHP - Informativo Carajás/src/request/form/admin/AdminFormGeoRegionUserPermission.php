<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 13/10/16
 * Time: 21:23
 */
sysLoadClass("GeoRegionUserPermission");

class AdminFormGeoRegionUserPermission extends DjReturnMsg
{

    public function __construct()
    {
        $login = SystemLogin::getLogin();
        $this->noPermission($login->getSystemUserPermissionUserRegister());

    }

    /**
     * @return mixed
     */
    public function manager()
    {

        $this->setMsg("Ops, parece que você não tem permissão");
        $this->setMsg("Permissão atualizada com sucesso :)", true);
        $this->setMsg("Ops não foi possivel atualizar permissão :)");

        $regionPer = new GeoRegionUserPermission();
        $login = SystemLogin::getLogin();
        $user = New SystemUser();
        $userId = DjRequest::post("system_user_id", "int", 0);
        $regionId = DjRequest::post("geo_region_id", "int", 0);
        $event = DjRequest::post("event", "int", 0);
        $news = DjRequest::post("news", "int", 0);
        $newspaper = DjRequest::post("newspaper", "int", 0);
        $company = DjRequest::post("company", "int", 0);
        $ads = DjRequest::post("ads", "int", 0);

        if ($user->validateUserManager($userId)) {


            $regionPer->setSystemUserIdFk($userId);
            $regionPer->setGeoRegionIdFk($regionId);

            $regionPer->sqlLoad($regionId, $userId);


            // verificando se o usuario logado tem permissão na região

            $event && $regionPer->validatePermission($regionId, "event") ? $regionPer->setEvent(1) : $regionPer->setEvent(0);

            $news && $regionPer->validatePermission($regionId, "news") ? $regionPer->setNews(1) : $regionPer->setNews(0);

            $newspaper && $regionPer->validatePermission($regionId, "newspaper") ? $regionPer->setNewspaper(1) : $regionPer->setNewspaper(0);

            $company && $regionPer->validatePermission($regionId, "company") ? $regionPer->setCompany(1) : $regionPer->setCompany(0);


            $ads && $regionPer->validatePermission($regionId, "ads") ? $regionPer->setAds(1) : $regionPer->setAds(0);


            // verificar se é para editar ou atualizar
            if ($regionPer->issetPermissionRegion($regionId, $userId)) {

                $regionPer->sqlUpdate() ? $this->setReturn(2) : $this->setReturn(3);
            } else {
                $regionPer->sqlInsert() ? $this->setReturn(2) : $this->setReturn(3);
            }

        } else {

            $this->setReturn(1);
        }


        return $this->getReturn();
    }


}