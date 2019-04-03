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
            $query = "INSERT INTO manifestacao (Tipo, Assunto, Mensagem, Sigilo,IDUsuario,DataManifestacao) VALUES ('"
                . $manifestacao->getTipo() . "', '"
                . $manifestacao->getAssunto() . "','"
                . $manifestacao->getMensagem()."','"
                . $manifestacao->getSigilo()."',$IDUsuario,'"
                . $manifestacao->getDataManifestacao()."')";
                var_dump($query);
                $teste = mysqli_query($connection,$query);
                var_dump($teste);
                if (mysqli_query($connection,$query)) {
                    $result = true;
                } else {
                    $result = false;
                }
            } catch (PDOException $exc) {
                echo $exc->getMessage();
                $result = false;
            }

            return $result;
    }

}

?>