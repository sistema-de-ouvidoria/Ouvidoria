<?php

include("model/Conexao.php");
require_once("Manifestacao.php");

class ManifestacaoFactory  {


    public function __construct() {

    }


    /**
    * Persiste objetos Contato no banco de dados.
    * @param Contato $obj - Objeto Contato a ser persistido.
    * @return boolean - se conseguiu salvar ou não.
    */

    public function salvarManifestacao($obj) {
    global $conexao;
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

                if (mysqli_query($conexao,$query)) {
                    $idGerado = mysqli_insert_id($conexao);
                    //$resultado = true;
                } else {
                    $resultado = false;
                }
            } catch (PDOException $exc) {
                echo $exc->getMessage();
                $resultado = false;
            }
            return $idGerado;
    }
}
?>