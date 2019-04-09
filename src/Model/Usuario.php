<?php

class Usuario{
    protected $cpf;
    protected $id_tipo_usuario;
    protected $nome;
    protected $endereco;
    protected $telefone;
    protected $email;
    protected $senha;

    function __construct($cpf,$id_tipo_usuario,$nome,$endereco,$telefone,$email,$senha) {
        $this->cpf = $cpf;
        $this->id_tipo_usuario = $id_tipo_usuario;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
    }

    //Setters e Getters da classe Manifestacao
    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getId_tipo_usuario(){
        return $this->id_tipo_usuario;
    }

    public function setId_tipo_usuario(Tipousuario $tipoUsuario){
        $this->id_tipo_usuario = $tipoUsuario->getId_tipo_usuario();
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }
}
?>