<?php

include_once 'conexao.php';

class usuario extends conexao {
    /* @Essa classe serve para indentificar o usuario e para segurança do sistema.
     * @Na pagina que esta classe for instaciada, 
     * 
     */

    private $id = null;
    private $nome = null;
    private $nomeUsuario = null;
    private $img = null;
    private $status = null;
    private $email = null;
    private $senha = null;
    private $cadastro = null;

    function __construct() {
        
    }

    public function criar($nome, $email, $senha) {
        $this->setEmail($email);
        $this->setNome($nome);
        $this->setSenha($senha);
        // verificando se não existe o email no Banco de dados
        if ($this->selecionarPorEmail($this->getEmail()) == false) {

            try {
                // cadatrando o usuario
                $cadastro = date('d/m/Y');
                $pdo = $this->conectar();
                $stmt = $pdo->prepare("INSERT INTO user (nome,email,senha,cadastro,status)VALUES(:nome,:email,:senha,:cadastro,:status)");
                $stmt->bindValue(":nome", $this->getNome());
                $stmt->bindValue(":email", $this->getEmail());
                $stmt->bindValue(":senha", $this->getSenha());
                $stmt->bindValue(":cadastro", $cadastro);
                $stmt->bindValue(":status", 1);
                $stmt->execute();

                // cadastrando primeira categoria
                $this->selecionarPorEmail($this->getEmail());
                $categoria = new categoriaUsuario($this->getId());
                $categoria->criar("Home", 1);

                // cadastrando os primeiros sites
                $site = new siteUsuario($this->getId(), $categoria->getId());
                $site->criarSusgentao();
                return 1;
            } catch (PDOException $erro) {
                return 2;
            }
        } else {
            return 3;
        }
    }

    public function deletar($id) {
        $this->setId($id);

        // deletando o usuario 
        $pdo = $this->conectar();
        $smtm = $pdo->prepare("DELETE FROM user WHERE id = :id");
        $smtm->bindValue(":id", $this->getId());
        $smtm->execute();

        // deletando as categorias do usuario
        $categoria = new categoriaUsuario($this->getId());
        $categoria->deletarComUsuario();

        // deletando sites do usuario
        $site = new siteUsuario($this->getId(), 0);
        $site->deletarComUsuario();
    }

