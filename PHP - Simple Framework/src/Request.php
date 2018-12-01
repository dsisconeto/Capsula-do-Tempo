<?php

namespace DSisconeto\Simple;


class Request
{
    private static $requestId;
    private static $classMethod;
    private static $getValues;
    private static $route;
    private static $type;
    const REGEX = "/\(([A-Za-z0-9_.-]*)\)/";

    public static function boot()
    {
        self::sessionStart();

        $url = self::fragmentUrl();

        switch ($url[0]) {

            case "services":
                self::$type = "App\\Controllers\\Services\\";
                require_once "../app/Routes/Services.php";
                // retira nome services da url
                $aux = array();
                for ($i = 0; $i < (count($url) - 1); $i++) {
                    $aux[$i] = $url[$i + 1];
                }
                $url = $aux;
                break;

            case "form":
                // retira o nome form da url
                self::$type = "App\\Controllers\\Forms\\";
                require_once "../app/Routes/Form.php";
                $aux = array();
                for ($i = 0; $i < (count($url) - 1); $i++) {
                    $aux[$i] = $url[$i + 1];
                }
                $url = $aux;
                break;

            default:
                self::$type = "App\\Controllers\\Views\\";
                require_once "../app/Routes/View.php";
                break;
        }


        $countUrl = count($url);
        $routes = self::getRoute();
        $indexRoute = null;

        if ($routes) {  // verifica se exist rotas

            foreach ($routes as $keyS => $arguments) { // percorre todas as rotas
                $i = 0;
                $points = 0;

                foreach ($arguments as $keySS) { // percorre os argumentos da roda

                    if (isset($url[$i])) {

                        if ($url[$i] == $arguments[$i]) {


                            ($points++);

                        } elseif (preg_match_all(self::REGEX, $arguments[$i])) {

                            ($points++);

                        } else {
                            $points = 0;
                        }
                    } else {
                        $points = 0;
                    }

                    $i++;
                }
                if ($points == $countUrl) {
                    $indexRoute = $keyS;
                    break;
                }
            }
        } else {

        }


        if (isset($indexRoute)) {

            $i = 0;

            foreach ($routes[$indexRoute] as $arguments) {

                if (preg_match_all(self::REGEX, $arguments)) {
                    self::setGet(self::$getValues[$indexRoute][$i], $url[$i]);
                }
                $i++;

            }
            self::$requestId = $indexRoute;

            self::execute();

        } else {
            $url = self::getUrl();
            throw new \Exception("404 rota({$url}) não encotrada");
        }


    }

    public static function definePathClassMethod($classMethod)
    {
        $return["class"] = "";
        $return["method"] = "";
        $explode = explode("@", $classMethod);
        $return["method"] = $explode[1];
        $explode2 = explode(".", $explode[0]);
        $count = count($explode2);
        if ($count > 1) {
            for ($i = 0; $i < $count; $i++) {

                $return["class"] .= "{$explode2[$i]}";

                if ($i != ($count - 1)) {
                    $return["class"] .= "\\";
                }
            }
        } else {
            $return["class"] = $explode[0];
        }


        return $return;
    }

    public static function route($route, $classMethod)
    {
        $route = self::verifyBar($route);

        $route = explode("/", "$route");
        $indexRoute = count(self::$route) == 0 ? 0 : count(self::$route);

        if ($route) {

            foreach ($route as $key => $value) {
                $preg = preg_match_all(self::REGEX, $value, $match);
                if ($preg) {
                    // definindo os valores das rotas
                    self::$getValues[$indexRoute][$key] = $match[1][0];
                }

                self::$route[$indexRoute][$key] = $value;
            }


            self::$classMethod[$indexRoute] = self::definePathClassMethod($classMethod);
        }

    }


    private static function execute()
    {
        if (isset(static::$classMethod[static::$requestId])) {

            $pcm = static::$classMethod[static::$requestId];
            $method = $pcm["method"];
            $class = self::$type . $pcm["class"];

            $result = (new $class)->$method();

            switch (self::getType()) {

                case "App\Controllers\Services\\":

                    header('Content-Type:application/json');

                    $json["boolean"] = is_array($result) && $result ? true : false;
                    $json["items"] = is_array($result) && $result ? $result : array();
                    $json["count"] = is_array($result) && $result ? count($result) : array();
                    echo json_encode($json);
                    exit();


                case "App\Controllers\Forms\\":
                    header('Content-Type:application/json');
                    if ((is_array($result)) && isset($result[0]["boolean"]) && isset($result[0]["msg"]) && isset($result[0]["data"])) {
                        echo json_encode($result);
                        exit();
                    }
                    break;

            }
        }
    }


