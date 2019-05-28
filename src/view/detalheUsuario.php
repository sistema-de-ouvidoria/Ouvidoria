<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Detalhe Usuário</title>
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

<!--MENU SUPERIOR -->

<?php include('menu.php');?>

<!--FIM MENU SUPERIOR -->

<!-- TELA DE CADASTRO -->
<br>
<br>
<div class="container mt-5">
        <form id="formularioUser" action="?section=UsuarioControle&function=usuarioDetalhe&cpf=<?=$usuario->cpf?>" class="row" method="POST">
            <div class="form-group col-6">
                <label >CPF:</label>
                <input name="cpf" value="<?=$usuario->cpf?>" readonly class="form-control">
            </div>
            <div class="form-group col-6">
                <label>Telefone</label>
                <input name="telefone" value="<?=$usuario->telefone?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="assunto">Nome</label>
                <input name="nome" value="<?=$usuario->nome?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Email</label>
                <input name="email" value="<?=$usuario->email?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Endereco</label>
                <input name="endereco" value="<?=$usuario->endereco?>" class="form-control" >
            </div>
            <input name="id" type="hidden" value="<?=$usuario->id_tipo_usuario?>" class="form-control" >
            <div class="form-group col-12">
                <input name="acao" type="submit" value="Desativar" class="btn btn-danger col-2 float-left">
                <button name="delegarPrivilegios" type="button" class="btn btn-info col-2 float-middle" data-toggle="modal" data-target="#myModal"> Delegar Previlégios</button>
                <input name="acao" type="submit" class="btn btn-success col-2 float-right" value="Alterar">
            </div>
        </form>



    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="col-sm-12 text-center">
                            <h5 class="modal-title text-center">Selecione o privilégio do usuário</h5>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-sm-12 text-center">
                    <p><?php
                        $tipoSelecionado = null;
                        echo "<select class='form-control' name = 'privilegio'>";
                        $tamanho = count($tipos);
                        if(isset($tipos)){
                            for($i = 0; $i < $tamanho; $i = $i + 2){
                                echo "<option value = {$tipos[$i]}";
                                if($tipoSelecionado == $tipos[$i])
                                    echo "selected = 'selected'";
                                echo ">{$tipos[$i+1]}</option>";
                            }
                        }
                        echo "</select>"
                        ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="col-sm-12 text-center">
                            <input name="acao" type="submit" class="btn btn-success" value="Salvar" data-dismiss="modal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
