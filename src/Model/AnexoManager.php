<?php

require_once("model/Anexo.php");
require_once("model/AnexoFactory.php");

class AnexoManager
{

    public function __construct()
    {

        $this->factory = new AnexoFactory();
    }

    public function salvaAnexo(string $id_anexo, string $caminho, string $nome_anexo)
    {
        $anexo = new Anexo($id_anexo, $caminho, $nome_anexo);

        return $this->factory->salvar($anexo);

    }
}