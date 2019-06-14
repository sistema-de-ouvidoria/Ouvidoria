<?php
namespace Ouvidoria\model\manager;
require_once("model/Imagem.php");
require_once("model/ImagemFactory.php");
use Ouvidoria\model\factory\ImagemFactory;
use Ouvidoria\model\Imagem;

class ImagemManager
{

    public function __construct()
    {

        $this->factory = new ImagemFactory();
    }

    public function salvaImagem(string $nome, string $caminho)
    {
        $imagem = new Imagem($nome, $caminho);

        return $this->factory->salvar($imagem);
    }
}