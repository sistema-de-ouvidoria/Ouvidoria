

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


  use ouvidoria;
DROP TABLE IF EXISTS `anexo`;
CREATE TABLE IF NOT EXISTS `anexo` (
  `id_anexo` varchar(255) NOT NULL,
  `caminho` varchar(255) DEFAULT NULL,
  `nome_anexo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_anexo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


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


DROP TABLE IF EXISTS `situacao`;
CREATE TABLE IF NOT EXISTS `situacao` (
  `id_situacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_situacao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_situacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `tipomanifestacao`;
CREATE TABLE IF NOT EXISTS `tipomanifestacao` (
  `id_tipo_manifestacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo_manifestacao` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_manifestacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo_usuario` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `cpf` varchar(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(30) NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;


INSERT INTO `tipomanifestacao` (`nome_tipo_manifestacao`) VALUES
('Elogio'),
('Denuncia');


INSERT INTO `situacao` (`nome_situacao`) VALUES
('Aberta'),
('Encaminhada'),
('Fechada');
