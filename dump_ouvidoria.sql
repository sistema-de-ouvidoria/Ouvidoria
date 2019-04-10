-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 05-Abr-2019 às 00:53
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ouvidoria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexo`
--

DROP TABLE IF EXISTS `anexo`;
CREATE TABLE IF NOT EXISTS `anexo` (
  `id_anexo` varchar(255) NOT NULL,
  `caminho` varchar(255) DEFAULT NULL,
  `nome_anexo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_anexo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manifestacao`
--

DROP TABLE IF EXISTS `manifestacao`;
CREATE TABLE IF NOT EXISTS `manifestacao` (
  `id_manifestacao` int(11) NOT NULL AUTO_INCREMENT,
  `cidadao_cpf` varchar(11) NOT NULL,
  `id_tipo_manifestacao` int(11) NOT NULL,
  `id_situacao` int(11) NOT NULL,
  `assunto` varchar(100) NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `sigilo` tinyint(1) DEFAULT NULL,
  `id_anexo` varchar(255) DEFAULT NULL,
  `data_manifestacao` timestamp NOT NULL,
  `data_resposta` timestamp DEFAULT NULL,
  PRIMARY KEY (`id_manifestacao`),
  CONSTRAINT FK_manif_situacao FOREIGN KEY (`id_situacao`) REFERENCES situacao(`id_situacao`),
  CONSTRAINT FK_manif_anexo FOREIGN KEY (`id_anexo`) REFERENCES situacao(`id_anexo`),
  CONSTRAINT FK_manif_tipomanif FOREIGN KEY (`id_tipo_manifestacao`) REFERENCES tipomanifestacao(`id_tipo_manifestacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao`
--

DROP TABLE IF EXISTS `situacao`;
CREATE TABLE IF NOT EXISTS `situacao` (
  `id_situacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_situacao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_situacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipomanifestacao`
--

DROP TABLE IF EXISTS `tipomanifestacao`;
CREATE TABLE IF NOT EXISTS `tipomanifestacao` (
  `id_tipo_manifestacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo_manifestacao` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_manifestacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id_tipo_usuario` int(11) AUTO_INCREMENT,
  `nome_tipo_usuario` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
INSERT INTO `tipousuario` (`nome_tipo_usuario`) VALUES
('Cidadao'),
('Ouvidor'),
('Administrador Publico'),
('Administrador Sistema');
--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `cpf` varchar(11),
  `id_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

INSERT INTO `usuario` (`cpf`, `id_tipo_usuario`, `nome`, `endereco`, `telefone`, `email`, `senha`) VALUES
('12345678910', 1, 'Fernando da Silva', 'Rua Lima Souza, 234', '999999999','fernando@gmail.com', md5('1234'));

--
-- Extraindo dados da tabela `tipomanifestacao`
--

INSERT INTO `tipomanifestacao` (`nome_tipo_manifestacao`) VALUES
('Elogio'),
('Reclamacao'),
('Sugestao'),
('Denuncia');

--
-- Extraindo dados da tabela `situacao`
--

INSERT INTO `situacao` (`nome_situacao`) VALUES
('Aberta'),
('Encaminhada'),
('Fechada');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
