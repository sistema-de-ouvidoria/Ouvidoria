<?php
namespace Ouvidoria\model\manager;
require ('model/ManifestacaoFactory.php');
use Ouvidoria\model\factory\ManifestacaoFactory;
use Ouvidoria\model\Manifestacao;
class ManifestacaoManager
{
    private $factory;

    public function __construct()
    {
        $this->factory = new ManifestacaoFactory();
    }

    public function salvaManifestacao(string $tipo, string $assunto, string $mensagem, bool $sigilo, string $dataManifestacao,
                                      string $cidadao_cpf, int $situacao, string $id_anexo)
    {
        if (!isset($tipo) || $tipo == "") {
            throw new Exception("O campo <strong>tipo</strong> deve ser preenchido!");
        } elseif (!isset($assunto) || $assunto == "") {
            throw new Exception("O campo <strong>assunto</strong> deve ser preenchido!");
        } elseif (!isset($mensagem) || $mensagem == "") {
            throw new Exception("O campo <strong>mensagem</strong> deve ser preenchido!");
        }


        $manifestacao = new Manifestacao($tipo, $assunto, $mensagem, $sigilo, $dataManifestacao,
            $cidadao_cpf, $situacao, $id_anexo);

        return $this->factory->salvarManifestacao($manifestacao);

    }

    public function listaManifestacoes($nvlAcesso)
    {
        return $this->factory->listarManifestacoes($nvlAcesso);
    }

    public function listaMinhasManifestacoes($cpf)
    {
        return $this->factory->listarMinhasManifestacoes($cpf);
    }

    public function alteraManifestacaoOuvidor($id)
    {
        return $this->factory->alterarManifestacaoOuvidor($id);
    }

    public function alteraManifestacaoAdmPublico($id, $resposta)
    {
        return $this->factory->alterarManifestacaoAdmPublico($id, $resposta);
    }

    public function selecionaManifestacaoAdmPublico(string $id)
    {
        $resultado = $this->factory->selecionarManifestacaoAdmPublico($id);

        return $resultado;
    }

    public function selecionaManifestacaoCidadao(string $id)
    {
        $resultado = $this->factory->selecionarManifestacaoCidadao($id);

        return $resultado;
    }

    public function selecionaManifestacaoOuvidor(string $id)
    {
        $resultado = $this->factory->selecionarManifestacaoOuvidor($id);

        return $resultado;
    }

    public function recusaManifestacao(string $id)
    {
        $resultado = $this->factory->recusaManifestacao($id);
    }

    public function removerInteresse(string $idManifestacao, string $idUsuario){
        return $this->factory->removerInteresse($idManifestacao,$idUsuario);
    }

    public function checaInteresse(string $idManifestacao,string $idUsuario){
        return $this->factory->checaInteresse($idManifestacao,$idUsuario);
    }
    public function manifestarInteresse(string $idManifestacao,string $idUsuario){
        return $this->factory->manifestarInteresse($idManifestacao,$idUsuario);
    }
    public function selecionaOuvidor(string $cpfOuvidor){
        return $this->factory->selecionaOuvidor($cpfOuvidor);
    }
    public function selecionaEmailInteressados(string $idManifestacao){
        return $this->factory->selecionaEmailInteressados($idManifestacao);
    }

    public function selecionaOrgao(string $id_orgao_publico){
        return $this->factory->selecionaOrgao($id_orgao_publico);
    }

    public function selecionaNomeAdmin(string $cpfAdminPublico){
        return $this->factory->selecionaNomeAdmin($cpfAdminPublico);
    }

    public function selecionaNomeOrgao(string $idManifestacao){
        return $this->factory->selecionaNomeOrgao($idManifestacao);
    }

    public function listaAcompanharManifestacao(){
        return $this->factory->listaAcompanharManifestacao();
    }
}

