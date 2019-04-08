<?php

include("model/Connection.php");
require_once("Manifestacao.php");
require_once("AbstractFactory.php");

class ManifestacaoFactory extends AbstractFactory {


    public function __construct() {

        parent::__construct();
    }


    /**
    * Persiste objetos Contato no banco de dados.
    * @param Contato $obj - Objeto Contato a ser persistido.
    * @return boolean - se conseguiu salvar ou não.
    */

    public function salvar($obj) {
    global $connection;
    $manifestacao = $obj;
    $IDUsuario = 0;

        try {
            $query = "INSERT INTO manifestacao (id_tipo_manifestacao,id_cidadao,assunto,mensagem,sigilo,data_manifestacao) VALUES ('"
                . $manifestacao->getId_tipo_manifestacao() . "','"
                . $IDUsuario . "','"
                . $manifestacao->getAssunto() . "','"
                . $manifestacao->getMensagem() . "','"
                . (int)$manifestacao->getSigilo()."','"
                . $manifestacao->getDataManifestacao()."')";

                if (mysqli_query($connection,$query)) {
                    $idGerado = mysqli_insert_id($connection);
                    $result = true;
                } else {
                    echo "deu ruim";
                    $result = false;
                }
            } catch (PDOException $exc) {
                echo $exc->getMessage();
                $result = false;
            }
            if($result){
                return $idGerado;
            }
                else
                    return false;
    }

}
?>