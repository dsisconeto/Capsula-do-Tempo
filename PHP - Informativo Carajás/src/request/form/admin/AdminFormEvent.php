<?php
sysLoadClass("Event");
sysLoadClass("SystemUrl");
sysLoadClass("DjUploadImage");
sysLoadClass("EventRelationshipGeoRegion");

use Respect\Validation\Validator as respect;

class AdminFormEvent extends DjReturnMsg
{

    public function register()
    {
        $event = new Event();
        $login = SystemLogin::getLogin();
        $sysUrl = new SystemUrl();

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

        if ($login->validateLogIn() && $login->getSystemUserPermissionEvent()) {

            $event->setName(DjRequest::post("event_name"));
            $event->setDescription(DjRequest::post("event_description"));
            $event->setEventLocal(DjRequest::post("event_local"));
            $event->setDate(DjRequest::post("event_date"), true);
            $event->region()->setId(DjRequest::post("geo_region_id_city"));

            $event->setAddress(DjRequest::post("event_address"));
            $event->setAddressMaps(Framework::getEmbedGoogleMaps(DjRequest::post("event_address_maps")));
            $event->category()->setId(DjRequest::post("event_category_id"));
            $event->setEventStatus(1);
            $event->setSystemUserId($login->getSystemUserId());
            $event->setRoof(DjRequest::post("event_roof"));


            $event->url()->setId($sysUrl->register($event->getName(), 3));

            if ($login->getSystemUserPermissionEventSuper()) {

                $event->setSystemUserIdPermission($login->getSystemUserId());

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

            if (!respect::length(2, 50)->validate($event->getEventLocal())) {
                $this->setReturn(4);
            }

            if (!respect::length(2, 300)->validate($event->getAddress())) {
                $this->setReturn(5);
            }

            if (!respect::date("Y-m-d H:i:s")->validate($event->getDate())) {

                $this->setReturn(12);
            }


            if ($this->noError()) {

                if ($event->sqlInsert()) {


                    $this->setReturn(6, $event->lastId());


                } else {

                    $this->setReturn(7);
                    $sysUrl->delete($event->url()->getId());
                }



            } else {
                $sysUrl->delete($event->url()->getId());
            }


        } else {

            $this->setReturn(1);
        }


//// cadastrar relação com  região
        if ($this->isSuccess()) {

            $return = $this->getReturn();

            DjRouter::callForm("admin.AdminFormEventRegion@register", array("post" => array("event_id" => $return[0]["data"], "geo_region_id" => DjRequest::post("geo_region_id"))));
        }

        return $this->getReturn();


    }


    public function edit()
    {
        $event = new Event();
        $login = SystemLogin::getLogin();

        $this->setMsg("Usuario não logado, ou não tem permissão", false, 1);
        $this->setMsg("O nome do evento deve conter entre 2  e 150 caracteres", false, 2);
        $this->setMsg("A descrição deve conter  no minimo 2 caracteres", false, 3);
        $this->setMsg("O local do evento deve conter entre 2  e 50 caracteres", false, 4);
        $this->setMsg("O endereço do evento deve conter entre 2  e 300 caracteres", false, 5);
        $this->setMsg("A data do evento é invalida", false, 12);
        $this->setMsg("Evento editado com sucesso", true, 6);
        $this->setMsg("Erro ao editar Evento", false, 7);
        $this->setMsg("Cidade Invalida", false, 8);


        if ($login->validateLogIn() && $login->getSystemUserPermissionEvent()) {

            $event->setId(DjRequest::post("event_id", "int"));
            $event->setName(DjRequest::post("event_name"));
            $event->setDescription(DjRequest::post("event_description"));
            $event->setEventLocal(DjRequest::post("event_local"));
            $event->setDate(DjRequest::post("event_date"), true);
            $event->setAddress(DjRequest::post("event_address"));
            $event->setAddressMaps(Framework::getEmbedGoogleMaps(DjRequest::post("event_address_maps")));
            $event->category()->setId(DjRequest::post("event_category_id"));
            $event->setRoof(DjRequest::post("event_roof"));
            $event->region()->setId(DjRequest::post("geo_region_id_city"));

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

            if (!respect::length(2, 50)->validate($event->getEventLocal())) {
                $this->setReturn(4);
            }

            if (!respect::length(2, 300)->validate($event->getAddress())) {
                $this->setReturn(5);
            }

            if (!respect::date("Y-m-d H:i:s")->validate($event->getDate())) {

                $this->setReturn(12);
            }


            if ($this->noError()) {

                if ($event->sqlUpdate()) {

                    $this->setReturn(6, $event->getId());


                } else {

                    $this->setReturn(7);

                }


            }


        } else {

            $this->setReturn(1);
        }


//// cadastrar relação com  região


        DjRouter::callForm("admin.AdminFormEventRegion@register", array("post" => array("event_id" => DjRequest::post("event_id"), "geo_region_id" => DjRequest::post("geo_region_id"))));

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
        $event->sqlLoad(DjRequest::post("event_id"));
        $eventMain->setId(DjRequest::post("event_id"));

        if ($eventMain->validateUserByEvent($eventMain->getId())) {

            $image = DjUploadImage::croppicFinish(DjRequest::post("event_cover"), "event_cover", 1000, 1000);


            if (($image) && $eventMain->imgExists($image["name"])) {

                $eventMain->setCover($image["name"]);


                if ($eventMain->sqlUpdateCover()) {


                    if ($event->getCover() && $event->getCover() != $eventMain->getCover()) {

                        $event->imgDelete($event->getCover());
                    }


                    $this->setReturn(14);

                } else {

                    $eventMain->imgDelete($eventMain->getCover());

                    $this->setReturn(15);
                }

            } else {
                DjWork::deleteImgTemp(DjRequest::post("event_cover"));
                $this->setReturn(13);
            }


        } else {
            DjWork::deleteImgTemp(DjRequest::post("event_cover"));
            $this->setReturn(1);
        }


        return $this->getReturn();
    }


    public function editStatus()
    {
        $this->setMsg("Usuário não logado, ou não tem permissão.", false, 1);
        $this->setMsg("Evento Públicado com sucesso.", true, 16);
        $this->setMsg("Evento salvo com sucesso.", true, 17);
        $this->setMsg("Evento em análise.", true, 18);
        $this->setMsg("Erro ao alterar status.", false, 19);
        $this->setMsg("Para Públicar o evento, o mesmo precisa ter uma capa.", false, 20);
        $this->setMsg("Para Públicar o evento, o mesmo precisa está relaciona com alguma região", false, 21);


        $event = new Event();
        $login = SystemLogin::getLogin();
        $regionRelation = new EventRelationshipGeoRegion();
        $event->setId(DjRequest::post("event_id"));

        if ($event->validateUserByEvent($event->getId())) {

            $event->sqlLoad($event->getId());
            $event->setEventStatus(DjRequest::post("event_status"));

            $event->setSystemUserIdPermission($login->getSystemUserId());

            if ($event->getEventStatus() == 3 && $login->getSystemUserPermissionEventSuper()) {
                /// caso seja públicar
                $event->setSystemUserIdPermission($login->getSystemUserId());

                if (!$event->imgExists($event->getCover())) {

                    $this->setReturn(20);

                } elseif (!$regionRelation->selectByEvent($event->getId())) {

                    $this->setReturn(21);

                } else {

                    $event->setEventStatus(3);
                    $event->sqlUpdateStatus() ? $this->setReturn(16) : $this->setReturn(19);
                }


            } elseif ($event->getEventStatus() == 2) {
                /// caso não tenha, entrar em analise
                $event->setEventStatus(2);
                $event->sqlUpdateStatus() ? $this->setReturn(18) : $this->setReturn(19);
            } else {

                $event->setEventStatus(1);
                $event->sqlUpdateStatus() ? $this->setReturn(17) : $this->setReturn(19);

            }


        } else {

            $this->setReturn(1);

        }


        return $this->getReturn();
    }


    public function delete()
    {
        $this->setMsg("Usuário não logado, ou não tem permissão", false, 1);
        $this->setMsg("Evento deletado com sucesso.", true, 2);
        $this->setMsg("Erro ao deletar evento", false, 3);

        $event = new Event();
        $gallery = new EventGallery();

        if ($event->validateUserByEvent(DjRequest::post("event_id"))) {

            $event->sqlLoad(DjRequest::post("event_id"));

            $event->imgDelete($event->getCover());
            $gallery->deleteByEvent(DjRequest::post("event_id"));

            $event->sqlDelete() ? $this->setReturn(2) : $this->setReturn(3);

        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();
    }


}