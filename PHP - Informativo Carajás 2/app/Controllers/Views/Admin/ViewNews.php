<?php


namespace App\Controllers\Views\Admin;

use App\Models\News\Category;
use App\Models\News\News;
use App\Models\News\RelationshipRegion;
use App\Models\News\RelationshipUserCategory;
use App\Models\User\Login;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\View;
use DSisconeto\Simple\Request;

class ViewNews extends View
{

    public function __construct()
    {

        Login::validateView(Request::cookie("jwt"), 1);

        $this->setData("systemUserName", Request::cookie("user_name"));
        $this->setData("permissionNews", Login::user()->getPermission(1));
        $this->setData("permissionNewsCategory", Login::user()->getPermission(2));
        $this->setData("permissionNewspaper", Login::user()->getPermission(10));
        $this->setData("permissionEvent", Login::user()->getPermission(4));
        $this->setData("permissionEventCategory", Login::user()->getPermission(5));
        $this->setData("permissionAds", Login::user()->getPermission(8));
        $this->setData("permissionCompany", Login::user()->getPermission(7));
        $this->setData("permissionGeoRegion", Login::user()->getPermission(11));
        $this->setData("permissionUserRegister", Login::user()->getPermission(9));
        $this->setData("HOST_MAIN", GetData::getConfig("HOST_MAIN"));
        $this->setData("HOST_IMG", GetData::getConfig("HOST_MAIN"));

    }


    public function displayTable()
    {

        $this->setData("categoryAll", (new Category())->selectAllByName());

        if (Request::get("news_status")) {


            $this->setData("newsStatus", Request::get("news_status"));

        } else {

            $this->setData("newsStatus", 0);

        }

        $this->view("admin.news@displayTable");
    }

    public function register()
    {

        $relation = new RelationshipUserCategory();

        $res = $relation->relatedToUser();

        if ($res) {

            $this->setData("allCategory", $res);
        }

        $this->setData("newsTitle", null);
        $this->setData("newsPost", null);
        $this->setData("newsPreview", null);
        $this->setData("newsKeywords", null);
        $this->setData("edit", false);
        $this->setData("select2", true);


        $this->view("admin.news@manager");
    }

    public function edit()
    {

        $news = new News();
        $region = new RelationshipRegion();
        $categoryHas = new RelationshipUserCategory();

        $news->loadTotal(Request::get("news_id", "int", 0));


        // Informações da noticia
        $this->setData("newsId", $news->getId());

        $this->setData("newsTitle", $news->getTitle());
        $this->setData("newsPost", $news->getPost());
        $this->setData("newsPreview", $news->getPreview());
        $this->setData("newsKeywords", $news->getKeywords());
        $this->setData("newsStatus", $news->getStatus());
        // categoria e tag selecionada
        $this->setData("newsCategoryId", $news->tag()->category()->getId());
        $this->setData("newsCategoryName", $news->tag()->category()->getName());
        $this->setData("newsTagId", $news->tag()->getId());
        $this->setData("newsTagName", $news->tag()->getName());
        // regiões selecionadas
        $res = $region->selectByNews($news->getId());
        $this->setData("geoRegionSelect", $res);
        // tags da categoria selecionada
        $res = $news->tag()->selectByCategory();
        $this->setData("newsTagAll", $res);
        // todas categorias disponiveis
        $res = $categoryHas->relatedToUser();
        $this->setData("allCategory", $res);

        $this->setData("edit", true);

        $this->view("admin.news@manager", false);
    }

    public function panel()
    {

        $this->setData("select2", true);
        $this->view("admin.news@panel");

    }

    public function cover()
    {
        $news = new News();
        // buscas os dados da noticias
        $this->setData("edit", false);
        $news->loadTotal(Request::get("news_id", "int", 0));


        $this->setData("newsTitle", $news->getTitle());
        $this->setData("newsId", $news->getId());
        $this->setData("newsStatus", $news->getStatus());

        if ($news->getCover()) {
            $this->setData("edit", true);
            $this->setData("newsCover", $news->getCover());
        }

        $this->view("admin.news@cover", false);
    }

    public function frameImgContent()
    {

        $this->view("admin.news@imgContentUpload");

    }

    public function tag()
    {


        $this->setData("newsCategoryAll", (new RelationshipUserCategory())->relatedToUser());


        $this->view("admin.news@tag");
    }

}