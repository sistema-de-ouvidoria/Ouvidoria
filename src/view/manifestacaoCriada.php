<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        <meta http-equiv=”content-type” content="text/html;" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
        <title>Manifestacação criada com sucesso</title>
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

	<!--MENU SUPERIOR -->
    <?php include('menu.php'); ?>

        <!--FIM MENU SUPERIOR --> 
        <br>
        <div class="msg" style="margin-top:50px;">Parabéns, sua manifestação foi enviada com <strong class="sucesso">sucesso!</strong></div>
        <br>
        <div class="msg" style="margin-top:200px;">Prezado(a) <strong><?php echo $nome_usuario; ?></strong>,
		sua manifestação foi criada e será encaminhada para o órgão responsável que terá <strong>30 dias úteis</strong> para resposta.</div>
		<br>
		<div class="msg" style="margin-top:50px;"><strong>Protocolo de atendimento <?php echo $protocolo_manifestacao . "."; ?></strong></div>
		<br>
		<div class="msg" style="margin-top:50px;">Para acompanhar sua manifestação, <a href="?=function=abrirManifestacao&<?php echo $protocolo_manifestacao; ?>">clique aqui</a> ou através da opção acompanhe sua manifestação no menu acima buscando com o protocolo gerado.</div>
</body>
</html>