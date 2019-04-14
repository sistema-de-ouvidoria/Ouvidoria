<?php
require('Conexao.php');
require_once("model/Manifestacao.php");
require_once("model/ManifestacaoFactory.php");

class ManifestacaoManager {
	private $factory;

	public function __construct() {

        $this->factory = new ManifestacaoFactory();
    }

    public function salvaManifestacao(string $tipo,string $assunto,string $mensagem,bool $sigilo,string $dataManifestacao,
									  string $cidadao_cpf, int $situacao, string $id_anexo){
    	if (!isset($tipo) || $tipo == "" ) {
			throw new Exception("O campo <strong>tipo</strong> deve ser preenchido!");
		} elseif (!isset($assunto) || $assunto == "") {
			throw new Exception("O campo <strong>assunto</strong> deve ser preenchido!");
		}elseif (!isset($mensagem) || $mensagem == "") {
			throw new Exception("O campo <strong>mensagem</strong> deve ser preenchido!");
		}
		

		$manifestacao = new Manifestacao($tipo, $assunto, $mensagem, $sigilo,$dataManifestacao,
			$cidadao_cpf, $situacao,$id_anexo);

		return $this->factory->salvarManifestacao($manifestacao);

    }


}

?>
