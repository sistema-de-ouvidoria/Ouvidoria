<?php


namespace Ouvidoria\model;


class Noticia
{
    protected $id_noticia;
    protected $titulo;
    protected $subtitulo;
    protected $descricao;
    protected $id_imagem;
    protected $data_publicacao;

    /**
     * Noticia constructor.
     * @param $id_noticia
     * @param $titulo
     * @param $subtitulo
     * @param $descricao
     * @param $data_publicacao
     */
    public function __construct($titulo, $subtitulo, $descricao, $id_imagem)
    {
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->descricao = $descricao;
        $this->id_imagem = $id_imagem;
    }

    /**
     * @return mixed
     */
    public function getIdNoticia()
    {
        return $this->id_noticia;
    }

    /**
     * @param mixed $id_noticia
     */
    public function setIdNoticia($id_noticia): void
    {
        $this->id_noticia = $id_noticia;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * @param mixed $subtitulo
     */
    public function setSubtitulo($subtitulo): void
    {
        $this->subtitulo = $subtitulo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getDataPublicacao()
    {
        return $this->data_publicacao;
    }

    /**
     * @param mixed $data_publicacao
     */
    public function setDataPublicacao($data_publicacao): void
    {
        $this->data_publicacao = $data_publicacao;
    }

    /**
     * @return mixed
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }

    /**
     * @param mixed $id_imagem
     */
    public function setIdImagem($id_imagem): void
    {
        $this->id_imagem = $id_imagem;
    }

}