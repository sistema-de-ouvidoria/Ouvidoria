<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        .onoffswitch {
            position: relative; width: 90px;
            -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
        }
        .onoffswitch-checkbox {
            display: none;
        }
        .onoffswitch-label {
            display: block; overflow: hidden; cursor: pointer;
            border: 2px solid #999999; border-radius: 20px;
        }
        .onoffswitch-inner {
            display: block; width: 200%; margin-left: -100%;
            transition: margin 0.3s ease-in 0s;
        }
        .onoffswitch-inner:before, .onoffswitch-inner:after {
            display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
            font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
            box-sizing: border-box;
        }
        .onoffswitch-inner:before {
            content: "ON";
            padding-left: 10px;
            background-color: #34A7C1; color: #FFFFFF;
        }
        .onoffswitch-inner:after {
            content: "OFF";
            padding-right: 10px;
            background-color: #EEEEEE; color: #999999;
            text-align: right;
        }
        .onoffswitch-switch {
            display: block; width: 18px; margin: 6px;
            background: #FFFFFF;
            position: absolute; top: 0; bottom: 0;
            right: 56px;
            border: 2px solid #999999; border-radius: 20px;
            transition: all 0.3s ease-in 0s;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
            right: 0px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv=”content-type” content="text/html;" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
    <title>Listar Manifestações</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SCRIPTS -->
    <script type="text/javascript" src="script.js""></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

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
<?php include('menu.php');?>

<div class="container-fluid mt-3">
    <h2>Lista de Manifestações</h2>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="input">Buscar por assunto ou descrição:</label>
            <input type="text" name="consulta" id="input" onkeyup="funcaoDeBusca()" class="form-control"/>
        </div>
        <div class="form-group col-md-6">
            <label for="inputProtocolo">Buscar pelo número de protocolo:</label>
            <input type="text" name="consulta_protocolo" id="inputProtocolo" onkeyup="funcaoDeBuscaProtocolo()" class="form-control"/>
        </div>
    </div>

    <div class="onoffswitch">
        <a class="btn btn-primary" href="?section=ManifestacaoControle&function=minhasManifestacoes">Mostrar apenas minhas manifestações</a>
    </div>
    <table id="minhaTabela" class="table-hover table-striped table-bordered" data-searching="false">
        <thead>
        <tr>
            <th>Protocolo</th>
            <th>Assunto</th>
            <th>Data de criação</th>
            <th>Tipo da Manifestação</th>
            <th>Situação</th>
            <th>Detalhar</th>
            <th style="display:none;"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        if (!is_null($dados)) {
            for ($i = 0; $i < count($dados); $i++): ?>
                <tr>
                    <td><?= $dados[$i][0] ?></td>
                    <td><?= $dados[$i][1] ?></td>
                    <td><?= date('d-m-Y', strtotime($dados[$i][2])) ?></td>
                    <td><?= $dados[$i][3] ?></td>
                    <td><?= $dados[$i][4] ?></td>
                    <td style="display:none;"><?= $dados[$i][5] ?></td>
                    <td><a class="btn btn-warning" href="?section=ManifestacaoControle&function=detalharManifestacaoCidadao&id=<?= $dados[$i][0] ?>">Detalhar</a></td>
                </tr>
            <?php endfor;
        } ?>
        </tbody>
    </table>
</div>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#minhaTabela').DataTable({
            "responsive": true,
            "language": {
                "lengthMenu": "",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "paginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    });
</script>
</body>
</html>