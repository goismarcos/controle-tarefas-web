<?php

require_once 'conexao.php';

class Login
{
    private $conexao;
    private $usuario;
    private $senha;

    //METODO CONSTRUTOR PARA INSTANCIAR AS CLASSES
    public function __construct()
    {
        $this->conexao = new conexao;
    }
    //usuario
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    //senha
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }


    //verificando se o login esta certo!
    public function autenticarLongin()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("SELECT *
                                                                        FROM tbusuario 
                                                                          WHERE usuario = ? 
                                                                            AND senha = sha1(md5(?));");
            $resposta->bindValue(1, $this->getUsuario(), PDO::PARAM_STR);
            $resposta->bindValue(2, $this->getSenha(), PDO::PARAM_STR);
            $resposta->execute();
            $dadosUsuario = $resposta->Fetch(PDO::FETCH_OBJ);
            if($resposta->rowCount() == 0 )
            {
                return false;
            }
            else
            {
                session_start();
                $_SESSION['id_usuario'] = $dadosUsuario->id_usuario;
                $_SESSION['nome'] = $dadosUsuario->nome;
                return true;

            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim da autenticaçao do login

    //metodos para sair da secao
    public function Sair()
    {
        session_destroy();
        header('location: ../login');
    }//fim do metodo para deslogar


}