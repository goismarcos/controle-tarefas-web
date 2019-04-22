<?php

/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 30/07/2017
 * Time: 11:14
 */
require_once 'conexao.php';
class Registrar
{
    private $conexao;
    private $usuario;
    private $nome;
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
    //nome
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    //verifica se o usuario existe
    public function verificarUsuario()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("SELECT usuario FROM tbusuario WHERE usuario = ? ;");
            $resposta->bindValue(1, $this->getUsuario(), PDO::PARAM_STR);
            $resposta->execute();
            if($resposta->rowCount() == 0 )
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim do verifica usuario existe

    //cadastrando usuarios
    public function insert()
    {
        try
        {
            $resposta = $this->conexao->Conectar()->prepare("INSERT INTO tbusuario (usuario, nome, senha) VALUES ( ?,?, sha1(md5(?)));");
            $resposta->bindValue(1, $this->getUsuario(), PDO::PARAM_STR);
            $resposta->bindValue(2, $this->getNome(), PDO::PARAM_STR);
            $resposta->bindValue(3, $this->getSenha(), PDO::PARAM_STR);
            if($resposta->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            return $e->getMenssage();
        }
    }//fim do cadastro
}