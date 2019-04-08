<?php

require_once("model/Anexo.php");
require_once("model/AnexoFactory.php");
class AnexoManager
{

    public function __construct() {

        $this->factory = new AnexoFactory();
    }

    public function salvaAnexo(string $id_anexo,int $id_gerado,string $caminho,string $nome_anexo){
        $anexo = new Anexo($id_anexo,$id_gerado, $caminho,$nome_anexo);

        return $this->factory->salvar($anexo);

    }
}