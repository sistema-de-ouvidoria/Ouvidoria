<?php
if (isset($_SESSION['usuario']['id_tipo_usuario'])) {
    $nivelAcesso = $_SESSION['usuario']['id_tipo_usuario'];
} else
    $nivelAcesso = 0;
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-dark navbar-expand-lg bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <?php if ($nivelAcesso > 0 && $nivelAcesso < 5) { ?>
                <li class="nav-item"><a class="nav-link" href="?section=UsuarioControle&function=inicial">Página Inicial</a>
                </li> <?php } else { ?>
                <li class="nav-item"><a class="nav-link" href="?section=UsuarioControle&function=">Página Inicial</a></li>
            <?php } ?>
            <?php if ($nivelAcesso > 0 && $nivelAcesso < 5) { ?>
                <li class="nav-item"><a class="nav-link" href="?section=ManifestacaoControle&function=criarManifestacaoAcao">Criar Manifestação</a>
                </li> <?php } ?>
            <?php if ($nivelAcesso > 0) { ?>
                <li class="nav-item"><a class="nav-link" href="?section=ManifestacaoControle&function=acompanharManifestacaoAcao">Acompanhar manifestação</a>
                </li> <?php } ?>
            <?php if ($nivelAcesso == 0 || $nivelAcesso == 5) { ?>
                <li class="nav-item"><a class="nav-link" href="?section=UsuarioControle&function=cadastrarUsuarioAcao">Cadastrar</a>
                </li> <?php } ?>
            <?php if ($nivelAcesso > 1 && $nivelAcesso < 5) { ?>
                <li class="nav-item"><a class="nav-link" href="?section=ManifestacaoControle&function=listar">Listar manifestações</a>
                </li> <?php } ?>
            <?php if ($nivelAcesso == 4) { ?>
                <li class="nav-item"><a class="nav-link" href="?section=UsuarioControle&function=listarUsuarios">Listar Usuários</a>
                </li> <?php } ?>
        </ul>
    </div>

    <div id="botao-login">
        <?php if (($nivelAcesso == 0 || $nivelAcesso == 5) && !isset($verificacao)) { ?><a href="index.php?section=UsuarioControle&function=loginAcao"
                                                                    class="btn btn-outline-success btn-lg active"
                                                                    role="button"
                                                                    aria-pressed="true">Login</a> <?php } ?>

    </div>
    <div class="btn-group">
        <?php if ($nivelAcesso > 0 && $nivelAcesso < 5) { ?>
            <button id="usuario" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['usuario']['nome']; ?></button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="index.php?section=UsuarioControle&function=alteraDadosAcao">Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?section=UsuarioControle&function=deslogar">Sair</a>
            </div>
        <?php } ?>
    </div>

</nav>
