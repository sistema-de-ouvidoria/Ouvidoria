<?php

namespace Ouvidoria\controller;

use Ouvidoria\model\manager\AnexoManager;
use Ouvidoria\model\manager\HistoricoManager;
use Ouvidoria\model\manager\ManifestacaoManager;
use Ouvidoria\model\manager\OrgaoPublicoManager;
use Ouvidoria\model\manager\TipoManifestacaoManager;
use Ouvidoria\model\manager\UsuarioManager;
use Ouvidoria\model\Email;

class ManifestacaoControle extends AbstractControle
{
    public function __construct()
    {
        $this->email = new Email();
        $this->manifestacaoManager = new ManifestacaoManager();
        $this->anexoManager = new Anexomanager();
        $this->tipoManager = new TipoManifestacaoManager();
        $this->usuarioManager = new UsuarioManager();
        $this->orgaoManager = new OrgaoPublicoManager();
        $this->historicoManager = new HistoricoManager();
        $this->inicializador();
    }

    public function inicializador()
    {
        $f = isset($_GET['function']) ? $_GET['function'] : "default";

        session_start();
        switch ($f) {
            case 'criarManifestacao':
                $this->criarManifestacao();
                break;
            case 'detalharManifestacaoOuvidor':
                $this->detalharManifestacaoOuvidor();
                break;
            case 'detalharManifestacaoAdmPublico':
                $this->detalharManifestacaoAdmPublico();
                break;
            case 'detalharManifestacaoEscolha':
                $this->detalharManifestacaoEscolha();
                break;
            case 'detalharManifestacaoCidadao':
                $this->detalharManifestacaoCidadao();
                break;
            case 'encaminhar':
                $this->encaminhar();
                break;
            case 'responder':
                $this->responderManifestacao();
                break;
            case 'listar':
                $this->listar();
                break;
            case 'recusarManifestacao':
                $this->recusarManifestacao();
                break;
            case 'criarManifestacaoAcao':
                $this->criarManifestacaoAcao();
                break;
            case 'minhasManifestacoes':
                $this->listarMinhasManifestacoes();
                break;
            case 'acompanharManifestacaoAcao':
                $this->acompanharManifestacaoAcao();
                break;
            case 'manifestarInteresse':
                $this->manifestarInteresse();
                break;
            case 'removerInteresse':
                $this->removerInteresse();
                break;
            case 'clicouLinkVerManifestacaoEmail':
                $this->clicouLinkVerManifestacaoEmail();
                break;
            default:
                break;
        }
        session_write_close();
    }

    public function removerInteresse()
    {
        $idUsuario = $_SESSION['usuario']['cpf'];
        $idManifestacao = $_GET['idManifestacao'];
        $resultado = $this->manifestacaoManager->removerInteresse($idManifestacao, $idUsuario);
        $id = $idManifestacao;
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoCidadao($idManifestacao);
        $checaInteresse = 0;
        $idUsuario = $_SESSION['usuario']['cpf'];

        $idManifestacao = $manifestacao->id_manifestacao;
        if ($this->manifestacaoManager->checaInteresse($idManifestacao, $idUsuario)) {
            $checaInteresse = 1;
        }
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoCidadao($idManifestacao);
        require('view/detalheManifestacaoCidadao.php');
    }

    public function clicouLinkVerManifestacaoEmail()
    {
        $id = $_GET['id'];
        require('view/fazerLogin.php');
    }

