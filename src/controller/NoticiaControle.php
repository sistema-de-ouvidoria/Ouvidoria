<?php

namespace Ouvidoria\controller;
use Ouvidoria\model\manager\NoticiaManager;
use Ouvidoria\model\manager\ImagemManager;

class NoticiaControle extends AbstractControle
{

    /**
     * NoticiaControle constructor.
     */
    public function __construct()
    {
        $this->noticiaManager = new NoticiaManager();
        $this->imagemManager = new ImagemManager();
        $this->inicializador();
    }

    public function inicializador()
    {
        $f = isset($_GET['function']) ? $_GET['function'] : "default";
        session_start();
        switch ($f) {
            case 'detalharNoticia':
                $this->detalharNoticia();
                break;
            case 'alterarNoticia':
                $this->alterarNoticia();
                break;
            case 'listarNoticias':
                $this->listarNoticias();
                break;
            case 'listarTodasNoticias':
                $this->listarTodasNoticias();
                break;
            case 'criarNoticia':
                $this->cadastrarNoticiaAcao();
                break;
            case 'cadastrarNoticia':
                $this->cadastrarNoticia();
                break;
            case 'verNoticia':
                $this->verNoticia();
                break;
            case 'excluirNoticia':
                $this->excluirNoticia();
                break;
            default:
                $this->inicio();
                break;
        }
        session_write_close();
    }

    public function inicio()
    {
        $noticias = $this->noticiaManager->listaNoticiasTelaInicial();
        require('view/telaInicial.php');
    }

    public function listarNoticias()
    {
        $nvlAcesso = isset($_SESSION['usuario']['id_tipo_usuario']) ? $_SESSION['usuario']['id_tipo_usuario'] : null;

        if (!is_null($nvlAcesso)) {
            $noticias = $this->noticiaManager->listaNoticias();
            require('view/listarNoticias.php');
        }
        else {
            echo 'Você não tem permissão para acessar essa página.';
            exit();
        }
    }

    public function cadastrarNoticia()
    {
        if (isset($_POST['sent'])) {
            $titulo = $_POST['titulo'];
            $subtitulo = $_POST['subtitulo'];
            $descricao = $_POST['editor'];
            if ($descricao) {
                if (isset($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0) {

                    $arquivo_tmp = $_FILES['imagem']['tmp_name'];
                    $nome = $_FILES['imagem']['name'];

                    // Pega a extensão
                    $extensao = pathinfo($nome, PATHINFO_EXTENSION);

                    // Converte a extensão para minúsculo
                    $extensao = strtolower($extensao);

                    // Somente imagens, .jpg;.jpeg;.gif;.png
                    // Aqui eu enfileiro as extensões permitidas e separo por ';'
                    // Isso serve apenas para eu poder pesquisar dentro desta String
                    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                        // Cria um nome único para esta imagem
                        // Evita que duplique as imagens no servidor.
                        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                        $novoNome = uniqid(time()) . '.' . $extensao;

                        // Concatena a pasta com o nome
                        $destino = 'C:/wamp64/www/Ouvidoria/src/arquivos/';

                        // tenta mover o arquivo para o destino

                        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino . $novoNome . "." . $extensao)) {
                            $id_imagem = $this->imagemManager->salvaImagem($novoNome, $destino);
                            try {
                                $this->noticiaManager->salvaNoticia($titulo, $subtitulo, $descricao, $id_imagem);
                                echo "<script type=\"text/javascript\">alert(\"Notícia criada com sucesso!\");</script>";
                                $this->listarNoticias();
                            } catch (Exception $e) {
                                $sucess = false;
                                $msg = $e->getMessage();
                            }
                        }
                        else {
                            echo "<script type=\"text/javascript\">alert(\"Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.\");</script>";
                            require('view/criarNoticia.php');
                        }
                    }
                    else {
                        echo "<script type=\"text/javascript\">alert(\"Você poderá enviar apenas arquivos \'*.jpg;*.jpeg;*.gif;*.png.\");</script>";
                        require('view/criarNoticia.php');
                    }
                }
                else {
                    echo "<script type=\"text/javascript\">alert(\"Você não enviou nenhum arquivo!\");</script>";
                    require('view/criarNoticia.php');
                }
            }
            else {
                $msgDescricao = false;
                require ('view/criarNoticia.php');
            }
        }
        else {
            echo "<script type=\"text/javascript\">alert(\"A notícia não foi salva!\");</script>";
            require ('view/criarNoticia.php');
        }
    }

    public function cadastrarNoticiaAcao()
    {
        require('view/criarNoticia.php');
    }

    public function verNoticia()
    {
        $noticia = $this->noticiaManager->selecionarNoticia($_GET['id']);
        require('view/verNoticia.php');
    }

    public function excluirNoticia()
    {
        $this->noticiaManager->excluirNoticia($_GET['id']);
        $this->listarNoticias();

    }

    public function listarTodasNoticias()
    {
        $noticias = $this->noticiaManager->listaTodasNoticias();
        require('view/verTodasNoticias.php');

    }

    private function detalharNoticia()
    {
        $noticia = $this->noticiaManager->selecionarNoticia($_GET['id']);
        require('view/detalharNoticia.php');
    }

    private function detalharNoticiaErro($id, $msg)
    {
        $noticia = $this->noticiaManager->selecionarNoticia($id);
        $msgDescricao = $msg;
        require('view/detalharNoticia.php');
    }

    public function alterarNoticia()
    {
        if (isset($_POST['sent'])) {
            $titulo = $_POST['titulo'];
            $subtitulo = $_POST['subtitulo'];
            $descricao = $_POST['editor'];
            $id = $_POST['id'];

            if ($descricao) {
                $this->noticiaManager->alterarNoticia($titulo, $subtitulo, $descricao, $id);
                echo "<script type=\"text/javascript\">alert(\"Notícia alterada com sucesso!\");</script>";
                $this->listarNoticias();
            }
            else {
                $msg = false;
                $this->detalharNoticiaErro($id, $msg);
            }
        }
        else {
            echo "<script type=\"text/javascript\">alert(\"A notícia não foi alterada!\");</script>";
            require ('view/criarNoticia.php');
        }

    }
}