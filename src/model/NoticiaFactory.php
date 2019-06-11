<?php
namespace Ouvidoria\model\factory;

require("Conexao.php");

require_once("Noticia.php");

class NoticiaFactory
{
    public function listarNoticias()
    {
        global $conexao;
        $noticias = array();

        $query = "SELECT * FROM noticia";

        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $noticias = mysqli_fetch_all($resultado);

                return $noticias;
            } else
                return NULL;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

    public function salvarNoticia($obj)
    {
        global $conexao;
        $manifestacao = $obj;

        try {
            $query = "INSERT INTO noticia (titulo, subtitulo, descricao) VALUES ('"
                . $manifestacao->getTitulo() . "','"
                . $manifestacao->getSubtitulo() . "','"
                . $manifestacao->getDescricao() . "')";

            if (mysqli_query($conexao, $query)) {
                mysqli_insert_id($conexao);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

}