<?php

require_once("model/TipoManifestacao.php");
require_once("model/TipoFactory.php");
class TipoManager
{

    public function __construct() {

        $this->factory = new TipoFactory();
    }

    public function listaTipos(){

        return $this->factory->selecionarTodosOsTipos();

    }
}