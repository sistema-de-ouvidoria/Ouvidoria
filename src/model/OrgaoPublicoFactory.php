<?php
namespace Ouvidoria\model\factory;

class OrgaoPublicoFactory
{
    public function listarOrgaosPublico()
    {
        global $conexao;
        $orgaos = array();
        $query = "SELECT id_orgao_publico, nome_orgao_publico, sigla_orgao_publico from orgaopublico";
        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $orgaos = mysqli_fetch_all($resultado);

                return $orgaos;
            } else
                return "Nenhum tipo encontrado";

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

}