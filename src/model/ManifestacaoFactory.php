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

    public function listarManifestacoes(string $acesso){
        global $conexao;
        $manifestacoes = array();

        if($acesso == 2) {
            $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem 
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao 
            WHERE s.id_situacao = 1;";
        }
        elseif ($acesso == 3) {
            $query = "SELECT id_manifestacao, assunto, data_manifestacao, nome_tipo_manifestacao, nome_situacao, mensagem 
            from manifestacao m INNER JOIN tipomanifestacao t ON m.id_tipo_manifestacao = t.id_tipo_manifestacao
            INNER JOIN situacao s ON s.id_situacao = m.id_situacao 
            WHERE s.id_situacao = 2;";
        }

        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $manifestacoes = mysqli_fetch_all($resultado);

                return $manifestacoes;
            }
            else
                return NULL;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

    public function selecionarManifestacao(string $id){
        global $conexao;

        $manifestacao = array();

        $query = "SELECT id_manifestacao, data_manifestacao, assunto, nome, nome_situacao, mensagem 
        from manifestacao m INNER JOIN usuario u ON  m.cidadao_cpf = u.cpf
        INNER JOIN situacao s ON s.id_situacao = m.id_situacao
        WHERE id_manifestacao = " . $id . ";";

        $resultado = mysqli_query($conexao, $query);

        if($resultado){
            $manifestacao = mysqli_fetch_object($resultado);

            return $manifestacao;
        }
        else {
            return "Nenhum tipo encontrado";
        }
    }

    public function alterarManifestacaoOuvidor($id) {
        global $conexao;

        $query = "UPDATE manifestacao m SET id_situacao = 2 WHERE id_manifestacao = " . $id . ";";

        if(mysqli_query($conexao, $query))
            return true;
        else
            return false;
    }

    public function alterarManifestacaoAdmPublico($id, $resposta) {
        global $conexao;

        $query = "UPDATE manifestacao SET resposta = '". $resposta ."', id_situacao= 3 WHERE id_manifestacao = " . $id . ";";

        if(mysqli_query($conexao, $query))
            return true;
        else
            return false;
    }

    public function recusaManifestacao($id){
        global $conexao;
        $query = "UPDATE manifestacao SET id_situacao = '1' where id_manifestacao = ".$id.";";

        if(mysqli_query($conexao,$query))
            return true;
        else
            return false;
    }
}
