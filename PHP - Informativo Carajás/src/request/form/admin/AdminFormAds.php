<?php

sysLoadClass("Ads");
sysLoadClass("DjUploadImage");

class AdminFormAds extends DjReturnMsg
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();


        if ($login->validateLogIn() && $login->getSystemUserPermissionAds()) {


        } else {

            exit();
        }


    }


    public function register()
    {

        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Não existe a imagem da publicidade no banco de dados", false, 2);
        $this->setMsg("Data de inicio da exibição, invalida", false, 4);
        $this->setMsg("Data de Fim da exibição invalida", false, 5);
        $this->setMsg("Publicidade cadastrada com sucesso", true, 6);
        $this->setMsg("Error ao cadastrar no banco de dados", false, 7);
        $this->setMsg("Data de Inicio da Exibição deve ser menor que a do fim", false, 10);
        $this->setMsg("O local selecionado é invalido", false, 11);
        $ads = new Ads();
        $adsLocal = new AdsLocal();
        $login = SystemLogin::getLogin();

        if (($login->validateLogIn() && $login->getSystemUserPermissionAds())) {

            if ($adsLocal->sqlLoad(DjRequest::post("ads_local_id"))) {


                $image = DjUploadImage::upload(DjRequest::file("ads_file"), "ads_banner", $adsLocal->getWidth(), $adsLocal->getHeight());
                $image = isset($image["name"]) ? $image["name"] : "";

                $ads->setSystemUserId($login->getSystemUserId());
                $ads->setAdsLink(DjRequest::post("ads_link"));
                $ads->setAdsFile($image);
                $ads->setAdsStartDisplay(DjWork::dateToEn(DjRequest::post("ads_start_display"), true));
                $ads->setAdsEndDisplay(DjWork::dateToEn(DjRequest::post("ads_end_display"), true));
                $ads->local()->setId(DjRequest::post("ads_local_id"));
                $ads->setAdsCompanyId(DjRequest::post("company_id"));
                $ads->setAdsStatus(1);

                if (!$ads->imgExists($ads->getAdsFile())):
                    // não existe a imagem nos arquivos
                    $this->setReturn(2);
                endif;

                // validando e verificando link da propaganda


                if (!$ads->validateDate($ads->getAdsStartDisplay())):
                    $this->setReturn(4);
                endif;

                if (!$ads->validateDate($ads->getAdsEndDisplay())):
                    $this->setReturn(5);
                endif;

                if (strtotime($ads->getAdsStartDisplay()) >= strtotime($ads->getAdsEndDisplay())):
                    $this->setReturn(10);
                endif;

                if ($this->noError()) {

                    if ($ads->sqlInsert()) {

                        $this->setReturn(6, $ads->lastId());


                    } else {

                        $this->setReturn(7);
                        $ads->imgDelete($ads->getAdsFile());
                    }

                } else {
                    $ads->imgDelete($ads->getAdsFile());
                }


            } else {
                $this->setReturn(11);
            }
        } else {
            $this->setReturn(1);
        }


        if ($this->isSuccess()) {

            DjRouter::callForm("admin.AdminFormAdsRegion@register", array("post" => array("ads_id" => $this->getData())));

        }
        return $this->getReturn();

    }


    public function edit()
    {

        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Não existe a imagem da publicidade no banco de dados", false, 2);
        $this->setMsg("Data de inicio da exibição, invalida", false, 4);
        $this->setMsg("Data de Fim da exibição invalida", false, 5);
        $this->setMsg("Publicidade editada com sucesso", true, 6);
        $this->setMsg("Error ao editar", false, 7);
        $this->setMsg("Data de Inicio da Exibição deve ser menor que a do fim", false, 10);
        $this->setMsg("O local selecionado é invalido", false, 11);


        $ads = new Ads();
        $ads2 = new Ads();

        $adsLocal = new AdsLocal();

        if ($ads->validateByUser(DjRequest::post("ads_id"))) {

            $ads->sqlLoad(DjRequest::post("ads_id"));
            // criando copia da
            $ads2->setAdsFile($ads->getAdsFile());


            if ($adsLocal->sqlLoad(DjRequest::post("ads_local_id")) && DjRequest::file("ads_file")) {

                $image = DjUploadImage::upload(DjRequest::file("ads_file"), "ads_banner", $adsLocal->getWidth(), $adsLocal->getHeight());
                $image = isset($image["name"]) ? $image["name"] : "";

                if ($ads->imgExists($image)):
                    //  existe a imagem nos arquivos
                    $ads->setAdsFile($image);
                    $ads->local()->setId(DjRequest::post("ads_local_id"));
                endif;

            }
            $ads->setAdsLink(DjRequest::post("ads_link"));
            $ads->setAdsStartDisplay(DjWork::dateToEn(DjRequest::post("ads_start_display"), true));
            $ads->setAdsEndDisplay(DjWork::dateToEn(DjRequest::post("ads_end_display"), true));
            // validando e verificando link da propaganda
            if (!$ads->validateDate($ads->getAdsStartDisplay())):
                $this->setReturn(4);
            endif;
            if (!$ads->validateDate($ads->getAdsEndDisplay())):
                $this->setReturn(5);
            endif;
            if (strtotime($ads->getAdsStartDisplay()) >= strtotime($ads->getAdsEndDisplay())):
                $this->setReturn(10);
            endif;
            if ($this->noError()) {

                if ($ads->sqlUpdate()) {

                    $this->setReturn(6, $ads->getAdsId());


                    if ($ads->getAdsFile() != $ads2->getAdsFile()) {

                        $ads2->imgDelete($ads2->getAdsFile());
                    }

                } else {

                    $this->setReturn(7);

                    if ($ads->getAdsFile() != $ads2->getAdsFile()) {

                        $ads->imgDelete($ads->getAdsFile());
                    }
                }
            } else {
                $ads->imgDelete($ads->getAdsFile());
            }
        } else {
            $this->setReturn(1);
        }
        if ($this->isSuccess()) {
            DjRouter::callForm("admin.AdminFormAdsRegion@register", array("post" => array("ads_id" => $ads->getAdsId())));
        }
        return $this->getReturn();
    }


    public function delete()
    {
        $ads = new Ads();
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Deletada com sucesso", true, 8);
        $this->setMsg("Erro com deletar", false, 9);

        $ads->setAdsId(DjRequest::post("ads_id"));

        if ($ads->validateByUser($ads->getAdsId())):

            if ($ads->sqlDelete()):

                $this->setReturn(8);

                $ads->imgDelete($ads->getAdsFile());
            else:

                $this->setReturn(9);

            endif;
        else:
            $this->setReturn(1);
        endif;

        return $this->getReturn();

    }


    public function editStatus()
    {
        $ads = new Ads();
        $ads->setAdsId(DjRequest::post("ads_id", "int", 0));

        $adsStatus = (DjRequest::post("ads_status", "int", 0) ? 1 : 0);


        $this->setMsg("Usuário não logado, ou não tem permissão.", false, 1);
        $this->setMsg("Anúncio desabilitado com sucesso", true, 2);
        $this->setMsg("Anúncio habilitado com sucesso", true, 3);
        $this->setMsg("Não foi possivel alterar o status do anúncio", false, 4);

        if ($ads->validateByUser($ads->getAdsId())) {

            $ads->setAdsStatus($adsStatus);
            if ($ads->sqlUpdateStatus()) {


                if ($ads->getAdsStatus()) {

                    $this->setReturn(3);

                } else {
                    $this->setReturn(2);

                }


            } else {

                $this->setReturn(4);
            }


        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();

    }

}