<?php
namespace Ouvidoria\model\manager;
require("model/Historico.php");
require("model/HistoricoFactory.php");
use Ouvidoria\model\Historico;
use Ouvidoria\model\factory\HistoricoFactory;

class HistoricoManager
{
    private $factory;

    public function __construct()
    {

        $this->factory = new HistoricoFactory();
    }

    public function salvaHistoricoManifestacao(string $orgao_publico, string $ouvidor, string $manifestacao)
    {
        $historico = new Historico($orgao_publico, $ouvidor, $manifestacao);

        return $this->factory->salvarHistoricoManifestacao($historico);

    }

    public function atualizaHistorico(string $adm_publico, string $id)
    {
        return $this->factory->atualizarHistorico($adm_publico, $id);
    }

    public function atualizaHistoricoRecusa(string $adm_publico, string $id, string $data, string $motivo)
    {
        return $this->factory->atualizarHistoricoRecusa($adm_publico, $id, $data, $motivo);
    }
}