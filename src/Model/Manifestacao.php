<?php
class Manifestacao{
	protected $IDManifestacao;
	protected $tipo;
	protected $assunto;
	protected $mensagem;
	protected $sigilo;
	protected $diretorioArquivo = array();
	protected $dataManifestacao;

	function __construct($tipo,$assunto,$mensagem,$sigilo,$dataManifestacao) {
		$this->tipo = $tipo;
		$this->assunto = $assunto;
		$this->mensagem = $mensagem;
		$this->sigilo = $sigilo;
		$this->dataManifestacao = $dataManifestacao;

	}
 
	public function setDiretorioArquivo(array $diretorioArquivo){
		$this->diretorioArquivo = $diretorioArquivo;
	}
	public function getDiretorioArquivo($indice)
	{
		if(array_key_exists($indice,$this->diretorioArquivo)):
			return $this->diretorioArquivo[$indice];
		else:
			exit(0);
		endif;
	}

	//Setters e Getters da classe Manifestacao
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	public function getTipo(){
		return $this->tipo;
	}

	public function setAssunto($assunto){
		$this->assunto = $assunto;
	}
	public function getAssunto(){
		return $this->assunto;
	}

	public function setMensagem($mensagem){
		$this->mensagem = $mensagem;
	}
	public function getMensagem(){
		return $this->mensagem;
	}

	public function setSigilo($sigilo){
		$this->sigilo = $sigilo;
	}
	public function getSigilo(){
		return $this->sigilo;
	}

	public function setDataManifestacao($dataManifestacao){
		$this->dataManifestacao = $dataManifestacao;
	}
	public function getDataManifestacao(){
		return $this->dataManifestacao;
	}
}
?>