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
        <link rel="shortcut icon" href="logo.jpg"/>

        <!-- ESTILOS PARA ESTA PÁGINA -->
        <!-- Nesse caso, este estilo é apenas para inserir imagens -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

        <link href="css/estilo.css" rel="stylesheet" type="text/css">

        <!-- JAVASCRIPT E JQUERY -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </head>

    <body>

        <?php $verificacao = 1; include('menu.php'); ?>

        <!--INICIO DO FORMULÁRIO -->

        <br>
        <div class="row mt-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            <h3>Fazer Login</h3>

            <form action="?function=fazerLogin" method="POST">
                <label>CPF:</label>
                <input name="cpf" type="number" onKeyDown="if(this.value.length==11) return false;" class="form-control" maxlength="11" required oninvalid="setCustomValidity('O campo CPF não pode estar vazio')" onchange="try{setCustomValidity('')}catch(e){}"/>
                <br>
                <label>Senha:</label>
                <input name="senha" type="password" class="form-control" maxlength="100" required oninvalid="setCustomValidity('O campo senha não pode estar vazio')" onchange="try{setCustomValidity('')}catch(e){}"/>
                <?php if(isset($msgLogin) && !$msgLogin): ?> <div class="alerta error" role="alert">Senha ou Login inválidos!</div> <br> <?php endif; ?>
                <br>
                <input type="submit" value="Entrar" class="btn btn-outline-success btn-lg active float-right"/>
            </form><!--FIM DO FORMULÁRIO -->
            </div>
        </div>
    </body>
</html>