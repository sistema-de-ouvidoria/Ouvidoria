<?php
require_once("model/Usuario.php");
require_once("model/UsuarioFactory.php");
class UsuarioManager
{

    public function __construct() {

        $this->factory = new UsuarioFactory();
    }

    public function validaUsuario(string $cpf, string $senha){

        return $this->factory->validarUsuario($cpf, $senha);


    }

    public function buscaUsuario(string $cpf){

        return $this->factory->selecionarUsuario($cpf);


    }

    public function registrarUsuario($cpfCadastro,$nomeCadastro,$enderecoCadastro,$telefoneCadastro,$emailCadastro,$senha1,$id_tipo_user){
        $usuario = new Usuario($cpfCadastro,$nomeCadastro,$enderecoCadastro,$telefoneCadastro,$emailCadastro,$senha1, $id_tipo_user);
        return $this->factory->cadastrarUsuario($usuario);
    }
}