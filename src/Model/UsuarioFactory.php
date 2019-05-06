<?php

include("model/Conexao.php");
require_once("Manifestacao.php");

class UsuarioFactory {


    public function __construct() {

    }


    /**
     * Persiste objetos Contato no banco de dados.
     * @param Contato $obj - Objeto Contato a ser persistido.
     * @return boolean - se conseguiu salvar ou não.
     */

    public function validarUsuario($cpf, $senha) {
        global $conexao;

        try {
            $query = "SELECT cpf, id_tipo_usuario from usuario where cpf = '$cpf' AND senha = '$senha'";
            $resultado =mysqli_query($conexao,$query);

            if ($resultado) {
                $usuario = mysqli_fetch_assoc($resultado);
            } else {
                $resultado = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
        return $usuario;
    }

    public function selecionarUsuario($cpf) {
        global $conexao;
        $nome_usuario = "";
        try {
            $query = "SELECT nome from usuario where cpf = '$cpf'";
            $resultado =mysqli_query($conexao,$query);

            if ($resultado) {
                $usuario = mysqli_fetch_array($resultado);
                $nome_usuario = $usuario[0];
            } else {
                $resultado = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
        return $nome_usuario;
    }

    public function buscaInfoUsuario($cpf){
        global $conexao;
        try {
            $query = "SELECT * from usuario where cpf = '$cpf'";
            $resultado =mysqli_query($conexao,$query);

            if ($resultado) {
                $usuario = mysqli_fetch_object($resultado);
            } else {
                $resultado = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
        return $usuario;
    }

    public function cadastrarUsuario($obj){
        global $conexao;
        $usuario = $obj;
        try{
            $query = "INSERT INTO usuario (cpf,nome,endereco,telefone,email,senha, id_tipo_usuario) VALUES ('"
                . $usuario->getCpf() ."','"
                . $usuario->getNome() ."','"
                . $usuario->getEndereco() ."','"
                . $usuario->getTelefone() ."','"
                . $usuario->getEmail() ."','"
                . md5($usuario->getSenha()) ."','"
                . $usuario->getIdTipoUsuario() ."')";
            if(mysqli_query($conexao,$query)){
                return true;
            }
            else
                return false;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function verificaSenha(string $senha,string $cpf){
        global $conexao;
        
        try{
            $query = "SELECT nome from usuario where cpf = '$cpf' and senha = '$senha'";
            if(mysqli_query($conexao,$query)){
                $resultado = mysqli_query($conexao,$query);
                $usuario = mysqli_fetch_object($resultado);
                return $usuario; 
            }
            else
                return false;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }
    //$query = "UPDATE manifestacao SET id_situacao = 2 WHERE id_manifestacao = " . $id . ";";
    public function alterarUsuario($obj){
        global $conexao;
        $usuario = $obj;
        
        try{
            $query = "UPDATE usuario SET cpf = '".$usuario->getCpf()."',nome = '".$usuario->getNome()."',endereco = '".$usuario->getEndereco()."',telefone = '".$usuario->getTelefone()."',email = '".$usuario->getEmail()."',senha = '".$usuario->getSenha()."' where cpf = '".$usuario->getCpf()."'";
            if(mysqli_query($conexao,$query)){
                return true; 
            }
            else
                return false;
        }catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }
}
?>