<?php

class conexao {

    // esta classe e para fazer conexao com banco de dados linkgx

    private static $conexao;

    private function __construct() {
        
    }

    public function conectar() {
        try {
            if (!isset(self::$conexao)) {
                self::$conexao = new PDO("mysql:host=localhost;dbname=linkgx", "root", "");
            }
        } catch (PDOException $e) {

            echo "Erro ao conectar com banco de dados do linkgx.com <br/>" . $e->getMessage();
        }
        return self::$conexao;
    }

}

?>
