<?php
namespace Ouvidoria\model\factory;

include("model/Conexao.php");
require_once("Manifestacao.php");

class UsuarioFactory
{


    public function __construct()
    {

    }


    /**
     * Persiste objetos Contato no banco de dados.
     * @param Contato $obj - Objeto Contato a ser persistido.
     * @return boolean - se conseguiu salvar ou não.
     */

    public function validarUsuario($cpf, $senha)
    {
        global $conexao;

        try {
            $query = "SELECT cpf, id_tipo_usuario, nome from usuario where cpf = '$cpf' AND senha = '$senha'";
            $resultado = mysqli_query($conexao, $query);

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

    public function selecionarUsuario($cpf)
    {
        global $conexao;
        $nome_usuario = "";
        try {
            $query = "SELECT nome from usuario where cpf = '$cpf'";
            $resultado = mysqli_query($conexao, $query);

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

    public function buscaInfoUsuario($cpf)
    {
        global $conexao;
        try {
            $query = "SELECT * from usuario where cpf = '$cpf'";
            $resultado = mysqli_query($conexao, $query);

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

    public function buscaInfoUsuarioDetalhe($cpf)
    {
        global $conexao;
        try {
            $query = "SELECT u.*, nome_tipo_usuario from usuario u
            INNER JOIN tipousuario t ON u.id_tipo_usuario = t.id_tipo_usuario
            where cpf = '$cpf'";
            $resultado = mysqli_query($conexao, $query);

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

    public function cadastrarUsuario($obj)
    {
        global $conexao;
        $usuario = $obj;
        try {
            $query = "INSERT INTO usuario (cpf,nome,endereco,telefone,email,senha, id_tipo_usuario) VALUES ('"
                . $usuario->getCpf() . "','"
                . $usuario->getNome() . "','"
                . $usuario->getEndereco() . "','"
                . $usuario->getTelefone() . "','"
                . $usuario->getEmail() . "','"
                . $usuario->getSenha() . "','"
                . $usuario->getIdTipoUsuario() . "')";
            if (mysqli_query($conexao, $query)) {
                return true;
            } else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function verificaSenha(string $senha, string $cpf)
    {
        global $conexao;

        try {
            $query = "SELECT nome from usuario where cpf = '$cpf' and senha = '$senha'";
            if (mysqli_query($conexao, $query)) {
                $resultado = mysqli_query($conexao, $query);
                $usuario = mysqli_fetch_object($resultado);
                return $usuario;
            } else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function alterarUsuario($obj)
    {
        global $conexao;
        $usuario = $obj;

        try {
            if ($usuario->getEmail() != null) {
                $query = "UPDATE usuario SET cpf = '" . $usuario->getCpf() . "',nome = '" . $usuario->getNome() . "',endereco = '" . $usuario->getEndereco() . "',telefone = '" . $usuario->getTelefone() . "',email = '" . $usuario->getEmail() . "',senha = '" . $usuario->getSenha() . "' where cpf = '" . $usuario->getCpf() . "'";
            } else {
                $query = "UPDATE usuario SET cpf = '" . $usuario->getCpf() . "',nome = '" . $usuario->getNome() . "',endereco = '" . $usuario->getEndereco() . "',telefone = '" . $usuario->getTelefone() . "',senha = '" . $usuario->getSenha() . "' where cpf = '" . $usuario->getCpf() . "'";
            }
            if (mysqli_query($conexao, $query)) {
                return true;
            } else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function alterarDados($obj)
    {
        global $conexao;
        $usuario = $obj;

        try {
            $query = "UPDATE usuario SET nome = '" . $usuario->getNome() . "',endereco = '" . $usuario->getEndereco() . "',telefone = '" . $usuario->getTelefone() . "',email = '" . $usuario->getEmail() . "' where cpf = '" . $usuario->getCpf() . "'";

            if (mysqli_query($conexao, $query)) {
                return true;
            } else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function selecionarEmail(string $cpf)
    {
        global $conexao;
        try {
            $query = "SELECT email from usuario where cpf = '$cpf'";
            if (mysqli_query($conexao, $query)) {
                $resultado = mysqli_query($conexao, $query);
                $resultado = mysqli_fetch_assoc($resultado);
                return $resultado;
            } else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function checaEmailBD(string $email)
    {
        global $conexao;
        try {
            $query = "SELECT cpf from usuario where email = '$email'";
            if (mysqli_query($conexao, $query))
                $resultado = mysqli_query($conexao, $query);
            $resultado = mysqli_fetch_assoc($resultado);
            if ($resultado == null)
                return true;
            else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function checaCPFBD(string $cpf)
    {
        global $conexao;
        try {
            $query = "SELECT nome from usuario where cpf = '$cpf'";
            if (mysqli_query($conexao, $query))
                $resultado = mysqli_query($conexao, $query);
            $resultado = mysqli_fetch_assoc($resultado);
            if ($resultado != null)
                return true;
            else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function listarUsuarios()
    {
        global $conexao;
        $usuarios = array();

        $query = "SELECT cpf, nome, email, telefone, t.nome_tipo_usuario, endereco
            from usuario u INNER JOIN tipousuario t ON u.id_tipo_usuario = t.id_tipo_usuario";

        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $manifestacoes = mysqli_fetch_all($resultado);

                return $manifestacoes;
            } else
                return NULL;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

    public function delegarPrivilegios(String $cpf, string $id)
    {
        global $conexao;

        $query = "UPDATE usuario SET id_tipo_usuario = '" . $id . "' WHERE cpf = " . $cpf . ";";

        if (mysqli_query($conexao, $query))
            return true;
        else
            return false;
    }

    public function alteraSenha(String $cpf, String $senha){
        global $conexao;

        $query = "UPDATE usuario SET senha = '".$senha."' where cpf = ".$cpf." ;";   
        if(mysqli_query($conexao,$query)){
            return true;
        }else
            return false;
    }

    public function desativaUsuario(String $cpf){
        global $conexao;

        $query = "UPDATE usuario set id_tipo_usuario = 5 where cpf = ".$cpf.";";
        if(mysqli_query($conexao,$query)){
            return true;
        }else
            return false;
        }
    }
