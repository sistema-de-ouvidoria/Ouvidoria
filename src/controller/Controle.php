<?php
include('model/ManifestacaoManager.php');
include('model/AnexoManager.php');
include('model/TipoManager.php');
include('model/UsuarioManager.php');
include('model/OrgaoPublicoManager.php');
include('model/HistoricoManager.php');

 class Controle {

    public function __construct() {
        $this->manifestacaoManager = new ManifestacaoManager();
        $this->anexoManager = new Anexomanager();
        $this->tipoManager = new TipoManager();
        $this->usuarioManager = new UsuarioManager();
        $this->orgaoManager = new OrgaoPublicoManager();
        $this->historicoManager = new HistoricoManager();
        $this->inicializador();

    }

    public function inicializador() {

        if (isset($_GET['function'])) {
            $f = $_GET['function'];
        } else {
            $f = "default";
        }

        switch ($f) {
            case 'fazerLogin':
                $this->fazerLogin();
                break;
            case 'criarManifestacao':
                $this->criarManifestacao();
                break;
            case 'cadastrarUsuario':
                $this->cadastrarUsuario();
                break;
            case 'cadastrarUsuarioAcao':
                $this->cadastrarUsuarioAcao();
                break;
            case 'loginAcao':
                $this->loginAcao();
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
            case 'listar':
                session_start();
                $this->listar($_SESSION['usuario']['id_tipo_usuario']);
                session_write_close();
                break;
            case 'deslogar':
                session_start();
                session_destroy();
                $_SESSION['usuario'] = null;
                $this->inicio();
                break;
            case 'recusarManifestacao':
                session_start();
                $this->recusarManifestacao();
                break;
            case 'alteraDadosAcao':
                session_start();
                $this->alteraDadosAcao();
                break;
            case 'alterarDados':
                session_start();
                $this->alterarDados();
                break;
            default:
                $this->inicio();
                break;
        }
    }

    public function alteraDadosAcao(){  
        $usuario = $this->usuarioManager->buscaInfoUsuario($_SESSION['usuario']['cpf']);
        require('view/alterarDados.php');
    }

    public function inicio() {
        require('view/fazerLogin.php');
    }

     public function cadastrarUsuarioAcao() {
         require('view/cadastrarUsuario.php');
     }

     public function loginAcao() {
        require('view/fazerLogin.php');
     }

    public function cadastrarUsuario() {
        if (isset($_POST['enviado'])){
            $nomeCadastro = $_POST['nomeCadastro'];
            $cpfCadastro = $_POST['cpfCadastro'];
            $enderecoCadastro = $_POST['enderecoCadastro'];
            $telefoneCadastro = $_POST['telefoneCadastro'];
            $emailCadastro = $_POST['emailCadastro'];
            $senha1 = $_POST['senhaCadastro'];
            $senha2 = $_POST['senhaConfirmacaoCadastro'];
            $senhaValidada = $this->comparaSenhas($senha1,$senha2);
            $tipo_usuario = 1;

            if($senhaValidada){
                try{
                    $this->usuarioManager->registrarUsuario($cpfCadastro,$nomeCadastro,$enderecoCadastro,$telefoneCadastro,$emailCadastro,$senha1,$tipo_usuario);
                    include 'view/cadastrarUsuario.php';
                }catch(Exception $e){
                    $msg = $e->getMessage();
                }
            }
            else{
                $msgErrosenhaIgual = false;
            }

            header('Location: view/cadastrarUsuario.php');
        }
    }

    public function alterarDados(){
        if (isset($_POST['enviado'])){
            $senhaAntigaConfirmacao =md5($_POST['senhaAntigaAlteraDados']);
            $cpfAlterado = $_POST['cpfAlteraDados'];
            if($this->usuarioManager->verificaSenhaAntiga($senhaAntigaConfirmacao,$cpfAlterado)){
                $nomeAlterado = $_POST['nomeAlteraDados'];
                $enderecoAlterado = $_POST['enderecoAlteraDados'];
                $telefoneAlterado = $_POST['telefoneAlteraDados'];
                $emailAlterado = $_POST['emailAlteraDados'];
                $senha1 = $_POST['senhaNovaAlteraDados'];
                $senha2 = $_POST['senhaNovaConfirmacaoAlteraDados'];

                if(isset($senha1) && isset($senha2) && $this->comparaSenhas($senha1,$senha2)){
                    try{
                        if($senha1 == "")
                            $senha1 = $senhaAntigaConfirmacao;
                        else
                            $senha1 = md5($senha1);
                        $sucesso = $this->usuarioManager->alteraUsuario($cpfAlterado,$nomeAlterado,$enderecoAlterado,$telefoneAlterado,$emailAlterado,$senha1);
                        echo "sucesso";
                        $this->alteraDadosAcao(); 
                    }catch(Exception $e){
                        $msg = $e->getMessage();
                    }
                }
            }
                else{
                    echo "senha errada";
                    $this->alteraDadosAcao();
                }

            header('Location: view/alterarDados.php');
            }   
        }

     public function comparaSenhas($senha1,$senha2){
         if($senha1 == $senha2)
             return true;
         else
             return false;
     }

    public function fazerLogin() {
        $cpf = isset($_POST["cpf"]) ? addslashes(trim($_POST["cpf"])) : FALSE;
        $senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

        if(!$cpf || !$senha){
            //tratar erros
           echo 'Você não tem permissão para acessar essa página.';
        } else {
            $usuario = $this->usuarioManager->validaUsuario($cpf, $senha);

            session_start();
            $_SESSION['usuario'] = $usuario;

            // Usuario Cidadao
            if ($_SESSION['usuario']['id_tipo_usuario'] == 1) {
                $listaTipos = $this->tipoManager->listaTipos();
                require('view/criarManifestacao.php');

            }
            // Usuario Ouvidor
            else if ($_SESSION['usuario']['id_tipo_usuario'] == 2) {
                $this->listar($_SESSION['usuario']['id_tipo_usuario']);
            }
            // Usuario Administrador Publico
            else if ($_SESSION['usuario']['id_tipo_usuario'] == 3)
                $this->listar($_SESSION['usuario']['id_tipo_usuario']);

            //Usuario Administrador Sistema
            else if ($_SESSION['usuario']['id_tipo_usuario'] == 4)
                header('Location: view/homeAdminSist.php');

            else {
                $msgLogin = false;
                require('view/fazerLogin.php');
            }
            session_write_close();
        }
    }

    public function listar($acesso){
        $nvlAcesso = $acesso;
        $dados = $this->manifestacaoManager->listaManifestacoes($acesso);

        if($nvlAcesso == 2)
            require('view/listarManifestacaoOuvidor.php');
        elseif ($nvlAcesso == 3)
            require('view/listarManifestacaoAdmPublico.php');

    }

    public function encaminhar() {
        session_start();
        $id = $_GET['id'];
        $id_orgao_publico = $_GET['org'];
        $ouvidor = $_SESSION['usuario']['cpf'];

        if($this->manifestacaoManager->alteraManifestacaoOuvidor($id)) {
            $this->historicoManager->salvaHistoricoManifestacao($id_orgao_publico, $ouvidor, $id);
        }
        $this->listar($_SESSION['usuario']['id_tipo_usuario']);
     }

    public function detalharManifestacaoOuvidor() {
        $manifestacao = $this->manifestacaoManager->selecionaManifestacao($_GET['id']);
        $orgaos = $this->orgaoManager->listaOrgaosPublico();
        require ('view/detalheManifestacaoOuvidor.php');
    }

    public function detalharManifestacaoAdmPublico() {
         $manifestacao = $this->manifestacaoManager->selecionaManifestacao($_GET['id']);
         require ('view/detalheManifestacaoAdmPublico.php');
     }

    public function criarManifestacao()
    {
        session_start();
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

                if(move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho . $idAnexo . "." . $extensao)) {
                    $this->anexoManager->salvaAnexo($idAnexo, $caminho, $nome_anexo);
                }
            }

            try {
                $idGerado = $this->manifestacaoManager->salvaManifestacao($tipo, $assunto, $mensagem, $sigilo, $dataManifestacao, $cpf_usuario, $situacao, $idAnexo);
                if($idGerado != null){
                    $nome_usuario = $this->usuarioManager->buscaUsuario($cpf_usuario);
                    $protocolo_manifestacao = $idGerado; 
                    require('view/manifestacaoCriada.php');
                }
                
            } catch (Exception $e) {
                $sucess = false;
                $msg = $e->getMessage();
            }
        }
        else {
            echo "<script type=\"text/javascript\">alert(\"O arquivo excede o tamanho máximo de upload do site!\");window.location.href=\"index.php\";</script>";
        }
    }

    public function responderManifestacao() {
         session_start();
         $id = $_POST['protocolo'];
         $adm_publico = $_SESSION['usuario']['cpf'];
         $resposta = $_POST['resposta'];


        if($this->manifestacaoManager->alteraManifestacaoAdmPublico($id, $resposta)) {
            $this->historicoManager->atualizaHistorico($adm_publico,$id);
        }

         $this->listar($_SESSION['usuario']['id_tipo_usuario']);
    }

    public function recusarManifestacao(){
        $id = $_GET['id'];
        $this->manifestacaoManager->recusaManifestacao($id);
        $this->listar($_SESSION['usuario']['id_tipo_usuario']);
    }
}