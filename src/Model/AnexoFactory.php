<?php

include("model/Connection.php");
require_once("Anexo.php");
require_once("AbstractFactory.php");
class AnexoFactory extends AbstractFactory
{
    public function __construct() {

        parent::__construct();
    }

    public function salvar($obj) {
        global $connection;
        $anexo = $obj;

        try {
            $query = "INSERT INTO anexo (id_anexo, id_manifestacao, caminho,nome_anexo) VALUES ('"
                . $anexo->getIdAnexo() . "', '"
                . $anexo->getIdManifestacao() . "','"
                . $anexo->getCaminho()."','"
                . $anexo->getNomeAnexo()."')";

                var_dump($query);

            if (mysqli_query($connection,$query)) {
                $result = true;
            } else {
                $result = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
        return $result;
    }

}