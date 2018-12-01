<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Event\Event;
use App\Models\Event\Gallery;
use App\Models\Event\RelationshipRegion;
use App\Models\User\Login;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;
use Respect\Validation\Validator as respect;

class FormEvent extends Form
{

    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), 4);

        if (Request::issetInput("event_id")) {
            $expression = (new Event())->validateByUser(Request::input("event_id", "int", 0));
            Login::exitForm($expression, "Não autorizado");
        }

    }

    public function register()
    {
        $event = new Event();

        $this->setMsg("Usuario não logado, ou não tem permissão", false, 1);
        $this->setMsg("O nome do evento deve conter entre 2  e 150 caracteres", false, 2);
        $this->setMsg("A descrição deve conter  no minimo 2 caracteres", false, 3);
        $this->setMsg("O local do evento deve conter entre 2  e 50 caracteres", false, 4);
        $this->setMsg("O endereço do evento deve conter entre 2  e 300 caracteres", false, 5);
        $this->setMsg("Erro ao criar url do evento", false, 11);
        $this->setMsg("A data do evento é invalida", false, 12);
        $this->setMsg("Evento Cadastrado com sucesso", true, 6);
        $this->setMsg("Erro ao cadastrar Evento", false, 7);
        $this->setMsg("Cidade Invalida", false, 8);
        $this->setMsg("Não foi possivel criar relação com região", false, 9);


        $regions = Request::post("geo_region_id", "array", array());
        $event->setName(Request::post("event_name"));
        $event->setDescription(Request::post("event_description"));
        $event->setLocal(Request::post("event_local"));
        $event->setDate(Request::post("event_date"), true);
        $event->region()->setId(Request::post("geo_region_id_city"));

        $event->setAddress(Request::post("event_address"));
        $event->setAddressMaps(DataFormat::embedMaps(Request::post("event_address_maps")));
        $event->category()->setId(Request::post("event_category_id"));
        $event->setStatus(1);
        $event->user()->setId(Login::user()->getId());
        $event->setRoof(Request::post("event_roof"));


        $event->url()->setUrl($event->getName());
        $event->url()->register();

        if (Login::user()->getPermission(6)) {

            $event->setSystemUserIdPermission(Login::user()->getId());

        } else {
            $event->setSystemUserIdPermission(0);
        }

        // verificando cidade
        if ($event->region()->regionLevel($event->region()->getId()) != 1) {
            $this->setReturn(8);
        }


        if (!$event->url()->getId()) {
            $this->setReturn(11);
        }


        if (!respect::length(2, 150)->validate($event->getName())) {
            $this->setReturn(2);
        }

        if (!respect::length(5)->validate($event->getDescription())) {
            $this->setReturn(3);
        }

        if (!respect::length(2, 50)->validate($event->getLocal())) {
            $this->setReturn(4);
        }

        if (!respect::length(2, 300)->validate($event->getAddress())) {
            $this->setReturn(5);
        }

        if (!respect::date("Y-m-d H:i:s")->validate($event->getDate())) {

            $this->setReturn(12);
        }


        if ($this->noError()) {

            if ($event->register()) {
                $event->lastId();
                $region = new RelationshipRegion();

                if ($region->register($event->getId(), $regions)) {

                    $this->setReturn(6, $event->getId());

                } else {

                    $this->setReturn(9);
                    $event->delete();
                    $event->url()->delete();
                }


            } else {

                $this->setReturn(7);
                $event->url()->delete();
            }


        } else {
            $event->url()->delete();
        }


        return $this->getReturn();


    }


    public function edit()
    {
        $event = new Event();

        $this->setMsg("Usuario não logado, ou não tem permissão", false, 1);
        $this->setMsg("O nome do evento deve conter entre 2  e 150 caracteres", false, 2);
        $this->setMsg("A descrição deve conter  no minimo 2 caracteres", false, 3);
        $this->setMsg("O local do evento deve conter entre 2  e 50 caracteres", false, 4);
        $this->setMsg("O endereço do evento deve conter entre 2  e 300 caracteres", false, 5);
        $this->setMsg("A data do evento é invalida", false, 12);
        $this->setMsg("Evento editado com sucesso", true, 6);
        $this->setMsg("Erro ao editar Evento", false, 7);
        $this->setMsg("Cidade Invalida", false, 8);
        $this->setMsg("Não foi possivel criar relação com região", false, 9);

        $regions = Request::post("geo_region_id", "array");
        $event->setId(Request::post("event_id", "int"));
        $event->setName(Request::post("event_name"));
        $event->setDescription(Request::post("event_description"));
        $event->setLocal(Request::post("event_local"));
        $event->setDate(Request::post("event_date"), true);
        $event->setAddress(Request::post("event_address"));
        $event->setAddressMaps(DataFormat::embedMaps(Request::post("event_address_maps")));
        $event->category()->setId(Request::post("event_category_id"));
        $event->setRoof(Request::post("event_roof"));
        $event->region()->setId(Request::post("geo_region_id_city"));


        if (!$event->url()->getId()) {
            $this->setReturn(11);
        }

        // verificando cidade
        if ($event->region()->regionLevel($event->region()->getId()) != 1) {

            $this->setReturn(8);
        }

        if (!respect::length(2, 150)->validate($event->getName())) {
            $this->setReturn(2);
        }

        if (!respect::length(5)->validate($event->getDescription())) {
            $this->setReturn(3);
        }

        if (!respect::length(2, 50)->validate($event->getLocal())) {
            $this->setReturn(4);
        }

        if (!respect::length(2, 300)->validate($event->getAddress())) {
            $this->setReturn(5);
        }

        if (!respect::date("Y-m-d H:i:s")->validate($event->getDate())) {

            $this->setReturn(12);
        }


        if ($this->noError()) {

            if ($event->edit()) {

                $this->setReturn(6, $event->getId());
                $region = new RelationshipRegion();
                $region->register($event->getId(), $regions);

            } else {

                $this->setReturn(7);
            }


        }


        return $this->getReturn();
    }


    public function uploadCover()
    {
        $this->setMsg("Erro ao fazer upload da imagem", false, 13);
        $this->setMsg("Capa do Evento cadastrada com sucesso.", true, 14);
        $this->setMsg("Erro ao fazer ao cadastrar capa no banco de dados.", true, 15);
        $this->setMsg("Imagem não encontrada no banco de dados", false, 8);


        $event = new Event();
        $eventMain = new Event();
        $event->load(Request::post("event_id"));
        $eventMain->setId(Request::post("event_id"));


        $image = UploadImage::croppicFinish(Request::post("event_cover"), "event_cover", 1000, 1000);


        if (($image) && $eventMain->imgExists($image["name"])) {

            $eventMain->setCover($image["name"]);


            if ($eventMain->editCover()) {


                if ($event->getCover() && $event->getCover() != $eventMain->getCover()) {

                    $event->imgDelete($event->getCover());
                }


                $this->setReturn(14);

            } else {

                $eventMain->imgDelete($eventMain->getCover());

                $this->setReturn(15);
            }

        } else {
            UploadImage::deleteImgTemp(Request::post("event_cover"));
            $this->setReturn(13);
        }


        return $this->getReturn();
    }


    public function editStatus()
    {
        $this->setMsg("Evento Públicado com sucesso.", true, 16);
        $this->setMsg("Evento salvo com sucesso.", true, 17);
        $this->setMsg("Evento em análise.", true, 18);
        $this->setMsg("Erro ao alterar status.", false, 19);
        $this->setMsg("Para Públicar o evento, o mesmo precisa ter uma capa.", false, 20);
        $this->setMsg("Para Públicar o evento, o mesmo precisa está relaciona com alguma região", false, 21);


        $event = new Event();
        $regionRelation = new RelationshipRegion();
        $event->setId(Request::post("event_id"));


        $event->load($event->getId());
        $event->setStatus(Request::post("event_status"));

        $event->setSystemUserIdPermission(Login::user()->getId());

        if ($event->getStatus() == 3 && Login::user()->getPermission(6)) {
            /// caso seja públicar
            $event->setSystemUserIdPermission(Login::user()->getId());

            if (!$event->imgExists($event->getCover())) {

                $this->setReturn(20);

            } elseif (!$regionRelation->selectByEvent($event->getId())) {

                $this->setReturn(21);

            } else {

                $event->setStatus(3);
                $event->editStatus() ? $this->setReturn(16) : $this->setReturn(19);
            }


        } elseif ($event->getStatus() == 2) {
            /// caso não tenha, entrar em analise
            $event->setStatus(2);

            $event->editStatus() ? $this->setReturn(18) : $this->setReturn(19);

        } else {

            $event->setStatus(1);
            $event->editStatus() ? $this->setReturn(17) : $this->setReturn(19);

        }


        return $this->getReturn();
    }


    public function delete()
    {
        $this->setMsg("Usuário não logado, ou não tem permissão", false, 1);
        $this->setMsg("Evento deletado com sucesso.", true, 2);
        $this->setMsg("Erro ao deletar evento", false, 3);

        $event = new Event();
        $gallery = new Gallery();
        $event->load(Request::post("event_id"));

        $event->load(Request::post("event_id"));

        $event->imgDelete($event->getCover());
        $gallery->deleteByEvent(Request::post("event_id"));
        $event->delete() ? $this->setReturn(2) : $this->setReturn(3);

        return $this->getReturn();
    }


}