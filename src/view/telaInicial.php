<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Ouvidoria - Notícias</title>
    <meta charset="utf-8">
    <meta http-equiv=”content-type” content="text/html;" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <!-- ESTILOS PARA ESTA PÁGINA -->
    <!-- Nesse caso, este estilo é apenas para inserir imagens -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="shortcut icon" href="logo.jpg"/>
    <link rel="stylesheet" href="style.css">

    <!-- JAVASCRIPT E JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>

<body>

<?php include('menu.php'); ?>

<!--INICIO DO FORMULÁRIO -->

<br>
    <div class="container mt-2" align="center">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <a href="?section=NoticiaControle&function=verNoticia&id=<?=$noticias[0][0]?>">
                        <img class="d-block w-100 img-carousel" src="arquivos/<?=$noticias[0][3]?>" alt="Primeiro Slide">

                        <div class="carousel-caption">
                            <h4 class="carousel-font title"><?=$noticias[0][1]?></h4>
                            <p class="carousel-font subtitle"><?=$noticias[0][2]?></p>
                        </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="?section=NoticiaControle&function=verNoticia&id=<?=$noticias[1][0]?>">
                        <img class="d-block w-100 img-carousel" src="arquivos/<?=$noticias[1][3]?>" alt="Segundo Slide">

                        <div class="carousel-caption d-none d-md-block">
                            <h4 class="carousel-font title"><?=$noticias[1][1]?></h4>
                            <p class="carousel-font subtitle"><?=$noticias[1][2]?></p>
                        </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="?section=NoticiaControle&function=verNoticia&id=<?=$noticias[2][0]?>">
                        <img class="d-block w-100 img-carousel" src="arquivos/<?=$noticias[2][3]?>" alt="Terceiro Slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h4 class="carousel-font title"><?=$noticias[2][1]?></h4>
                            <p class="carousel-font subtitle"><?=$noticias[2][2]?></p>
                        </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="?section=NoticiaControle&function=verNoticia&id=<?=$noticias[3][0]?>">
                        <img class="d-block w-100 img-carousel" src="arquivos/<?=$noticias[3][3]?>" alt="Quarto Slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h4 class="carousel-font title"><?=$noticias[3][1]?></h4>
                            <p class="carousel-font subtitle"><?=$noticias[3][2]?></p>
                        </div>
                    </a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
        <div class="form-group mt-3">
            <a href="?section=NoticiaControle&function=listarTodasNoticias" type="submit" class="btn btn-primary col-2 float-right">Ver mais notícias...</a>
        </div>
    </div>
</body>
</html>