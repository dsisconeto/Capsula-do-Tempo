<?php

namespace App\Controllers\Forms\Admin;

use App\Models\News\News;
use App\Models\News\RelationshipRegion;
use App\Models\News\Tag;
use App\Models\Process\NewsHome;
use App\Models\User\Login;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;
use Respect\Validation\Validator as respect;


class FormNews extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::input("jwt", "str", ""), 1);

        if (Request::issetInput("news_id")) {
            $expression = (new News())->validateByUser(Request::input("news_id", "int", 0));
            Login::exitForm($expression, "Não autorizado");
        }
    }

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
        $this->setMsg("Não foi possivel criar relação com uma região", false, 9);
        $regionHas = new RelationshipRegion();

        $regions = Request::post("geo_region_id", "array");

        $news = new News();
        // validando o usuario
        $news->setTitle(Request::post("news_title"));
        $news->setPost(Request::post("news_post"));
        $news->setStatus(1);
        $news->user()->setId(Login::user()->getId());
        $news->tag()->setId(Request::post("news_tag_id"));


        if (!respect::length(5, 150)->validate($news->getTitle())):
            /// validando o titulo
            $this->setReturn(2);
        endif;

        if (!respect::length(20)->validate($news->getPost())):
            // validando Post
            $this->setReturn(3);
        endif;

        if (!respect::length(10, 250)->validate($news->getPreview())):
            // ca não seja enviada uma previa será colocada os 250 primeiros digitos
            $news->setPreview(DataFormat::limitText($news->getPost(), 250));
        endif;

        if (!respect::length(10, 150)->validate($news->getKeywords())):
            /// caso não seja enviado keywords validas será colocadas as do titulo
            $news->setKeywords(DataFormat::keyWords($news->getTitle()));
        endif;

        // caso não tenha erros insert essa porra mano
        if ($this->noError()) {

            $news->url()->setUrl($news->getTitle());
            $news->url()->register();

            if ($news->register()) {

                $news->lastId();

                if ($regionHas->register($news->getId(), $regions)) {


                    (new NewsHome())->verify($regions);

                    $this->setReturn(7, $news->getId());

                } else {
                    $news->url()->delete();
                    $news->delete();

                    $this->setReturn(9);
                }

            } else {
                $news->url()->delete();
                $news->delete();
                $this->setReturn(8);
            }
        }


        return $this->getReturn();
    }


    public function edit()
    {

        $this->setMsg("O titulo da noticia deve conter entre 5 a 150 caracteres", false, 2);
        $this->setMsg("O post da noticia deve conter no minimo 20 caracteres", false, 3);
        $this->setMsg("A preview da noticia deve conter entre 10 a 250 caracteres", false, 4);
        $this->setMsg("As keywords deve conter entre 10 a 150", false, 5);
        $this->setMsg("Noticia editada com sucesso", true, 7);
        $this->setMsg("FALTA_ERROR, não foi possivel editar a noticias no banco de dados", false, 8);
        $this->setMsg("Selecione uma categoria", false, 9);

        $tag = new Tag();
        $news = new News();
        $geoRegion = new RelationshipRegion();
        $regions = Request::post("geo_region_id", "array");


        $news->load(Request::post("news_id"));

        $news->setId(Request::post("news_id"));
        $news->setTitle(Request::post("news_title"));
        $news->setPost(Request::post("news_post"));
        $news->tag()->setId(Request::post("news_tag_id"));


        if (!respect::length(5, 150)->validate($news->getTitle())):
            /// validando o titulo
            $this->setReturn(2);
        endif;

        if (!$tag->issetTagId($news->tag()->getId())) {
            $this->setReturn(9);
        }

        if (!respect::length(20)->validate($news->getPost())):
            // validando Post
            $this->setReturn(3);
        endif;

        if (!respect::length(10, 250)->validate($news->getPreview())):
            // ca não seja enviada uma previa será colocada os 250 primeiros digitos
            $news->setPreview(DataFormat::limitText($news->getPost(), 250));
        endif;

        if (!respect::length(10, 150)->validate($news->getKeywords())):
            /// caso não seja enviado keywords validas será colocadas as do titulo
            $news->setKeywords(DataFormat::keyWords($news->getTitle()));
        endif;

        // caso não tenha erros insert essa porra mano
        if ($this->noError()) {

            if ($news->edit()) {

                $geoRegion->register($news->getId(), $regions);
                (new NewsHome())->verify($regions);
                $this->setReturn(7, $news->getId());

            } else {
                // caso der merda, apaga a imagem que foi upada;
                $this->setReturn(8);
            }
        }


        return $this->getReturn();
    }


    public function updateStatus()
    {
        $this->setMsg("Notícia públicada com sucesso", true, 13);
        $this->setMsg("Notícia despublicada com sucesso", true, 15);
        $this->setMsg("Não foi possivel públicar a notícia, coleque uma capa e tente novamente", false, 16);
        $this->setMsg("Não foi possivel públicar a notícia, relacione a mesma com uma região e tente novamente", false, 18);
        $this->setMsg("Não foi possivel editar o status da notícia, erro no banco de dados", false, 17);


        $relationGeoRegion = new RelationshipRegion();
        $news = new News();


        $news->setId(Request::post("news_id", "int", 0));
        $news->setStatus(Request::post("news_status", "int", 0));

        if ($news->getStatus() == 3) {

            $news->load($news->getId());
            $news->setStatus(3);

            if (!$news->imgExists($news->getCover())) {
                $this->setReturn(16);

            } elseif (!$relationGeoRegion->selectByNews($news->getId())) {
                $this->setReturn(18);

            } else {

                $news->editStatus() ? $this->setReturn(13) : $this->setReturn(17);
            }


        } else {

            $news->setStatus(1);
            $this->setReturn(15);
            $news->editStatus() ? $this->setReturn(15) : $this->setReturn(17);

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
        $cover = Request::post("news_cover");

        $resNews = $news->load(Request::post("news_id"));
        $news2 = $news;


        if ($resNews) {
            // movendo para pastar certar e criando thumbnail
            $image = UploadImage::croppicFinish($cover, "news_cover", 1200, 720);

        } else {

            $this->setReturn(18);
        }


        if ((isset($image["name"])) && $news->imgExists($image["name"])) {

            $cover = $image["name"];
            $capaAntiga = $news2->getCover();

            $news->setCover($cover);

            if ($news->editCover()) {

                $this->setReturn(20);

                $news->imgDelete($capaAntiga);
            } else {
                $this->setReturn(19);
                $news->imgDelete($cover);
            }


        } else {
            UploadImage::deleteImgTemp($cover);
            $news->imgDelete($cover);
            $this->setReturn(18);
        }


        return $this->getReturn();

    }

    public function delete()
    {
        $this->setMsg("Noticia Deletada com sucesso", true, 2);
        $this->setMsg("FALTA_ERROR, não foi possivel deletar a noticias no banco de dados", false, 3);

        $news = new News();
        $news->setId(Request::post("news_id"));

        if ($news->delete()):

            $this->setReturn(2);

            $news->imgDelete($news->getCover());
        else:
            $this->setReturn(3);
        endif;


        return $this->getReturn();
    }


}