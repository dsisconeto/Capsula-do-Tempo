<?php
sysLoadClass("Framework");

class dbConnection extends Framework
{
    private static $conexao;

    private function connect()
    {
        try {
            $config = DjWork::getConfigs();

            if (!isset(self::$conexao)) {
                self::$conexao = new PDO(
                    "mysql:host={$config["db_host"]};dbname={$config["db_name"]}",
                    $config["db_user"],
                    $config["db_pass"],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            }
        } catch (PDOException $e) {
            echo "<h1>Falha ao estabalecer conexão conexão com a base de dados</h1>";
            exit();
        }

        return self::$conexao;
    }

    public function runQuery($sql)
    {
        $stm = $this->connect()->prepare($sql);
        return $stm->execute();
    }

    public function runSelect($sql)
    {
        $stm = $this->connect()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}
