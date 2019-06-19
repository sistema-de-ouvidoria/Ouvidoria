-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 08-Maio-2019 às 01:12
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ouvidoria`
--

-- --------------------------------------------------------
--
-- Estrutura da tabela `interesse`
--
DROP TABLE IF EXISTS `interesse`;
CREATE TABLE IF NOT EXISTS `interesse`
(
    `idManifestacao`   varchar(12),
    `idUsuario`    varchar(11),
    PRIMARY KEY (`idManifestacao`,`idUsuario`)
);

--
-- Estrutura da tabela `anexo`
--

DROP TABLE IF EXISTS `anexo`;
CREATE TABLE IF NOT EXISTS `anexo`
(
    `id_anexo`   varchar(255) NOT NULL,
    `caminho`    varchar(255) DEFAULT NULL,
    `nome_anexo` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id_anexo`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico`
(
    `id_historico`  int(11) NOT NULL AUTO_INCREMENT,
    `orgao_publico` int(11)     DEFAULT NULL,
    `ouvidor`       varchar(11) DEFAULT NULL,
    `adm_publico`   varchar(11) DEFAULT NULL,
    `manifestacao`  int(11)     DEFAULT NULL,
    `respondida` tinyint(1)    DEFAULT NULL,
    `data_rejeicao` timestamp DEFAULT NULL,
    `motivo` TEXT DEFAULT NULL,
    PRIMARY KEY (`id_historico`),
    KEY `FK_hist_manif` (`manifestacao`),
    KEY `FK_hist_orgpublico` (`orgao_publico`),
    KEY `FK_hist_ouvidor` (`ouvidor`),
    KEY `FK_hist_admpublico` (`adm_publico`)
);

--
-- Extraindo dados da tabela `historico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `manifestacao`
--

DROP TABLE IF EXISTS `manifestacao`;
CREATE TABLE IF NOT EXISTS `manifestacao`
(
    `id_manifestacao`      int(11)       NOT NULL AUTO_INCREMENT,
    `cidadao_cpf`          varchar(11)   NOT NULL,
    `id_tipo_manifestacao` int(11)       NOT NULL,
    `id_situacao`          int(11)       NOT NULL,
    `assunto`              varchar(100)  NOT NULL,
    `mensagem`             varchar(1000) NOT NULL,
    `sigilo`               tinyint(1)    DEFAULT NULL,
    `id_anexo`             varchar(255)  DEFAULT NULL,
    `data_manifestacao`    timestamp     NOT NULL,
    `resposta`             varchar(1000) DEFAULT NULL,
    PRIMARY KEY (`id_manifestacao`),
    KEY `FK_manif_situacao` (`id_situacao`),
    KEY `FK_manif_anexo` (`id_anexo`),
    KEY `FK_manif_tipomanif` (`id_tipo_manifestacao`)
);

--
-- Extraindo dados da tabela `manifestacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `orgaopublico`
--

DROP TABLE IF EXISTS `orgaopublico`;
CREATE TABLE IF NOT EXISTS `orgaopublico`
(
    `id_orgao_publico`    int(11) NOT NULL AUTO_INCREMENT,
    `sigla_orgao_publico` varchar(20)  DEFAULT NULL,
    `nome_orgao_publico`  varchar(100) DEFAULT NULL,
    PRIMARY KEY (`id_orgao_publico`)
);

--
-- Extraindo dados da tabela `orgaopublico`
--

INSERT INTO `orgaopublico` (`id_orgao_publico`, `sigla_orgao_publico`, `nome_orgao_publico`)
VALUES (1, 'Agehab', 'Agencia de Habitacao de Mato Grosso do Sul'),
       (2, 'Agepan', 'Agencia Estadual de Regulacao de Servicos Publicos'),
       (3, 'Agesul', 'Agencia Estadual de Gestao de Empreendimentos de Mato Grosso do Sul'),
       (4, 'Agraer', 'Agencia de Desenvolvimento Agrario e Extensao Rural'),
       (5, 'Assomasul', 'Associacao dos Municipios de Mato Grosso do Sul'),
       (6, 'Detran/MS', 'Departamento Estadual de Transito de Mato Grosso do Sul'),
       (7, 'Funtrab', 'Fundacao do Trabalho e Economia Solidaria'),
       (8, 'Iagro', 'Agencia Estadual de Defesa Sanitaria Animal e Vegetal'),
       (9, 'Imprensa', 'Diario Oficial do Estado de Mato Grosso do Sul'),
       (10, 'Jucems', 'Junta Comercial do Estado de Mato Grosso do Sul'),
       (11, 'MSGAS', 'Companhia de Gas do Estado de Mato Grosso do Sul'),
       (12, 'PM/MS', 'Policia Militar de Mato Grosso do Sul'),
       (13, 'Portal MS', 'Governo do Estado de Mato Grosso do Sul'),
       (14, 'SAD', 'Secretaria de Estado de Administracao do MS'),
       (15, 'Sanesul', 'Empresa de Saneamento do Estado de Mato Grosso do Sul'),
       (16, 'SED', 'Secretaria de Estado de Educacao de Mato Grosso do Sul'),
       (17, 'Sefaz', 'Secretaria de Estado de Fazenda de Mato Grosso do Sul'),
       (18, 'Sejusp', 'Secretaria de Estado de Justica e Seguranca Publica'),
       (19, 'Semac', 'Secretaria de Estado do Meio Ambiente, das Cidades, do Planejamento, da Ciencia e Tecnologia'),
       (20, 'Seprotur',
        'Secretaria de Estado de Desenvolvimento Agrario, da Producao, da Industria, do Comercio e do Turismo'),
       (21, 'SES', 'Secretaria de Estado de Saude de Mato Grosso do Sul'),
       (22, 'Setass', 'Secretaria de Estado de Trabalho, Assistencia Social e Economia Solidaria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao`
