<?php
namespace Ouvidoria\model\manager;
require_once("model/TipoUsuarioFactory.php");

use Ouvidoria\model\factory\TipoUsuarioFactory;


class TipoUsuarioManager
{
    public function __construct()
    {
        $this->factory = new TipoUsuarioFactory();
    }

    public function listaTipos()
    {
        return $this->factory->listarTipoUsuario();
    }
}