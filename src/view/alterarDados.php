<?php
session_start();
require ('model/Conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Usuário</title>
    <meta charset="utf-8">
    <meta http-equiv=”content-type” content="text/html;" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">


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
    <form action="?function=cadastrarUsuario" method="POST">
        <div class="form-group col-md-4">
            <label>Nome:<?php echo $usuario->nome;?></label><input type="text" name="nomeCadastro" class="form-control" />
        </div>
        <div class="form-group  col-md-4">
            <label>CPF:<?php echo $usuario->cpf;?></label><input type="text" name="cpfCadastro" class="form-control" readonly />
        </div>
        <div class="form-group  col-md-4">
            <label>Endereço:<?php echo $usuario->endereco; ?></label><input type="text" name="enderecoCadastro" class="form-control" />
            <label>Telefone:<?php echo $usuario->telefone; ?></label><input type="text" name="telefoneCadastro" class="form-control" />
            <label>E-mail:<?php echo $usuario->email; ?></label><input type="email" name="emailCadastro" class="form-control" />
        </div>
        <div class="form-group col-md-4">
            <label>Confirme a senha antiga:</label><input type="text" name="senhaAntigaAlterar"class="form-control" />
            <label>Nova senha:</label><input type="text" name="senhaNovaAlterar" class="form-control" />
            <label>Confirme a nova senha:</label><input name="senhaNovaConfirmacaoAlterar" type="text" class="form-control" />
            <?php if(isset($msgErrosenhaIgual) && !$msgErrosenhaIgual) echo "As senhas devem ser iguais";?>


        </div>
        <div class="form-group  col-md-8">


            <input  type="submit" value="Enviar" name="enviado" class="float-right btn btn-outline-primary active"/>

        </div>
    </form>
</div>
<!-- FIM DA TELA DE CADASTRO -->

</body>

<!--<button class="btn btn-outline-success btn-lg active float-right" role="button" aria-pressed="true"">Enviar</button>
