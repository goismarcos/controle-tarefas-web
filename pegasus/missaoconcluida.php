<?php
header('Content-Type: text/html; charset=iso-8859',true);
require_once '../classe/pegasus.php';

 $page = isset($_GET['p']) ? $_GET['p'] : '' ;

$objPegasus = new Pegasus();//instanciando obj
$resposta2 = $objPegasus->publicacaoMostrarConclusao();//retornando tabela de missao concluida


require_once '../classe/login.php';
$objLogin = new Login();

session_start();

$nomeUsuario = $_SESSION['nome'];
$id_usuario = $_SESSION['id_usuario'];

//se nao estiver logado vai ser rederecionado nessa porra
if(!isset($nomeUsuario))
{
    header("location: ../login/");
    
}
//deslogando
if (!empty($_GET['sair']) == "sim")
{
    $objLogin->Sair();
}

?>
<html>
<head>
    <title>Pegasus</title>
    <link rel="icon" href="../imagem/icone_pegasus.ico" type="image/ico">
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="../css/animate.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="refresh" content="300;url=index.php">
    <style>
        body
        {
            background-image: url('../imagem/logodefundo.jpg');
            background-position: 50%;
            background-repeat: repeat;
        }
        img
        {
            border-radius: 10px;
        }
    </style>
</head>
<body>
<!--comeÃ§o no navbar-->
<!-- Static navbar -->
<nav class="navbar navbar-inverse" style="background-color: #333333;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand glyphicon glyphicon-home" href="index.php"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a class="glyphicon glyphicon-check" href="missaoconcluida.php" title="Missões Concluidas"> Missões-Concluidas</a></li>
                <li><a class="glyphicon glyphicon-print" href="#"> Toners</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a><?php echo $nomeUsuario;?></a></li>
                <li><a class="glyphicon glyphicon-log-out" href="?sair=sim"> Sair</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
<!--fim do nav bar-->
<div class="conteiner">
    <div class="">
        <div class="col-lg-4">
            <center>
                <img src="../imagem/legenda2.jpg" width="100%"/>
            </center>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <cente><img src="../imagem/logo.jpg" width="100%" /></center>
        </div>
        <!-- fim do cabeçalho-->
        <div class="col-lg-4">
            <br>
            <div class="panel panel-info">
                <center><h1><b><div class="panel-heading animated jackInTheBox">DADOS DE BORDO</div></b></h1></center>
                <hr>
                <div class="panel-body">
                    <h4><div class="animated slideInRight" id="30dias"></div></h4>
                    <h4><div class="animated slideInLeft" id="7dias"></div></h4>
                    <h4><div class="animated slideInRight" id="totalRealizadas"></div></h4>
                    <h4><div class="animated slideInLeft" id="quantidade"></div></h4>
                    <h4><div class="animated slideInRight" id="todas"></div></h4>
                </div>
                <div class="panel-footer">Create by Marcos Antonio Gois</div>
            </div>
        </div>
        <div class="col-lg-8">
            <br>
            <div class="panel panel-warning">
                <div class="panel-body">
                    <center>
                    <table id='tabela2' class='table table-bordered table-striped'>
                        <thead>
                          <tr>
                              <th>Onde é</th>
                              <th >Data missão</th>
                              <th >Finalizado por</th>
                              <th >Data resolução</th>
                              <th width='5' >Status</th>
                              <th width='10'>Opções</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($resposta2 as $linha)
                            {
                                $id_missao = (string)$linha['id_missao'];
                                if($linha['status'] == 0)
                                {
                                    $alerta = "<center><img src='../imagem/alerta.png' width='30' /></center>";
                                }
                                else
                                {
                                    $alerta = "<center><img src='../imagem/certo.png' width='30' /></center>";
                                }
                                echo "

                                      <tr>
                                        <td id='on'>".$linha['onde'] ."</td>
                                        <td id='d'>" .$linha['data']."</td>
                                        <td id='d'>" .$linha['id_usuario_concluir']."</td>
                                        <td id='c'>" .$linha['data_conclusao']."</td>
                                        <td id='a'>". $alerta ."</td>
                                        <td id='o' >
                                        <center>
                                             <form method='post' action='../acao/publicacao.php?p=reabrir'>
                                                <button type='button' id='ver' name='ver' class='btn btn-small btn-warning' data-toggle='modal' data-target='#modal3-".$linha['id_missao'] ."'>Ver</button>
                                                <input type='hidden' name='id_missao' id='id_missao' value='$id_missao' />
                                                <button type='submit' id='reabrir' name='reabrir' class='btn btn-small btn-success'>Reabrir</button>
                                            </form>
                                        </center>
                                            <!-- Modal  ver-->
                                            <div class='modal fade bd-example-modal-lg' id='modal3-".$id_missao."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
                                              <div class='modal-dialog modal-lg' role='document'>
                                                <div class='modal-content'>
                                                  <div class='modal-header'>
                                                       <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                        <center><h2 class='modal-title' id='exampleModalLongTitle'>Missão N°".$id_missao."</h2></center>
                                                  </div>
                                                  <div class='modal-body text-justify'>
                                                    <div class='container-fluid'>
                                                        <div class='row'>
                                                            <div class='col-md-6'>
                                                                <h3>Onde é?</h3>
                                                                ".$linha['onde']."
                                                                <h3>Descrição:</h3>
                                                                ".$linha['descricao']."
                                                                <h3>Resolução:</h3>
                                                                ".$linha['conclusao']."
                                                            </div>
                                                            <div class='col-md-6'>
                                                                <h3>Operador da missão:</h3>
                                                                ".$linha['id_usuario']."
                                                                <h3>Data da missão:</h3>
                                                                ".$linha['data']."
                                                                <h3>Operador que concluiu:</h3>
                                                                ".$linha['id_usuario_concluir']."
                                                                <h3>Data da conclusão:</h3>
                                                                ".$linha['data_conclusao']."
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Sair</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </td>
                                      </tr>
                              ";  
                            }
                        ?>
                        </tbody>
                    </table>  
                    </center>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
<?php
if(!($page == ''))
{
    echo "<script> alert('Missão reaberta!'); </script>";
}
?>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script/publicacao.js"></script>
<script src="../js/script/verTabela.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  
</body>
</html>
