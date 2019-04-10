<?php
session_start();
require ('../model/Connection.php');
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
            $msg = "false";/*
            
            if(!isset($_SESSION['CPF'])){
                header('Location: ../index.php');
            }
            */
        ?>

        <!--MENU SUPERIOR -->      
                 

      
            <nav class="navbar navbar-dark navbar-expand-lg bg-dark fixed-top" > 
                <!--BOTÃO SANDUICHE-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button><!--FIM BOTÃO SANDUICHE -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="home.php">Página Inicial</a></li>
                        <li class="nav-item"><a class="nav-link" href="minha-pg.html">Minha Página</a></li>
                        <li class="nav-item"><a class="nav-link" href="sobre.html">Sobre</a></li>
                    </ul>
                </div>
                <div id="botoes"
                    <form id="botoes">
                        <input type="submit" class="btn btn-outline-success" value="  Login  " /></li>
                        <a href="cadastrarUsuario.php" class="btn btn-outline-info active"  aria-pressed="true" >Cadastre-se</a><
                    </form>
                </div>

            </nav>

        <!--FIM MENU SUPERIOR --> 

 

        <!-- TELA DE CADASTRO -->
        <br>
        <br>
        <br>
        <br>
        <div style="margin-left: 1cm">
            <h1> Cadastre-se </h1>
        <br>
            <form action="" method="POST">
                <div class="form-group col-md-8">
                    <label>Nome:</label><input type="text" class="form-control" />
                </div>
                <div class="form-group  col-md-4">
                    <label>CPF:</label><input type="text" class="form-control" />
                </div>
                <div class="form-group  col-md-8">
                    <label>Endereço:</label><input type="text" class="form-control" />
                    <label>Telefone:</label><input type="text" class="form-control" />
                    <label>E-mail:</label><input type="email" class="form-control" />
                </div>
                <div class="form-group col-md-4">
                    <label>Senha:</label><input type="text" class="form-control" />
                    <label>Confirme a senha:</label><input type="text" class="form-control" />
                </div>
                <div class="form-group  col-md-8">


                <input  type="submit" value="Enviar" class="float-right btn btn-outline-primary active"/>

                </div>
            </form>
        </div>
      <!-- FIM DA TELA DE CADASTRO -->

   </body>

    <!--<button class="btn btn-outline-success btn-lg active float-right" role="button" aria-pressed="true"">Enviar</button>
