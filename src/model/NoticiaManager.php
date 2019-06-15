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

    public function listaNoticiasTelaInicial()
    {
        return $this->factory->listarNoticiasTelaInicial();
    }

    public function salvaNoticia($titulo, $subtitulo, $descricao, $id_imagem)
    {
        $noticia = new Noticia($titulo, $subtitulo, $descricao, $id_imagem);

        return $this->factory->salvarNoticia($noticia);
    }

    public function selecionarNoticia($id)
    {
        return $this->factory->selecionarNoticia($id);
    }

}