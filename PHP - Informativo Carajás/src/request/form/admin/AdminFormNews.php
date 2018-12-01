<?php

sysLoadClass("News");
sysLoadClass("NewsCategory");
sysLoadClass("NewsRelationshipRegion");
sysLoadClass("DjUploadImage");

use Respect\Validation\Validator as respect;

sysLoadClass("NewsTag");

class AdminFormNews extends DjReturnMsg
{


    public function register()
    {
        $this->setMsg("Não está logado, ou não tem permissão", false, 1);
        $this->setMsg("O titulo da noticia deve conter entre 5 a 150 caracteres", false, 2);
        $this->setMsg("O post da noticia deve conter no minimo 20 caracteres", false, 3);
        $this->setMsg("A preview da noticia deve conter entre 10 a 250 caracteres", false, 4);
        $this->setMsg("As keywords deve conter entre 10 a 150", false, 5);
        $this->setMsg("Não foi encontrada a imagem no servidor", false, 6);
        $this->setMsg("Noticia cadastra com sucesso", true, 7);
        $this->setMsg("FALTA_ERROR, não foi possivel cadastrar a noticias no banco de dados", false, 8);

        $geoRegion = new NewsRelationshipRegion();
        $login = SystemLogin::getLogin();
        $systemUrl = new SystemUrl();
        $news = new News();
        // validando o usuario
        if (($login->validateLogIn()) && $login->getSystemUserPermissionNews()):

            $news->setNewsTitle(DjRequest::post("news_title"));
            $news->setNewsPost(DjRequest::post("news_post"));
            $news->setNewsStatus(1);
            $news->setSystemUserIdFk($login->getSystemUserId());
            $news->setNewsTagIdFk(DjRequest::post("news_tag_id"));
            $news->setNewsOrder(DjRequest::post("news_order"));
            $news->setNewsLocalId(DjRequest::post("news_local_id"));


            if (!respect::length(5, 150)->validate($news->getNewsTitle())):
                /// validando o titulo
                $this->setReturn(2);
            endif;

            if (!respect::length(20)->validate($news->getNewsPost())):
                // validando Post
                $this->setReturn(3);
            endif;

            if (!respect::length(10, 250)->validate($news->getNewsPreview())):
                // ca não seja enviada uma previa será colocada os 250 primeiros digitos
                $news->setNewsPreview($news->limitText($news->getNewsPost(), 250));
            endif;

            if (!respect::length(10, 150)->validate($news->getNewsKeywords())):
                /// caso não seja enviado keywords validas será colocadas as do titulo
                $news->setNewsKeywords($news->keyWords($news->getNewsTitle()));
            endif;

            // caso não tenha erros insert essa porra mano
            if ($this->noError()):

                $news->setSystemUrlIdFk($systemUrl->register($news->getNewsTitle(), 1));

                if ($news->sqlInsert()):
                    // criando url
                    $this->setReturn(7, $news->lastId());
                else:
                    // caso der merda, apaga a imagem que foi upada;
                    $this->setReturn(8);
                endif;
            else:
                // caso, de merda  apaga a imagem que foi upada
            endif;
        else:
            // caso, de merda  apaga a imagem que foi upada
            // caso não esteja logado ou não tenha permissão
            $this->setReturn(1);
        endif;


        if ($this->isSuccess()) {

            $geoRegion->register(DjRequest::post("geo_region_id"), $news->getNewsId());
        }

        return $this->getReturn();
    }


    public function edit()
    {

        $this->setMsg("Não está logado, ou não tem permissão", false, 1);
        $this->setMsg("O titulo da noticia deve conter entre 5 a 150 caracteres", false, 2);
        $this->setMsg("O post da noticia deve conter no minimo 20 caracteres", false, 3);
        $this->setMsg("A preview da noticia deve conter entre 10 a 250 caracteres", false, 4);
        $this->setMsg("As keywords deve conter entre 10 a 150", false, 5);
        $this->setMsg("Noticia editada com sucesso", true, 7);
        $this->setMsg("FALTA_ERROR, não foi possivel editar a noticias no banco de dados", false, 8);
        $this->setMsg("Selecione uma categoria", false, 9);

        $tag = new NewsTag();
        $news = new News();
        $geoRegion = new NewsRelationshipRegion();

        // validando o usuario
        if ($news->validateByUser(DjRequest::post("news_id"))):

            $news->setNewsId(DjRequest::post("news_id"));
            $news->setNewsTitle(DjRequest::post("news_title"));
            $news->setNewsPost(DjRequest::post("news_post"));
            $news->setNewsTagIdFk(DjRequest::post("news_tag_id"));
            $news->setNewsOrder(DjRequest::post("news_order"));
            $news->setNewsLocalId(DjRequest::post("news_local_id"));


            if (!respect::length(5, 150)->validate($news->getNewsTitle())):
                /// validando o titulo
                $this->setReturn(2);
            endif;

            if (!$tag->issetTagId($news->getNewsTagIdFk())) {
                $this->setReturn(9);
            }

            if (!respect::length(20)->validate($news->getNewsPost())):
                // validando Post
                $this->setReturn(3);
            endif;

            if (!respect::length(10, 250)->validate($news->getNewsPreview())):
                // ca não seja enviada uma previa será colocada os 250 primeiros digitos
                $news->setNewsPreview($news->limitText($news->getNewsPost(), 250));
            endif;

            if (!respect::length(10, 150)->validate($news->getNewsKeywords())):
                /// caso não seja enviado keywords validas será colocadas as do titulo
                $news->setNewsKeywords($news->keyWords($news->getNewsTitle()));
            endif;

            // caso não tenha erros insert essa porra mano
            if ($this->noError()):


                if ($news->sqlUpdate()):
                    // criando url
                    $this->setReturn(7, $news->getNewsId());
                else:
                    // caso der merda, apaga a imagem que foi upada;
                    $this->setReturn(8);
                endif;
            else:
                // caso, de merda  apaga a imagem que foi upada
            endif;
        else:
            // caso, de merda  apaga a imagem que foi upada
            // caso não esteja logado ou não tenha permissão
            $this->setReturn(1);
        endif;


        if ($this->isSuccess()) {

            $geoRegion->register(DjRequest::post("geo_region_id"), $news->getNewsId());
        }


        return $this->getReturn();
    }


