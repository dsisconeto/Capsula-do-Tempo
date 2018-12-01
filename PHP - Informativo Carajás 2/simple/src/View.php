<?php

namespace DSisconeto\Simple;


abstract class View
{
    private static $smarty;


    final public function location($router = "")
    {
        $host = GetData::getHostMain();
        header("location:{$host}$router");
        exit();

    }


    public function consumer($url)
    {
        return new Consumer($url);
    }


    final public function view($display, $filter = true)
    {

        $templeDir = "../templates/";
        $view = "";
        $displayExplode = explode(".", $display);
        $displayExplode2 = explode("@", $display);

        self::setData("host", GetData::getHostMain());
        self::setData("isMobile", GetData::getIsMobile());
        self::setData("count", 1);


        if (count($displayExplode) > 1) {

            $count = count($displayExplode) - 1;

            foreach ($displayExplode as $Key => $value) {

                if ($Key < $count) {

                    $templeDir .= "$value/";

                } else {

                    $res = explode("@", $value);

                    if (isset($res[0]) && isset($res[1])) {
                        $templeDir .= "{$res[0]}/";

                        $view .= "{$res[1]}.tpl";

                    }

                }

            }


        } elseif (isset($displayExplode2[0]) && isset($displayExplode2[1])) {
            $templeDir .= "{$displayExplode2[0]}/";

            $view .= "{$displayExplode2[1]}.tpl";

        } elseif (strlen($display) > 1) {

            $view .= "$display.tpl";

        }

        self::Smarty()->setCompileDir("../templates_c");
        self::Smarty()->template_dir = "$templeDir";

        if ($filter) {
            self::Smarty()->registerFilter("output", "minify_html");
        }


        self::Smarty()->display($view);
    }


    final private static function Smarty()
    {
        if (!self::$smarty) {

            self::$smarty = new \Smarty();

        }

        return self::$smarty;

    }

    final public function setData($name, $value)
    {

        self::Smarty()->assign($name, $value);


    }


}