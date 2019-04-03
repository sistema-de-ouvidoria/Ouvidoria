<?php
require ('model/Connection.php');
$query = "SELECT tipo from TiposManifestacao";
$tipos = mysqli_query($connection,$query);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Criando manifestação</title>
	
</head>
<body>
	<?php
        $msg = "false";

    ?>
    <div id="menu" >
    	<ul>
    		<li><a>Pagina Inicial</a></li>
    		<li><a>Minha Pagina</a></li>
    		<li><a>Sobre</a></li>
    		<li style="float:right"><a class="active" href="../model/Logout.php">logout</a></li>
    	</ul>
    </div>
    <h1>Descreva sua manifestação</h1>
    <div class="formulario">
    	<form enctype="multipart/form-data" action="?function=criarManifestacao" method="POST">
    		<div class="field">
    			<div class="selecionarTipo"><label>Tipo</label>
    				<?php
    				$tipoSelecionado = null;
    				echo "<select name = 'tipo'>";
    				while (($row = mysqli_fetch_assoc($tipos)) != null)
    				{
    					echo "<option value = '{$row['tipo']}'";
    					if ($tipoSelecionado == $row['tipo'])
    						echo "selected = 'selected'";
    					echo ">{$row['tipo']}</option>";
    				}
    				echo "</select>";
    				?>
    			</div>
    		</div>
    		<div class="field">
    			<div class="control">
    				<p>Deseja que sua manifestação seja sigilosa?</p>
    				<p>(Optar pelo sigilo garante que seus dados somente serão acessiveis pela Ouvidoria e pelo órgão responsável.)</p>
    				<div class="checkbox">
    					 <input type="checkbox" name="sigilo" value="true">Sim<br>
    				</div>
    			</div>
    		</div>
    		<div class="field">
    			<div class="control">
    				<p>Sobre o que deseja falar?</p>
    				<div class="boxAssunto">
    					<label>Assunto</label><input name="assunto" style="width: 594px" type="text" required="required">
    				</div>
    			</div>
    		</div>
    		<div class="field">
    			<div class ="control">
    				<div class="anexo"><label>Anexo</label>
    					<input type="file" name="anexo[]" multiple > 
                        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    				</div>
    			</div>
    		</div>
    		<div class="field">
    			<div class="control">
    				<label>Sua mensagem</label>
    				<div class="boxMensagem">
    					<textarea rows="5" style="width: 50em" id="mensagem" name="mensagem"></textarea>
    				</div>
    			</div>
    		</div>
    		<button type="submit" value="Enviar" name="sent"/>Enviar</button> 
    	</form>
    </div>
</body>
</html>