--

DROP TABLE IF EXISTS `situacao`;
CREATE TABLE IF NOT EXISTS `situacao`
(
    `id_situacao`   int(11)      NOT NULL AUTO_INCREMENT,
    `nome_situacao` varchar(255) NOT NULL,
    PRIMARY KEY (`id_situacao`)
);

--
-- Extraindo dados da tabela `situacao`
--

INSERT INTO `situacao` (`id_situacao`, `nome_situacao`)
VALUES (1, 'Aberta'),
       (2, 'Encaminhada'),
       (3, 'Fechada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipomanifestacao`
--

DROP TABLE IF EXISTS `tipomanifestacao`;
CREATE TABLE IF NOT EXISTS `tipomanifestacao`
(
    `id_tipo_manifestacao`   int(11)      NOT NULL AUTO_INCREMENT,
    `nome_tipo_manifestacao` varchar(100) NOT NULL,
    PRIMARY KEY (`id_tipo_manifestacao`)
);

--
-- Extraindo dados da tabela `tipomanifestacao`
--

INSERT INTO `tipomanifestacao` (`id_tipo_manifestacao`, `nome_tipo_manifestacao`)
VALUES (1, 'Elogio'),
       (2, 'Reclamação'),
       (3, 'Sugestao'),
       (4, 'Denuncia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario`
(
    `id_tipo_usuario`   int(11)      NOT NULL AUTO_INCREMENT,
    `nome_tipo_usuario` varchar(255) NOT NULL,
    PRIMARY KEY (`id_tipo_usuario`)
);

--
-- Extraindo dados da tabela `tipousuario`
--

INSERT INTO `tipousuario` (`id_tipo_usuario`, `nome_tipo_usuario`)
VALUES (1, 'Cidadao'),
       (2, 'Ouvidor'),
       (3, 'Administrador Publico'),
       (4, 'Administrador Sistema'),
       (5, 'Desativado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario`
(
    `cpf`             varchar(11)  NOT NULL,
    `id_tipo_usuario` int(11)      NOT NULL,
    `nome`            varchar(50)  NOT NULL,
    `endereco`        varchar(150) NOT NULL,
    `telefone`        varchar(11) DEFAULT NULL,
    `email`           varchar(100) NOT NULL,
    `senha`           varchar(10)  NOT NULL,
    PRIMARY KEY (`cpf`),
    UNIQUE KEY `email` (`email`),
    KEY `fk_tipo_usuario` (`id_tipo_usuario`)
);

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpf`, `id_tipo_usuario`, `nome`, `endereco`, `telefone`, `email`, `senha`)
VALUES ('12345678910', 1, 'Joao da Silva', 'Rua Lima Souza, 234', '999999999', 'fernando@gmail.com', '12345'),
       ('12345678911', 2, 'Paulo da Silva Lima', 'Rua Lima Souza, 235', '999999999', 'paulo@gmail.com', '12345'),
       ('12345678912', 3, 'Maria da Silva', 'Rua Lima Souza, 236', '999999999', 'maria@gmail.com', '12345'),
       ('12345678913', 4, 'Joana da Silva', 'Rua Lima Souza, 237', '999999999', 'joana@gmail.com', '12345');
COMMIT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

DROP TABLE IF EXISTS `noticia`;
CREATE TABLE IF NOT EXISTS `noticia`
(
    `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR (100)      NOT NULL,
    `subtitulo` VARCHAR(250)  NOT NULL,
    `descricao` LONGTEXT NOT NULL,
    `data_publicacao` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `id_imagem` int(11) NOT NULL,
    PRIMARY KEY (`id_noticia`),
    KEY `fk_noticia_imagem` (`id_imagem`)
);

--
-- Estrutura da tabela `imagem`
--

DROP TABLE IF EXISTS `imagem`;
CREATE TABLE IF NOT EXISTS `imagem`
(
    `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
    `nome_imagem` varchar(255) DEFAULT NULL,
    `caminho_imagem` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id_imagem`)
);
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
