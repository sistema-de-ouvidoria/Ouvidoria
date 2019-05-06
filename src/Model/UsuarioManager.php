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

    public function alteraUsuario(string $cpfAlterado,string $nomeAlterado,string $enderecoAlterado, string $telefoneAlterado,$emailAlterado,$senha1){
        $usuario = new Usuario();
        $usuario->setCpf($cpfAlterado);
        $usuario->setNome($nomeAlterado);
        $usuario->setEndereco($enderecoAlterado);
        $usuario->setTelefone($telefoneAlterado);
        $usuario->setEmail($emailAlterado);
        $usuario->setSenha($senha1);
        return $this->factory->alterarUsuario($usuario);
    }

    public function buscaInfoUsuario(string $cpf){
        return $this->factory->buscaInfoUsuario($cpf);
    }

    public function registrarUsuario($cpfCadastro,$nomeCadastro,$enderecoCadastro,$telefoneCadastro,$emailCadastro,$senha1,$id_tipo_user){
        $usuario = new Usuario($cpfCadastro,$nomeCadastro,$enderecoCadastro,$telefoneCadastro,$emailCadastro,$senha1, $id_tipo_user);
        return $this->factory->cadastrarUsuario($usuario);
    }
    public function verificaSenhaAntiga(string $senha,string $cpf){
        return $this->factory->verificaSenha($senha,$cpf);
    }
}
//update usuario set email='maria@gmail.com', telefone = '999999999', senha = md5(1234) where cpf = '12345678912'