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

        try {
            $query = "INSERT INTO manifestacao (id_tipo_manifestacao, cidadao_cpf, assunto, mensagem, sigilo, id_situacao, id_anexo, data_manifestacao) VALUES ('"
                . $manifestacao->getId_tipo_manifestacao() . "','"
                . $manifestacao->getCidadao_cpf() . "','"
                . $manifestacao->getAssunto() . "','"
                . $manifestacao->getMensagem() . "','"
                . (int)$manifestacao->getSigilo()."','"
                . $manifestacao->getId_situacao()."','"
                . $manifestacao->getIdAnexo()."','"
                . $manifestacao->getDataManifestacao()."')";

                if (mysqli_query($connection,$query)) {
                    $idGerado = mysqli_insert_id($connection);
                    $result = true;
                } else {
                    $result = false;
                }
            } catch (PDOException $exc) {
                echo $exc->getMessage();
                $result = false;
            }
    }
}
?>