<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 26/08/16
 * Time: 19:33
 */
class DjRouter
{

    private static $router;
    private static $getValues;
    private static $indexRouter;
    private static $segmentRouter;


    public static function getSegmentRouter()
    {

        return self::$segmentRouter;
    }

    public static function getIndexRouter()
    {

        return self::$indexRouter;
    }

    public static function router($router, $pathClassMethod, Array $configGet = Array())
    {

        $len = strlen($router);

        $bar = substr($router, ($len - 1), ($len));

        $router = ($bar != "/" ? $router .= "/" : $router);
        $ex = explode("/", $router);

        if (($router == "//" && $len == 2) || ($router == "/" && $len == 1)) {

            $router = "index/";

        } else if ($router == "(.)/" && $len == 4) {

            $router = "index/(.)/";

            if (isset($configGet[1])) {
                $configGet[2] = $configGet[1];
                unset($configGet[1]);
            }

        } else if (count($ex) == 2) {

            $router = "index/{$ex[0]}/";

        }

        $ex = explode("/", $router);
        $count = 0;
        $router = "";
        $countArray = count($ex) - 1;
        $indexRouter = count(self::$indexRouter) == 0 ? 0 : count(self::$indexRouter);


        if ($ex) {

            foreach ($ex as $key => $value) {


                if ($configGet) {

                    if ($value == "(.)") {

                        self::$getValues[$indexRouter][($count + 1)] = $configGet[($count + 1)];

                    }

                }

                if ($count < $countArray) {

                    if ($value) {

                        $router .= "$value/";
                        self::$segmentRouter[$indexRouter][$count] = $value;
                    }


                } else {

                    $router .= $value ? "$value" : "";
                }

                $count++;

            }

            self::$indexRouter[$indexRouter] = $router;
            self::$router[$indexRouter] = self::definePcm($pathClassMethod);
        }


    }


    public static function executeServices()
    {

        self::execute("services");
    }

    public static function executeForm()
    {

        self::execute("form");

    }

    public static function executeController()
    {
        self::execute("controller");
    }


    public static function setValueGet($indexRouter)
    {

        if (isset(self::$getValues[$indexRouter])) {


            foreach (self::$getValues[$indexRouter] as $key => $val) {


                if (DjRequest::issetGet("router_$key")) {

                    $_GET[$val] = DjRequest::get("router_$key");

                }

            }

        }

    }


    public static function routerServices($router, $pathClassMethod, $configGet = array())
    {


        self::router($router, $pathClassMethod, $configGet);
    }


    private static function definePcm($pathClassMethod)
    {
        $path = "";

        $pathClassMethod = explode(".", $pathClassMethod);

        if ($pathClassMethod) {


            $count = count($pathClassMethod) - 1;
            foreach ($pathClassMethod as $key => $value) {


                if ($key < $count) {
                    $path .= "$value/";

                } else {


                    $classMethod = $value;

                }

            }

        } else {

            $classMethod = $pathClassMethod;
        }

        $res = explode("@", $classMethod);

        if (isset($res[0]) && isset($res[1])) {

            return array("class" => $res[0], "method" => $res[1], "path" => $path);

        } else {

            return array("class" => "", "method" => "", "path" => "");
        }


    }


    private static function execute($type)
    {


        $dir = "../src/request/";
        $boot = self::$router;

        switch ($type) {

            case "services":
                $dir .= "services/";
                break;

            case "form":
                $dir .= "form/";
                break;

            case "controller":
                $dir .= "controller/";
                break;

        }


        if (isset($boot[DjRequest::get("router")])) {

            $boot = $boot[DjRequest::get("router")];

            $class = $boot["class"];
            $method = $boot["method"];

            if ($boot["path"]) {
                $dir .= $boot["path"];
            }


            $file = $dir . $class . ".php";


            if (file_exists($file)) {
                require_once $file;


                if (class_exists($class)) {
                    $class = new $class;
                    if (method_exists($class, $method)) {


                        $res = call_user_func(array($class, $method));

                        switch ($type) {

                            case "services":

                                $json["boolean"] = is_array($res) && $res ? true : false;
                                $json["items"] = is_array($res) && $res ? $res : array();
                                $json["count"] = is_array($res) && $res ? count($res) : array();
                                echo json_encode($json);
                                break;

                            case "form":
                                if ((is_array($res)) && isset($res[0]["boolean"]) && isset($res[0]["msg"]) && isset($res[0]["data"])) {
                                    echo json_encode($res);
                                }
                                break;


                        }
                    }

                }


            }
        }


    }


    public static function boot()
    {

        DjWork::sessionStart();
        switch (DjRequest::get("boot")) {

            case "services":
                require_once "../src/router/services.php";

                break;


            case "controller":
                require_once "../src/router/controller.php";

                break;

            case "form":

                require_once "../src/router/form.php";

                break;
        }


        $count = 1;
        $router = "";

        $indexRouter = self::getIndexRouter();
        $segment = self::getSegmentRouter();

        $comp = array();

        foreach ($indexRouter as $keyRouter => $valRouter) {


            foreach ($segment[$keyRouter] as $keySeg => $valSeg) {

                if (!isset($comp[$keyRouter])) {

                    $comp[$keyRouter] = "";
                }

                if ($valSeg == "(.)") {

                    $numberRouter = $keySeg + 1;
                    $comp[$keyRouter] .= DjRequest::get("router_$numberRouter") . "/";


                } elseif (!$valSeg) {


                } else {

                    $comp[$keyRouter] .= "$valSeg/";

                }

            }


        }


        $routerGet = "";
        $countRouter = 1;
        foreach ($_GET as $key => $val) {


            if ($key == "router_{$countRouter}") {


                $routerGet .= $val ? "$val/" : "";

                $countRouter++;
            }

        }

        $routerDefine = null;

        foreach ($comp as $keyRouter => $valRouter) {

            if ($routerGet == $valRouter) {

                $routerDefine = $keyRouter;

                self::setValueGet($keyRouter);
                break;
            }


        }


        DjRequest::setGet("router", $routerDefine);

    }


    public static function callForm($pathClassMethod, $config = array())
    {
        return self::call("form", $pathClassMethod, $config);
    }


    public static function callController($pathClassMethod, $config = array())
    {
        return self::call("controller", $pathClassMethod, $config);
    }


    private static function call($type, $pathClassMethod, $config = array())
    {
//  exemplo array("post"=>array( "id"=> 1));

        if ((isset($config["get"])) && $config["get"]) {

            foreach ($config["get"] as $keyGet => $valGet) {

                DjRequest::setGet($keyGet, $valGet);
            }
        }


        if ((isset($config["post"])) && $config["post"]) {

            foreach ($config["post"] as $keyPost => $valPost) {

                DjRequest::setPost($keyPost, $valPost);

            }
        }


        $boot = self::definePcm($pathClassMethod);
        $dir = "../src/request/";

        switch ($type) {

            case "services":
                $dir .= "services/";
                break;

            case "form":
                $dir .= "form/";
                break;

            case "controller":
                $dir .= "controller/";
                break;

        }

        $class = isset($boot["class"]) ? $boot["class"] : null;
        $method = isset($boot["method"]) ? $boot["method"] : null;

        if ((isset($boot["path"])) && $boot["path"]) {
            $dir .= $boot["path"];
        }


        $file = $dir . $class . ".php";


        if (file_exists($file)) {
            require_once $file;

            if (class_exists($class)) {

                $class = new $class;

                return call_user_func(array($class, $method));

            }


        }


    }
}