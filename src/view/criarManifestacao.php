<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Criar Manifestação</title>
        <meta charset="utf-8">
        <meta http-equiv=”content-type” content="text/html;" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keywords" content="tags, que, eu, quiser, usar, para, os, robos, do, google" />
        <title>Fala aÍ</title>
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
        <div id="manifestacao" style="margin-left: 1cm">
            <h3>Manifestação</h3>  

            <form enctype="multipart/form-data" action="?section=ManifestacaoControle&function=criarManifestacao" method="POST">
                <p>Descreva abaixo o conteúdo de sua manifestação. Se você quiser, é possível inserir anexos para melhor fundamentar sua manifestação.</p>        
                <label>Tipo de manifestacao:</label>
                <?php
                $tipoSelecionado = null;
                echo "<select name = 'tipo'>";
                $tamanho = count($listaTipos);
                if(isset($listaTipos)){
                    for($i = 0; $i < $tamanho; $i = $i + 2){
                        echo "<option value = {$listaTipos[$i]}";
                        if($tipoSelecionado == $listaTipos[$i])
                            echo "selected = 'selected'";
                        echo ">{$listaTipos[$i+1]}</option>";
                    }
                }
                echo "</select>"
                ?>
                <br>
                <strong>Sobre o que deseja se manifestar?</strong>
                <br>   
                       
                <label>Assunto:</label>
                <input name="assunto" type="text" class="form-control col-md-8" maxlength="100" required oninvalid="setCustomValidity('O campo assunto não pode estar vazio')" onchange="try{setCustomValidity('')}catch(e){}"/>

                <br>
                <label>Incluir anexos: </label>
                <br>
                <input name="anexo" type="file"/>           
                <br>
                <br>
                <label>Sua mensagem:</label>
                <textarea name="mensagem" rows="6" class="form-control col-md-8" maxlength="1000" required oninvalid="setCustomValidity('O campo sua mensagem não pode estar vazio')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                <br>
                Se deseja que sua manifestação seja sigilosa, marque a opção: <strong>"Manifestação sigilosa"</strong>.
                <div id="texto-explicativo" style="font-size: 12px">
                    (Optar pelo sigilo garante que seus dados serão acessados somente pela ouvidoria e orgãos responsáveis pela sua manifestação.)
                </div>   
                <label><strong>Manifestacão sigilosa: </strong></label>
                <input type="checkbox" name="sigilo" value="true">Sim<br>
                <br>
                <input id="botao" name="sent" type="submit" value="Enviar" class="btn btn-outline-success btn-lg active"/>
            </form><!--FIM DO FORMULÁRIO -->    
        </div>
   </body>
</html>