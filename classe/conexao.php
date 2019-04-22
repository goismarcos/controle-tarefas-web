<?php

/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 17/07/2017
 * Time: 00:43
 */
class Conexao
{
    //atributos
    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private static $pdo;

    function __construct()
    {
        $this->servidor = "localhost";
        $this->banco = "dbpegasus";
        $this->usuario = "helpdesk";
        $this->senha = "123456";
    }

    //metodo para conectar
    public function Conectar()
    {
        try
        {
            if(is_null(self::$pdo))//se a conexao nao foi estaciada
            {
                self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
            }
            return self::$pdo;	//estanciando a conexao
        }
        catch (PDOException $e)
        {
            echo 'Erro: '.$e->getMessage();
        }

    }
}
