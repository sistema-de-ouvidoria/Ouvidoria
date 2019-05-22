<?php
namespace Ouvidoria\model;
class Manifestacao
{
    protected $id_manifestacao;
    protected $id_tipo_manifestacao;
    protected $cidadao_cpf;
    protected $id_situacao;
    protected $assunto;
    protected $mensagem;
    protected $sigilo;
    protected $data_manifestacao;
    protected $data_resposta;
    protected $id_anexo;

    function __construct($tipo, $assunto, $mensagem, $sigilo, $dataManifestacao, $cidadao_cpf, $id_situacao, $id_anexo)
    {
        $this->id_tipo_manifestacao = $tipo;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
        $this->sigilo = $sigilo;
        $this->data_manifestacao = $dataManifestacao;
        $this->cidadao_cpf = $cidadao_cpf;
        $this->id_situacao = $id_situacao;
        $this->id_anexo = $id_anexo;
    }

    //Setters e Getters da classe Manifestacao
    public function getId_manifestacao()
    {
        return $this->id_manifestacao;
    }

    public function setId_manifestacao($id_manifestacao)
    {
        $this->id_manifestacao = $id_manifestacao;
    }

    public function getId_tipo_manifestacao()
    {
        return $this->id_tipo_manifestacao;
    }

    public function setId_tipo_manifestacao(tipomanifestacao $id_tipo_manifestacao)
    {
        $this->id_tipo_manifestacao = $id_tipo_manifestacao;
    }

    public function getCidadao_cpf()
    {
        return $this->cidadao_cpf;
    }

    public function setCidadao_cpf(usuario $cidadao_cpf)
    {
        $this->cidadao_cpf = $cidadao_cpf;
    }

    public function getId_situacao()
    {
        return $this->id_situacao;
    }

    public function setId_situacao(situacao $id_situacao)
    {
        $this->id_situacao = $id_situacao;
    }

    public function getAssunto()
    {
        return $this->assunto;
    }

    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function getSigilo()
    {
        return $this->sigilo;
    }

    public function setSigilo($sigilo)
    {
        $this->sigilo = $sigilo;
    }

    public function getDataManifestacao()
    {
        return $this->data_manifestacao;
    }

    public function setDataManifestacao($data_manifestacao)
    {
        $this->data_manifestacao = $data_manifestacao;
    }

    public function getData_resposta()
    {
        return $this->data_resposta;
    }

    public function setData_resposta($data_resposta)
    {
        $this->data_resposta = $data_resposta;
    }

    public function getIdAnexo()
    {
        return $this->id_anexo;
    }

    public function setIdAnexo(string $id_anexo)
    {
        $this->id_anexo = $id_anexo;
    }
}

?>