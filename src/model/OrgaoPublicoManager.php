<?php
namespace Ouvidoria\model\manager;
require_once("model/OrgaoPublicoFactory.php");

use Ouvidoria\model\factory\OrgaoPublicoFactory;

class OrgaoPublicoManager
{

    private $factory;

    public function __construct()
    {

        $this->factory = new OrgaoPublicoFactory();
    }

    public function listaOrgaosPublico()
    {
        return $this->factory->listarOrgaosPublico();
    }

}