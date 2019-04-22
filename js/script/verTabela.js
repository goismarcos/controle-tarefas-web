$(document).ready(function(){
    function verTabela(){
            $.ajax({
            type: "GET",
            url: "../acao/verTabela.php",
            success: function(dados)
            {
                $('#quantidade').html("Missões em espera: "+dados);
            }
        });
    }
    verTabela();
    function missao30dias(){
            $.ajax({
            type: "GET",
            url: "../acao/verTabela.php?p=30dias",
            success: function(dados)
            {
                $('#30dias').html("Missões realizadas nos ultimos 30 dias: "+dados);
            }
        });
    }
    missao30dias();
    function missao7dias(){
        $.ajax({
            type: "GET",
            url: "../acao/verTabela.php?p=7dias",
            success: function(dados)
            {
                $('#7dias').html("Missões realizadas nos ultimos 7 dias: "+dados);
            }
        });
    }
    missao7dias();
    function totalRealizadas(){
        $.ajax({
            type: "GET",
            url: "../acao/verTabela.php?p=totalRealizadas",
            success: function(dados)
            {
                $('#totalRealizadas').html("Total de missões realizadas: "+dados);
            }
        });
    }
    totalRealizadas();
    function todas(){
        $.ajax({
            type: "GET",
            url: "../acao/verTabela.php?p=todas",
            success: function(dados)
            {
                $('#todas').html("Todas missões: "+dados);
            }
        });
    }
    todas();
    $('#tabela').DataTable();
    $('#tabela2').DataTable();
});
        
	

