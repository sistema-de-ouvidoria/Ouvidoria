<?php

class Anexo{
    protected $nome_anexo;
    //protected $id_manifestacao;
    protected $caminho;
    protected $nome_real;

    function __construct($nome_real,$caminho,$nome_anexo) {
        $this->nome_real = $nome_real;
        $this->caminho = $caminho;
        $this->nome_anexo = $nome_anexo;
    }

    public function getNomeReal(){
        return $this->nome_real;
    }

    public function setNomeReal($nome_real){
        $this->nome_real = $nome_real;
    }

    public function getNomeAnexo(){
        return $this->nome_anexo;
    }

    public function setNomeAnexo($nome_anexo){
        $this->nome_anexo = $nome_anexo;
    }

    public function getCaminho(){
        return $this->caminho;
    }

    public function setCaminho($caminho){
        $this->caminho = $caminho;
    }
}
?>