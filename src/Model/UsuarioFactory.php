<?php

include("model/Connection.php");
require_once("Manifestacao.php");
require_once("AbstractFactory.php");

class UsuarioFactory extends AbstractFactory {


    public function __construct() {

        parent::__construct();
    }


    /**
    * Persiste objetos Contato no banco de dados.
    * @param Contato $obj - Objeto Contato a ser persistido.
    * @return boolean - se conseguiu salvar ou não.
    */

    public function selectUsuario($cpf) {
    global $connection;
    $nome_usuario = null;

        try {
            $query = "SELECT nome from usuario where cpf = '$cpf'";
            $result =mysqli_query($connection,$query);

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

    public function salvar($obj){

    }
}
?>