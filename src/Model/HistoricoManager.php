<?php
require('Conexao.php');
require_once("model/Historico.php");
require_once("model/HistoricoFactory.php");

class HistoricoManager
{
    private $factory;

    public function __construct() {

        $this->factory = new HistoricoFactory();
    }

    public function salvaHistoricoManifestacao(string $orgao_publico,string $ouvidor,string $manifestacao){
        $historico = new Historico($orgao_publico, $ouvidor, $manifestacao);

        return $this->factory->salvarHistoricoManifestacao($historico);

    }

    public function atualizaHistorico(string $adm_publico, string $id){
        return $this->factory->atualizarHistorico($adm_publico, $id);
    }

}