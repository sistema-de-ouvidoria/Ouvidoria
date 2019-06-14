<?php
namespace Ouvidoria\controller;

require('model/Email.php');
require('model/ManifestacaoManager.php');
require('model/AnexoManager.php');
require('model/TipoManifestacaoManager.php');
require('model/UsuarioManager.php');
require('model/OrgaoPublicoManager.php');
require('model/HistoricoManager.php');
require('model/TipoUsuarioManager.php');
require('model/NoticiaManager.php');
require('model/ImagemManager.php');

abstract class AbstractControle
{

    public function __construct(){}

    abstract public function inicializador ();

}