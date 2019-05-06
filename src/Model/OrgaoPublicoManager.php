<?php
require('Conexao.php');
require_once("model/OrgaoPublico.php");
require_once("model/OrgaoPublicoFactory.php");


class OrgaoPublicoManager
{

    private $factory;

    public function __construct() {

        $this->factory = new OrgaoPublicoFactory();
    }

    public function listaOrgaosPublico(){
        return $this->factory->listarOrgaosPublico();
    }

}