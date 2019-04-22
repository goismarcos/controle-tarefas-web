/**
 * Created by Marcos on 17/07/2017.
 */

$(function(){
    //deixando a notificação e login invisivel
    $("#carregando").hide();
    $("#notificacao").hide();

    //limpa o campo de usuario
    $("#usuario").click(function(){
        $("#usuario").val('');
    })

    //limpa o campo de senha
    $("#senha").click(function(){
        $("#senha").val('');
    })

    //quando clickar nessa desgraça
    $('#entrar').click(function(){
        $("#carregando").show();

        //se o fdp nao digita nada
        if($("#usuario").val() == '' || $("#senha").val() == '')
        {
            $("#notificacao").html('<p class="text-danger">Digite todos os campos</p>');
            $("#notificacao").show();
            $("#carregando").hide();
        }
        else//se nao
        {
            $("#carregando").show();

            $.ajax({
                type: 'POST',
                url: '../acao/login.php',
                data: $("form").serialize(),
                dataType: 'html',
                success: function(resultado)
                {   //alert(resultado);
                    if(resultado == 'ok')
                    {
                        $("#carregando").hide();
                        window.location.href="../pegasus/";
                    }
                    else
                    {
                        $("#notificacao").html('<p class="text-danger">'+resultado+'</p>');
                        $("#notificacao").show();
                        $("#carregando").hide();
                    }
                }
            });
        }
    });
});

