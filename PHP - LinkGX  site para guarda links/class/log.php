<?php

class log extends conexao {

    private $email = null;
    private $senha = null;
    private $idUser = null;
    private $logar = null;
    private $permanacia = null;

    public function __construct() {
        
    }

    public function login($email, $senha, $permanacia) {
        // se efetuar login getLogar retonarar 1, se o email nao for cadastradado return 3
        // e se a senha for invalida return 2
        
        
        $user = new usuario();
        $this->setPermanacia($permanacia);
        if($user->selecionarPorEmail($email) == true) {
           
            if ($user->getSenha() == $senha && $user->getSenha() != null) {

                $this->setEmail($email);
                $this->setIdUser($user->getId());
                $this->setSenha($user->getSenha());
                $this->setLogar(1);

                $_SESSION["user"] = $this->getIdUser();

                if ($permanacia != null) {
                    $this->setPermanacia(true);
                    $tempo_cookie = (time() + (364 * 24 * 3600));
               
                    setcookie('user', $this->getUsuario(), $tempo_cookie);
                   
                }
                 
                
            } else {
                $this->setLogar(2);
                 
            }
            
        } else {
            $this->setLogar(3);
             
            
        }
        return $this->getLogar();
        
    }

    public function logout() {
        setcookie('user', null, (time() - (364 * 24 * 3600)));
        unset($_SESSION['user']); 
    }
    
    public function validaUsuario($id,$senha){
        $usuario = new usuario();
        $usuario->selecionarPorId($id);
        if($usuario->getSenha() == $senha){
            
            return true;
        }else{ return false;}
       
        
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email =  strip_tags(addslashes($email));
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha =   strip_tags(addslashes($senha));
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($usuario) {
        $this->idUser =  (int) strip_tags(addslashes($usuario));
    }

    public function getLogar() {
        return $this->logar;
    }

    public function setLogar($logar) {
        $this->logar =   strip_tags(addslashes($logar));
    }

    public function getPermanacia() {
        return $this->permanacia;
    }

    public function setPermanacia($permanacia) {
        $this->permanacia =   strip_tags(addslashes($permanacia));
    }


}

?>
