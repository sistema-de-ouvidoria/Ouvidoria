<?php
namespace Ouvidoria\model\factory;

include("model/Conexao.php");
require_once("Imagem.php");

class ImagemFactory
{
    public function salvar($obj)
    {
        global $conexao;
        $img = $obj;

        try {
            $query = "INSERT INTO imagem (nome_imagem, caminho_imagem) VALUES ('"
                . $img->getNomeImagem() . "', '"
                . $img->getCaminhoImagem() . "')";

            if (mysqli_query($conexao, $query)) {
                $idGerado = mysqli_insert_id($conexao);
            } else {
                $idGerado = null;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        return $idGerado;
    }
}