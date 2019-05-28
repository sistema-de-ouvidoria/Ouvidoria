<?php
namespace Ouvidoria\model\factory;

include("model/Conexao.php");
require_once("TipoManifestacao.php");

class TipoManifestacaoFactory
{

    public function listarTipoManifestacao()
    {
        global $conexao;
        $tipos = array();
        $query = "SELECT id_tipo_manifestacao,nome_tipo_manifestacao from tipomanifestacao";
        try {
            $resultado = mysqli_query($conexao, $query);
            if (mysqli_num_rows($resultado) > 0) {
                $i = 0;
                while ($linha = mysqli_fetch_array($resultado)) {
                    $tipos[$i] = $linha['id_tipo_manifestacao'];
                    $tipos[$i + 1] = $linha['nome_tipo_manifestacao'];
                    $i = $i + 2;

                }
                return $tipos;
            } else
                return "Nenhum tipo encontrado";

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }
}

?>