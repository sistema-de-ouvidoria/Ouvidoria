<?php

require ('model/Conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Alterar Dados</title>
    <meta charset="utf-8">
    <meta http-equiv=”content-type” content="text/html;" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="shortcut icon" href="logo.jpg"/>
    <link rel="stylesheet" href="style.css">
    <!-- SCRIPTS -->
    <script type="text/javascript" src="script.js"></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


        <!-- ESTILOS PARA ESTA PÁGINA -->
        <!-- Nesse caso, este estilo é apenas para inserir imagens -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

        <!-- JAVASCRIPT E JQUERY -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>
<body>
<?php
/*

if(!isset($_SESSION['CPF'])){
    header('Location: ../index.php');
}
*/
?>

<!--MENU SUPERIOR -->

<?php include('menu.php'); ?>

<!--FIM MENU SUPERIOR -->

<!-- TELA DE CADASTRO -->
<br>
<br>
<br>
<br>
<div style="margin-left: 1cm">
    <h1> Alterar dados </h1>
    <br>
    <form action="?section=UsuarioControle&function=redefinirSenha" method="POST" name="formulario">     
            <label>Nova senha:</label><input type="password" id="senha" name="senha" class="form-control" />

            <?php if(isset($senhaMenor) && !$senhaMenor){ echo "<span style='color:red;'>O campo senha não pode conter menos de 5 caracteres</span>";echo "<br>";} ?>
            <label>Confirme a nova senha:</label><input id="senhaConfirmacao" name="senhaConfirmacao" type="password" class="form-control" />
            <?php if(isset($senhaIgual) && !$senhaIgual)echo "<span style='color:red;'>A confirmação de senha não confere!</span>";?>
        </div>
        <div class="form-group  col-md-4">
            <input  type="submit" value="Enviar" name="enviado"class="float-right btn btn-outline-success active"/>

        </div>
    </form>
    <br><br>
</div>
<!-- FIM DA TELA DE CADASTRO -->

</body>
