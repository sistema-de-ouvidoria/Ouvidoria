<?php

class HistoricoFactory {

    public function salvarHistoricoManifestacao($obj) {
        global $conexao;
        $historico = $obj;

        try {
            $query = "INSERT INTO historico (manifestacao, ouvidor, orgao_publico) VALUES ('"
                . $historico->getIdManifestacao() . "','"
                . $historico->getCpfOuvidor() . "','"
                . $historico->getIdOrgaoPublico()."')";

            if (mysqli_query($conexao,$query)) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function atualizarHistorico($adm_publico, $protocolo) {
        global $conexao;

        $query = "UPDATE historico SET adm_publico = '". $adm_publico ."' WHERE manifestacao = " . $protocolo . ";";

        if(mysqli_query($conexao, $query))
            return true;
        else
            return false;
    }
}