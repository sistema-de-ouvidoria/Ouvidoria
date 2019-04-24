<?php
include('model/ManifestacaoManager.php');
include('model/AnexoManager.php');
include('model/TipoManager.php');
include ('model/UsuarioManager.php');
 class Controle {

    private $manager;

    public function __construct() {

        $this->manifestacaoManager = new ManifestacaoManager();
        $this->anexoManager = new Anexomanager();
        $this->tipoManager = new TipoManager();
        $this->usuarioManager = new UsuarioManager();
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
            default:
                $this->inicio();
                break;
        }
    }

    public function inicio() {
        //$listaTipos = $this->tipoManager->listaTipos();
        require('view/cadastrarUsuario.php');
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

            require('view/cadastrarUsuario.php');
        }
    }

     public function comparaSenhas($senha1,$senha2){
         if($senha1 == $senha2)
             return true;
         else
             return false;
     }

    public function fazerLogin() {
        $_SESSION = $_POST;

        $login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
        $senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;


        if(!$login || !$senha){
           echo 'teste';
        }
    }

    public function criarManifestacao()
    {
        if (isset($_POST['sent'])) {

            $tipo = $_POST['tipo'];
            $sigilo = isset($_POST['sigilo']) ? true : false;
            $assunto = $_POST['assunto'];
            $mensagem = $_POST['mensagem'];
            $dataManifestacao = date('Y/m/d');
            $cpf_usuario = '12345678910';
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
                    //echo "<script type=\"text/javascript\">alert(\"Sua manifestação foi criada com sucesso!\");window.location.href=\"index.php\";</script>";
                    $nome_usuario = $this->usuarioManager->buscaUsuario($cpf_usuario);
                    $protocolo_manifestacao = $idGerado; 
                    require('view/manifestacaoCriada.php');
                }
                
            } catch (Exception $e) {
                $sucess = false;
                $msg = $e->getMessage();
            }
            //header("location: index.php");
        }
        else {
            echo "<script type=\"text/javascript\">alert(\"O arquivo excede o tamanho máximo de upload do site!\");window.location.href=\"index.php\";</script>";
        }
    }
}