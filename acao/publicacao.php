<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 05/08/2017
 * Time: 09:52
 */
 require_once '../classe/pegasus.php';
 $objPegasus = new Pegasus();

 $page = isset($_GET['p']) ? $_GET['p'] : '' ;

if($page == 'postar')
{
    if($_POST['descricao'] == '' || $_POST['onde'] == '')
    {
        print 'Digite alguma coisa nos dois campos!';
    }
    else
    {
        $objPegasus->setOnde(htmlentities(strtoupper($_POST['onde'])));
        $objPegasus->setDescricao(htmlentities(strtoupper($_POST['descricao'])));
        $objPegasus->setIdUsuario($_POST['id_usuario']);
        if($objPegasus->publicacao())
        {
            print 'Conteudo publicado com sucesso!';
        }
        else
        {
            print 'Erro ao publicar, tente novamente mais tarde';
        }
    }

}
else if($page == 'concluir')
{
    $objPegasus->setIdMissao($_POST['id_missao']);
    $objPegasus->setIdUsuarioConcluir($_POST['id_usuario_concluir']);
    $objPegasus->setSolucao(htmlentities(strtoupper($_POST['conclusao'])));
    if($objPegasus->publicacaoConcluir())
    {
        header('location: ../pegasus/index.php?p=concluida');
    }
    else
    {
        print htmlentities('erro ao concluir missao');
    }
}
else if($page == 'reabrir')
{
    $objPegasus->setIdMissao($_POST['id_missao']);
    if($objPegasus->publicacaoReabrir())
    {
        header('location: ../pegasus/missaoconcluida.php?p=reaberta');
    }
    else
    {
        print htmlentities('erro ao reabrir missao');
    }
}


?>