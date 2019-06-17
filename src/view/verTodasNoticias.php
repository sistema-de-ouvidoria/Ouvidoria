<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Ouvidoria - Notícia</title>
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

    <!-- ESTILOS PARA ESTA PÁGINA -->
    <!-- Nesse caso, este estilo é apenas para inserir imagens -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- JAVASCRIPT E JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>
<body>
<?php include('menu.php');?>
<section id="content-section">
    <h1 class="borderHeading">
        Últimas notícias
    </h1>
    <div class="tile-list-1">
        <div class="tileItem">
            <hr/>
            <?php
            $i = 0;
            if (!is_null($noticias)) {
                for ($i = 0; $i < count($noticias); $i++): ?>
            <div class="span10 tileContent">
                <h2 class="tileHeadline">
                    <a href="?section=NoticiaControle&function=verNoticia&id=<?=$noticias[$i][4]?>"><?=$noticias[$i][0]?></a>
                </h2>
                <a href="?section=NoticiaControle&function=verNoticia&id=<?=$noticias[$i][4]?>">
                    <img src="arquivos/<?=$noticias[$i][1]?>" alt="Imagem da noticia" height="86" width="128" class="tileImage">
                </a>
                <span class="description"><?=$noticias[$i][2]?></span>
                <p><?=$noticias[$i][3]?></p>
            </div>
            <hr/>
            <?php endfor;
            } ?>
        </div>
    </div>
</section>
</body>
</html>
