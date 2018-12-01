<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 07/04/16
 * Time: 19:11
 */
sysLoadClass("ActionAds");
sysLoadClass("SystemUrl");
sysLoadClass("Company");

sysLoadClass("AdsRelationshipRegion");
sysLoadClass("GeoRegionRelationshipParent");


class Ads extends ActionAds
{
    public function __construct()
    {
        $this->setImgFolder("ads_banner");
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Não existe a imagem da publicidade no banco de dados", false, 2);
        $this->setMsg("Data de inicio da exibição, invalida", false, 4);
        $this->setMsg("Data de Fim da exibição invalida", false, 5);
        $this->setMsg("Publicidade cadastrada com sucesso", true, 6);
        $this->setMsg("Error ao cadastrar no banco de dados", false, 7);
        $this->setMsg("Data de Inicio da Exibição deve ser menor que a do fim", false, 10);

        //delete
        $this->setMsg("Deletada com sucesso", true, 8);
        $this->setMsg("Erro com deletar", false, 9);

        // edit
        $this->setMsg("Publicidade editada com sucesso", true, 11);
    }


    public function lastId()
    {
        $cri = new Criteria();
        $cri->setProperty("order", "ads_id DESC");
        $cri->setProperty("limit", 1);

        $res = $this->sqlSelect($cri);

        return $res[0]["ads_id"];
    }


    public function updateTurnover($adsId, $regionId, $adsLocalId)
    {
        $this->setAdsId($adsId);

        $adsRelationshipRegion = new AdsRelationshipRegion();
        $lastTurnover = $adsRelationshipRegion->selectLastTurnoverByRegion($regionId, $adsLocalId);

        $this->setAdsTurnover(($lastTurnover + 1));
        return $this->sqlUpdateTurnover();
    }


    public function validateByUser($adsId)
    {
        $login = SystemLogin::getLogin();
        if ((($login->validateLogIn()) && $login->getSystemUserPermissionAds() && ($this->sqlLoad($adsId))) && $this->getSystemUserId() == $login->getSystemUserId()):

            return true;
        else:
            return false;
        endif;

    }
}