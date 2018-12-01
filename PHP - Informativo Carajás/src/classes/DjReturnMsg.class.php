<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 26/08/16
 * Time: 21:26
 */
class DjReturnMsg
{
    private $msg;
    private $return;


    public function setMsg($msg, $boolean = false, $code = false)
    {
        if (!$code) {
            $code = count($this->msg);
            if ($code != 0) {
                $code += 1;
            }
        }

        $this->msg[$code]["msg"] = $msg;
        $this->msg[$code]["boolean"] = $boolean;


    }


    public function jsonExit($array)
    {

        echo json_encode($array);
        exit();


    }

    public function setReturn($code, $data = false)
    {

        if (isset($this->msg[$code])):

            $this->msg[$code]["data"] = $data;

            $count = count($this->return);

            if ($count > 0):

                $count += 1;
                $this->return[$count] = $this->msg[$code];
            else:

                $this->return[0] = $this->msg[$code];

            endif;


        endif;
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {

        if ($this->return != array()) {

            return $this->return;

        } else {

            $this->setMsg("Não foi definido uma menssagem de retorno", false, 0);
            $this->setReturn(0);


            return $this->return;

        }


    }


    public function noError()
    {
        return count($this->return) == 0 ? true : false;
    }

    public function isSuccess()
    {

        $res = $this->getReturn();

        return ((isset($res[0]["boolean"])) && $res[0]["boolean"]);

    }

    public function getData($index = 0)
    {

        return isset($this->return[$index]["data"]) ? $this->return[$index]["data"] : false;
    }


    public function noPermission($expresion)
    {


        if (!$expresion) {

            $json[0]["msg"] = "Ops, Você não tem perissão para fazer isto :)";
            $json[0]["boolean"] = false;
            $json[0]["data"] = false;


            echo json_encode($json);
            exit();
        }

    }

}