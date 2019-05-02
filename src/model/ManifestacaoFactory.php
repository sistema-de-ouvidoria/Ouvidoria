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

    public function listarManifestacoes(){
        global $conexao;
        $manifestacoes = array();

        $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem 
        from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
        INNER JOIN situacao s ON s.id_situacao = m.id_situacao;";
        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $manifestacoes = mysqli_fetch_all($resultado);

                return $manifestacoes;
            }
            else
                return "Nenhum tipo encontrado";

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }
}