    public function updateStatus()
    {
        $this->setMsg("Notícia públicada com sucesso", true, 13);
        $this->setMsg("Notícia em analise para ser públicada", true, 14);
        $this->setMsg("Notícia despublicada com sucesso", true, 15);

        $this->setMsg("Não foi possivel públicar a notícia, coleque uma capa e tente novamente", false, 16);
        $this->setMsg("Não foi possivel públicar a notícia, relacione a mesma com uma região e tente novamente", false, 18);
        $this->setMsg("Não foi possivel editar o status da notícia, erro no banco de dados", false, 17);


        $login = SystemLogin::getLogin();
        $relationGeoRegion = new NewsRelationshipRegion();
        $news = new News();
        $news2 = new News();
        if ($news->validateByUser(DjRequest::post("news_id"))) {

            $news->setNewsId(DjRequest::post("news_id"));
            $news->setNewsStatus(DjRequest::post("news_status"));

            if ($news->getNewsStatus() == 3 && $login->getSystemUserPermissionNewsSuper()) {
                $news->sqlLoad($news->getNewsId());

                $news->setNewsStatus(3);

                if (!$news->imgExists($news->getNewsCover())) {
                    $this->setReturn(16);

                } elseif (!$relationGeoRegion->selectByNews($news->getNewsId())) {
                    $this->setReturn(18);

                } else {
                    $news2->lastOrder($news->getNewsOrder(), $news->getNewsLocalId());

                    $news->sqlUpdateStatus() ? $this->setReturn(13) : $this->setReturn(17);

                }


            } elseif ($news->getNewsStatus() == 3 && !$login->getSystemUserPermissionNewsSuper()) {

                $this->setReturn(14);
                $news->setNewsStatus(2);

                $news->sqlUpdateStatus() ? $this->setReturn(14) : $this->setReturn(17);
            } else {

                $news->setNewsStatus(1);
                $this->setReturn(15);
                $news->sqlUpdateStatus() ? $this->setReturn(15) : $this->setReturn(17);

            }

        } else {

            $this->setReturn(1);
        }


        return $this->getReturn();

    }


    public function editCover()
    {
        $this->setMsg("Não está logado, ou não tem permissão", false, 1);
        $this->setMsg("Imagem não encontra no sistema de arquivos", false, 18);
        $this->setMsg("Erro ao cadastrar no banco de dados", false, 19);
        $this->setMsg("Capa da Notícia atualizada com sucesso", true, 20);

        $news = new News();
        $cover = DjRequest::post("news_cover");

        if ($news->validateUser(DjRequest::post("news_id"))) {
            $resNews = $news->sqlLoad(DjRequest::post("news_id"));
            $news2 = $news;


            if ($resNews) {
                // movendo para pastar certar e criando thumbnail
                $image = DjUploadImage::croppicFinish($cover, "news_cover", 1200, 720);

            } else {

                $this->setReturn(18);
            }


            if ((isset($image["name"])) && $news->imgExists($image["name"])) {
                $cover = $image["name"];
                $capaAntiga = $news2->getNewsCover();

                $news->setNewsCover($cover);

                if ($news->sqlUpdateCover()) {

                    $this->setReturn(20);

                    $news->imgDelete($capaAntiga);
                } else {
                    $this->setReturn(19);
                    $news->imgDelete($cover);
                }


            } else {
                DjWork::deleteImgTemp($cover);
                $news->imgDelete($cover);
                $this->setReturn(18);
            }


        } else {
            $this->setReturn(1);
            isset($image["name"]) ? $news->imgDelete($image["name"]) : false;
            DjWork::deleteImgTemp($cover);

        }


        return $this->getReturn();

    }

    public function delete()
    {
        $this->setMsg("Não está logado, ou não tem permissão", false, 1);
        $this->setMsg("Noticia Deletada com sucesso", true, 2);
        $this->setMsg("FALTA_ERROR, não foi possivel deletar a noticias no banco de dados", false, 3);

        $news = new News();
        $newsId = DjRequest::post("news_id");

        // verificando se tem todas as permisões
        if ($news->validateUser($newsId)):

            if ($news->sqlDelete()):

                $this->setReturn(2);

                $news->imgDelete($news->getNewsCover());
            else:
                $this->setReturn(3);
            endif;
            $this->setReturn(1);
        endif;

        return $this->getReturn();
    }


}