    public function listarMinhasManifestacoes()
    {
        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $dados = $this->manifestacaoManager->listaMinhasManifestacoes($_SESSION['usuario']['cpf']);
            require('view/listarMinhasManifestacoes.php');
        } else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }
    }

    public function manifestarInteresse()
    {
        $idUsuario = $_SESSION['usuario']['cpf'];
        $idManifestacao = $_GET['idManifestacao'];
        $result = $this->manifestacaoManager->manifestarInteresse($idManifestacao, $idUsuario);
        $id = $idManifestacao;
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoCidadao($idManifestacao);
        $checaInteresse = 0;
        $idUsuario = $_SESSION['usuario']['cpf'];

        $idManifestacao = $manifestacao->id_manifestacao;
        if ($this->manifestacaoManager->checaInteresse($idManifestacao, $idUsuario)) {
            $checaInteresse = 1;
        }
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoCidadao($idManifestacao);
        require('view/detalheManifestacaoCidadao.php');
    }

    public function acompanharManifestacaoAcao()
    {
        $this->listarAcompanharManifestacao();
    }

    public function listarAcompanharManifestacao()
    {

        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $dados = $this->manifestacaoManager->listaAcompanharManifestacao();
            require('view/acompanharManifestacaoLista.php');
        } else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }

    }

    public function criarManifestacaoAcao()
    {
        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $listaTipos = $this->tipoManager->listaTipos();
            require('view/criarManifestacao.php');
        } else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }


    }

    public function listar()
    {
        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $dados = $this->manifestacaoManager->listaManifestacoes($nvlAcesso);
            require('view/listarManifestacoes.php');
        } else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }
    }

    public function encaminhar()
    {
        if ($_GET['org'] == null) {
            $this->detalharManifestacaoOuvidorComErro();
        } else {
            $id = $_GET['id'];
            $id_orgao_publico = $_GET['org'];
            $ouvidor = $_SESSION['usuario']['cpf'];
            if ($this->manifestacaoManager->alteraManifestacaoOuvidor($id)) {
                $this->historicoManager->salvaHistoricoManifestacao($id_orgao_publico, $ouvidor, $id);
                $this->enviaEmailDoEncaminhar($id, $ouvidor, $id_orgao_publico);
            }
            echo "<script type=\"text/javascript\">alert(\"Manifestação encaminhada com sucesso.\");</script>";
            $this->listar();
        }
    }

    public function detalharManifestacaoOuvidorComErro()
    {
        $erroComboBox = false;
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoOuvidor($_GET['id']);
        $orgaos = $this->orgaoManager->listaOrgaosPublico();
        require('view/detalheManifestacaoOuvidor.php');
    }

    public function detalharManifestacaoOuvidor()
    {
        $erroComboBox = true;
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoOuvidor($_GET['id']);
        $orgaos = $this->orgaoManager->listaOrgaosPublico();
        require('view/detalheManifestacaoOuvidor.php');
    }

    public function detalharManifestacaoAdmPublico()
    {
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoAdmPublico($_GET['id']);
        require('view/detalheManifestacaoAdmPublico.php');
    }

    public function detalharManifestacaoAdmPublicoComErro()
    {
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoAdmPublico($_GET['id']);
        $erroResposta = false;
        require('view/detalheManifestacaoAdmPublico.php');
    }

    public function criarManifestacao()
    {
        if (isset($_POST['sent'])) {
            $tipo = $_POST['tipo'];
            $sigilo = isset($_POST['sigilo']) ? true : false;
            $assunto = $_POST['assunto'];
            $mensagem = $_POST['mensagem'];
            $dataManifestacao = date('Y/m/d');
            $cpf_usuario = $_SESSION['usuario']['cpf'];
            $situacao = 1;
            $idAnexo = "";

            if ($_FILES['anexo']['error'] != UPLOAD_ERR_NO_FILE) {
                $nome_anexo = $_FILES['anexo']['name'];
                $extensao = explode('.', $nome_anexo);
                $extensao = strtolower(end($extensao));
                $idAnexo = "anexo-" . date('d-m-Y_h_i_s');
                $caminho = "C:/wamp64/www/Ouvidoria/src/arquivos/";

                if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho . $idAnexo . "." . $extensao)) {
                    $idAnexo = $idAnexo . "." . $extensao;
                    $this->anexoManager->salvaAnexo($idAnexo, $caminho, $nome_anexo);
                }
            }

            try {
                $idGerado = $this->manifestacaoManager->salvaManifestacao($tipo, $assunto, $mensagem, $sigilo, $dataManifestacao, $cpf_usuario, $situacao, $idAnexo);
                if ($idGerado != null) {
                    $nome_usuario = $this->usuarioManager->buscaUsuario($cpf_usuario);
                    $protocolo_manifestacao = $idGerado;
                    $assunto = "Manifestacação enviada com sucesso";
                    $texto = "Parabéns, sua manifestação foi enviada com sucesso!<br><br>
                Prezado(a) <strong>" . $nome_usuario . "</strong> sua manifestação foi criada e será encaminhada para o órgão responsável que terá <strong>30 dias úteis</strong> para resposta.<br><br>
                Seu <strong>protocolo de atendimento é " . $protocolo_manifestacao . "</strong>
                Para acompanhar sua manifestação, <a href='http://localhost/ouvidoria/src/index.php?section=ManifestacaoControle&function=detalharManifestacaoCidadao&id=$protocolo_manifestacao'>clique aqui</a>";
                    $emailDestino = $this->usuarioManager->selecionarEmail($cpf_usuario);
                    $emailDestino = join(",", $emailDestino);
                    $this->email->enviarEmail($emailDestino, $assunto, $texto);
                    $this->manifestacaoManager->manifestarInteresse($protocolo_manifestacao, $cpf_usuario);
                    echo "<script type=\"text/javascript\">alert(\"Manifestação criada com sucesso.\");</script>";
                    require('view/manifestacaoCriada.php');
                }

            } catch (Exception $e) {
                $sucess = false;
                $msg = $e->getMessage();
            }
        } else {
            echo "<script type=\"text/javascript\">alert(\"O arquivo excede o tamanho máximo de upload do site!\");window.location.href=\"index.php\";</script>";
        }
    }

    public function responderManifestacao()
    {
        $id = $_POST['protocolo'];
        $adm_publico = $_SESSION['usuario']['cpf'];
        $resposta = $_POST['resposta'];

        if(!empty($resposta)) {
            if ($this->manifestacaoManager->alteraManifestacaoAdmPublico($id, $resposta)) {
                $this->historicoManager->atualizaHistorico($adm_publico, $id);
                $this->enviaEmailResponder($id, $adm_publico);
                echo "<script type=\"text/javascript\">alert(\"Manifestação respondida com sucesso.\");</script>";
                $this->listar();
            }
        }
        else{
            $_GET['id'] = $id;
            $this->detalharManifestacaoAdmPublicoComErro();
        }



    }

    public function recusarManifestacao()
    {
        $motivo = $_POST['motivoRejeicao'];
        var_dump($motivo);
        $id = $_POST['idManifestacao'];
        echo $id;
        $adm_publico = $_SESSION['usuario']['cpf'];
        $data = date('Y/m/d');

        $this->manifestacaoManager->recusaManifestacao($adm_publico,$id,$data,$motivo);
        $this->historicoManager->atualizaHistoricoRecusa($adm_publico, $id, $data, $motivo);
        $this->enviaEmailDoRecusar($id, $adm_publico);
        $this->listar();
    }

    public function detalharManifestacaoCidadao()
    {
        $checaInteresse = 0;
        $idUsuario = $_SESSION['usuario']['cpf'];

        if ($this->manifestacaoManager->checaInteresse($_GET['id'], $idUsuario)) {
            $checaInteresse = 1;
        }
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoCidadao($_GET['id']);
        require('view/detalheManifestacaoCidadao.php');
    }

    public function enviaEmailDoEncaminhar(string $idManifestacao, string $cpfOuvidor, string $id_orgao_publico)
    {
        $nomeOuvidor = $this->manifestacaoManager->selecionaOuvidor($cpfOuvidor);
        $listaEmail = $this->manifestacaoManager->selecionaEmailInteressados($idManifestacao);
        $nomeOrgao = $this->manifestacaoManager->selecionaOrgao($id_orgao_publico);
        foreach ($listaEmail as $emails => $email) {
            $assunto = "A manifestação " . $idManifestacao . " foi alterada";
            $texto = "A manifestação <strong>" . $idManifestacao . " </strong>foi encaminhada para o órgão público <strong>" . $nomeOrgao['nome_orgao_publico'] . " </strong> pelo ouvidor <strong>" . $nomeOuvidor['nome'] . "</strong>.
        <br><br>Para acompanhar a manifestação, <a href='http://localhost/ouvidoria/src/index.php?section=ManifestacaoControle&function=clicouLinkVerManifestacaoEmail&id=$idManifestacao'>clique aqui</a>.
        <br><br><br><br><br><br><i>Esta é uma mensagem automática</i>";
            $emailDestino = $email;
            $this->email->enviarEmail($emailDestino, $assunto, $texto);
        }
    }

    public function enviaEmailDoRecusar(string $idManifestacao, string $cpfAdminPublico)
    {
        $nomeAdminPublico = $this->manifestacaoManager->selecionaNomeAdmin($cpfAdminPublico);
        $nomeOrgao = $this->manifestacaoManager->selecionaNomeOrgao($idManifestacao);
        $listaEmail = $this->manifestacaoManager->selecionaEmailInteressados($idManifestacao);
        foreach ($listaEmail as $emails => $email) {
            $assunto = "A manifestação " . $idManifestacao . " foi alterada";
            $texto = "O administrador público <strong>" . $nomeAdminPublico . "</strong> do órgão <strong>" . $nomeOrgao . "</strong> recusou a manifestação <strong>" . $idManifestacao . "</strong>.<br><br>
        <strong>Motivo</strong>:A Manifestação foi encaminhada para o órgão errado.
        <br><br><br>Para acompanhar a manifestação, <a href='http://localhost/ouvidoria/src/index.php?section=ManifestacaoControle&function=clicouLinkVerManifestacaoEmail&id=$idManifestacao'>clique aqui</a>.";
            $emailDestino = $email;

            $this->email->enviarEmail($emailDestino, $assunto, $texto);
        }
    }

    public function enviaEmailResponder(string $idManifestacao, string $cpfAdminPublico)
    {
        $nomeAdminPublico = $this->manifestacaoManager->selecionaNomeAdmin($cpfAdminPublico);
        $listaEmail = $this->manifestacaoManager->selecionaEmailInteressados($idManifestacao);
        $nomeOrgao = $this->manifestacaoManager->selecionaNomeOrgao($idManifestacao);
        foreach ($listaEmail as $emails => $email) {
            $assunto = "A manifestação " . $idManifestacao . " foi alterada";
            $texto = "A manifestação <strong>" . $idManifestacao . " </strong> foi respondida pelo Administrador Público <strong>" . $nomeAdminPublico . " </strong> do órgão público <strong>" . $nomeOrgao . " </strong>.
        <br><br>Para acompanhar a manifestação, <a href='http://localhost/ouvidoria/src/index.php?section=ManifestacaoControle&function=clicouLinkVerManifestacaoEmail&id=$idManifestacao'>clique aqui</a>.";
            $emailDestino = $email;
            $this->email->enviarEmail($emailDestino, $assunto, $texto);
        }
    }

    public function detalharManifestacaoEscolha()
    {
        if($_GET['situacao'] == 'Aberta') {
            $manifestacao = $this->manifestacaoManager->selecionaManifestacaoOuvidor($_GET['id']);
            $orgaos = $this->orgaoManager->listaOrgaosPublico();
            require('view/detalheManifestacaoOuvidor.php');
        }
        elseif($_GET['situacao'] == 'Encaminhada') {
            $manifestacao = $this->manifestacaoManager->selecionaManifestacaoAdmPublico($_GET['id']);
            require('view/detalheManifestacaoAdmPublico.php');
        }
        elseif($_GET['situacao'] == 'Fechada') {
            $manifestacao = $this->manifestacaoManager->selecionaManifestacaoAdmPublico($_GET['id']);
            require('view/detalheManifestacaoAdmSistema.php');
        }
    }
}