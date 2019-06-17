<?php
$autalizar = false;
require ('model/Conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Fazer Login</title>
    <meta charset="utf-8">
    <meta http-equiv=”content-type” content="text/html;" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
    <title>Fazer Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="logo.jpg">
    <link rel="stylesheet" href="style.css">

    <!-- ESTILOS PARA ESTA PÁGINA -->
    <!-- Nesse caso, este estilo é apenas para inserir imagens -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- SCRIPTS -->
    <script type="text/javascript" src="script.js"></script>

    <!-- JAVASCRIPT E JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



</head>
<body>

<!--MENU SUPERIOR -->

<?php include('menu.php'); ?>

<!--FIM MENU SUPERIOR -->

<!-- TELA DE CADASTRO -->
<br>
<br>
<br>
<br>
<div style="margin-left: 1cm">
    <h1> Cadastre-se </h1>
    <br>

    <?php if(!isset($usuario->nome)){?>

        <div>
            <form name="formularioCadastro" action="?section=UsuarioControle&function=cadastrarUsuario" method="POST">
                <div class="form-group col-md-4">
                    <label>Nome:</label><input type="text" name="nomeCadastro" class="form-control" required oninvalid="setCustomValidity('O campo nome deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                </div>
                <div class="form-group  col-md-4">
                    <label>CPF:</label><input type="number" id="cpf" placeholder="Insira apenas números" name="cpfCadastro" maxlength="11" name="cpfCadastro" class="form-control" onkeypress="return somenteNumerosCPF(event)" required oninvalid="setCustomValidity('O campo CPF deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    <?php if(isset($cpfExiste) && !$cpfExiste) echo "<span style='color:red;'>CPF já cadastrado</span>";?>
                </div>
                <div class="form-group  col-md-4">
                    <label>Endereço:</label><input type="text" name="enderecoCadastro" class="form-control" />
                    <label>Telefone:</label><input type="number" id="telefone" maxlength="11" name="telefoneCadastro" onkeypress="return somenteNumerosTel(event)" required class="form-control"/>
                    <label>E-mail:</label><input type="email" name="emailCadastro" class="form-control" required oninvalid="setCustomValidity('E-mail inválido')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    <?php if(isset($emailUnico) && !$emailUnico){ echo "<span style='color:red;'>E-mail inserido já cadastrado</span>"; echo "<br>";}?>
                </div>
                <div class="form-group col-md-4">
                    <label>Senha:</label><input type="password" id="senhaCadastro" required name="senhaCadastro" class="form-control" />
                    <?php if(isset($senhaMenor) && !$senhaMenor){ echo "<span style='color:red;'>O campo senha não pode conter menos de 5 caracteres</span>";echo "<br>";} ?>
                    <label>Confirme a senha:</label><input id="senhaConfirmacaoCadastro" name="senhaConfirmacaoCadastro" type="password" class="form-control" required oninvalid="setCustomValidity('O campo Confirmar senha deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    <?php if(isset($senhaIgual) && !$senhaIgual)echo "<span style='color:red;'>A confirmação de senha não confere</span>";?>
                </div>
                <div class="form-group col-md-4">
                    <input  type="submit" value="Enviar"  name="enviado" class="float-right btn btn-outline-success active"/>
                </div>
            </form>
            <br><br>
        </div>
    <?php }else{ ?>
        <div>
            <form name="formularioCadastro" name="formularioCadastro" action="?section=UsuarioControle&function=cadastrarUsuario" method="POST">
                <div class="form-group col-md-4">
                    <label>Nome:</label><input type="text" value="<?=$usuario->nome?>" name="nomeCadastro" class="form-control" required oninvalid="setCustomValidity('O campo nome deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                </div>
                <div class="form-group  col-md-4">
                    <label>CPF:</label><input type="number" id="cpf" value="<?=$usuario->cpf?>" placeholder="Insira apenas números" name="cpfCadastro" maxlength="11" name="cpfCadastro" class="form-control" onkeypress="return somenteNumerosCPF(event)" required oninvalid="setCustomValidity('O campo CPF deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    <?php if(isset($cpfExiste) && !$cpfExiste) echo "<span style='color:red;'>CPF já cadastrado</span>";?>
                </div>
                <div class="form-group  col-md-4">
                    <label>Endereço:</label><input type="text" value="<?=$usuario->endereco?>" name="enderecoCadastro" class="form-control" />
                    <label>Telefone:</label><input type="number" value="<?=$usuario->telefone?>"  id="telefone" maxlength="11" name="telefoneCadastro" onkeypress="return somenteNumerosTel(event)" required class="form-control"/>
                    <label>E-mail:</label><input type="email" value="<?=$usuario->email?>" name="emailCadastro" class="form-control" required oninvalid="setCustomValidity('E-mail inválido')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    <?php if(isset($emailUnico) && !$emailUnico){ echo "<span style='color:red;'>E-mail inserido já cadastrado</span>"; echo "<br>";}?>
                </div>
                <div class="form-group col-md-4">
                    <label>Senha:</label><input type="password" id="senhaCadastro" required name="senhaCadastro" class="form-control" />
                    <?php if(isset($senhaMenor) && !$senhaMenor){ echo "<span style='color:red;'>O campo senha não pode conter menos de 5 caracteres</span>";echo "<br>";} ?>
                    <label>Confirme a senha:</label><input id="senhaConfirmacaoCadastro" name="senhaConfirmacaoCadastro" type="password" class="form-control" required oninvalid="setCustomValidity('O campo Confirmar senha deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    <?php if(isset($senhaIgual) && !$senhaIgual)echo "<span style='color:red;'>A confirmação de senha não confere</span>";?>
                </div>
                <div class="form-group col-md-4">
                    <input  type="submit" value="Enviar"  name="enviado" class="float-right btn btn-outline-success active"/>
                </div>
            </form>
            <br><br>
        </div>
    <?php } ?>

    <!-- FIM DA TELA DE CADASTRO -->

</body>