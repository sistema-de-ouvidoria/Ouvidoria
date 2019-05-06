<?php
if(isset($_SESSION['usuario']['id_tipo_usuario'])){
    $nivelAcesso = $_SESSION['usuario']['id_tipo_usuario'];
}
else
    $nivelAcesso = 0;
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-dark navbar-expand-lg bg-dark" >

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="?function=">Página Inicial</a></li>
            <?php if($nivelAcesso > 0){?><li class="nav-item"><a class="nav-link" href="?function=minhaPaginaAcao">Minha Página</a></li> <?php } ?>
            <?php if($nivelAcesso == 0){?><li class="nav-item"><a class="nav-link" href="?function=cadastrarUsuarioAcao">Cadastrar</a></li> <?php }?>
            <?php if($nivelAcesso > 1){?><li class="nav-item"><a class="nav-link" href="?function=listar">Listar manifestações</a></li> <?php }?>
            <?php if($nivelAcesso > 0){?><li class="nav-item"><a class="nav-link" href="?function=alterarDados">Alterar dados</a></li> <?php }?>
            <li class="nav-item"><a class="nav-link" href="?function=sobreAcao">Sobre</a></li>
        </ul>
    </div>

    <div id="botao-login">
        <?php if($nivelAcesso == 0 && !isset($verificacao)){?><a href="?function=loginAcao" class="btn btn-outline-success btn-lg active" role="button" aria-pressed="true">Login</a> <?php }?>
        
    </div>
    <div id="botao-deslogar">    
        <?php if($nivelAcesso > 0){?> <a class="btn btn-outline-danger" href="?function=deslogar"><i class="fa fa-sign-out" aria-hidden="true"></i></a> <?php }?>
    </div>
</nav>
