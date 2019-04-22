<html>
<head>
    <title>Login Pegasus</title>
    <link rel="icon" href="../imagem/icone_pegasus.ico" type="image/ico">
    <style>
        body
        {
            background-image: url('../imagem/logodefundo.jpg');
            background-position: 50%;
            background-repeat: repeat;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="../css/animate.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
    <br><br><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <center><img src="../imagem/pegasus-logo.png" class="img-rounded"  width="120" height="120" alt="center"></center>
                    <form class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" placeholder="Digite o usuario" name="usuario" id="usuario"><br>
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" placeholder="Digite a senha" name="senha" id="senha"><br>
                        <div align="right"><button type="button" class="btn btn-primary" id="entrar">Entrar</button></div><br>
                        <center><div id="carregando"><img src="../imagem/carregando.gif"  width="80" height="80"> </div></center>
                        <center><div id="notificacao"></div></center>
                        <br><hr>
                        <div align="right"><h5>Ainda não tem conta? <a href="../registrar">Cadastrar agora!</a></h5></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script/login.js"></script>
</body>
</html>