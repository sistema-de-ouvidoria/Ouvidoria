<?php

require_once("model/Anexo.php");
require_once("model/AnexoFactory.php");
class AnexoManager
{
    public function __construct() {

        $this->factory = new AnexoFactory();
    }

    public function salvaAnexo(string $nome_anexo,string $caminho,string $nome_real){
        $anexo = new Anexo($nome_real,$caminho, $nome_anexo);

        $this->factory->salvar($anexo);
    }
}