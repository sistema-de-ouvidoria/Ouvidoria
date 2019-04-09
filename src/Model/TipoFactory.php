<?php

include("model/Connection.php");
require_once("TipoManifestacao.php");
require_once("AbstractFactory.php");

class TipoFactory extends AbstractFactory {


    public function __construct() {

        parent::__construct();
    }


    /**
    * Persiste objetos Contato no banco de dados.
    * @param Contato $obj - Objeto Contato a ser persistido.
    * @return boolean - se conseguiu salvar ou não.
    */

    public function salvar($obj) {
    }
    public function selectAllTipos(){
        global $connection;
        $tipos = array();
        $query = "SELECT id_tipo_manifestacao,nome_tipo_manifestacao from tipomanifestacao";
        try{
            $resultado = mysqli_query($connection,$query);
            if(mysqli_num_rows($resultado) > 0){
                $i = 0;
                while($row = mysqli_fetch_array($resultado)){
                    $tipos[$i] = $row['id_tipo_manifestacao'];
                    $tipos[$i+1] = $row['nome_tipo_manifestacao'];
                    $i = $i + 2;

                }
                return $tipos;
            }
            else
                return "Nenhum tipo encontrado";

        }catch (PDOException $exc) {
                echo $exc->getMessage();
                $result = false;
            }
    }
}
?>