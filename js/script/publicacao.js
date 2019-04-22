
    $("#publicar").click(function () {
        $.ajax({
            type: 'POST',
            url: '../acao/publicacao.php?p=postar',
            data: $("form").serialize(),
            dataType: 'html',
            success: function (msg) 
            {
                //alert(msg);
                //se o fdp nao digita nada
                if ($("#descricao").val() == '' || $("#onde").val() == '') 
                {
                    $("#notificacao").html("<p class='text-danger'>"+ msg +"</p>");
                    $("#notificacao").show();
                    $("#carregando").hide();
                }
                else 
                {
                    alert(msg);
                    location.reload();
                }
            }
        });
    });
    
    

    




