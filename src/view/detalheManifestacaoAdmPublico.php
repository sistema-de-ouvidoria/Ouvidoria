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
    <link rel="stylesheet" href="style.css">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- ESTILOS PARA ESTA PÁGINA -->
    <!-- Nesse caso, este estilo é apenas para inserir imagens -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- JAVASCRIPT E JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <form id="form" class="row" action="?section=ManifestacaoControle&function=responder" method="post">
        <div class="form-group col-6">
            <label for="protocolo">Protocolo:</label>
            <input value="<?=$manifestacao->id_manifestacao?>" name="protocolo" id="protocolo" readonly class="form-control">
        </div>
        <div class="form-group col-6">
            <label for="data">Data de Criação:</label>
            <input id="data" class="form-control" value="<?=date('d-m-Y', strtotime($manifestacao->data_manifestacao))?>" readonly>
        </div>
        <div class="form-group col-12">
            <label for="assunto">Assunto:</label>
            <input id="assunto" class="form-control" value="<?=$manifestacao->assunto?>" readonly>
        </div>
        <div class="form-group col-6">
            <label for="prop">Proprietário:</label>
            <input id="prop" class="form-control" value="<?=$manifestacao->nome?>" readonly>
        </div>
        <div class="form-group col-6">
            <label for="anexo">Anexo:</label>
            <?php
            $x = (empty($manifestacao->id_anexo)) ? 'error.php' : $manifestacao->id_anexo;
            ?>
            <br>
            <a href="arquivos/<?=$x?>"><span style="font-size: 26px" class="anx glyphicon glyphicon-download-alt"></span></a>
        </div>
        <div class="form-group col-6">
            <label for="situacao">Situação:</label>
            <input id="situacao" class="form-control" value="<?=$manifestacao->nome_situacao?>" readonly>
        </div>
        <div class="form-group col-6">
            <label for="setor">Setor Responsável:</label>
            <input id="setor" value="<?=$manifestacao->nome_orgao_publico?>" readonly class="form-control"/>
        </div>
        <div class="form-group col-12">
            <label for="descricao">Descrição:</label>
            <textarea name="mensagem" rows="6" class="form-control" maxlength="1000" readonly><?=$manifestacao->mensagem?></textarea>
        </div>
        <div class="form-group col-12">
            <label for="resposta">Resposta:</label>
            <textarea id="resposta" onchange="seleciona_resposta(this)"  name="resposta"rows="6"class="form-control" maxlength="1000" placeholder="Digite aqui sua resposta..." required></textarea>
            <?php
            if(isset($erroResposta) && !$erroResposta){
                ?><span style='color:red;' role="alert">O campo resposta deve ser informado!</span> <?php
            }?>
        </div>
        <div class="form-group col-12">
            <a class="btn btn-success float-right" href="#" onClick="document.getElementById('form').submit();"><span class="fa fa-check"></span> Responder</a>
            <button name="recusarManifestacao" type="button" class="btn btn-danger   col-2 float-left" data-toggle="modal" data-target="#myModal"><span class="fa fa-wrench"></span>Rejeitar manifestação</button>
        </div>
    </form>
</div>
<script>
    function seleciona_resposta(el) {
        var $lnk = document.getElementById("resposta_adm");
        $lnk.href = $lnk.href.replace(/resposta=(.*)/, 'resposta=') + el.value;
    }
</script>


<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="col-sm-12 text-center">
                            <h5 class="modal-title text-center">Descreva o motivo</h5>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body">
                <form method="POST" action="?section=ManifestacaoControle&function=recusarManifestacao">
                <div class="container-fluid">
                        <div class="col-sm-12 text-center">
                        <textarea id="motivoRejeicao" name="motivoRejeicao"rows="6"class="form-control" maxlength="1000" placeholder="Motivo da rejeição" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="col-sm-12 text-center">
                            <input id="idManifestacao" name="idManifestacao" hidden="hidden" value="<?php echo $manifestacao->id_manifestacao;?>">
                            <input name="recusarManifestacao" type="submit" class="btn btn-danger text-center" value="Rejeitar">
                            
                        </div>
                    </div>
                </div>
                </form>    
                
            </div>
        </div>
    </div>



</body>
