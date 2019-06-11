<?php


namespace Ouvidoria\controller;
use Ouvidoria\model\manager\NoticiaManager;

class NoticiaControle extends AbstractControle
{

    /**
     * NoticiaControle constructor.
     */
    public function __construct()
    {
        $this->noticiaManager = new NoticiaManager();
        $this->inicializador();
    }

    public function inicializador()
    {
        $f = isset($_GET['function']) ? $_GET['function'] : "default";
        session_start();
        switch ($f) {
            case 'listarNoticias':
                $this->listarNoticias();
                break;
            case 'criarNoticia':
                $this->criarNoticia();
                break;
            case 'cadastrarNoticia':
                $this->cadastrarNoticia();
                break;
            default:
                $this->inicio();
                break;
        }
        session_write_close();
    }

    public function inicio()
    {
        require('view/telaInicial.php');
    }

    public function listarNoticias()
    {
        $noticias = $this->noticiaManager->listaNoticias();
        require('view/listarNoticias.php');
    }

    public function cadastrarNoticia()
    {
        if (isset($_POST['sent'])) {
            $titulo = $_POST['titulo'];
            $subtitulo = $_POST['subtitulo'];
            $descricao = $_POST['editor'];

            try {
                $this->noticiaManager->salvaNoticia($titulo, $subtitulo, $descricao);
                require('view/criarNoticia.php');
            } catch (Exception $e) {
                $sucess = false;
                $msg = $e->getMessage();
            }
        }
        else {
            echo "<script type=\"text/javascript\">alert(\"A notícia não foi salva!\");window.location.href=\"view/criarNoticia.php\";</script>";
        }
    }

    public function criarNoticia()
    {
        require('view/criarNoticia.php');
    }
}