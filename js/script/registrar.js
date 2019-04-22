$(function() {
    $("#campos").hide();
    $("#trocar").hide();
    $("#carregando").hide();
    //Pesquisar usuario igual
    $("#verifica").click(function(e){
        e.preventDefault();
        var u = $("#usuario").val();
        $.ajax({
            type: 'POST',
            url: '../acao/registrar.php?p=verifica',
            data: "usuario="+u,
            beforeSend: function () {

                $("#carregando").show();

            },
            error: function () {
                $("#notificacao").html('Erro na conexão');
                $("#notificacao").show();
            },
            success: function (msg) {

                //se o fdp nao digita nada
                if($("#usuario").val() == '' || $("#usuario").val().length < 6 )
                {
                    $("#notificacao").html("<p class='text-danger'>Digite o campo com no minimo 6 digitos</p>");
                    $("#notificacao").show();
                    $("#carregando").hide();
                }
                else if(msg == 1)//se for um permite desabito a vireficação e habilito outros campos
                {
                    //alert(msg);
                    $("#carregando").hide();
                    $("#notificacao").html("<p class='text-success'>Usuario disponivel</p>");
                    $("#usuario").prop("disabled", true);
                    $("#verifica").prop("disabled", true);
                    $("#trocar").show();
                    $("#campos").show();
                    $("#nome").val('');
                    $("#senha").val('');
                }
                else if (msg == 0)//se caso tenha um usuario identico
                {
                    $("#carregando").hide();
                    $("#notificacao").html("<p class='text-danger'>Ja existe um usuario com esse nome</p>");
                }
                else
                {

                }

            }
        });
    });//fim da verificação se tem usuario igual

    //trocar de usuario
    $("#trocar").click(function (e)
    {//funcao caso o usuario quiser trocar usuario
        e.preventDefault();
        $("#carregando").hide();
        $("#usuario").prop("disabled", false);
        $("#verifica").prop("disabled", false);
        $("#trocar").hide();
        $("#usuario").val('');
        $("#nome").val('');
        $("#senha").val('');
        $("#campos").hide();
        $("#notificacao").html('');

    });//fim da opcao para trocar de usuario

    //cadastrando usuario
    $("#cadastrar").click(function () {
        var n = $("#usuario").val();
        var a = $("#nome").val();
        var s = $("#senha").val();
        var c = $("#curso").val();


        $.ajax({
            type: 'POST',
            url: '../acao/registrar.php?p=cadastrar',
            data: "usuario="+n+"&nome="+a+"&senha="+s+"&curso="+c,
            success: function (msg) {
                //se o fdp nao digita nada
                if($("#nome").val() == '' || $("#senha").val() == '' || $("#nome").val().length < 6 || $("#senha").val().length < 6)
                {
                    $("#notificacao").html("<p class='text-danger'>Digite todos os campos com no minimo 6 digitos</p>");
                    $("#notificacao").show();
                    $("#carregando").hide();
                }
                else
                {
                    $("#notificacaoCadastro").html("<p class='text-success'>"+msg+"</p>");
                    $("#cadastroRealizado").hide();
                }
            }
        });
    });//fim do cadastro de usuario

    //populando o combo box
    $("#curso").ready(function(){
       $.ajax({
           type: 'POST',
           url: '../acao/registrar.php?p=curso',
           success: function (msg)
           {
               $('#curso').html(msg);//mostrando cursos
           }

       });
    });
});
