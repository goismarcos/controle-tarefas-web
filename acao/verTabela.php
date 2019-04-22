<?php
    require_once '../classe/pegasus.php';
    $objPegasus = new Pegasus();//instanciando obj
     $page = isset($_GET['p']) ? $_GET['p'] : '' ;
     
    if($page == '30dias')// missoes realizadas nos  ultimos 30 dias
    {
           $resposta = $objPegasus->missaoUltimosTrintaDiasRealizadas();//retornando tabela
           $cont = 0;
           foreach($resposta as $row)
           {
               $cont++;       
           }
           echo "".$cont;
   }
   else if($page == '7dias')
   {
       $resposta = $objPegasus->missaoUltimosSeteDiasRealizadas();
        $cont = 0;
        foreach($resposta as $row)
        {
            $cont++;       
        }
        echo "".$cont;
   }
   else if($page == 'totalRealizadas')
   {
       $resposta = $objPegasus->totalRealizadas();
        $cont = 0;
        foreach($resposta as $row)
        {
            $cont++;       
        }
        echo "".$cont;
   }
   else if($page == 'todas')
   {
        $resposta = $objPegasus->todas();
        $cont = 0;
        foreach($resposta as $row)
        {
            $cont++;       
        }
        echo "".$cont;
   }
    else
    {
        $resposta = $objPegasus->publicacaoMostrar();//aqui mostrar a missoes faltando
        $cont = 0;
        foreach($resposta as $row)
        {
            $cont++;       
        }
        echo "".$cont;
    }
  
