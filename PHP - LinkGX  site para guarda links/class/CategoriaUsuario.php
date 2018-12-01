<?php

/**
 * Está classe e responsavel pelas categorias do usario
 * quando instacia essa class devem passa id do usuario
 * @author Dejair Sisconeto
 */
class categoriaUsuario extends Conexao {

    private $id = null;
    private $idUser = null;
    private $nome = null;
    private $ordem = null;
    private $status = null;

    public function __construct($usuario) {
        $this->setIdUser($usuario);
    }

    public function criar($nome,$status) {
       
        if ($this->getIdUser() != null) {
            $this->setNome($nome);
            $this->setStatus($status);
            // loop para ver quantos ordem possui
            $dados_ordem = $this->totalDeCategorias();


            try {
                // fazendo insert da categoria
                $pdo = $this->conectar();
                $stmt = $pdo->prepare("INSERT INTO categoria (nome,id_user,ordem,status)VALUES(:nome,:usuario,:ordem,:status)");
                $stmt->bindValue(":nome", $this->getNome());
                $stmt->bindValue(":usuario", $this->getIdUser());
                $stmt->bindValue(":ordem", $this->getOrdem());
                $stmt->bindValue(":status", $this->getStatus());
                $stmt->execute();
               
                $smtm = $pdo->prepare("SELECT * FROM categoria WHERE id_user = :usuario ORDER BY id DESC LIMIT 1");
                $smtm->bindValue(":usuario", $this->getIdUser());
                $smtm->execute();
                $dados = $smtm->fetchAll(PDO::FETCH_ASSOC);
                foreach ($dados as $key) {
                    $this->setId($key["id"]);
                    $this->setNome($key["nome"]);
                    $this->setOrdem($key["ordem"]);
                    $this->setStatus($key["type"]);
                    return true;
                }
            } catch (PDOException $erro) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editar($nome, $type) {
        try {
            $this->setNome($nome);
            $this->setType($type);
            $pdo = $this->conectar();
            $smtm = $pdo->prepare("UPDATE categoria SET nome = :nome  , type = :type WHERE id = :id AND id_user = :id_user");
            $smtm->bindValue(":nome", $this->getNome());
            $smtm->bindValue(":type", $this->getType());
            $smtm->bindValue(":id", $this->getId());
            $smtm->bindValue(":id_user", $this->getUsuario());
            $smtm->execute();

            $site = new siteUsuario($this->getUsuario(), $this->getId());
            $site->t($this->getStatus());
            return true;
        } catch (PDOException $erro) {
            return false;
        }
    }

    public function deletar($id) {

        $this->setId($id);
        $pdo = $this->conectar();
        $smtm = $pdo->prepare("DELETE FROM categoria WHERE id = :categoria AND id_user = :usuario");
        $smtm->bindValue(":categoria", $this->getId());
        $smtm->bindValue(":usuario", $this->getUsuario());
        $smtm->execute();
        $site = new site_usuario($this->getUsuario(), $this->getId());
        $site->deletarTodosPorCategoria();
    }

    public function deletarComUsuario() {
        $this->setIdUsuario($idUsuario);
        //deletando todos os site do usuario em questão
        $pdo = $this->conectar();
        $smtm = $pdo->prepare("DELETE FROM categoria WHERE id_user = :usuario");
        $smtm->bindValue(":usuario", $this->getIdUsuario());
        $smtm->execute();
    }

    public function selecionarUma($id) {
        $this->setId($id);
        $pdo = $this->conectar();
        $stmt = $pdo->prepare("SELECT * FROM categoria WHERE id_user = :user AND id = :categoria");
        $stmt->bindValue(":user", $this->getIdUser());
        $stmt->bindValue(":categoria", $this->getId());
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as $e) {

            $this->setId($e["id"]);
            $this->setNome($e["nome"]);
            $this->setOrdem($e["ordem"]);
            $this->setStatus($e["type"]);
        }
        return $dados;
    }

    public function selecionarTodas() {
        // pegando todas as categotegoria do banco de dados 
        // este metodo dever usar um forech para exibir os dados
        try {
            $pdo = $this->conectar();
            $stmt = $pdo->prepare("SELECT * FROM categoria WHERE id_user = :user ORDER BY ordem");
            $stmt->bindValue(":user", $this->getIdUser());
      
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
       
            return $dados;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function totalDeCategorias() {
        $quatidade = null;
        try {
            $pdo = $this->conectar();
            $stmt = $pdo->prepare("SELECT * FROM categoria WHERE id_user = :id_user ORDER BY ordem");
            $stmt->bindValue(":id_user", $this->getIdUser());
            $stmt->execute();
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            while(mysql_fetch_array($dado)) {
                $quatidade += 1;
            }
            return $quatidade;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getPrimeiraCategoria() {
        $pdo = $this->conectar();
        $stmt = $pdo->prepare("SELECT * FROM  categoria WHERE id_user = :usuario ORDER BY ordem ASC LIMIT 1");
        $stmt->bindValue(":usuario", $this->getIdUser());
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados as $e) {
            $this->setId($e["id"]);
            $this->setNome($e["nome"]);
            $this->setOrdem($e["ordem"]);
            $this->setStatus($e["type"]);
        }
    }
    
    public function travar($id){
        
        
    }
    
    public function publica($id){
        
        
    }
    
    public function privada($id){
        $this->setId($id);
        try {
   
            $pdo = $this->conectar();
            $smtm = $pdo->prepare("UPDATE categoria SET  type = :type WHERE id = :id AND id_user = :id_user");
            $smtm->bindValue(":type", 2);
            $smtm->bindValue(":id", $this->getId());
            $smtm->bindValue(":id_user", $this->getIdUser());
            $smtm->execute();
            return true;
        } catch (PDOException $erro) {
            return false;
        }
        
        
    }

    public function destravar($id) {
        try {
            $this->setId($id);
            $pdo = $this->conectar();
            $smtm = $pdo->prepare("UPDATE categoria SET  type = :type WHERE id = :id AND id_user = :id_user");
            $smtm->bindValue(":type", 2);
            $smtm->bindValue(":id", $this->getId());
            $smtm->bindValue(":id_user", $this->getIdUser());
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

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = strip_tags(addslashes($nome));
    }

    public function getOrdem() {
        return $this->ordem;
    }

    public function setOrdem($ordem) {
        $this->ordem = $ordem;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->idUser = (int) strip_tags(addslashes($idUser));
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = (int) strip_tags(addslashes($type));
    }

}

?>
