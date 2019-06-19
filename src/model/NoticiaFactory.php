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
                return null;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return null;
        }
    }

    public function listarTodasNoticias()
    {
        global $conexao;
        $noticias = array();

        $query = "SELECT titulo, i.nome_imagem, subtitulo, data_publicacao, id_noticia FROM noticia n
        INNER JOIN imagem i ON n.id_imagem = i.id_imagem";

        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $noticias = mysqli_fetch_all($resultado);

                return $noticias;
            } else
                return null;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return null;
        }
    }

    public function excluirNoticia($id)
    {
        global $conexao;

        $query = "DELETE FROM noticia WHERE id_noticia = " . $id .";";

        $resultado = mysqli_query($conexao, $query);

        return $resultado;

    }

    public function selecionarNoticia($id)
    {
        global $conexao;

        $noticia = array();

        $query = "SELECT id_noticia, titulo, subtitulo, descricao, nome_imagem FROM noticia n
        INNER JOIN imagem i ON n.id_imagem = i.id_imagem
        WHERE id_noticia = " . $id .";";

        $resultado = mysqli_query($conexao, $query);

        if ($resultado) {
            $noticia = mysqli_fetch_object($resultado);

            return $noticia;
        } else {
            return null;
        }

    }
    public function listarNoticiasTelaInicial()
    {
        global $conexao;
        $noticias = array();

        $query = "SELECT id_noticia, titulo, subtitulo, nome_imagem FROM noticia n
        INNER JOIN imagem i ON n.id_imagem = i.id_imagem
        ORDER BY n.data_publicacao DESC
        LIMIT 4";

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
        $noticia = $obj;

        try {
            $query = "INSERT INTO noticia (titulo, subtitulo, descricao, id_imagem) VALUES ('"
                . $noticia->getTitulo() . "','"
                . $noticia->getSubtitulo() . "','"
                . $noticia->getDescricao() . "',"
                . $noticia->getIdImagem() . ")";

            if (mysqli_query($conexao, $query)) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function alterarNoticia($titulo, $subtitulo, $descricao, $id)
    {
        global $conexao;

        try {
            $query = "UPDATE noticia SET titulo = '"
                . $titulo . "', subtitulo = '"
                . $subtitulo . "', descricao = '"
                . $descricao . "'WHERE id_noticia = "
                . $id . ";";

            if (mysqli_query($conexao, $query)) {
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