<?php
session_start();
require ('model/Conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Detalhe Manifestação</title>
    <meta charset="utf-8">
    <meta http-equiv=”content-type” content="text/html;" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
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

<div class="container mt-3">
    <form class="row" action="?function=encaminhar&id=<?=$manifestacao->id_manifestacao?>" method="GET">
        <div class="form-group col-6">
            <label for="protocolo">Protocolo:</label>
            <input value="<?=$manifestacao->id_manifestacao?>" id="protocolo" readonly class="form-control">
        </div>
        <div class="form-group col-6">
            <label for="data">Data de Criação:</label>
            <input id="data" class="form-control" value="<?=date('d-m-Y', strtotime($manifestacao->data_manifestacao))?>" readonly>
        </div>
        <div class="form-group col-12">
            <label for="assunto">Assunto:</label>
            <input id="assunto" class="form-control" value="<?=$manifestacao->assunto?>" readonly>
        </div>
        <div class="form-group col-12">
            <label for="prop">Proprietário:</label>
            <input id="prop" class="form-control" value="<?=$manifestacao->nome?>" readonly>
        </div>
        <div class="form-group col-6">
            <label for="situacao">Situação:</label>
            <input id="situacao" class="form-control" value="<?=$manifestacao->nome_situacao?>" readonly>
        </div>
        <div class="form-group col-12">
            <label for="descricao">Descrição:</label>
            <textarea name="mensagem" rows="6" class="form-control" maxlength="1000" readonly><?=$manifestacao->mensagem?></textarea>
        </div>
        <div class="form-group col-12">
            <label for="setor">Setor Responsável:</label>
            <?php
            $tipoSelecionado = null;
            echo "<select class='container mr-12' onchange='seleciona_orgao(this)' name = 'orgao' id='orgao'>";
            $tamanho = count($orgaos);
            if(isset($orgaos)){
                echo "<option value = ''>Selecione um Orgão Publico</option>";
                for($i = 0; $i < $tamanho; $i++){
                    echo "<option id='orgao' value = {$orgaos[$i][0]}";
                    if($tipoSelecionado == $orgaos[$i][0]) {
                        echo "selected = 'selected'";
                        $tipoSelecionado = $orgaos[$i][0];
                    }
                    echo ">{$orgaos[$i][2]}</option>";
                }
            }
            echo "</select>"
            ?>
            <a class="btn btn-warning float-right mt-3" href="?function=encaminhar&id=<?=$manifestacao->id_manifestacao?>&org="id="orgao_publico"><i class="fa fa-wrench"></i> Encaminhar</a>
        </div>
    </form>
</div>

<script>
    function seleciona_orgao(el) {
        var $lnk = document.getElementById("orgao_publico");
        $lnk.href = $lnk.href.replace(/orgao=(.*)/, 'orgao=') + el.value;
    }
</script>

</body>
