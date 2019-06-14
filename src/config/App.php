<?php
namespace Ouvidoria;

use Ouvidoria\controller\UsuarioControle;
use Ouvidoria\controller\ManifestacaoControle;
use Ouvidoria\controller\NoticiaControle;
use Ouvidoria\model\manager\NoticiaManager;

class App {
    const USUARIO = 'UsuarioControle';
    const MANIFESTACAO = 'ManifestacaoControle';
    const NOTICIA = 'NoticiaControle';

    public function __construct (){
        $this->noticiaManager = new NoticiaManager();
        $this->handleRequest ();
    }

    private function handleRequest (){
        $section = isset($_GET['section']) ? $_GET['section'] : 'default';
        switch ($section){
            case self::USUARIO:
                new UsuarioControle();
                break;
            case self:: MANIFESTACAO:
                new ManifestacaoControle();
                break;
            case self:: NOTICIA:
                new NoticiaControle();
                break;
            default:
                session_start();
                $noticias = $this->noticiaManager->listaNoticiasTelaInicial();
                require('view/telaInicial.php');
                break;
        }
    }
}