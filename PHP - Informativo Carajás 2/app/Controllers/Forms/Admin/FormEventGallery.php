<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Event\Event;
use App\Models\Event\Gallery;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\UploadImage;
use DSisconeto\Simple\Request;

class FormEventGallery extends Form
{

    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(4));

    }

    public function upload()
    {


        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Imagem não encontrada no sistema de arquivos", false, 2);
        $this->setMsg("Upload efetuado com sucesso", true, 3);
        $this->setMsg("Erro ao fazer cadastrar imagem no banco de dados", false, 4);

        $gallery = new Gallery();
        $gallery->event()->setId(Request::post("event_id"));

        if ($gallery->event()->validateByUser($gallery->event()->getId())) {


            $res = UploadImage::uploadBase64(Request::post("event_gallery_file"), "event_gallery", 1200, 900);


            if (($res) && $gallery->imgExists($res["name"])) {

                $gallery->setFile($res["name"]);
                $gallery->setOrder(($gallery->lastOrder($gallery->event()->getId()) + 1));


                if ($gallery->register()) {

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
        $eventId = Request::post("event_id");
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Imagens deletadas com sucesso", true, 6);
        $this->setMsg("Erro ao deletar  Imagem", false, 7);

        $gallery = new Gallery();
        $gallery->event()->setId($eventId);
        if ($gallery->event()->validateByUser($gallery->event()->getId())) {

            $res = $gallery->selectByEvent($gallery->event()->getId());
            if ($res) {
                $gallery->deleteAll();
                foreach ($res as $key) {

                    $gallery->imgDelete($key["event_gallery_file"]);
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

        $gallery = new Gallery();

        if ($gallery->validateByUser(Request::post("event_gallery_id"))) {

            $gallery->load(Request::post("event_gallery_id"));

            if ($gallery->delete()) {
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
        $gallery = new Gallery();
        $data["success"] = 0;
        $data["error"] = 0;
        $data["permission"] = 0;

        $i = 0;

        $flag = true;
        foreach (Request::post("gallery") as $key) {

            if ($gallery->validateByUser($key)) {

                if ($flag) {
                    $event->editRoof($key);
                    $flag = false;
                }
                $gallery->setOrder($i);
                $gallery->setId($key);
                $gallery->edit() ? $data["success"]++ : $data["error"]++;
                $i++;
            } else {
                $data["permission"]++;

            }

        }

        $this->setReturn(5, $data);


        return $this->getReturn();
    }


    public function loadShard()
    {
        $this->setMsg("Informações carregadas com sucesso.", true, 1);
        $this->setMsg("Não foi possivel carregar imagens.", false, 2);
        $event = new Event();
        $event->load(Request::post("event_id", "int", 0));
        $gallery = new Gallery();

        $res = $gallery->selectByEvent($event->getId());
        if ($res) {
            foreach ($res as $key) {
                file_get_contents("https://www.facebook.com/sharer/sharer.php?u=" . GetData::getHostMain() . $event->url()->getUrl() . "/?photo=" . $key["event_gallery_id"]);
            }

            $this->setReturn(1);
        } else {
            $this->setReturn(2);
        }

        return $this->getReturn();
    }


}