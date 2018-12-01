<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 27/04/17
 * Time: 02:22
 */

namespace App\Models\News;


use App\Models\Geo\Region;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\Model;

class Panel extends Model
{
    private $numberLocal = 22;
    private $region;
    private $local;

    /**
     * @return int
     */
    public function getNumberLocal()
    {
        return $this->numberLocal;
    }


    public function __construct()
    {
        $this->setTable("news_panel");
        $this->setPrimaryKey("geo_region_id_fk");


    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("geo_region_id_fk", $this->region()->getId());

        for ($i = 1; $i <= $this->getNumberLocal(); $i++) {
            $sql->setRowData("local_$i", $this->local($i)->getId());
        }

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->region()->getId()));
        for ($i = 1; $i <= $this->getNumberLocal(); $i++) {
            $sql->setRowData("local_$i", $this->local($i)->getId());
        }
        $sql->setCriteria($criteria);
        return $sql->execute();
    }

    public function loadTotal($col = NULL, $all = false, $limit = false)
    {
        $news = new News();
        $sql = $this->sqlSelect();
        $sql->addColumn("*");
        $criteria = $this->criteria();
        $criteria->add($this->filter("geo_region_id_fk", "=", $this->region()->getId()));
        $criteria->setProperty("limit", "1");
        $sql->setCriteria($criteria);

        $resultPanel = $sql->execute();

        if ($resultPanel) {

            $resultPanel = $resultPanel[0];
            $criteria = $this->createCriteriaNews($resultPanel);
            if ($all) {
                $resultNews = $news->select($criteria, $col);
            } else {
                $resultNews = $news->selectBasic($criteria, $col);
            }
            if ($resultNews) {
                foreach ($resultNews as $key) {
                    for ($i = 1; $i <= $this->getNumberLocal(); $i++) {
                        if ($key["news_id"] == $resultPanel["local_{$i}"]) {
                            $resultPanel["local_{$i}"] = $key;
                        } elseif (!$resultPanel["local_{$i}"]) {
                            $resultPanel["local_{$i}"] = array("news_id" => 0, "news_title" => "Não Definida");
                        }
                    }
                }
                unset($resultPanel["geo_region_id_fk"]);
                if ($limit) {
                    for ($i = 1; $i <= $this->getNumberLocal(); $i++) {
                        if ($i > $limit) {
                            unset($resultPanel["local_{$i}"]);
                        }
                    }
                }


                return $resultPanel;
            }


        }

        return false;
    }

    public function convert($resultNews)
    {
        $i = 1;
        $resultPanel = null;
        foreach ($resultNews as $key) {

            $resultPanel["local_{$i}"] = $key;
            $i++;
        }


        return $resultPanel;

    }


    public function createCriteriaNews($result)
    {
        $criteria = $this->criteria();

        if ($result) {
            for ($i = 1; $i <= $this->getNumberLocal(); $i++) {
                if ($result["local_$i"]) {
                    $criteria->add($this->filter("news_id", "=", $result["local_$i"]), Criteria::OR_OPERATOR);
                }
            }
        }
        $criteria->setProperty("limit", $this->getNumberLocal());
        return $criteria;
    }

    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;


        return $sql->execute();
    }

    public function issetPanel()
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();
        $criteria->add($this->filter("geo_region_id_fk", "=", $this->region()->getId()));
        $criteria->setProperty("limit ", "1");
        $sql->addColumn("geo_region_id_fk");
        $sql->setCriteria($criteria);
        return boolval($sql->execute());
    }

    public function load()
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();
        $criteria->add($this->filter("geo_region_id_fk", "=", $this->region()->getId()));
        $criteria->setProperty("limit ", "1");
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        $result = $sql->execute();

        if ($result) {
            $result = $result[0];
            for ($i = 1; $i <= $this->numberLocal; $i++) {
                $this->local($i)->setId($result["local_$i"]);
            }
        }
        return $result;
    }


    /**
     * @return Region
     */
    public function region()
    {
        $this->region = $this->region ? $this->region : new Region();

        return $this->region;
    }


    /**
     * @return News
     */
    public function local($indice)
    {
        $this->local[$indice] = isset($this->local[$indice]) ? $this->local[$indice] : new News();

        return $this->local[$indice];
    }

}