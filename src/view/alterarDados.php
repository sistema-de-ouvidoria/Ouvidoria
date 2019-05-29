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

    <!-- SCRIPTS -->
    <script type="text/javascript" src="script.js" /></script>

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
    <form action="?section=UsuarioControle&function=alterarDados" method="POST" name="formulario">
        <div class="form-group col-md-4">
            <label>Nome:</label><input type="text" name="nomeAlteraDados" value="<?=$usuario->nome?>"  class="form-control"/>
        </div>
        <div class="form-group  col-md-4">
            <label>CPF:</label><input type="text" name="cpfAlteraDados" value="<?=$usuario->cpf?>" class="form-control" readonly />
        </div>
        <div class="form-group  col-md-4">
            <label>Endereço:</label><input type="text" name="enderecoAlteraDados" value="<?=$usuario->endereco?>" class="form-control" />
            <label>Telefone:</label><input type="number" id="telefone" maxlength="11" onkeypress="return somenteNumerosTel(event)" name="telefoneAlteraDados" value="<?=$usuario->telefone?>" class="form-control" />
            <label>E-mail:</label><input type="email" name="emailAlteraDados" value="<?=$usuario->email?>" class="form-control" />
            <?php if(isset($emailUnico) && !$emailUnico){ echo "<span style='color:red;'>E-mail inserido já cadastrado</span>"; echo "<br>";}?>
        </div>
        <div class="form-group col-md-4">

            <label>Senha atual:</label><input type="password" id="senhaAntigaAlteraDados" name="senhaAntigaAlteraDados" required="required" class="form-control" />
            <?php if(isset($senhaDiferenteBanco) && !$senhaDiferenteBanco){ echo "<span style='color:red;'>Senha digitada não confere</span>";echo "<br>";} ?>
            <label>Nova senha:</label><input type="password" id="senhaNovaAlteraDados" name="senhaNovaAlteraDados" class="form-control" />

            <?php if(isset($senhaMenor) && $senhaMenor){ echo "<span style='color:red;'>O campo nova senha não pode conter menos de 5 caracteres</span>";echo "<br>";} ?>
            <label>Confirme a nova senha:</label><input id="senhaNovaConfirmacaoAlteraDados" name="senhaNovaConfirmacaoAlteraDados" type="password" class="form-control" />
            <?php if(isset($senhaIgual) && !$senhaIgual)echo "<span style='color:red;'>A confirmação de senha não confere</span>";?>
        </div>
        <div class="form-group  col-md-4">
            <input  type="submit" value="Enviar" name="enviado"class="float-right btn btn-outline-success active"/>

        </div>
    </form>
    <br><br>
</div>
<!-- FIM DA TELA DE CADASTRO -->

</body>
