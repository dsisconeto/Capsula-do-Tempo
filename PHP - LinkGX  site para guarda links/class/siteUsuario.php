<?php

class siteUsuario extends Conexao {

    private $id = null;
    private $idUser = null;
    private $nome = null;
    private $url = null;
    private $idCategoria = null;
    private $ordem = null;
    private $type = null;
    private $data = null;
    private $referencia = null;
    private $status = null;

    public function __construct($idUsuario, $idCategoria) {
        $this->setIdUsuario($idUsuario);
        $this->setIdCategoria($idCategoria);
    }

    public function criar($nome, $url, $status) {
        $this->setNome($nome);
        $this->setUrl($url);
        $this->setStatus($status);
        $this->setOrdem(1);
        /// verificando se contem http:// da url
        if (substr($this->getUrl(), 0, 7) == "http://" || substr($this->getUrl(), 0, 8) == "https://") {
            
        } else {
            $this->setUrl("http://" . $this->getUrl());
        }
        
        // contando o numero de sites quem tem para definir a ordem do novo
        $contandoSites = $this->selecioneTodosSites();
        foreach ($contandoSites as $key) {
            $this->setOrdem(($this->getOrdem() + 1));
        }
        
        // chamando o metodo verificandoTipo
        $dados_de_referencia = $this->verificarDoTipo($this->getNome(), $this->getUrl());
        try {
            if ($dados_de_referencia != null && $this->getReferencia() != null) {

                $pdo = $this->conectar();
                $stmt = $pdo->prepare("INSERT INTO sites_user (ordem,id_user,categoria,type,referencia,status)VALUES(:ordem,:usuario,:categoria,:type,:referencia,:status)");
                $stmt->bindValue(":ordem", $this->getOrdem());
                $stmt->bindValue(":usuario", $this->getIdUsuario());
                $stmt->bindValue(":categoria", $this->getIdCategoria());
                $stmt->bindValue(":type", 3);
                $stmt->bindValue(":referencia", $this->getReferencia());
                $stmt->bindValue(":status", $this->getStatus());
                $stmt->execute();

                return true;
            } else {

                $pdo = $this->conectar();
                $stmt = $pdo->prepare("INSERT INTO sites_user (nome,url,ordem,id_user,categoria,type,status)VALUES(:nome,:url,:ordem,:usuario,:categoria,:type,:status)");
                $stmt->bindValue(":nome", $this->getNome());
                $stmt->bindValue(":url", $this->getUrl());
                $stmt->bindValue(":ordem", $this->getOrdem());
                $stmt->bindValue(":usuario", $this->getIdCategoria());
                $stmt->bindValue(":categoria", $this->getIdCategoria());
                $stmt->bindValue(":type", 1);
                $stmt->bindValue(":status", $this->getStatus());
                $stmt->execute();
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deletar($id) {
        try {
            // deletar um  site especifico
            $pdo = $this->conectar();
            $stmt = $pdo->prepare("DELETE FROM sites_user WHERE id = :site  AND id_user= :usuario  AND categoria = :categoria ");
            $stmt->bindValue(":site", $id);
            $stmt->bindValue(":usuario", $this->getIdUsuario());
            $stmt->bindValue(":categoria", $this->getIdCategoria());
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deletarComCategoria($categoria) {
        $pdo = $this->conectar();

        $smtm = $pdo->prepare("DELETE FROM sites_user WHERE categoria = :categoria");
        $smtm->bindValue(":categoria", $this->getIdCategoria());
        $smtm->bindValue(":usuario", $this->getIdUsuario());
        $smtm->execute();
    }

    public function deletarComUsuario() {
        //deletando todos os site do usuario em questão
        
        $pdo = $this->conectar();
        $smtm = $pdo->prepare("DELETE FROM sites_user WHERE id_user = :usuario");
        $smtm->bindValue(":usuario", $this->getIdUsuario());
        $smtm->execute();
    }

    public function editar() {
        
    }

     public function selecioneUmSite($id) {
        // seleciona apenas um site
        $this->setId($id);
        $pdo = $this->conectar();
        $stmt = $pdo->prepare("SELECT * FROM sites_user WHERE id = :site AND id_user = :user AND categoria = :categoria");
        $stmt->bindValue(":site", $this->getId());
        $stmt->bindValue(":user", $this->getIdUsuario());
        $stmt->bindValue(":categoria", $this->getIdCategoria());
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as $e) {

            $this->setNome($e["nome"]);
            $this->setUrl($e["url"]);
            $this->setOrdem($e["ordem"]);
            $this->setType($e["type"]);
            $this->setReferencia($e["referencia"]);
        }
    }
    public function selecioneTodosSites() {
        try {
            $pdo = $this->conectar();
            $stmt = $pdo->prepare("SELECT * FROM sites_user WHERE id_user = :usuario AND categoria = :categoria ORDER BY ordem");
            $stmt->bindValue(":usuario", $this->getIdUsuario());
            $stmt->bindValue(":categoria", $this->getIdCategoria());
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        } catch (PDOException $erro) {
            $dados == null;
        }
    }



    public function selecionarReferencia($referencia) {
        $this->setReferencia($referencia);
        
        $pdo = $this->conectar();
        $stmt = $pdo->prepare("SELECT *  FROM site_system WHERE id = :referencia");
        $stmt->bindValue(":referencia", $this->getReferencia());
        $stmt->execute();

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function criarSusgentao() {
        try {
            $pdo = $this->conectar();
            $stmt = $pdo->prepare("SELECT * FROM  sugestao");
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $key) {
                $this->cadastrar($key["nome"], $key["url"], 1);
            }
        } catch (PDOException $e) {

            echo "Erro no cadatrar Sustao" . $e->getMessage();
        }
    }
    
    public function verificarDados($url){
        $this->setUrl($url);
        
       $tags =  get_meta_tags($this->getUrl());
       
       
    }

    public function verificarDoTipo($nome, $url) {
        $this->setNome($nome);
        $this->setUrl($url);
        $dados = null;
        try {
            $pdo = $this->conectar();
            $stmt = $pdo->prepare("SELECT * FROM site_system WHERE url = :url OR nome = :nome");
            $stmt->bindValue(":url", $this->getUrl());
            $stmt->bindValue(":nome", $this->getNome());
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $key) {
                $this->setReferencia($key["id"]);
            }
        } catch (PDOException $erro) {
            
        }
        return $dados;
    }

    public function mudarStatusComCategoria($status) {
        $this->setStatus($status);
        try {
            $this->setStatus($this->getStatus());
            $pdo = $this->conectar();
            $smtm = $pdo->prepare("UPDATE sites_user SET  status = :status WHERE categoria = :c AND id_user = :id_user");
            $smtm->bindValue(":status", $this->getStatus());
            $smtm->bindValue(":c", $this->getCategoria());
            $smtm->bindValue(":id_user", $this->getUsuario());
            $smtm->execute();
            return true;
        } catch (PDOException $erro) {
            return false;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int) strip_tags(addslashes($id));
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = (int) strip_tags(addslashes($idUsuario));
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = strip_tags(addslashes($nome));
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = strip_tags(addslashes($url));
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = strip_tags(addslashes($idCategoria));
    }

    public function getOrdem() {
        return $this->ordem;
    }

    public function setOrdem($ordem) {
        $this->ordem = strip_tags(addslashes($ordem));
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = strip_tags(addslashes($type));
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function setReferencia($referencia) {
        $this->referencia = strip_tags(addslashes($referencia));
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = strip_tags(addslashes($data));
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = strip_tags(addslashes($status));
    }

}

?>
