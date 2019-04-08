<?php
include('model/ManifestacaoManager.php');
include('model/AnexoManager.php');
 class Control {

    private $manager;

    public function __construct() {

        $this->manifestacaoManager = new ManifestacaoManager();
        $this->anexoManager = new anexomanager();
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
            echo "teste";
            if (isset($_POST['sent'])){

                $tipo = $_POST['tipo'];
                var_dump($tipo);
                $sigilo = isset($_POST['sigilo']) ? true : false;
                $assunto = $_POST['assunto'];
                $mensagem = $_POST['mensagem'];
                $dataManifestacao = date('Y/d/m');
                var_dump($_FILES['anexo']);

                if(isset($_FILES['anexo'])){
                    $total_arquivos = count($_FILES['anexo']['name']);
                    var_dump($total_arquivos);
                    $total_tamanho = $_FILES['anexo']['size'];
                    $anexos = array();
                    $j = 0;

                        for($i = 0; $i < $total_arquivos; $i++) {
    
                            if(isset($_FILES['anexo']['name'][$i]) && $_FILES['anexo']['size'][$i] > 0) {
                                $extensao = explode('.', $_FILES['anexo']['name'][$i]);
                                $extensao = strtolower(end($extensao));

                                $idAnexo = "anexo-".date('d-m-Y h_i_s');
                                $nome_anexo = $_FILES['anexo']['name'][$i];
                                $caminho = "C:\wamp64\www\Ouvidoria\src\arquivos\\";
                                
                                //Vetor criado para pegar as informações do arquivo para mandar para o método que salva o arquivo e mandar para a classe de anexo    
                                $anexos[$j] = $idAnexo;
                                $anexos[$j+1] = $caminho;
                                $anexos[$j+2] = $nome_anexo;
                                $anexos[$j+3] = $extensao;
                                var_dump($anexos);
                                
                                
                            }
                            var_dump($anexos);
                            var_dump($_FILES['anexo']['tmp_name'][$i],$anexos[$j+1].$anexos[$j].".".$anexos[$j+3]);
                            var_dump($_FILES['anexo']['tmp_name'][$i],"C:\wamp64\www\Ouvidoria\src\arquivos\\teaste.jpg");
                            echo $anexos[$j+1]."<p>";
                            echo $anexos[$j]."<p>";
                            echo $anexos[$j+3];
                       
                            var_dump(move_uploaded_file($_FILES['anexo']['tmp_name'][$i],"C:\wamp64\www\Ouvidoria\src\arquivos\\anexo-08-04-2019 06_16_26.jpg"));
                            var_dump(move_uploaded_file($_FILES['anexo']['tmp_name'][$i],$anexos[$j+1].$anexos[$j].".".$anexos[$j+3]));
                            $j = $j + 3;
                    }
                }

                try{
                    $msg = $this->manifestacaoManager->salvaManifestacao($tipo,$assunto,$mensagem,$sigilo,$dataManifestacao);
                    if($msg != false){
                        $id_gerado = $msg;
                        try{
                            for($i = 0, $j = 0; $i < $total_arquivos; $i++ , $j = $j + 3){
                                echo $id_gerado;
                                var_dump($anexos);
                                var_dump($this->anexoManager->salvaAnexo($anexos[$j],$id_gerado,$anexos[$j+1],$anexos[$j+2]));
                                move_uploaded_file($_FILES['anexo']['tmp_name'][$i],$anexos[$j+1].$anexos[$j].".".$anexos[$j+3]);
                            }
                            
                        }catch(Exception $e){
                            $sucessoAnexo = false;
                            $msg = $e->getMessage();
                        }


                    }
                    
                }catch(Exception $e){
                    $sucess = false;
                    $msg = $e->getMessage();
                }
                require_once('index.php');
            }
        }
}