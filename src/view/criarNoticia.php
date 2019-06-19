<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Criar Notícia</title>
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

    <!-- ESTILOS PARA ESTA PÁGINA -->
    <!-- Nesse caso, este estilo é apenas para inserir imagens -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- JAVASCRIPT E JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        window.onload = function()  {
            CKEDITOR.replace( 'editor' );
        };
    </script>
</head>
<body>

<!--MENU SUPERIOR -->

<?php include('menu.php'); ?>

<!--FIM MENU SUPERIOR -->

<!-- TELA DE CADASTRO -->
<div class="container mt-4">
    <form id="form" enctype="multipart/form-data" class="row" action="?section=NoticiaControle&function=cadastrarNoticia" method="post">
        <div class="form-group col-12">
            <label for="titulo">Título:</label>
            <input name="titulo" id="titulo" maxlength="100" required class="form-control">
        </div>
        <div class="form-group col-12">
            <label for="subtitulo">Subtítulo:</label>
            <input id="subtitulo" maxlength="250" name="subtitulo" class="form-control" required>
        </div>
        <div class="form-group col-12">
            <label for="editor">Descrição:</label>
            <textarea id="editor" name="editor" required></textarea>
            <?php if(isset($msgDescricao) && !$msgDescricao): ?> <span style='color:red;' role="alert">O campo descrição não pode estar vazio!</span> <br> <?php endif; ?>
        </div>
        <div class="form-group col-12">
            <label for="imagem">Imagem da manchete:</label>
            <input name="imagem" type="file" />
        </div>

        <div class="form-group col-12">
            <input name="sent" type="submit" class="btn btn-success col-2 float-right" value="Salvar">
        </div>
    </form>
</div>

</body>
