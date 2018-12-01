<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 09:11
 */

sysLoadClass("EventGallery");
sysLoadClass("Event");
sysLoadClass("DjUploadImage");

class AdminFormEventGallery extends DjReturnMsg
{


    public function upload()
    {

        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Imagem não encontrada no sistema de arquivos", false, 2);
        $this->setMsg("Upload efetuado com sucesso", true, 3);
        $this->setMsg("Erro ao fazer cadastrar imagem no banco de dados", false, 4);

        $gallery = new EventGallery();
        $event = new Event();
        $event->setId(DjRequest::post("event_id"));
        if ($event->validateUserByEvent($event->getId())) {


            $res = DjUploadImage::uploadBase64(DjRequest::post("event_gallery_file"), "event_gallery", 1200, 900);


            if (($res) && $gallery->imgExists($res["name"])) {

                $gallery->event()->setId($event->getId());
                $gallery->setFile($res["name"]);
                $gallery->setOrder(($gallery->lastOrder($event->getId()) + 1));


                if ($gallery->sqlInsert()) {

                    $this->setReturn(3);


                } else {
                    $gallery->imgDelete($res["name"]);

                    $this->setReturn(4);
                }


            } else {
                $this->setReturn(2);

            }


        } else {
            $this->setReturn(1);

        }

        return $this->getReturn();
    }

    public function deleteAll()
    {
        $eventId = DjRequest::post("event_id");
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Imagens deletadas com sucesso", true, 6);
        $this->setMsg("Erro ao deletar  Imagem", false, 7);

        $gallery = new EventGallery();
        $event = new Event();
        if ($event->validateUserByEvent($eventId)) {

            $res = $gallery->selectByEvent($eventId);
            if ($res) {
                foreach ($res as $key) {
                    $gallery->setId($key["event_gallery_id"]);
                    $gallery->sqlDelete();
                    $gallery->imgDelete($gallery->getFile());
                }
                $this->setReturn(6);
            } else {
                $this->setReturn(7);
            }


        } else {
            $this->setReturn(1);
        }
        return $this->getReturn();
    }

    public function delete()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Imagem deletada com sucesso", true, 6);
        $this->setMsg("Erro ao deletar  Imagem", false, 7);

        $gallery = new EventGallery();

        if ($gallery->validateByUser(DjRequest::post("event_gallery_id"))) {

            $gallery->sqlLoad(DjRequest::post("event_gallery_id"));

            if ($gallery->sqlDelete()) {
                $gallery->imgDelete($gallery->getFile());
                $this->setReturn(6);
            } else {
                $this->setReturn(7);
            }
        } else {
            $this->setReturn(1);

        }

        return $this->getReturn();
    }

    public function serializeOrder()
    {
        $this->setMsg("ordenação feitta", true, 5);
        $event = new Event();
        $gallery = new EventGallery();
        $login = SystemLogin::getLogin();
        $data["success"] = 0;
        $data["error"] = 0;
        $data["permission"] = 0;
        if ($login->validateLogIn() && $login->getSystemUserPermissionEvent()) {
            $i = 0;

            $flag = true;
            foreach (DjRequest::post("gallery") as $key) {

                if ($gallery->validateByUser($key)) {

                    if ($flag) {
                        $event->updateRoof($key);
                        $flag = false;
                    }
                    $gallery->setOrder($i);
                    $gallery->setId($key);
                    $gallery->sqlUpdate() ? $data["success"]++ : $data["error"]++;
                    $i++;
                } else {
                    $data["permission"]++;

                }

            }

            $this->setReturn(5, $data);


        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }


    public function loadShard()
    {
        $this->setMsg("Informações carregadas com sucesso.", true, 1);
        $this->setMsg("Não foi possivel carregar imagens.", false, 2);
        $event = new Event();
        $event->sqlLoad(DjRequest::post("event_id", "int", 0));
        $gallery = new EventGallery();

        $res = $gallery->selectByEvent($event->getId());
        if ($res) {
            foreach ($res as $key) {
                file_get_contents("https://www.facebook.com/sharer/sharer.php?u=" . DjWork::getHost() . $event->url()->getUrl() . "/?photo=" . $key["event_gallery_id"]);
            }

            $this->setReturn(1);
        } else {
            $this->setReturn(2);
        }

        return $this->getReturn();
    }


}