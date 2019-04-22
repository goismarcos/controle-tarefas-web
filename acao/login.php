<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 29/07/2017
 * Time: 18:46
 */
require_once '../classe/login.php';
$login = new Login();
$login->setUsuario($_POST['usuario']);
$login->setSenha($_POST['senha']);

if($login->autenticarLongin())
{
    print 'ok';
}
else
{
    print 'Nome e/ou senha incorretos!';
}