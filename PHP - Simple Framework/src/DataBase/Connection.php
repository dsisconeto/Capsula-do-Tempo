<?php

namespace DSisconeto\Simple\DataBase;

use DSisconeto\Simple\GetData;

class Connection
{
    private static $connect;    // guarda a unica instacia
    private function __construct()
    {
        // construtor privado
    }

    public static function PDO()
    {
        // faz a conexão com banco de dados
        try {
            // pega os dados do arquivo de configuração
            $host = GetData::getConfig("DB_HOST");
            $db = GetData::getConfig("DB_NAME");
            $user = GetData::getConfig("DB_USER");
            $pass = GetData::getConfig("DB_PASSWORD");
            // caso não exista uma conexão com o banco de dados instacia uma
            if (!isset(self::$connect)) {

                switch (GetData::getConfig("DB_DRIVER")) {
                    case "mysql":
                        self::$connect = new \PDO(
                            "mysql:host={$host};dbname={$db}", $user, $pass,
                            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                        break;

                    case "pgsql":
                        self::$connect = new \PDO("pgsql:host={$host} dbname={$db} user={$user} password={$pass}");
                        break;
                }


            }
        } catch (\PDOException $e) {
            echo "<h1>Falha ao estabelecer conexão com o banco de dados :/</h1>";
            exit();
        }

        // se já existia uma retona a mesma, se não, retorna uma nova.
        return self::$connect;
    }


    public static function query($sql)
    {
        $stm = self::PDO()->prepare($sql);

        return $stm->execute();
    }

    public static function select($sql)
    {
        $stm = self::PDO()->prepare($sql);

        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }





}
