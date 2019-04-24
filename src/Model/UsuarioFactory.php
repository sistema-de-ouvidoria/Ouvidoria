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

    public function selecionarUsuario($cpf) {
        global $conexao;
        $nome_usuario = null;

        try {
            $query = "SELECT nome from usuario where cpf = '$cpf'";
            $result =mysqli_query($conexao,$query);

            if ($result) {
                $row = mysqli_fetch_array($result);
                $nome_usuario = $row[0];
            } else {
                $result = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
        return $nome_usuario;
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
                . $usuario->getSenha() ."','"
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
}
?>