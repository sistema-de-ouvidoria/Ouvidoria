<?php
namespace Ouvidoria\model\manager;
require_once("model/TipoFactory.php");
use Ouvidoria\model\factory\TipoFactory;

class TipoManager
{

    public function __construct()
    {

        $this->factory = new TipoFactory();
    }

    public function listaTipos()
    {

        return $this->factory->listarTipoManifestacao();

    }
}