<?php
namespace Ouvidoria\model;

class Situacao{
    protected $id_situacao;
    protected $nome_situacao;

    function __construct()
    {

    }

    public function getId_situacao()
    {
        return $this->id_situacao;
    }

    public function setId_situacao($id_situacao)
    {
        $this->id_situacao = $id_situacao;
    }

    public function getNome_situacao()
    {
        return $this->nome_situacao;
    }

    public function setNome_situacao($nome_situacao)
    {
        $this->nome_situacao = $nome_situacao;
    }
}

?>