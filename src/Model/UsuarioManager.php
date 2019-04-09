<?php
require_once("model/Usuario.php");
require_once("model/UsuarioFactory.php");
class Usuariomanager
{

    public function __construct() {

        $this->factory = new UsuarioFactory();
    }

    public function buscaUsuario(string $cpf){

        return $this->factory->selectUsuario($cpf);


    }
}