<?php
namespace Ouvidoria\model\manager;
require ('model/NoticiaFactory.php');
use Ouvidoria\model\factory\NoticiaFactory;
use Ouvidoria\model\Noticia;

class NoticiaManager
{
    private $factory;

    public function __construct()
    {
        $this->factory = new NoticiaFactory();
    }

    public function listaNoticias()
    {
        return $this->factory->listarNoticias();
    }

    public function salvaNoticia($titulo, $subtitulo, $descricao)
    {
        $noticia = new Noticia($titulo, $subtitulo, $descricao);

        return $this->factory->salvarNoticia($noticia);
    }

}