<?php
namespace Ouvidoria\controller;

require('model/ManifestacaoManager.php');
require('model/AnexoManager.php');
require('model/TipoManager.php');
require('model/UsuarioManager.php');
require('model/OrgaoPublicoManager.php');
require('model/HistoricoManager.php');



abstract class AbstractControle
{

    public function __construct()
    {
    }

    abstract public function inicializador ();

}