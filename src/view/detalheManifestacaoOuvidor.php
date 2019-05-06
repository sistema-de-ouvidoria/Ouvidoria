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
    <form action="?function=encaminhar&id=<?=$manifestacao->id_manifestacao?>" method="GET">
        <div class="row form-group col-md-4">
            <label for="protocolo">Protocolo:</label><input id="protocolo" type="text" name="nomeCadastro" value="<?=$manifestacao->id_manifestacao?>" readonly class="form-control" />
            <label>Data de Criação:</label><input type="text" name="cpfCadastro" value="<?=date('d-m-Y', strtotime($manifestacao->data_manifestacao))?>" readonly class="form-control" />
            <label>Assunto:</label><input type="text" value="<?=$manifestacao->assunto?>" name="enderecoCadastro" readonly class="form-control" />
            <label>Proprietário:</label><input type="text" value="<?=$manifestacao->nome?>" name="telefoneCadastro" readonly class="form-control" />
            <label>Situação:</label><input type="email" name="emailCadastro" value="<?=$manifestacao->nome_situacao?>" readonly class="form-control" />
            <label>Descrição:</label><textarea name="mensagem" rows="6" class="form-control col-md-12" maxlength="1000" readonly><?=$manifestacao->mensagem?></textarea>
        </div>
        <div class="row">
            <?php
            $tipoSelecionado = null;
            echo "<select onchange='seleciona_orgao(this)' name = 'orgao' id='orgao'>";
            $tamanho = count($orgaos);
            if(isset($orgaos)){
                echo "<option value = ''>Selecione um Orgão Publico</option>";
                for($i = 0; $i < $tamanho; $i++){
                    echo "<option id='orgao' value = {$orgaos[$i][0]}";
                    if($tipoSelecionado == $orgaos[$i][0]) {
                        echo "selected = 'selected'";
                        $tipoSelecionado = $orgaos[$i][0];
                    }
                    echo ">{$orgaos[$i][1]}</option>";
                }
            }
            echo "</select>"
            ?>
        </div>
            <a class="btn btn-warning" href="?function=encaminhar&id=<?=$manifestacao->id_manifestacao?>&org="id="orgao_publico"><i class="fa fa-wrench"></i> Encaminhar</a>
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
