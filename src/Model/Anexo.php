<?php

class Anexo{
    protected $id_anexo;
    protected $id_manifestacao;
    protected $caminho;
    protected $nome_anexo;

    function __construct(string $id_anexo,int $id_manifestacao,string $caminho,string $nome_anexo) {
        $this->id_anexo = $id_anexo;
        $this->id_manifestacao = $id_manifestacao;
        $this->caminho = $caminho;
        $this->nome_anexo = $nome_anexo;
    }

    public function getNomeAnexo(){
        return $this->nome_anexo;
    }

    public function setNomeAnexo(string $nome_anexo){
        $this->nome_anexo = $nome_anexo;
    }

    public function getIdAnexo(){
        return $this->id_anexo;
    }

    public function setIdAnexo(string $id_anexo){
        $this->id_anexo = $id_anexo;
    }

    public function getCaminho(){
        return $this->caminho;
    }

    public function setCaminho($caminho){
        $this->caminho = $caminho;
    }
    public function getIdManifestacao(){
        return $this->id_manifestacao;
    }
    public function setIdManifestacao(string $id_manifestacao){
        $this->id_manifestacao = $id_manifestacao;
    }
}
?>