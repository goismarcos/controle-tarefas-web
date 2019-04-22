<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 30/07/2017
 * Time: 11:54
 */
require_once '../classe/registrar.php';
$objRegistrar = new Registrar();

$page = isset($_GET['p']) ? $_GET['p'] : '' ;

if($page == 'verifica')//aqui vai verificar se ja existe usuario com esse nome
{
    $objRegistrar->setUsuario($_POST['usuario']);
    if($objRegistrar->verificarUsuario())
    {
        print 1;
    }
    else
    {
        print 0;
    }
}
else if($page == 'cadastrar')//aqui ira cadastrar
{
    $objRegistrar->setUsuario($_POST['usuario']);
    $objRegistrar->setNome($_POST['nome']);
    $objRegistrar->setSenha($_POST['senha']);
    if($objRegistrar->insert())
    {
        print 'Cadastro realizado com sucesso!<br>Bem vindo!';
    }
    else
    {
        print 'Erro ao cadastrar tente novamente!';
    }
}