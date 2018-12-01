<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 18:58
 */

sysLoadClass("NewsContentImg");
sysLoadClass("DjUploadImage");

class AdminFormNewsContentImg extends DjReturnMsg
{


    public function register()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("O arquivo da imagem não conta nosso sistema", false, 2);
        $this->setMsg("Imagem adicionada com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar imagem no banco de dados", false, 4);

        $contentImg = new NewsContentImg();


        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionNews()):


            $res = DjUploadImage::upload(DjRequest::file("news_content_img_file"), "news_content", 1200, 720);

            $newsContentImgFile = $res ? $res["name"] : false;

            if ($contentImg->imgExists($newsContentImgFile)):

                $contentImg->setNewsContentImgFile($newsContentImgFile);
                $contentImg->setSystemUserIdFk($login->getSystemUserId());


                if ($contentImg->sqlInsert()):
                    $this->setReturn(3);
                else:
                    $contentImg->imgDelete($newsContentImgFile);
                    $this->setReturn(4);
                endif;

            else:
                $contentImg->imgDelete($newsContentImgFile);
                $this->setReturn(2);
            endif;


        else:

            $this->setReturn(1);
        endif;

        return $this->getReturn();
    }

    public function delete()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Erro ao deletar imagem", false, 5);
        $this->setMsg("Imagem deletada com sucesso", true, 6);

        $newsContentImgId = DjRequest::post("news_content_img_id");
        $contentImg = new NewsContentImg();

        if ($contentImg->validateUser($newsContentImgId)):

            if ($contentImg->sqlDelete()):
                $contentImg->imgDelete($contentImg->getNewsContentImgFile());

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