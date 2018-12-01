<?php

namespace App\Controllers\Forms\Admin;

use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Form;
use App\Models\Ads\Ads;
use App\Models\Ads\Local;
use App\Models\User\Login;
use DSisconeto\Simple\UploadImage;
use DSisconeto\Simple\Request;
use Respect\Validation\Validator as respect;

class FormAds extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(8));
        $adsId = Request::post("ads_id", "int", 0);
        if ($adsId) {
            $ads = new Ads();
            $ads->validateByUser($adsId);
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
        $adsLocal = new Local();


        if ($adsLocal->sqlLoad(Request::post("ads_local_id"))) {


            $image = UploadImage::upload(Request::file("ads_file"), "ads_banner", $adsLocal->getWidth(), $adsLocal->getHeight());
            $image = isset($image["name"]) ? $image["name"] : "";

            $ads->user()->setId(Login::user()->getId());
            $ads->setLink(Request::post("ads_link"));
            $ads->setFile($image);
            $ads->setStartDisplay(DataFormat::dateToEn(Request::post("ads_start_display"), true));
            $ads->setEndDisplay(DataFormat::dateToEn(Request::post("ads_end_display"), true));
            $ads->local()->setId(Request::post("ads_local_id"));
            $ads->company()->setId(Request::post("company_id"));
            $ads->setStatus(1);

            if (!$ads->imgExists($ads->getFile())):
                // não existe a imagem nos arquivos
                $this->setReturn(2);
            endif;

            // validando e verificando link da propaganda


            if (!respect::date("Y-m-d H:i:s")->validate($ads->getStartDisplay())):
                $this->setReturn(4);
            endif;

            if (!respect::date("Y-m-d H:i:s")->validate($ads->getEndDisplay())):
                $this->setReturn(5);
            endif;

            if (strtotime($ads->getStartDisplay()) >= strtotime($ads->getEndDisplay())):
                $this->setReturn(10);
            endif;

            if ($this->noError()) {

                if ($ads->register()) {

                    $this->setReturn(6, $ads->lastId());


                } else {

                    $this->setReturn(7);
                    $ads->imgDelete($ads->getFile());
                }

            } else {
                $ads->imgDelete($ads->getFile());
            }


        } else {
            $this->setReturn(11);
        }


        if ($this->isSuccess()) {

            $region = new FormAdsRegion();
            Request::setPost("ads_id", $this->getData());
            $region->register();
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

        $adsLocal = new Local();

        if ($ads->validateByUser(Request::post("ads_id"))) {

            $ads->load(Request::post("ads_id"));
            // criando copia da
            $ads2->setFile($ads->getFile());


            if ($adsLocal->sqlLoad(Request::post("ads_local_id")) && Request::file("ads_file")) {

                $image = UploadImage::upload(Request::file("ads_file"), "ads_banner", $adsLocal->getWidth(), $adsLocal->getHeight());
                $image = isset($image["name"]) ? $image["name"] : "";

                if ($ads->imgExists($image)):
                    //  existe a imagem nos arquivos
                    $ads->setFile($image);
                    $ads->local()->setId(Request::post("ads_local_id"));
                endif;

            }
            $ads->setLink(Request::post("ads_link"));
            $ads->setStartDisplay(DataFormat::dateToEn(Request::post("ads_start_display"), true));
            $ads->setEndDisplay(DataFormat::dateToEn(Request::post("ads_end_display"), true));

            if (!respect::date("Y-m-d H:i:s")->validate($ads->getStartDisplay())):
                $this->setReturn(4);
            endif;

            if (!respect::date("Y-m-d H:i:s")->validate($ads->getEndDisplay())):
                $this->setReturn(5);
            endif;

            if (strtotime($ads->getStartDisplay()) >= strtotime($ads->getEndDisplay())):
                $this->setReturn(10);
            endif;


            if ($this->noError()) {

                if ($ads->edit()) {

                    $this->setReturn(6, $ads->getId());


                    if ($ads->getFile() != $ads2->getFile()) {

                        $ads2->imgDelete($ads2->getFile());
                    }

                } else {

                    $this->setReturn(7);

                    if ($ads->getFile() != $ads2->getFile()) {

                        $ads->imgDelete($ads->getFile());
                    }
                }
            } else {
                $ads->imgDelete($ads->getFile());
            }
        } else {
            $this->setReturn(1);
        }
        if ($this->isSuccess()) {

            $region = new FormAdsRegion();
            Request::setPost("ads_id", $this->getData());
            $region->register();

        }
        return $this->getReturn();
    }


    public function delete()
    {
        $ads = new Ads();
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Deletada com sucesso", true, 8);
        $this->setMsg("Erro com deletar", false, 9);

        $ads->setId(Request::post("ads_id"));

        if ($ads->validateByUser($ads->getId())):

            if ($ads->delete()):

                $this->setReturn(8);

                $ads->imgDelete($ads->getFile());
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
        $ads->setId(Request::post("ads_id", "int", 0));

        $adsStatus = (Request::post("ads_status", "int", 0) ? 1 : 0);


        $this->setMsg("Usuário não logado, ou não tem permissão.", false, 1);
        $this->setMsg("Anúncio desabilitado com sucesso", true, 2);
        $this->setMsg("Anúncio habilitado com sucesso", true, 3);
        $this->setMsg("Não foi possivel alterar o status do anúncio", false, 4);

        if ($ads->validateByUser($ads->getId())) {
            $ads->setStatus($adsStatus);

            if ($ads->editStatus()) {


                if ($ads->getStatus()) {

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