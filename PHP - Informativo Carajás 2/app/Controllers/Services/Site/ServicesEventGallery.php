<?php

namespace App\Controllers\Services\Site;

use App\Models\Event\Gallery;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Request;

class ServicesEventGallery
{


    public function downloadPhoto()
    {
        $gallery = new Gallery();
        $url = $gallery->getImgFolderLg(Request::get("file", "string"));
        if (file_exists($url)) {

            header("Content-type: image/jpeg");
            // informa o tipo do arquivo ao navegador
            header("Content-Length: " . filesize($url)); //informa o tamanho do arquivo ao navegador
            header("Content-Disposition: attachment; filename=" . basename($url));
            // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
            readfile($url); // lê o arquivo

        }
        exit;
    }


    public function requestByEvent()
    {
        $gallery = new Gallery();
        $cri = new Criteria();

        $cri->add(new Filter("event_id", "=", Request::get("event_id", "int")));
        $cri->setProperty("order", "event_gallery_order ASC");


        $col[] = "event_gallery_file";
        $col[] = "event_gallery_id";

        return $gallery->select($cri, $col);
    }

}