<?php


namespace Ouvidoria\model;


class Imagem
{
    protected $id_imagem;
    protected $nome_imagem;
    protected $caminho_imagem;

    /**
     * Imagem constructor.
     * @param $nome_imagem
     * @param $caminho_imagem
     */
    public function __construct($nome_imagem, $caminho_imagem)
    {
        $this->nome_imagem = $nome_imagem;
        $this->caminho_imagem = $caminho_imagem;
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

    /**
     * @return mixed
     */
    public function getNomeImagem()
    {
        return $this->nome_imagem;
    }

    /**
     * @param mixed $nome_imagem
     */
    public function setNomeImagem($nome_imagem): void
    {
        $this->nome_imagem = $nome_imagem;
    }

    /**
     * @return mixed
     */
    public function getCaminhoImagem()
    {
        return $this->caminho_imagem;
    }

    /**
     * @param mixed $caminho_imagem
     */
    public function setCaminhoImagem($caminho_imagem): void
    {
        $this->caminho_imagem = $caminho_imagem;
    }




}