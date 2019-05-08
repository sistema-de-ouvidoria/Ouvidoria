<?php

class TipoManifestacao
{
    protected $id_tipo_manifestacao;
    protected $nome_tipo_manifestacao;

    function __construct($id_tipo_manifestacao, $nome_tipo_manifestacao)
    {
        $this->id_tipo_manifestacao = $id_tipo_manifestacao;
        $this->nome_tipo_manifestacao = $nome_tipo_manifestacao;
    }

    public function getId_tipo_manifestacao()
    {
        return $this->id_tipo_manifestacao;
    }

    public function setId_tipo_manifestacao($id_tipo_manifestacao)
    {
        $this->id_tipo_manifestacao = $id_tipo_manifestacao;
    }

    public function getNome_tipo_manifestacao()
    {
        return $this->nome_tipo_manifestacao;
    }

    public function setNome_tipo_manifestacao($nome_tipo_manifestacao)
    {
        $this->nome_tipo_manifestacao = $nome_tipo_manifestacao;
    }
}

?>