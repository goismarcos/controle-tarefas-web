<?php
header('Content-Type: text/html; charset=iso-8859',true);
require_once '../classe/pegasus.php';
$objPegasus = new Pegasus();//instanciando obj
$resposta = $objPegasus->publicacaoMostrar();//retornando tabela de missao nao concluida
$resposta2 = $objPegasus->publicacaoMostrarConclusao();//retornando tabela de missao concluida

 $page = isset($_GET['p']) ? $_GET['p'] : '' ;

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
            <center><img src="../imagem/logo.jpg" width="100%" /></center>
        </div>
        <!-- fim do cabeçalho-->
        <div class="col-lg-4">
            <br>
            <div class="panel panel-warning">
                <div class="panel-body">
                    <form >
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>" />
                        <label for="onde">Onde é o problema?</label>
                        <input style="text-transform: uppercase;" type="text" class="form-control" name="onde" id="onde" placeholder="Digite aqui o local do problema..." >
                        <br>
                        <label for="descricao">Descrição do que esta acontecendo</label>
                        <textarea style="text-transform: uppercase;" class="form-control" id="descricao" name="descricao" rows="8" placeholder="Digite aqui o que esta acontecendo..."></textarea><br>
                        <div align="right"><button type="button" id="publicar" name="publicar" class="btn btn-primary btn-lg">Publicar</button></div>
                    </form>
                    <i><div id="quantidade"></div></i>
                </div>
                <div class="panel-footer">Create by Marcos Antonio Gois</div>
            </div>
        </div>
        <!--DATA TABLE-->
        
        <div class="col-lg-8 col-sm-8 col-md-8" id="tabelaInteira" >
            <br>
            <div class="panel panel-warning">
                <div class="panel-body">
                    <table id="tabela" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th >Onde é</th>
                                <th >Data da missão</th>
                                <th >Operador</th>
                                <th width="10" >Status</th>
                                <th width="10">Opções</th>
                            
                            </tr>
                        </thead>
                        <tbody id="corpo">
                            <?php
                                foreach($resposta as $row)
                                {
                                    $id_missao = (string)$row['id_missao'];
                                    if($row['status'] == 0)
                                    {
                                        $alerta = "<center><img src='../imagem/alerta.png' width='30' /></center>";
                                    }
                                    else
                                    {
                                        $alerta = "<center><img src='../imagem/certo.png' width='30' /></center>";
                                    }
                                    echo "
                                    <tr>
                                        <td>".$row['onde'] ."</td>
                                        <td>".  $row['data'] ."</td>
                                        <td>" .$row['id_usuario']."</td>
                                        <td>". $alerta ."</td>
                                        <td>
                                            <center>
                                            <button type='button' id='ver' name='ver' class='btn btn-md btn-warning' data-toggle='modal' data-target='#modal-".$row['id_missao'] ."'>Ver</button>
                                            <button type='button' id='gravarSolucao' name='gravarSolucao' class='btn btn-md btn-success' data-toggle='modal' data-target='#gravarSolucaoModal".$row['id_missao'] ."'>Concluir</button>
                                            </center>
                                            <!-- Modal conclusao -->
                                            <div class='modal fade' id='gravarSolucaoModal".$row['id_missao'] ."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                              <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                  <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                      <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                    <center><h2 class='modal-title' id='exampleModalLabel'>Conclusão da missão N°".$id_missao."</h2></center>
                                                  </div>
                                                  <div class='modal-body'>
                                                        <form method='post' action='../acao/publicacao.php?p=concluir'>
                                                            <input type='hidden' name='id_missao' id='id_missao' value='".$row['id_missao'] ."' />
                                                            <input type='hidden' name='id_usuario_concluir' id='id_usuario_concluir' value='".$id_usuario."' />
                                                            <label for='conclusao'>Como você resolveu?</label>
                                                            <textarea style='text-transform: uppercase;' required='true' class='form-control' id='conclusao' name='conclusao' rows='8' placeholder='Digite a conclusao...'></textarea><br>            
                                                  </div>
                                                  <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Close</button>
                                                            <button type='submit' id='concluir' name='concluir' class='btn btn-success btn-lg'>Concluir</button>
                                                        </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>





                                        </td>
                                    </tr>
                                        <!-- Modal ver -->
                                        <div class='modal fade bd-example-modal-lg' id='modal-".$row['id_missao'] ."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
                                          <div class='modal-dialog modal-lg' role='document'>
                                            <div class='modal-content'>
                                              <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                  <span aria-hidden='true'>&times;</span>
                                                </button>
                                                <center><h2 class='modal-title' id='exampleModalLongTitle'>Missão N°".$row['id_missao'] ."</h2></center>
                                              </div>
                                              <div class='modal-body text-justify'>
                                                <div class='container-fluid'>
                                                    <div class='row'>
                                                        <div class='col-md-6'>
                                                            <h3>Onde é?</h3>
                                                            ".$row['onde']."
                                                            <h3>Descrição:</h3>
                                                            ".$row['descricao']."
                                                        </div>
                                                        <div class='col-md-6'>
                                                            <h3>Operador da missão:</h3>
                                                            ".$row['id_usuario']."
                                                            <h3>Data da missão:</h3>
                                                            ".$row['data']."
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
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(($page == 'concluir'))
{
    echo "<script> alert('Missão Concluida!'); </script>";
}
?>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script/publicacao.js"></script>
<script src="../js/script/verTabela.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</body>
</html>
