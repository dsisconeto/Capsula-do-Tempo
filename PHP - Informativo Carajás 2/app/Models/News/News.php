<?php

namespace App\Models\News;


use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\Geo\RegionUserPermission;
use App\Models\System\SystemUrl;
use App\Models\User\Login;
use App\Models\User\User;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Request;

/**
 * Class News
 * @package App\Models\News
 */
class News extends Model
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $title;
    private $post;
    private $preview;
    private $keywords;
    private $tag;
    private $cover;
    private $status;
    private $newsNotificationApp;
    private $counterView;
    private $user;
    private $url;
    private $userPermission;
    private $dateInsert;
    private $dateUpdate;


    public function __construct()
    {
        $this->setTable("news");
        $this->setImgFolder("news_cover");
        $this->setPrimaryKey("news_id");
        $this->url = new SystemUrl();
        $this->url()->entity()->setId(1);

    }

    public function register()
    {

        $sql = $this->sqlInsert();

        $sql->setRowData("news_title", $this->getTitle());
        $sql->setRowData("news_post", $this->getPost());
        $sql->setRowData("news_preview", $this->getPreview());
        $sql->setRowData("news_keywords", $this->getKeywords());
        $sql->setRowData("news_status", $this->getStatus());
        $sql->setRowData("news_notification_app", $this->getNewsNotificationApp());
        $sql->setRowData("system_user_id_fk", $this->user()->getId());
        $sql->setRowData("system_url_id_fk", $this->url()->getId());
        $sql->setRowData("system_user_id_permission_fk", $this->getUserPermission());
        $sql->setRowData("news_date_insert", GetData::getCurrentTime());
        $sql->setRowData("news_tag_id_fk", $this->tag()->getId());
        $sql->setRowData("session", session_id());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', "{$this->getId()}"));

        $sql->setRowData("news_title", $this->getTitle());
        $sql->setRowData("news_post", $this->getPost());
        $sql->setRowData("news_preview", $this->getPreview());
        $sql->setRowData("news_keywords", $this->getKeywords());
        $sql->setRowData("news_notification_app", $this->getNewsNotificationApp());
        $sql->setRowData("system_user_id_permission_fk", $this->getUserPermission());
        $sql->setRowData("news_date_update", GetData::getCurrentTime());
        $sql->setRowData("news_tag_id_fk", $this->tag()->getId());

        $sql->setCriteria($criteria);

        return $sql->execute();
    }


    public function editStatus()
    {

        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', "{$this->getId()}"));
        $sql->setRowData("news_status", $this->getStatus());
        $sql->setCriteria($criteria);
        return $sql->execute();


    }

    public function editCover()
    {

        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', "{$this->getId()}"));
        $sql->setRowData("news_cover", $this->getCover());
        $sql->setCriteria($criteria);
        return $sql->execute();


    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setJoin("news", "news_tag", "news_tag_id_fk", "news_tag_id");
        $sql->setJoin("news_tag", "news_category", "news_category_id_fk", "news_category_id");
        $sql->setJoin("news", "system_url", "system_url_id_fk", "system_url_id");

        return $sql->execute();
    }


    public function searchWithRegion($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;

        $sql->setJoin("news", "news_tag", "news_tag_id_fk", "news_tag_id");
        $sql->setJoin("news_tag", "news_category", "news_category_id_fk", "news_category_id");
        $sql->setJoin("news", "system_url", "system_url_id_fk", "system_url_id");
        $sql->setJoin("news", "news_relationship_region", "news_id", "news_id_fk");

        return $sql->execute();
    }


    public function load($id = false)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        if ($id) {
            $criteria->add($this->filter('news_id', '=', $id));
        } else {
            $criteria->add($this->filter('news_id', '=', $this->getId()));
        }


        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->addColumn("*");


        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["news_id"]);
            $this->setTitle($res["news_title"]);
            $this->setPost($res["news_post"]);
            $this->setPreview($res["news_preview"]);
            $this->setKeywords($res["news_keywords"]);
            $this->tag()->setId($res["news_tag_id_fk"]);
            $this->setCover($res["news_cover"]);
            $this->setStatus($res["news_status"]);
            $this->setNewsNotificationApp($res["news_notification_app"]);
            $this->setCounterView($res["news_counter_view"]);
            $this->setUserPermission($res["system_user_id_permission_fk"]);
            $this->user()->setId($res["system_user_id_fk"]);
            $this->url()->setId($res["system_url_id_fk"]);
            $this->setDateInsert($res["news_date_insert"]);
            $this->setDateUpdate($res["news_date_update"]);
        endif;

        return $res;
    }

    public function loadTotal($id = false)
    {
        if ($id) {
            $this->setId($id);
        }

        // carrega todos os dados de uma noticia
        // pode ser tanto po id quando por url
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        if ($this->getId()) {
            $criteria->add($this->filter('news_id', '=', $this->getId()));
        } else {
            $criteria->add($this->filter('system_url_url', '=', $this->url()->getUrl()));
        }

        $criteria->setProperty("limit", 1);
        $sql->setCriteria($criteria);

        $sql->setJoin("news", "news_tag", "news_tag_id_fk", "news_tag_id");
        $sql->setJoin("news_tag", "news_category", "news_category_id_fk", "news_category_id");
        $sql->setJoin("news", "system_url", "system_url_id_fk", "system_url_id");

        $sql->addColumn("*");
        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["news_id"]);
            $this->setTitle($res["news_title"]);
            $this->setPost($res["news_post"]);
            $this->setPreview($res["news_preview"]);
            $this->setKeywords($res["news_keywords"]);
            $this->tag()->setId($res["news_tag_id_fk"]);
            $this->tag()->setName($res["news_tag_name"]);
            $this->tag()->setNickname($res["news_tag_nickname"]);
            $this->tag()->category()->setId($res["news_category_id"]);
            $this->tag()->category()->setName($res["news_category_name"]);
            $this->tag()->category()->setNickname($res["news_category_nickname"]);
            $this->tag()->category()->setColor($res["news_category_color"]);
            $this->setCover($res["news_cover"]);
            $this->setStatus($res["news_status"]);
            $this->setNewsNotificationApp($res["news_notification_app"]);
            $this->setCounterView($res["news_counter_view"]);
            $this->setUserPermission($res["system_user_id_permission_fk"]);
            $this->user()->setId($res["system_user_id_fk"]);
            $this->url()->setId($res["system_url_id_fk"]);
            $this->url()->setUrl($res["system_url_url"]);
            $this->setDateInsert($res["news_date_insert"]);
            $this->setDateUpdate($res["news_date_update"]);
        endif;

        return $res;

    }

    public function validateByUser($news_id = false)
    {
        if ($news_id) {
            $this->setId($news_id);
        }

        $sql = $this->sqlSelect();
        $regionUser = new RegionUserPermission();
        $criteria1 = $this->criteria();
        $criteria2 = $regionUser->createCriteria("news", "news_relationship_region.geo_region_id");
        $criteria3 = $this->criteria();
        $sql->addColumn("news_id");
        $criteria1->add($this->filter("news_id", "=", $this->getId()));

        $criteria3->setProperty("limit", "1");
        $criteria3->add($criteria1);
        $criteria3->add($criteria2);
        $sql->setCriteria($criteria3);

        $sql->setJoin("news", "news_relationship_region", "news_id", "news_id_fk");

        return $sql->execute();
    }


    public function related($regionId, $limit = 3)
    {
        // seleciona noticias relacionadas
        $criteriaRegion = (new RegionRelationshipParent())->createCriteriaByRegion($regionId);
        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $keyWords = DataFormat::keyWords($this->getTitle(), true);

        foreach ($keyWords as $key => $value) {

            $cri->add($this->filter("news_title", "LIKE", "%$value%"), Criteria::OR_OPERATOR);


        }

        $cri2->add($this->filter("news_status", "=", "3"));

        $cri3->setProperty("order", "news_date_insert DESC");
        $cri3->setProperty("limit", $limit);
        $cri3->add($cri);
        $cri3->add($cri2);
        $cri3->add($criteriaRegion);


        return $this->searchWithRegion($cri3);
    }

    /**
     * @param $regionId
     * @param int $limit
     * @return array
     *  retorna as noticias mais vistas
     */
    public function mostViewed($regionId, $limit = 3)
    {

        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $criteriaRegion = (new RegionRelationshipParent())->createCriteriaByRegion($regionId);

        $cri->add($this->filter("news_date_insert", ">=", DataFormat::dateLess(GetData::getCurrentTime(), 7)));
        $cri->add($this->filter("news_status", "=", "3"));


        $cri2->setProperty("limit", $limit);
        $cri2->setProperty("order", "news_counter_view DESC");

        $cri2->add($cri);
        $cri2->add($criteriaRegion);


        return $this->searchWithRegion($cri2);
    }


    public function selectMachete($regionId)
    {


        $panel = new Panel();
        $panel->region()->setId($regionId);
        $panel->load();

        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $cri->add($this->filter("news_id", "=", $panel->local(1)->getId()), Criteria::OR_OPERATOR);
        $cri->add($this->filter("news_id", "=", $panel->local(2)->getId()), Criteria::OR_OPERATOR);
        $cri->add($this->filter("news_id", "=", $panel->local(3)->getId()), Criteria::OR_OPERATOR);

        $cri2->add($this->filter("news_status", "=", 3));
        $cri3->setProperty("limit", 3);

        $cri3->add($cri);
        $cri3->add($cri2);

        $col = array("news_title", "news_cover", "news_tag_name", "news_category_name", "news_category_color", "system_url_url");

        return $this->select($cri3, $col);
    }


    public function updateCounterView($newsId, $counterView)
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $criteria->add($this->filter("news_id", "=", $newsId));
        $sql->setCriteria($criteria);
        $sql->setRowData("news_counter_view", $counterView);


        return $sql->execute();
    }


    public function selectByTag($tagId, $limit)
    {
        // seleciona as ultimas noticias por tag

        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $criteriaRegion = (new RegionRelationshipParent())->createCriteriaByRegion(Region::define());
        $cri->add($this->filter("news_status", "=", "3"));
        $cri->add($this->filter("news_tag.news_tag_id_fk", "=", $tagId));
        $cri2->setProperty("limit", $limit);
        $cri2->setProperty("order", "news_date_insert DESC");

        $cri2->add($cri);
        $cri2->add($criteriaRegion);


        return $this->searchWithRegion($cri2);
    }


    public function selectByCategory($catId, $limit, $col = "*")
    {


        $cri = $this->criteria();
        $cri2 = $this->criteria();
        $criteriaRegion = (new RegionRelationshipParent())->createCriteriaByRegion(Region::define());
        $cri->add($this->filter("news_status", "=", "3"));
        $cri->add($this->filter("news_category.news_category_id", "=", $catId));
        $cri2->setProperty("limit", $limit);
        $cri2->setProperty("order", "news_date_insert DESC");

        $cri2->add($cri);
        $cri2->add($criteriaRegion);


        return $this->searchWithRegion($cri2, $col);
    }


    public function lastNews($limit = 3)
    {
        // busca as ultimas noticias por região

        $geoRegionRelationParent = new RegionRelationshipParent();
        $cri = $geoRegionRelationParent->createCriteriaByRegion(Region::define());

        $cri2 = $this->criteria();
        $cri3 = $this->criteria();

        $cri2->add($this->filter("news_status", "=", 3));

        $cri3->add($cri);
        $cri3->add($cri2);

        $cri3->setProperty("limit", "$limit");
        $cri3->setProperty("order", "news_date_insert DESC");

        return $this->searchWithRegion($cri3);

    }


    /**
     * @return SystemUrl
     */
    public function url()
    {
        return $this->url;
    }


    /**
     * @return mixed
     */
    public
    function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public
    function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public
    function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public
    function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public
    function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public
    function getPreview()
    {
        return $this->preview;
    }

    /**
     * @param mixed $preview
     */
    public
    function setPreview($preview)
    {
        $this->preview = $preview;
    }

    /**
     * @return mixed
     */
    public
    function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return Tag
     */
    public function tag()
    {
        $this->tag = $this->tag ? $this->tag : new Tag();

        return $this->tag;
    }


    /**
     * @return mixed
     */
    public
    function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public
    function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return mixed
     */
    public
    function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public
    function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public
    function getNewsNotificationApp()
    {
        return $this->newsNotificationApp;
    }

    /**
     * @param mixed $newsNotificationApp
     */
    public
    function setNewsNotificationApp($newsNotificationApp)
    {
        $this->newsNotificationApp = $newsNotificationApp;
    }

    /**
     * @return mixed
     */
    public
    function getCounterView()
    {
        return $this->counterView;
    }

    /**
     * @param mixed $counterView
     */
    public
    function setCounterView($counterView)
    {
        $this->counterView = $counterView;
    }

    /**
     * @return User
     */
    public
    function user()
    {
        $this->user = $this->user ? $this->user : new User();

        return $this->user;
    }


    /**
     * @return mixed
     */
    public
    function getUserPermission()
    {
        return $this->userPermission;
    }

    /**
     * @param mixed $userPermission
     */
    public
    function setUserPermission($userPermission)
    {
        $this->userPermission = $userPermission;
    }

    /**
     * @return mixed
     */
    public
    function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * @param mixed $dateInsert
     */
    public
    function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;
    }

    /**
     * @return mixed
     */
    public
    function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     */
    public
    function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }


}
