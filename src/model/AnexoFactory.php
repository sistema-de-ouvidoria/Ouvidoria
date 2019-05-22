<?php
namespace Ouvidoria\model\factory;

include("model/Conexao.php");
require_once("Anexo.php");

class AnexoFactory
{
    public function __construct()
    {

    }

    public function salvar($obj)
    {
        global $conexao;
        $anexo = $obj;

        try {
            $query = "INSERT INTO anexo (id_anexo, caminho,nome_anexo) VALUES ('"
                . $anexo->getIdAnexo() . "', '"
                . $anexo->getCaminho() . "','"
                . $anexo->getNomeAnexo() . "')";

            if (mysqli_query($conexao, $query)) {
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