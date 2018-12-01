<?php

class AdminControllerHome extends DjView
{


    public function index()
    {

        $url = new SystemUrl();

        $login = SystemLogin::getLogin();


        if ($login->validateLogIn()) {
            // criar sitemap

            if (!isset($_COOKIE["sitemap"])) {

                $url->siteMapCreate();
                setcookie("sitemap", '1', time() + 3600 * 60);
            }

            $this->view("admin@home");
        } else {

            $this->location("login/?continue=" . DjWork::currentUrl());
        }
    }
}