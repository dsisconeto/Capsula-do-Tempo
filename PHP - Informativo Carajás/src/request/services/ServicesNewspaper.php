<?php
sysLoadClass("Newspaper");
sysLoadClass("NewspaperPage");

class ServicesNewspaper
{


    public function featAll()
    {
        $newspaper = new Newspaper();

        return $newspaper->search(DjRequest::cookie("geo_region_id"));

    }

    public function allPagesByNewspaper()
    {

        $page = new NewspaperPage();
        return $page->selectByNewspaper(DjRequest::get("newspaper_id", "int", 0));


    }

    public function page()
    {
        $newapeprId = DjRequest::get("newspaper_id", "int", 0);
        $pageNumber = DjRequest::get("newspaper_page_number", "int", 0);
        $page =new NewspaperPage();

        $cri = new Criteria();
        $cri->add(new Filter("newspaper_id", "=",$newapeprId));
        $cri->add(new Filter("newspaper_page_number", "=",$pageNumber));

        return $page->sqlSelect($cri);
    }


}