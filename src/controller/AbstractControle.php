<?php
namespace Ouvidoria\controller;

require('model/ManifestacaoManager.php');
require('model/AnexoManager.php');
require('model/TipoManifestacaoManager.php');
require('model/UsuarioManager.php');
require('model/OrgaoPublicoManager.php');
require('model/HistoricoManager.php');
require('model/TipoUsuarioManager.php');

abstract class AbstractControle
{

    public function __construct(){}

    abstract public function inicializador ();

}