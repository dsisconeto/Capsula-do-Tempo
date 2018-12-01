<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 28/08/16
 * Time: 17:49
 */

sysLoadClass("EventGallery");

class ServicesEventGallery
{


    public function downloadPhoto()
    {

        $gallery = new EventGallery();

        $url = $gallery->getImgFolderLg(DjRequest::get("file", "string"));


        if (file_exists($url)) {

            header("Content-type: image/jpeg");
            // informa o tipo do arquivo ao navegador
            header("Content-Length: " . filesize($url)); //informa o tamanho do arquivo ao navegador
            header("Content-Disposition: attachment; filename=" . basename($url));
            // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
            readfile($url); // lê o arquivo
            exit; // aborta pós-ações
        }


    }


    public function requestByEvent()
    {
        $page = DjRequest::get("page", "int", 1);
        $limit = $page == 1 ? 12 : 6;

        $gallery = new EventGallery();
        $cri = new Criteria();

        $cri->add(new Filter("event_id", "=", DjRequest::get("event_id", "int")));
        $cri->setProperty("order", "event_gallery_order ASC");

        $cri->setProperty("limit", $gallery->paginate($page, $limit));

        $col[] = "event_gallery_file";
        $col[] = "event_gallery_id";

        return $gallery->sqlSelect($cri, $col);
    }

}