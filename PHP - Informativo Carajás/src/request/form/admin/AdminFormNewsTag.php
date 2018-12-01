<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 17:12
 */
sysLoadClass("NewsTag");
sysLoadClass("News");

class AdminFormNewsTag extends DjReturnMsg
{


    public function __construct()
    {

        $login = SystemLogin::getLogin();
        if ($login->validateLogIn() && $login->getSystemUserPermissionNews() && $login->getSystemUserPermissionNewsCategory()) {


        } else {

            exit();
        }

    }

    public function register()
    {

        $this->setMsg("Usuário não logado, ou não tem permissão.", false, 1);
        $this->setMsg("O nome da tag dever conter  de 2 a 20 caracteres", false, 2);
        $this->setMsg("Já existe uma tag com mesmo nome", false, 3);
        $this->setMsg("Tag adiciona com sucesso", true, 4);
        $this->setMsg("Erro ao  inserir tag no banco de dados", false, 5);

        $newsTag = new NewsTag();

        $newsTag->setNewsCategoryIdFk(DjRequest::post("news_category_id"));
        $newsTag->setNewsTagName(DjRequest::post("news_tag_name"));

        if ($newsTag->validateUser($newsTag->getNewsCategoryIdFk())):


            if (!$newsTag->validateCounterString($newsTag->getNewsTagName(), 2, 20)):
                $newsTag->setReturn(2);

            endif;

            if ($newsTag->issetTagByCategory($newsTag->getNewsTagName(), $newsTag->getNewsCategoryIdFk())):
                $this->setReturn(3);

            endif;

            $newsTag->setNewsTagName($newsTag->getNewsTagName());
            $newsTag->setNewsTagNickname($newsTag->standardizeUrl($newsTag->getNewsTagName()));
            $newsTag->setNewsCategoryIdFk($newsTag->getNewsCategoryIdFk());


            if ($this->noError()):

                if ($newsTag->sqlInsert()):

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
        $this->setMsg("O nome da tag dever conter  de 2 a 20 caracteres", false, 2);
        $this->setMsg("Já existe uma tag com mesmo nome", false, 3);
        $this->setMsg("Tag editada com sucesso", true, 4);
        $this->setMsg("Erro ao  editar tag no banco de dados", false, 5);

        $newsTag = new NewsTag();

        $newsTag->setNewsTagName(DjRequest::post("news_tag_name"));
        $newsTag->setNewsTagId(DjRequest::post("news_tag_id"));

        if ($newsTag->validateUser($newsTag->getNewsCategoryIdFk())):


            if (!$newsTag->validateCounterString($newsTag->getNewsTagName(), 2, 20)):
                $newsTag->setReturn(2);

            endif;

            if ($newsTag->issetTagByCategory($newsTag->getNewsTagName(), $newsTag->getNewsCategoryIdFk())):
                $this->setReturn(3);

            endif;

            $newsTag->setNewsTagName($newsTag->getNewsTagName());
            $newsTag->setNewsTagNickname($newsTag->standardizeUrl($newsTag->getNewsTagName()));


            if ($this->noError()):

                if ($newsTag->sqlUpdateName()):

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

        $newsTag = new NewsTag();
        $newsTag->sqlLoad(DjRequest::post("news_tag_id", "int"));

        $news = new News();
        $cri = new Criteria();
        $cri->add(new Filter("news_tag_id_fk", "=", $newsTag->getNewsTagId()));
        $cri->setProperty("limit", "1");

        if (!$news->sqlSelect($cri)) {

            if ($newsTag->validateUser($newsTag->getNewsCategoryIdFk())):

                $newsTag->sqlDelete() ? $this->setReturn(6) : $this->setReturn(7);

            else:

                $this->setReturn(1);

            endif;


        } else {

            $this->setReturn(8);
        }

        return $this->getReturn();

    }
}