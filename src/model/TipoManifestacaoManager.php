<?php
namespace Ouvidoria\model\manager;
require_once("model/TipoManifestacaoFactory.php");
use Ouvidoria\model\factory\TipoManifestacaoFactory;

class TipoManifestacaoManager
{

    public function __construct()
    {

        $this->factory = new TipoManifestacaoFactory();
    }

    public function listaTipos()
    {

        return $this->factory->listarTipoManifestacao();

    }
}