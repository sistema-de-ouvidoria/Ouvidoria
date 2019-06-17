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
</head>
<body>

<!--MENU SUPERIOR -->

<?php include('menu.php');?>

<!--FIM MENU SUPERIOR -->

<!-- TELA DE CADASTRO -->
<br>
<br>
<div class="container mt-5">
        <form id="formularioUser" action="?section=UsuarioControle&function=usuarioDetalhe" class="row" method="POST">
            <div class="form-group col-6">
                <label for="cpf">CPF:</label>
                <input id="cpf" name="cpfAlteraDados" value="<?=$usuario->cpf?>" readonly class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="telefone">Telefone:</label>
                <input id="telefone" name="telefone" required oninvalid="setCustomValidity('O campo telefone deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$usuario->telefone?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="nome">Nome:</label>
                <input id="nome" required oninvalid="setCustomValidity('O campo nome deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" name="nomeAlteraDados" value="<?=$usuario->nome?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="email">Email:</label>
                <input id="email" name="emailAlteraDados" required oninvalid="setCustomValidity('O campo email deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$usuario->email?>" class="form-control">
                <?php if(isset($erro) && !$erro){ echo "<span style='color:red;'>E-mail inserido já cadastrado</span>"; echo "<br>";}?>
            </div>
            <div class="form-group col-12">
                <label for="endereco">Endereco:</label>
                <input id="endereco" required oninvalid="setCustomValidity('O campo endereço deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" name="enderecoAlteraDados" value="<?=$usuario->endereco?>" class="form-control" >
            </div>
            <div class="form-group col-12">
                <label for="privilegios">Privilégios:</label>
                <input id="privilegios" name="privilegios" value="<?=$usuario->nome_tipo_usuario?>" class="form-control" >
            </div>
            <input name="id" type="hidden" value="<?=$usuario->id_tipo_usuario?>" class="form-control" >
            <div class="form-group col-12">
                <button name="delegarPrivilegios" type="button" class="btn btn-info col-2 float-left" data-toggle="modal" data-target="#myModal"><span class="fa fa-wrench"></span> Delegar Previlégios</button>
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
                        if(isset($erroComboBox) && !$erroComboBox){
                            ?><span style='color:red;' role="alert">O privilégio deve ser informado!</span> <?php
                        }
                        echo "<select onchange='seleciona_orgao(this)' name = 'orgao' id='orgao' class='form-control'>";
                        $tamanho = count($tipos);
                        if(isset($tipos)){
                            echo "<option value = 'null'>Selecione um Privilégio</option>";
                            for($i = 0; $i < $tamanho-2; $i = $i + 2){
                                echo "<option id='privilegio' value = {$tipos[$i]}";
                                if($tipoSelecionado == $tipos[$i]) {
                                    echo "selected = 'selected'";
                                    $tipoSelecionado = $tipos[$i];
                                    $_SESSION['tipo'] = $tipos[$i];
                                }
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
                            <a href="?section=UsuarioControle&function=usuarioDetalhe&cpf=<?=$usuario->cpf?>&privilegio=<?=$tipoSelecionado?>" class="btn btn-success" id="orgao_publico">Salvar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function seleciona_orgao(el) {
        var $lnk = document.getElementById("orgao_publico");
        $lnk.href = $lnk.href.replace(/orgao=(.*)/, 'orgao=') + el.value;
    }
</script>
</div>
</body>
