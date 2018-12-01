<?php

require_once "../vendor/autoload.php";


$region = new \App\Models\Geo\Region();
$newsHome = new \App\Models\Process\NewsHome();

$regions = $region->select();

foreach ($regions as $aux) {
    $newsHome->setRegionId($aux["geo_region_id"]);
    $newsHome->setData("");
    $newsHome->setObsolete(1);
    $newsHome->register();
}



