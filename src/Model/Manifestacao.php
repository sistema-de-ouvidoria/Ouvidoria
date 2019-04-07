<?php
class Manifestacao{
    protected $id_manifestacao;
    protected $id_tipo_manifestacao;
    protected $id_cidadao;
    protected $id_ouvidor;
    protected $id_adm_publico;
    protected $id_situacao;
    protected $assunto;
    protected $mensagem;
    protected $sigilo;
    //protected $diretorioArquivo = array();
    protected $dataManifestacao;
    protected $data_resposta;

    function __construct($tipo,$assunto,$mensagem,$sigilo,$dataManifestacao) {
        $this->id_tipo_manifestacao = $tipo;
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
    public function getId_manifestacao(){
        return $this->id_manifestacao;
    }

    public function setId_manifestacao($id_manifestacao){
        $this->id_manifestacao = $id_manifestacao;
    }

    public function getId_tipo_manifestacao(){
        return $this->id_tipo_manifestacao;
    }

    public function setId_tipo_manifestacao(tipomanifestacao $id_tipo_manifestacao){
        $this->id_tipo_manifestacao = $id_tipo_manifestacao;
    }

    public function getId_cidadao(){
        return $this->id_cidadao;
    }

    public function setId_cidadao(usuario $id_cidadao){
        $this->id_cidadao = $id_cidadao;
    }

    public function getId_ouvidor(){
        return $this->id_ouvidor;
    }

    public function setId_ouvidor(usuario $id_ouvidor){
        $this->id_ouvidor = $id_ouvidor;
    }

    public function getId_adm_publico(){
        return $this->id_adm_publico;
    }

    public function setId_adm_publico(usuario $id_adm_publico){
        $this->id_adm_publico = $id_adm_publico;
    }

    public function getId_situacao(){
        return $this->id_situacao;
    }

    public function setId_situacao(situacao $id_situacao){
        $this->id_situacao = $id_situacao;
    }

    public function getAssunto(){
        return $this->assunto;
    }

    public function setAssunto($assunto){
        $this->assunto = $assunto;
    }

    public function getMensagem(){
        return $this->mensagem;
    }

    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }

    public function getSigilo(){
        return $this->sigilo;
    }

    public function setSigilo($sigilo){
        $this->sigilo = $sigilo;
    }

    public function getDataManifestacao(){
        return $this->dataManifestacao;
    }

    public function setDataManifestacao($dataManifestacao){
        $this->dataManifestacao = $dataManifestacao;
    }

    public function getData_resposta(){
        return $this->data_resposta;
    }

    public function setData_resposta($data_resposta){
        $this->data_resposta = $data_resposta;
    }
}
?>