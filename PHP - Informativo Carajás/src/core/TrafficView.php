<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 08/05/16
 * Time: 12:54
 */
sysLoadClass("TrafficSource");
sysLoadClass("SystemUrl");
sysLoadClass("ActionTrafficView");


class TrafficView extends ActionTrafficView
{


    public function register($url, $source = 0)
    {
        $trafficSource = new TrafficSource();
        $systemUrl = new SystemUrl();
        // verificar se não é bot

        if (DjWork::crawlerDetect()) {
            // é boot
            return false;
        } else {

            // verificando se existe uma fonte
            if (($source) && $trafficSource->sqlLoad($source)):
                $this->setTrafficSourceId($source);
            else:
                $this->setTrafficSourceId(1);
            endif;
            // capturando ip
            $this->setTrafficUserId($this->getIp());
            // capturando sistema operacional
            $this->setTrafficOsId(DjWork::captureOs());
            // verificando se url existe
            if ($systemUrl->issetUrl($url)):
                // setando o id da url
                $this->setSystemUrl($systemUrl->getId());
            else:
                return false;
            endif;
            // veiricando se não existe cookie para mesma url
            if (!isset($_COOKIE[$url])):
                // inserindo novo registro
                if ($this->sqlInsert()):
                    // criando cookie para não dublicar a visita
                    setcookie($url, "url", time() + 120);
                    return true;
                else:
                    return false;
                endif;

            else:
                return true;
            endif;

        }
    }


    public function counterViewUrl($systemUrlId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("system_url_id_fk", "=", $systemUrlId));
        $col[] = "system_url_id_fk";

        return count($this->sqlSelect($cri, $col));
    }
}