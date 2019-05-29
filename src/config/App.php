<?php
namespace Ouvidoria;

use Ouvidoria\controller\UsuarioControle;
use Ouvidoria\controller\ManifestacaoControle;

class App {
    const USUARIO = 'UsuarioControle';
    const MANIFESTACAO = 'ManifestacaoControle';

    public function __construct (){
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
            default:
                session_start();
                require('view/telaInicial.php');
                break;
        }
    }
}