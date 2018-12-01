<?php

namespace App\Controllers\Forms\Admin;

use App\Models\News\ContentImg;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;

class FormNewsContentImg extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), 1);
    }

    public function register()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("O arquivo da imagem não conta nosso sistema", false, 2);
        $this->setMsg("Imagem adicionada com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar imagem no banco de dados", false, 4);

        $contentImg = new ContentImg();


        $res = UploadImage::upload(Request::file("news_content_img_file"), "news_content", 1200, 720);

        $newsContentImgFile = $res ? $res["name"] : false;

        if ($contentImg->imgExists($newsContentImgFile)):

            $contentImg->setFile($newsContentImgFile);
            $contentImg->user()->setId(Login::user()->getId());


            if ($contentImg->register()):
                $this->setReturn(3);
            else:
                $contentImg->imgDelete($newsContentImgFile);
                $this->setReturn(4);
            endif;

        else:
            $contentImg->imgDelete($newsContentImgFile);
            $this->setReturn(2);
        endif;


        return $this->getReturn();
    }

    public function delete()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Erro ao deletar imagem", false, 5);
        $this->setMsg("Imagem deletada com sucesso", true, 6);

        $newsContentImgId = Request::post("news_content_img_id");
        $contentImg = new ContentImg();

        if ($contentImg->validateUser($newsContentImgId)):

            if ($contentImg->delete()):
                $contentImg->imgDelete($contentImg->getFile());

                $this->setReturn(6);
            else:
                $this->setReturn(5);
            endif;

        else:
            $this->setReturn(1);
        endif;

        return $this->getReturn();

    }


}