    public static function setCookie($name, $value = "", $expire = 0, $path = "/", $domain = "", $secure = false, $httponly = false)
    {

        $name = md5($name);

        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);

    }

    public static function unsetCookie($name, $path = "/")
    {
        $name = md5($name);
        if (isset($_COOKIE[$name])) {
            setcookie($name, null, -1, $path);
            unset($_COOKIE[$name]);
        }
    }


    private static function getRoute()
    {

        return self::$route;
    }

    private static function getType()
    {
        return self::$type;
    }


    private static function verifyBar($route)
    {
        $len = strlen($route);

        if ($len == 1) {
            $route = "index";
        }

        $barInit = substr($route, 0, 1);
        if ($barInit == "/") { // verifica se tem uma barra no inicio
            // caso tenha retira ela
            $route = substr($route, 1, $len);
        }
        $barFinal = substr($route, ($len - 1), ($len));
        if ($barFinal == "/") {
            $route = substr($route, 0, ($len - 1));
        }

        return $route;
    }


    private static function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    }

    private static function fragmentUrl()
    {
        $url = self::getUrl();
        // contar a url
        $len = strlen($url);
        if ($len > 1) {

            if (substr($url, ($len - 1), $len) == "/") {
                $url = substr($url, 0, ($len - 1));
            }

            if (substr($url, 0, 1) == "/") {
                $url = substr($url, 1, ($len));
            }
            return explode("/", $url);
        } else {
            return array(0 => "index");
        }
    }


    private static function sessionStart()
    {

        try {
            if (!isset($_SESSION)) {
                session_set_cookie_params(GetData::getConfig("SESSION_TIME") * 60);
                session_cache_expire(GetData::getConfig("SESSION_TIME"));
                session_name(md5("LALALAL" . $_SERVER['REMOTE_ADDR'] . "mdksamkdmasd"));
                session_start();
            }
        } catch (\Exception $e) {

        }
    }


    public static function cookie($cookieName, $type = false, $valueDefault = "")
    {
        return self::inputDefine($cookieName, "cookie", $type, $valueDefault);

    }

    public static function post($postName, $type = false, $valueDefault = "")
    {
        return self::inputDefine($postName, "post", $type, $valueDefault);

    }


    public static function get($getName, $type = false, $valueDefault = "")
    {

        return self::inputDefine($getName, "get", $type, $valueDefault);

    }

    public static function session($getName, $type = false, $valueDefault = "")
    {
        return self::inputDefine($getName, "session", $type, $valueDefault);

    }

    public static function file($getName)
    {
        return self::inputDefine($getName, "file", "", "");
    }


    public static function input($name, $type, $default = "")
    {
        $value = $default;
        $cookieName = md5($name);
        if (isset($_POST[$name])) {
            $value = $_POST[$name];
        } elseif (isset($_GET[$name])) {
            $value = $_GET[$name];
        } elseif (isset($_COOKIE[$cookieName])) {
            $value = $_COOKIE[$cookieName];
        } elseif (isset($_SESSION[$name])) {

            $value = $_SESSION[$name];
        } elseif (isset($_FILES[$name])) {
            $value = $_FILES[$name];
        }

        $value = DataFormat::convertType($value, $type);
        return $value;
    }


    public static function issetInput($name)
    {
        $cookieName = md5($name);
        if (isset($_POST[$name])) {
            return true;
        } elseif (isset($_GET[$name])) {
            return true;
        } elseif (isset($_COOKIE[$cookieName])) {
            return true;
        } elseif (isset($_SESSION[$name])) {
            return true;
        } elseif (isset($_FILES[$name])) {

            return true;
        }

        return false;
    }

    private
    static function inputDefine($name, $method, $dataType = false, $valueDefault = null)
    {
        $method = strtolower($method);

        switch ($method) {

            case "post":
                $method = $_POST;
                break;

            case "get":
                $method = $_GET;
                break;


            case "file":


                $method = $_FILES;

                break;

            case "cookie":
                $name = md5($name);
                $method = $_COOKIE;
                break;

            case "session":
                Request::sessionStart();
                $method = $_SESSION;
                break;

        }

        if (isset($method[$name])) {

            $data = $method[$name];


            $data = DataFormat::convertType($data, $dataType);

            return $data;

        } else {

            return $valueDefault;

        }

    }

    public
    static function setGet($name, $value)
    {
        if ($name && $value || (is_numeric($value))) {

            $_GET["$name"] = $value;

            return $_GET["$name"];

        } else {

            return null;
        }
    }


    public
    static function setSession($name, $value)
    {

        self::sessionStart();
        if ($name && $value || (is_numeric($value))) {

            $_SESSION["$name"] = $value;

            return $_SESSION["$name"];

        } else {

            return null;
        }

    }

    public
    static function setPost($name, $value)
    {

        if ($name && $value || (is_numeric($value))) {

            $_POST["$name"] = $value;

            return $_POST["$name"];

        } else {

            return null;
        }
    }

    public
    static function issetGet($name)
    {
        return self::issetRequest($name, "get");
    }

    public
    static function issetPost($name)
    {
        return self::issetRequest($name, "post");
    }

    public
    static function issetCookie($name)
    {

        return self::issetRequest($name, "cookie");

    }

    private
    static function issetRequest($name, $method)
    {
        switch ($method) {

            case "post":
                $method = $_POST;
                break;

            case "get":
                $method = $_GET;
                break;

            case "cookie":
                $name = md5($name);
                $method = $_COOKIE;
                break;

            case "session":
                self::sessionStart();
                $method = $_SESSION;
                break;


        }

        return isset($method[$name]) ? true : false;
    }


}