    public function editarStatus($id, $status) {
        $this->setId($id);
        $this->setStatus($status);

        try {
            $pdo = $this->conectar();
            $stmt = $pdo->prepare("UPDATE user SET status = :status WHERE id = :id");
            $stmt->bindValue(":status", $this->getStatus());
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function editarEmail($id, $email, $senha) {
        $this->setId($id);
        $this->setEmail($email);
        $this->setSenha($senha);

        if ($this->selecionarPorEmail($this->getEmail()) == false) {
            $login = new log();
            $validar = $login->validaUsuario($this->getId(), $this->getSenha());

            if ($validar == true) {
                try {


                    $pdo = $this->conectar();
                    $stmt = $pdo->prepare("UPDATE user SET email = :email");
                    $stmt->bindValue(":email", $this->getEmail());
                    $stmt->execute();
                    return true;
                } catch (PDOException $ee) {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editarSenha($id, $senha) {
        $this->setId($id);
        $this->setSenha($senha);

        $login = new log();
        $validar = $login->validaUsuario($this->getId(), $this->getSenha());

        if ($validar == true) {
            try {
                $pdo = $this->conectar();
                $stmt = $pdo->prepare("UPDATE user SET senha = :senha");
                $stmt->bindValue(":senha", $this->getEmail());
                $stmt->execute();
                return true;
            } catch (PDOException $ee) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editarNomeUsuario($id, $nomeUsuario) {

        if ($this->selecionarPorNomedeUsuario($nomeUsuario, 2) == 0) {
            $this->setId($id);
            $this->setNomeUsuario($nomeUsuario);
            try {
                $pdo = $this->conectar();
                $stmt = $pdo->prepare("UPDATE user SET nomeUsuario = :nomeUsuario WHERE id = :id");
                $stmt->bindValue(":nomeUsuario", $this->getNomeUsuario());
                $stmt->bindValue(":id", $this->getId());
                $stmt->execute();
                return 1;
            } catch (PDOException $ee) {
                return 2;
                echo $ee->getMessage();
            }
        } else {

            return 3;
        }
    }

    public function atualizaIMG($id, $img) {

        $this->setId($id);
        $this->setImg($img);

        if ($this->getId() != null && $this->getImg() != null) {

            try {
                $pdo = $this->conectar();
                $stmt = $pdo->prepare("UPDATE user SET img = :img WHERE id = :id");
                $stmt->bindValue(":img", $this->getImg());
                $stmt->bindValue(":id", $this->getId());
                $stmt->execute();
                return true;
            } catch (PDOException $ee) {
                return false;
            }
        }
    }

    public function selecionarPorEmail($email) {
        $this->setEmail($email);

        try {

            $pdo = $this->conectar();
            $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindValue(":email", $this->getEmail());
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                foreach ($dados as $e) {
                    $this->setId($e["id"]);
                    $this->setNome($e["nome"]);
                    $this->setNomeUsuario($e["nomeUsuarios"]);
                    $this->setStatus($e["status"]);
                    $this->setEmail($e["email"]);
                    $this->setSenha($e["senha"]);
                    $this->setCadastro($e["cadastro"]);
                }

                // validação de seguração
                if ($this->getId() == null || $this->getSenha() == null) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } catch (PDOException $erro) {
            return false;
        }
    }

    public function selecionarPorId($id) {
        // quando instacia essa class só chame este metodo quando tiver uma session
        $this->setId($id);

        if ($this->getId() != null) {

            $pdo = $this->conectar();
            $stmt = $pdo->prepare("SELECT  * FROM user  WHERE id = :id ");
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();
            while ($ln = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $this->setId($ln["id"]);
                $this->setNome($ln["nome"]);
                $this->setNomeUsuario($ln["nomeUsuarios"]);
                $this->setStatus($ln["status"]);
                $this->setEmail($ln["email"]);
                $this->setSenha($ln["senha"]);
                $this->setCadastro($ln["cadastro"]);
            }
            if($this->getId() != null && $this->getSenha != null){
                 return true;
            }else{
                return false;
            }

           
        } else {
            echo "É precisor estar logado para";
            return false;
            exit;
        }
    }

    public function selecionarPorNomedeUsuario($nomeUsuario, $op) {
        // op 1  para set dados 2 só para retona se  ja exites  o msm
        // quando instacia essa class só chame este metodo quando tiver uma session
        $this->setNomeUsuario($nomeUsuario);

        if ($this->getNomeUsuario() != null) {
            try {


                $pdo = $this->conectar();
                $stmt = $pdo->prepare("SELECT  * FROM user  WHERE nomeUsuario = :nomeUsuario");
                $stmt->bindValue(":nomeUsuario", $this->getNomeUsuario());
                $stmt->execute();
                if ($op == 1) {
                    while ($ln = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $this->setId($ln["id"]);
                        $this->setNome($ln["nome"]);
                        $this->setStatus($ln["status"]);
                        $this->setEmail($ln["email"]);
                        $this->setSenha($ln["senha"]);
                        $this->setCadastro($ln["cadastro"]);
                    }

                    if ($this->getId() != null && $this->getSenha() != null) {
                        return 1;
                    } else {
                        return 0;
                    }
                } elseif ($op == 2) {
                    if ($stmt->rowCount() > 0) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
                if ($this->getId() != null && $this->getSenha() != null) {
                    return 1;
                    exit();
                }

                return 0;
            } catch (PDOException $e) {
                return 0;
            }
        } else {

            return 0;
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

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = strip_tags(addslashes($nomeUsuario));
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = strip_tags(addslashes($img));
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = strip_tags(addslashes($status));
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = strip_tags(addslashes($email));
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = strip_tags(addslashes($senha));
    }

    public function getCadastro() {
        return $this->cadastro;
    }

    public function setCadastro($cadastro) {
        $this->cadastro = strip_tags(addslashes($cadastro));
    }

}

?>
