<?php

namespace App\Models\Process;

use App\Models\Geo\Region;
use App\Models\Geo\RegionRelationshipParent;
use App\Models\News\Category;
use App\Models\News\News;
use App\Models\News\Panel;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;

class NewsHome extends Model
{

    private $regionId;
    private $data;
    private $obsolete;


    public function __construct()
    {
        $this->setTable("process_news_home");
        $this->setPrimaryKey("geo_region_id_fk");


    }

    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("geo_region_id_fk", $this->getRegionId());
        $sql->setRowData("obsolete", $this->getObsolete());
        $sql->setRowData("data", $this->getData());
        $sql->setRowData("date_update", GetData::getCurrentTime());

        return $sql->execute();
    }


    public function edit()
    {
        $sql = $this->sqlUpdate();

        $criteria = $this->criteria();
        $criteria->add(new Filter("geo_region_id_fk", "=", $this->getRegionId()));
        $sql->setCriteria($criteria);
        $sql->setRowData("obsolete", $this->getObsolete());
        $sql->setRowData("data", $this->getData());
        $sql->setRowData("date_update", GetData::getCurrentTime());


        return $sql->execute();
    }


    public function load($regionId)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();
        $criteria->add(new Filter("geo_region_id_fk", "=", $regionId));
        $criteria->setProperty("limit", "1");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        $res = $sql->execute();


        if ($res) {
            $res = $res[0];
            $this->setRegionId($res["geo_region_id_fk"]);
            $this->setData($res["data"]);
            $this->setObsolete($res["obsolete"]);

        } else if ((new Region())->issetRegion($regionId)) {

            $this->setRegionId($regionId);
            $this->setObsolete(1);
            $this->setData("");
            $this->register();


        }

        if ($this->getObsolete()) {
            return $this->reload($regionId);
        }

        return true;
    }


    public function verify($regions)
    {
        $region = new Region();
        $parent = new RegionRelationshipParent();
        $criteria = new Criteria();

        if (is_array($regions)) {
            $regions = $parent->validateRegion($regions);
            foreach ($regions as $aux) {
                $criteria->add(new Filter("geo_region_id", "=", $aux["geo_region_id"]), Filter::OR_OPERATOR);
            }

            $regions = $region->select($criteria);

            $this->beginTransaction();
            foreach ($regions as $aux) {

                if ($aux["geo_region_level"] > 1) {
                    $parent->region()->setId($aux["geo_region_id"]);
                    $regions2 = $parent->selectDownRegion();

                    foreach ($regions2 as $aux2) {

                        $this->setRegionId($aux2["geo_region_id"]);
                        $this->setObsolete(1);
                        $this->setData("");
                        $this->edit();

                    }


                } else {

                    $this->setRegionId($aux["geo_region_id"]);
                    $this->setObsolete(1);
                    $this->setData("");
                    $this->edit();
                }


            }
            $this->commit();

        } else {

            $this->setRegionId($regions);
            $this->setObsolete(1);
            $this->setData("");
            $this->edit();

        }
    }


    public function reload($regionId)
    {
        $this->setRegionId($regionId);
        $this->setObsolete(0);
        $panel = new Panel();
        $news = new News();
        $categorys = (new Category())->selectAllByName();

        $resultPanel = null;
        $categoryResult = null;
        // recuperas todas categorias de noticias

        $col = ["news_id", "news_title", "news_cover", "system_url_url"];
        foreach ($categorys as $aux) {
            $categoryResult[] = [
                "news_category_name" => $aux["news_category_name"],
                "items" => $news->selectByCategory($aux["news_category_id"], 8, $col)
            ];
        }
        // recuperar as notiias
        $panel->region()->setId(Region::define());
        $resultPanel = $panel->loadTotal($col, true);

        $resultPanel = [
            "panel" => $resultPanel,
            "category" => $categoryResult
        ];

        $this->setData(json_encode($resultPanel));


        return $this->edit();
    }

    /**
     * @return mixed
     */
    public function getObsolete()
    {
        return $this->obsolete;
    }

    /**
     * @param mixed $obsolete
     */
    public function setObsolete($obsolete)
    {
        $this->obsolete = $obsolete;
    }


    /**
     * @return mixed
     */
    public function getRegionId()
    {
        return $this->regionId;
    }

    /**
     * @param mixed $regionId
     */
    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


}