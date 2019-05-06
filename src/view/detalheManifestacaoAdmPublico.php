<?php
session_start();
require ('model/Conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv=”content-type” content="text/html;" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="shortcut icon" href="logo.jpg"/>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <div style="margin-left: 1cm">
        <form id="form" method="post" action="?function=responder">
            <div class="row form-group col-md-4">
                <label for="protocolo">Protocolo:</label><input name="protocolo" value="<?=$manifestacao->id_manifestacao?>" readonly class="form-control" />
                <label>Data de Criação:</label><input value="<?=date('d-m-Y', strtotime($manifestacao->data_manifestacao))?>" readonly class="form-control" />
                <label>Assunto:</label><input value="<?=$manifestacao->assunto?>" readonly class="form-control" />
                <label>Proprietário:</label><input value="<?=$manifestacao->nome?>" readonly class="form-control" />
                <label>Situação:</label><input value="<?=$manifestacao->nome_situacao?>" readonly class="form-control" />
                <label>Orgão Responsavel:</label><input value="<?=$manifestacao->nome_orgao_publico?>" readonly class="form-control" />
                <label>Descrição:</label><textarea rows="6" class="form-control col-md-12" maxlength="1000" readonly><?=$manifestacao->mensagem?></textarea>
                <label>Resposta:</label><textarea onchange="seleciona_resposta(this)" required name="resposta" rows="6" class="form-control col-md-12" maxlength="1000"></textarea>
            </div>
            <div class="row col-md-10 container clearfix">
                <a class="btn btn-success" href="#" onClick="document.getElementById('form').submit();"><i class="fa fa-check"></i> Responder</a>
                <a class="btn btn-danger" href="?function=recusarManifestacao&id=<?php echo $manifestacao->id_manifestacao; ?>"><i class="fa fa-times"></i>Recusar</a>
                <a class="btn btn-primary" href="?function=listar"><i class="fa fa-times"></i> Voltar</a>

            </div>
        </form>

        </div>
</div>

<script>
    function seleciona_resposta(el) {
        var $lnk = document.getElementById("resposta_adm");
        $lnk.href = $lnk.href.replace(/resposta=(.*)/, 'resposta=') + el.value;
    }
</script>

</body>
