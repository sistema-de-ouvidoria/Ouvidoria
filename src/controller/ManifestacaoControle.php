<?php
namespace Ouvidoria\controller;

use Ouvidoria\model\manager\AnexoManager;
use Ouvidoria\model\manager\HistoricoManager;
use Ouvidoria\model\manager\ManifestacaoManager;
use Ouvidoria\model\manager\OrgaoPublicoManager;
use Ouvidoria\model\manager\TipoManifestacaoManager;
use Ouvidoria\model\manager\UsuarioManager;

class ManifestacaoControle extends AbstractControle
{
    public function __construct()
    {
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
            case 'encaminhar':
                $this->encaminhar();
                break;
            case 'responder':
                $this->responderManifestacao();
                break;
            case 'detalharManifestacaoCidadao':
                $this->detalharManifestacaoCidadao();
                break;
            case 'listar':
                $this->listar($_SESSION['usuario']['id_tipo_usuario']);
                break;
            case 'recusarManifestacao':
                $this->recusarManifestacao();
                break;
            case 'criarManifestacaoAcao':
                $this->criarManifestacaoAcao();
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
            default:
                $userControl = new UsuarioControle();
                $userControl->inicio();
                break;
        }
        session_write_close();
    }

    public function removerInteresse(){
        $idUsuario = $_SESSION['usuario']['cpf'];
        $idManifestacao = $_GET['idManifestacao'];
        $resultado = $this->manifestacaoManager->removerInteresse($idManifestacao,$idUsuario);
        $checaInteresse = 0;
        $this->acompanharManifestacaoAcao();
    }

    public function manifestarInteresse(){
        $idUsuario = $_SESSION['usuario']['cpf'];
        $idManifestacao = $_GET['idManifestacao'];
        $result = $this->manifestacaoManager->manifestarInteresse($idManifestacao,$idUsuario);
    }

    public function acompanharManifestacaoAcao(){
		$this->listarAcompanharManifestacao();
	}

    public function listarAcompanharManifestacao()
    {
        $nvlAcesso = 1;
        if (!is_null($nvlAcesso)) {
            $dados = $this->manifestacaoManager->listaManifestacoes($nvlAcesso);
            require ('view/listarManifestacoes.php');
        }
    }

    public function criarManifestacaoAcao()
    {
        $listaTipos = $this->tipoManager->listaTipos();
        require('view/criarManifestacao.php');
    }

    public function listar()
    {
        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $dados = $this->manifestacaoManager->listaManifestacoes($nvlAcesso);
            require ('view/listarManifestacoes.php');
        } else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }
    }

    public function encaminhar()
    {
        if ($_GET['org'] == "") {
            $this->listar();
        } else {
            $id = $_GET['id'];
            $id_orgao_publico = $_GET['org'];
            $ouvidor = $_SESSION['usuario']['cpf'];

            if ($this->manifestacaoManager->alteraManifestacaoOuvidor($id)) {
                $this->historicoManager->salvaHistoricoManifestacao($id_orgao_publico, $ouvidor, $id);
            }
            $this->listar();
        }
    }

    public function detalharManifestacaoOuvidor()
    {
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoOuvidor($_GET['id']);
        $orgaos = $this->orgaoManager->listaOrgaosPublico();
        require('view/detalheManifestacaoOuvidor.php');
    }

    public function detalharManifestacaoAdmPublico()
    {
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoAdmPublico($_GET['id']);
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
                    $this->anexoManager->salvaAnexo($idAnexo, $caminho, $nome_anexo);
                }
            }

            try {
                $idGerado = $this->manifestacaoManager->salvaManifestacao($tipo, $assunto, $mensagem, $sigilo, $dataManifestacao, $cpf_usuario, $situacao, $idAnexo);
                if ($idGerado != null) {
                    $nome_usuario = $this->usuarioManager->buscaUsuario($cpf_usuario);
                    $protocolo_manifestacao = $idGerado;
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


        if ($this->manifestacaoManager->alteraManifestacaoAdmPublico($id, $resposta)) {
            $this->historicoManager->atualizaHistorico($adm_publico, $id);
        }

        $this->listar();
    }

    public function recusarManifestacao()
    {
        $id = $_GET['id'];
        $adm_publico = $_SESSION['usuario']['cpf'];
        $data = date('Y/m/d');
        $motivo = "Recusado";

        $this->manifestacaoManager->recusaManifestacao($id);
        $this->historicoManager->atualizaHistoricoRecusa($adm_publico, $id, $data, $motivo);
        $this->listar();
    }

    public function detalharManifestacaoCidadao()
    {
		$checaInteresse = 0;
		$idUsuario = $_SESSION['usuario']['cpf'];
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoCidadao($_GET['id']);
		$idManifestacao = $manifestacao->id_manifestacao;
		if($this->manifestacaoManager->checaInteresse($idManifestacao,$idUsuario)){
			$checaInteresse = 1;
		}
        $manifestacao = $this->manifestacaoManager->selecionaManifestacaoCidadao($_GET['id']);
        require('view/detalheManifestacaoCidadao.php');
    }

}