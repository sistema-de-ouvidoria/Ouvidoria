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
  `resposta` text DEFAULT NULL,
  PRIMARY KEY (`id_manifestacao`),
  CONSTRAINT FK_manif_situacao FOREIGN KEY (`id_situacao`) REFERENCES situacao(`id_situacao`),
  CONSTRAINT FK_manif_anexo FOREIGN KEY (`id_anexo`) REFERENCES situacao(`id_anexo`),
  CONSTRAINT FK_manif_tipomanif FOREIGN KEY (`id_tipo_manifestacao`) REFERENCES tipomanifestacao(`id_tipo_manifestacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `situacao`;
CREATE TABLE IF NOT EXISTS `situacao` (
  `id_situacao` int NOT NULL AUTO_INCREMENT,
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
  `id_tipo_usuario` int(11) AUTO_INCREMENT,
  `nome_tipo_usuario` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `cpf` varchar(11),
  `id_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `orgaopublico`;
CREATE TABLE IF NOT EXISTS `orgaopublico` (
    `id_orgao_publico` int NOT NULL AUTO_INCREMENT,
    `sigla_orgao_publico` varchar(20),
    `nome_orgao_publico` varchar(100),
    PRIMARY KEY (`id_orgao_publico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
    `id_historico` int NOT NULL AUTO_INCREMENT,
    `orgao_publico` int,
    `ouvidor` varchar(11),
    `adm_publico` varchar(11),
    `manifestacao` int(11),
    PRIMARY KEY (`id_historico`),
    CONSTRAINT FK_hist_manif FOREIGN KEY (`manifestacao`) REFERENCES manifestacao(`id_manifestacao`),
    CONSTRAINT FK_hist_orgpublico FOREIGN KEY (`orgao_publico`) REFERENCES orgaopublico(`id_orgao_publico`),
    CONSTRAINT FK_hist_ouvidor FOREIGN KEY (`ouvidor`) REFERENCES usuario(`cpf`),
    CONSTRAINT FK_hist_admpublico FOREIGN KEY (`adm_publico`) REFERENCES usuario(`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;
INSERT INTO `usuario` (`cpf`, `id_tipo_usuario`, `nome`, `endereco`, `telefone`, `email`, `senha`) VALUES
('12345678910', 1, 'Joao da Silva', 'Rua Lima Souza, 234', '999999999','fernando@gmail.com', md5('1234')),
('12345678911', 2, 'Paulo da Silva', 'Rua Lima Souza, 235', '999999999','paulo@gmail.com', md5('1234')),
('12345678912', 3, 'Maria da Silva', 'Rua Lima Souza, 236', '999999999','maria@gmail.com', md5('1234')),
('12345678913', 4, 'Joana da Silva', 'Rua Lima Souza, 237', '999999999','joana@gmail.com', md5('1234'));
INSERT INTO `tipomanifestacao` (`nome_tipo_manifestacao`) VALUES
('Elogio'),
('Reclamacao'),
('Sugestao'),
('Denuncia');
INSERT INTO `situacao` (`nome_situacao`) VALUES
('Aberta'),
('Encaminhada'),
('Fechada');
INSERT INTO `tipousuario` (`nome_tipo_usuario`) VALUES
('Cidadao'),
('Ouvidor'),
('Administrador Publico'),
('Administrador Sistema');
INSERT INTO `orgaopublico` (`sigla_orgao_publico`, `nome_orgao_publico`) VALUES
('Agehab', 'Agencia de Habitacao de Mato Grosso do Sul'),
('Agepan', 'Agencia Estadual de Regulacao de Servicos Publicos'),
('Agesul', 'Agencia Estadual de Gestao de Empreendimentos de Mato Grosso do Sul'),
('Agraer', 'Agencia de Desenvolvimento Agrario e Extensao Rural'),
('Assomasul', 'Associacao dos Municipios de Mato Grosso do Sul'),
('Detran/MS', 'Departamento Estadual de Transito de Mato Grosso do Sul'),
('Funtrab', 'Fundacao do Trabalho e Economia Solidaria'),
('Iagro', 'Agencia Estadual de Defesa Sanitaria Animal e Vegetal'),
('Imprensa', 'Diario Oficial do Estado de Mato Grosso do Sul'),
('Jucems', 'Junta Comercial do Estado de Mato Grosso do Sul'),
('MSGAS', 'Companhia de Gas do Estado de Mato Grosso do Sul'),
('PM/MS', 'Policia Militar de Mato Grosso do Sul'),
('Portal MS', 'Governo do Estado de Mato Grosso do Sul'),
('SAD', 'Secretaria de Estado de Administracao do MS'),
('Sanesul', 'Empresa de Saneamento do Estado de Mato Grosso do Sul'),
('SED', 'Secretaria de Estado de Educacao de Mato Grosso do Sul'),
('Sefaz', 'Secretaria de Estado de Fazenda de Mato Grosso do Sul'),
('Sejusp', 'Secretaria de Estado de Justica e Seguranca Publica'),
('Semac', 'Secretaria de Estado do Meio Ambiente, das Cidades, do Planejamento, da Ciencia e Tecnologia'),
('Seprotur', 'Secretaria de Estado de Desenvolvimento Agrario, da Producao, da Industria, do Comercio e do Turismo'),
('SES', 'Secretaria de Estado de Saude de Mato Grosso do Sul'),
('Setass', 'Secretaria de Estado de Trabalho, Assistencia Social e Economia Solidaria' );