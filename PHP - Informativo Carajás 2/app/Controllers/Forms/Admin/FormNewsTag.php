<?php

namespace App\Controllers\Forms\Admin;

use App\Models\News\News;
use App\Models\News\Tag;
use App\Models\User\Login;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;

use Respect\Validation\Validator as respect;

class FormNewsTag extends Form
{


    public function __construct()
    {

        Login::validateForm(Request::cookie("jwt"), array(1));
    }

    public function register()
    {

        $this->setMsg("Usuário não logado, ou não tem permissão.", false, 1);
        $this->setMsg("O nome da Tag dever conter  de 2 a 20 caracteres", false, 2);
        $this->setMsg("Já existe uma tagId com mesmo nome", false, 3);
        $this->setMsg("Tag adiciona com sucesso", true, 4);
        $this->setMsg("Erro ao  inserir tagId no banco de dados", false, 5);

        $newsTag = new Tag();

        $newsTag->category()->setId(Request::post("news_category_id"));
        $newsTag->setName(Request::post("news_tag_name"));

        if ($newsTag->validateUser($newsTag->category()->getId())):


            if (!respect::length(2, 20)->validate($newsTag->getName())):
                $this->setReturn(2);

            endif;

            if ($newsTag->issetTagByCategory($newsTag->getName(), $newsTag->category()->getId())):
                $this->setReturn(3);

            endif;

            $newsTag->setName($newsTag->getName());
            $newsTag->setNickname(DataFormat::standardizeUrl($newsTag->getName()));
            $newsTag->category()->setId($newsTag->category()->getId());


            if ($this->noError()):

                if ($newsTag->register()):

                    $this->setReturn(4);

                else:

                    $this->setReturn(5);

                endif;


            endif;

        else:
            $this->setReturn(1);

        endif;

        return $this->getReturn();


    }

    public function editName()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("O nome da tagId dever conter  de 2 a 20 caracteres", false, 2);
        $this->setMsg("Já existe uma tagId com mesmo nome", false, 3);
        $this->setMsg("Tag editada com sucesso", true, 4);
        $this->setMsg("Erro ao  editar tagId no banco de dados", false, 5);

        $newsTag = new Tag();

        $newsTag->setName(Request::post("news_tag_name"));
        $newsTag->setId(Request::post("news_tag_id"));

        if ($newsTag->validateUser($newsTag->category()->getId())):


            if (!respect::length(2, 20)->validate($newsTag->getName())):
                $this->setReturn(2);

            endif;

            if ($newsTag->issetTagByCategory($newsTag->getName(), $newsTag->category()->getId())):
                $this->setReturn(3);

            endif;

            $newsTag->setName($newsTag->getName());
            $newsTag->setNickname(DataFormat::standardizeUrl($newsTag->getName()));


            if ($this->noError()):

                if ($newsTag->edit()):

                    $this->setReturn(4);

                else:

                    $this->setReturn(5);

                endif;


            endif;

        else:
            $this->setReturn(1);

        endif;

        return $this->getReturn();


    }


    public function delete()
    {
        $this->setMsg("Não tem permissão ou não está logado", false, 1);
        $this->setMsg("Tag deletada com sucesso", true, 6);
        $this->setMsg("Erro ao Deletar Tag", false, 7);
        $this->setMsg("Existe notícia com essa tag", false, 8);

        $newsTag = new Tag();
        $newsTag->load(Request::post("news_tag_id", "int"));

        $news = new News();
        $cri = new Criteria();
        $cri->add(new Filter("news_tag_id_fk", "=", $newsTag->getId()));
        $cri->setProperty("limit", "1");

        if (!$news->select($cri)) {

            if ($newsTag->validateUser($newsTag->category()->getId())):

                $newsTag->delete() ? $this->setReturn(6) : $this->setReturn(7);

            else:

                $this->setReturn(1);

            endif;


        } else {

            $this->setReturn(8);
        }

        return $this->getReturn();

    }
}