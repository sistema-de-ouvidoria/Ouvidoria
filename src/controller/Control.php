<?php
include('model/ManifestacaoManager.php');
 class Control {

    private $manager;

    public function __construct() {

        $this->manager = new ManifestacaoManager();
    }

    public function init() {

        if (isset($_GET['function'])) {
            $f = $_GET['function'];
        } else {
            $f = "default";
        }

        switch ($f) {
            case 'criarManifestacao':
                $this->criarManifestacao();
                break;
            default:
                $this->home();
                break;
        }
    }

        public function home() {
        	require('view/criarManifestacao.php');
    	}

        public function criarManifestacao(){
            if (isset($_POST['sent'])){

                $tipo = $_POST['tipo'];
                $sigilo = isset($_POST['sigilo']) ? true : false;
                $assunto = $_POST['assunto'];
                $mensagem = $_POST['mensagem'];
                $dataManifestacao = date('Y/d/m');
                var_dump($_FILES['anexo']);

                if(isset($_FILES['anexo'])){
                    $total_arquivos = count($_FILES['anexo']['name']);
                    $total_tamanho = $_FILES['anexo']['size'];

                        for($i = 0; $i < $total_arquivos; $i++) {
    
                        if(isset($_FILES['anexo']['name'][$i]) && $_FILES['anexo']['size'][$i] > 0) {
                            $extensao = explode('.', $_FILES['anexo']['name'][$i]);
                            $extensao = strtolower(end($extensao));
                            $novo_nome = "anexo-".date('Y-d-m');
                            $nome_real = $_FILES['anexo']['name'];
                            $diretorio = "C:\wamp64\www\Ouvidoria\arquivos\\";
                        }
                        var_dump(move_uploaded_file($_FILES['anexo']['tmp_name'][$i],$diretorio.$novo_nome.".".$extensao));

                    }
                }

                try{
                    $msg = $this->manager->salvaManifestacao($tipo,$assunto,$mensagem,$sigilo,$dataManifestacao);
                    $sucess = false;
                }catch(Exception $e){
                    $sucess = true;
                    $msg = $e->getMessage();
                }
                require_once('index.php');
            }
        }
}