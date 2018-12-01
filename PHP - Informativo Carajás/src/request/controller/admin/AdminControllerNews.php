<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 02/09/16
 * Time: 16:01
 */

sysLoadClass("News");
sysLoadClass("NewsCategory");
sysLoadClass("NewsRelationshipUserCategory");
sysLoadClass("NewsRelationshipRegion");
sysLoadClass("NewsLocal");
sysLoadClass("NewsTag");
sysLoadClass("NewsRelationshipUserCategory");

class AdminControllerNews extends DjView
{

    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionNews()) {

            $this->setDate("systemUserName", $login->getSystemUserName());
            $this->setDate("systemUserProfilePhoto", $login->getSystemUserProfilePhoto(true));


        } else {

            $this->location("login/?continue=" . DjWork::currentUrl());

        }

    }


    public function displayTable()
    {

        $category = new NewsCategory();

        $this->setDate("categoryAll", $category->selectAllByName());

        if (DjRequest::get("news_status")) {


            $this->setDate("newsStatus", DjRequest::get("news_status"));

        } else {

            $this->setDate("newsStatus", 0);

        }

        $this->view("admin.news@displayTable");
    }

    public function register()
    {
        $login = SystemLogin::getLogin();
        $newsLocal = new NewsLocal();
        $categoryRelationUser = new NewsRelationshipUserCategory();

        $this->setDate("newsTitle", null);
        $this->setDate("newsPost", null);
        $this->setDate("newsPreview", null);
        $this->setDate("newsKeywords", null);
        $this->setDate("edit", false);
        $this->setDate("select2", true);

        $res = $categoryRelationUser->relatedToUser($login->getSystemUserId());
        $resLocal = $newsLocal->selectOrderByName();

        $this->setDate("newsLocalAll", $resLocal);
        $this->setDate("allCategory", $res);

        $this->view("admin.news@manager");
    }

    public function edit()
    {

        $login = SystemLogin::getLogin();
        $categoryRelationUser = new NewsRelationshipUserCategory();
        $news = New News();
        $newsLocal = new NewsLocal();
        $newsTag = new NewsTag();


        $newsId = DjRequest::get("news_id", "int", 0);


        if ($news->validateByUser($newsId)) {

            $resNews = $news->sqlLoad($newsId);

            $this->setDate("newsId", $news->getNewsId());
            $this->setDate("newsTitle", $news->getNewsTitle());
            $this->setDate("newsPost", $news->getNewsPost());
            $this->setDate("newsPreview", $news->getNewsPreview());
            $this->setDate("newsKeywords", $news->getNewsKeywords());
            $this->setDate("newsStatus", $news->getNewsStatus());

            $this->setDate("newsCategoryId", $resNews["news_category_id"]);
            $this->setDate("newsCategoryName", $resNews["news_category_name"]);

            $this->setDate("newsTagId", $resNews["news_tag_id"]);
            $this->setDate("newsTagName", $resNews["news_tag_name"]);

            $this->setDate("newsLocalId", $resNews["news_local_id"]);
            $this->setDate("newsLocalName", $resNews["news_local_name"]);
            $this->setDate("newsOrder", $resNews["news_order"]);
            $this->setDate("newsLocalCountMax", $resNews["news_local_count_max"]);

            $newTagAll = $newsTag->selectByCategory($resNews["news_category_id"]);
            $this->setDate("newsTagAll", $newTagAll);


            $this->setDate("edit", true);


            $newsRegion = new NewsRelationshipRegion();
            $resRegion = $newsRegion->selectByNews($news->getNewsId());

            if ($resRegion):
                $this->setDate("geoRegionSelect", $resRegion);
            endif;


            $res = $categoryRelationUser->relatedToUser($login->getSystemUserId());
            $this->setDate("select2", true);
            $this->setDate("allCategory", $res);
            /// listando os locais
            $resLocal = $newsLocal->selectOrderByName();
            $this->setDate("newsLocalAll", $resLocal);


            $this->view("admin.news@manager");

        } else {
            $this->location("admin/noticia/todas/");
        }


    }

    public function cover()
    {

        $this->setDate("edit", false);
        $this->setDate("news_status", 0);
        $news = new News();
        $newsId = DjRequest::get("news_id", "int", 0);
        if ($news->validateByUser($newsId)):

            $news->sqlLoad($newsId);


            $this->setDate("newsTitle", $news->getNewsTitle());
            $this->setDate("newsId", $news->getNewsId());
            $this->setDate("newsStatus", $news->getNewsStatus());
            if ($news->getNewsCover()):

                $this->setDate("edit", true);
                $this->setDate("newsCover", $news->getNewsCover());
                $this->setDate("news_status", $news->getNewsStatus());

            endif;


            $this->setDate("newsId", $newsId);

            $this->view("admin.news@cover");

        else:
            $this->location("admin/noticia/todas/");
        endif;


    }

    public function frameImgContent()
    {

        $this->view("admin.news@imgContentUpload");

    }

    public function tag()
    {

        $newsCategory = new NewsRelationshipUserCategory();

        $res = $newsCategory->relatedToUser();
        $this->setDate("newsCategoryAll", $res);
        $this->view("admin.news@tag");
    }

}