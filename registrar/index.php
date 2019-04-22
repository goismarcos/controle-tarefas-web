<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 17/07/2017
 * Time: 19:49
 */
?>
<html>
<head>
    <title>Registrar Pegasus</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="icon" href="../imagem/icone_pegasus.ico" type="image/ico">
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="../css/animate.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body
        {
            background-image: url('../imagem/logodefundo.jpg');
            background-position: 100%;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
<div class="container">
    <br><br><br>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <center><img src="../imagem/pegasus-logo.png" class="img-rounded"  width="110" height="110" alt="center"></center>
                    <form class="form-group" >
                        <div id="cadastroRealizado">
                            <!-- ver usuario se existe-->
                            <label for="usuario">Usuario</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="usuario" maxlength="20" placeholder="Escolha um usuario">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" id="verifica" type="submit">Verificar</button>
                                </span>
                            </div><!-- trocar usuario -->
                            <h6><div align="right" ><a id="trocar" href="#">Trocar usuario</a></div></h6>
                            <center><div id="notificacao"></div></center>
                            <!--abre outros campos para poder cadastrar-->
                            <div id="campos">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" maxlength="100" placeholder="Digite seu nome" id="nome">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" maxlength="70" placeholder="Digite a senha" id="senha"><br>
                                <br>
                                <div align="right"><button type="button" class="btn btn-primary btn-md" id="cadastrar">Cadastrar</button></div>
                            </div>
                        </div>
                        <!--notificaçoes se o cadastro foi feito-->
                        <center><div id="notificacaoCadastro"></div></center>
                        <!--carregando-->
                        <center><div id="carregando"><img src="../imagem/carregando.gif"  width="80" height="80"> </div></center>
                        <hr>
                        <div align="right"><h5>Você já uma tem conta? <a href="../login/">Entrar</a></h5></div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script/registrar.js"></script>
</body>
</html>
