<?php
namespace Ouvidoria\model;

class Tipousuario
{

    protected $id_tipo_usuario;
    protected $nome_tipo_usuario;

    function __construct($id_tipo_usuario, $nome_tipo_usuario)
    {
        $this->id_tipo_usuario = $id_tipo_usuario;
        $this->nome_tipo_usuario = $nome_tipo_usuario;
    }

    public function getId_tipo_usuario()
    {
        return $this->id_tipo_usuario;
    }

    public function setId_tipo_manifestacao($id_tipo_usuario)
    {
        $this->id_tipo_usuario = $id_tipo_usuario;
    }

    public function getNome_tipo_manifestacao()
    {
        return $this->nome_tipo_usuario;
    }

    public function setNome_tipo_usuario($nome_tipo_usuario)
    {
        $this->nome_tipo_usuario = $nome_tipo_usuario;
    }

}

?>
