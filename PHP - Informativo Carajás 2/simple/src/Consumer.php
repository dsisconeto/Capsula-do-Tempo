<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 06/05/17
 * Time: 12:57
 */

namespace DSisconeto\Simple;

use GuzzleHttp\Client as Guzzle;

class Consumer
{
    private $params;
    private $url;

    public function __construct($url)
    {

        $this->url = $url;
    }


    public function get()
    {
        return $this->request("GET");
    }


    public function post()
    {
        return $this->request("POST");
    }

    public function definerParams($method)
    {
        $params = array('form_params' => array());
        if ($method == "POST") {
            $params = array('form_params' => array());
            if (count($this->params)) {
                foreach ($this->params as $key => $val) {
                    $params["form_params"][$key] = $val;
                }
            }
            return $params;

        } else {


            if (count($this->params)) {

                foreach ($this->params as $key => $val) {

                    if ($key == 0) {
                        $this->url .= "?";

                    } else {
                        $this->url .= "&";
                    }

                    if (is_array($val)) {
                        foreach ($val as $key2 => $val2) {
                            $this->url .= "{$key}[$key2]={$val2}&";
                        }
                    } else {

                        $this->url .= "{$key}={$val}";
                    }
                }

            }

        }

        return $params;
    }


    private function request($method)
    {
        $guzzle = new Guzzle();
        $array = array();

        if ($method == "POST") {

            $response = $guzzle->request($method, $this->url, $this->definerParams($method))->getBody();

        } else {
            $this->definerParams($method);
            $response = $guzzle->request($method, $this->url)->getBody();
        }


        if ($response) {
            $array = json_decode($response, true);
        }
        return $array;
    }


    public function add($name, $value)
    {
        $this->params[$name] = $value;

        return $this;
    }

}