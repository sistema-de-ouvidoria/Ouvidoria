<?php
namespace Ouvidoria\model;

class Historico
{

    protected $id_historico;
    protected $id_manifestacao;
    protected $id_orgao_publico;
    protected $cpf_ouvidor;
    protected $cpf_adm_publico;

    function __construct(string $orgao_publico, string $ouvidor, string $manifestacao)
    {
        $this->id_orgao_publico = $orgao_publico;
        $this->id_manifestacao = $manifestacao;
        $this->cpf_ouvidor = $ouvidor;
    }

    /**
     * @return mixed
     */
    public function getIdOrgaoPublico()
    {
        return $this->id_orgao_publico;
    }

    /**
     * @param mixed $id_orgao_publico
     */
    public function setIdOrgaoPublico($id_orgao_publico): void
    {
        $this->id_orgao_publico = $id_orgao_publico;
    }

    /**
     * @return mixed
     */
    public function getCpfOuvidor()
    {
        return $this->cpf_ouvidor;
    }

    /**
     * @param mixed $cpf_ouvidor
     */
    public function setCpfOuvidor($cpf_ouvidor): void
    {
        $this->cpf_ouvidor = $cpf_ouvidor;
    }

    /**
     * @return mixed
     */
    public function getCpfAdmPublico()
    {
        return $this->cpf_adm_publico;
    }

    /**
     * @param mixed $cpf_adm_publico
     */
    public function setCpfAdmPublico($cpf_adm_publico): void
    {
        $this->cpf_adm_publico = $cpf_adm_publico;
    }

    public function getIdHistorico()
    {
        return $this->id_historico;
    }

    public function setIdHituacao($id_historico)
    {
        $this->$id_historico = $id_historico;
    }

    public function getIdManifestacao()
    {
        return $this->id_manifestacao;
    }

    public function setIdManifestacao($id_manifestacao)
    {
        $this->id_manifestacao = $id_manifestacao;
    }
}
