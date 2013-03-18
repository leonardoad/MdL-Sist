
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 18/03/2013 às 15:05:35
-- Versão do Servidor: 5.1.66
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `u616479190_mdlsist`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `descricao` longtext,
  `ativo` char(1) DEFAULT 'S',
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99993 ;

--
-- Extraindo dados da tabela `album`
--

INSERT INTO `album` (`id_album`, `titulo`, `descricao`, `ativo`, `ordem`) VALUES
(99991, 'Banner Topo', NULL, NULL, 1),
(99992, 'Banner Rodape', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo`
--

CREATE TABLE IF NOT EXISTS `arquivo` (
  `id_arquivo` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` char(1) DEFAULT 'S',
  `ext` varchar(5) DEFAULT NULL,
  `id_owner` int(11) DEFAULT NULL,
  `principal` char(1) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `link` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id_arquivo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Extraindo dados da tabela `arquivo`
--

INSERT INTO `arquivo` (`id_arquivo`, `ativo`, `ext`, `id_owner`, `principal`, `ordem`, `descricao`, `link`) VALUES
(18, 'S', 'jpg', 99992, 'N', NULL, 'banner2', NULL),
(19, 'S', 'jpg', 99991, 'S', NULL, 'Conheca esse incrivel produto', 'http://localhost/Projetos/Opertur/web/produto/id/2'),
(20, 'S', 'jpg', 99991, 'N', NULL, 'banner3', NULL),
(22, 'S', 'jpg', 2, 'N', NULL, 'cofre1', NULL),
(23, 'S', 'jpg', 2, 'S', NULL, 'cofre 2', NULL),
(27, 'S', 'jpg', 1, 'S', NULL, 'video', NULL),
(28, 'S', 'jpg', 1, 'N', NULL, 'video_port', NULL),
(30, 'S', 'jpg', 4, 'S', NULL, 'Cofre_Biciletario', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` char(1) COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `fone2` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `fone3` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `logradouro` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `complemento` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `uf` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `cep` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `ativo`, `nome`, `email`, `fone`, `fone2`, `fone3`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`) VALUES
(1, 'S', 'Maria', 'Maria@terra.com', '(99) 9999-9999', '(00) 0000-0000', '(33) 3333-3333', 'rua anita', '340', 'ap 299', 'pretopolis', 'porto alegre', 'RS', '99.999.999'),
(2, 'S', 'Leo', 'leo@gmail.com', '(09) 9999-9999', '(22) 2222-2222', '(22) 2222-2222', 'rua dos andradas', '09', '09', 'asv', 'porto alegre', 'qw', '22.222.222'),
(3, '', 'Fulana da Silva', 'fulana@terra.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '', 'asdcasd', 'asdcdsc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'S', 'ascac', 'sadva', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `trocasenhatempo` char(1) DEFAULT NULL,
  `tempotrocasenha` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nomefantasia` varchar(60) DEFAULT NULL,
  `razaosocial` varchar(60) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `uf` varchar(50) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `fax` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `inscricaoestadual` varchar(18) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `embratur` varchar(18) DEFAULT NULL,
  `iata` varchar(18) DEFAULT NULL,
  `snea` varchar(18) DEFAULT NULL,
  `abav` varchar(18) DEFAULT NULL,
  `responsavel` varchar(50) DEFAULT NULL,
  `principal` char(1) DEFAULT NULL,
  `editavel` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nomefantasia`, `razaosocial`, `endereco`, `cidade`, `bairro`, `uf`, `cep`, `telefone`, `fax`, `cnpj`, `inscricaoestadual`, `email`, `site`, `embratur`, `iata`, `snea`, `abav`, `responsavel`, `principal`, `editavel`) VALUES
(1, 'Sleifer Desenvolvimento', 'Sleifer Desenvolvimento', 'Rua Suddo, 203', 'Viamdo', 'Santa Isabel', 'RS', '94.480.450', '(51) 8575-9375', NULL, NULL, NULL, 'ismaelsleifer@gmail.com', 'www.sleifer.com.br', NULL, NULL, NULL, NULL, 'Ismael Sleifer', 'N', 'N'),
(3, 'Mural das Lembrancinhas', 'Mural das Lembrancinhas Ltda', 'Rua Ernesto Zamprogna', 'POA', 'ProtÃ¡sio Alves', 'RS', NULL, NULL, NULL, NULL, NULL, 'muraldaslembrancinhas@gmail.com', 'muraldaslembrancinhas.blogspot.com', NULL, NULL, NULL, NULL, 'Taise Faria Alves', 'S', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id_log` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` text COLLATE utf8_bin NOT NULL,
  `usuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_owner` int(11) NOT NULL,
  `controller` varchar(100) COLLATE utf8_bin NOT NULL,
  `tipo` int(11) NOT NULL,
  `act` varchar(50) COLLATE utf8_bin NOT NULL,
  `ip` varchar(70) COLLATE utf8_bin NOT NULL,
  `acao` int(11) NOT NULL,
  UNIQUE KEY `id_log` (`id_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=55 ;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`id_log`, `descricao`, `usuario`, `datahora`, `id_owner`, `controller`, `tipo`, `act`, `ip`, `acao`) VALUES
(1, 'INSERT INTO `produto` (`nome`, `descricao`, `destaque`, `id_tipoproduto`) VALUES (''svasdv'', ''asdvasdvasdv'', ''S'', ''3'')', 'Administrador', '2013-03-15 02:13:21', 9, 'Produto', 3, 'btnSalvarclick', '127.0.0.1', 1),
(2, 'Inserido <b> asdvasdvasdv</b>', 'Administrador', '2013-03-15 02:13:21', 9, 'Produto', 7, 'btnSalvarclick', '127.0.0.1', 1),
(3, 'DELETE FROM `permissao` WHERE (1=1  and id_permissao = ''4'' )', 'Administrador', '2013-03-15 04:06:06', 4, 'Usuario', 3, 'btnExcluirclick', '127.0.0.1', 3),
(4, 'Deletado a permissÃ£o Acesso total ao sistema', 'Administrador', '2013-03-15 04:06:06', 4, 'Usuario', 6, 'btnExcluirclick', '127.0.0.1', 3),
(5, 'DELETE FROM `usuario` WHERE (1=1  and id_usuario = ''4'' )', 'Administrador', '2013-03-15 04:06:06', 4, 'Usuario', 3, 'btnExcluirclick', '127.0.0.1', 3),
(6, 'Deletado UsuÃ¡rio Top chaves', 'Administrador', '2013-03-15 04:06:06', 4, 'Usuario', 6, 'btnExcluirclick', '127.0.0.1', 3),
(7, 'INSERT INTO `usuario` (`ativo`, `nomecompleto`, `loginuser`, `tipo`, `grupo`, `email`, `smtp`, `porta`, `assinaturaemail`, `excluivel`, `editavel`, `senha`, `datasenha`, `id_empresa`) VALUES (''S'', ''Taise Faria Alves'', ''taise'', ''user'', ''-1'', ''muraldaslembrancinhas@gmail,com'', null, null, null, ''S'', ''S'', ''2f312853d785497cea6acc1babab8b4d'', ''2013-03-15'', ''3'')', 'Administrador', '2013-03-15 04:06:50', 5, 'Usuario', 3, 'btnSalvarclick', '127.0.0.1', 1),
(8, 'Inserido UsuÃ¡rio<b> Taise Faria Alves</b>', 'Administrador', '2013-03-15 04:06:50', 5, 'Usuario', 7, 'btnSalvarclick', '127.0.0.1', 1),
(9, 'Valor do campo <b>nomefantasia</b> foi alterado de <b>Top Chaves</b> para <b>Mural das Lembrancinhas</b>. <br /> Valor do campo <b>razaosocial</b> foi alterado de <b>Top Chaves</b> para <b>Mural das Lembrancinhas Ltda</b>. <br /> Valor do campo <b>endereco</b> foi alterado de <b>rua tal</b> para <b>Rua Ernesto Zamprogna</b>. <br /> Valor do campo <b>bairro</b> foi alterado de <b>vazio</b> para <b>ProtÃ¡sio Alves</b>. <br /> Valor do campo <b>uf</b> foi alterado de <b>vazio</b> para <b>RS</b>. <br /> Valor do campo <b>email</b> foi alterado de <b>vazio</b> para <b>muraldaslembrancinhas@gmail.com</b>. <br /> Valor do campo <b>site</b> foi alterado de <b>vazio</b> para <b>muraldaslembrancinhas.blogspot.com</b>. <br /> Valor do campo <b>responsavel</b> foi alterado de <b>sdvsdavasds</b> para <b>Taise Faria Alves</b>.', 'Administrador', '2013-03-15 04:09:09', 3, 'Empresa', 5, 'btnSalvarclick', '127.0.0.1', 2),
(10, 'UPDATE `empresa` SET `nomefantasia` = ''Mural das Lembrancinhas'', `razaosocial` = ''Mural das Lembrancinhas Ltda'', `endereco` = ''Rua Ernesto Zamprogna'', `cidade` = ''POA'', `bairro` = ''ProtÃ¡sio Alves'', `uf` = ''RS'', `cep` = null, `telefone` = null, `fax` = null, `cnpj` = null, `inscricaoestadual` = null, `email` = ''muraldaslembrancinhas@gmail.com'', `site` = ''muraldaslembrancinhas.blogspot.com'', `embratur` = null, `iata` = null, `snea` = null, `abav` = null, `responsavel` = ''Taise Faria Alves'', `principal` = ''N'', `editavel` = ''S'' WHERE (1=1  and id_empresa = ''3'' )', 'Administrador', '2013-03-15 04:09:09', 3, 'Empresa', 3, 'btnSalvarclick', '127.0.0.1', 2),
(11, 'Valor do campo <b>principal</b> foi alterado de <b>N</b> para <b>S</b>.', 'Administrador', '2013-03-15 04:09:18', 3, 'Empresa', 5, 'btnSalvarclick', '127.0.0.1', 2),
(12, 'UPDATE `empresa` SET `nomefantasia` = ''Mural das Lembrancinhas'', `razaosocial` = ''Mural das Lembrancinhas Ltda'', `endereco` = ''Rua Ernesto Zamprogna'', `cidade` = ''POA'', `bairro` = ''ProtÃ¡sio Alves'', `uf` = ''RS'', `cep` = null, `telefone` = null, `fax` = null, `cnpj` = null, `inscricaoestadual` = null, `email` = ''muraldaslembrancinhas@gmail.com'', `site` = ''muraldaslembrancinhas.blogspot.com'', `embratur` = null, `iata` = null, `snea` = null, `abav` = null, `responsavel` = ''Taise Faria Alves'', `principal` = ''S'', `editavel` = ''S'' WHERE (1=1  and id_empresa = ''3'' )', 'Administrador', '2013-03-15 04:09:18', 3, 'Empresa', 3, 'btnSalvarclick', '127.0.0.1', 2),
(13, 'INSERT INTO `permissao` (`id_usuario`, `id_processo`, `ver`, `inserir`, `excluir`, `editar`) VALUES (''5'', ''1'', ''S'', ''S'', ''S'', ''S'')', 'Administrador', '2013-03-15 10:01:14', 5, 'Usuario', 3, 'btnSalvarclick', '::1', 1),
(14, 'Inserido a permissÃ£o<b> Acesso total ao sistema</b>', 'Administrador', '2013-03-15 10:01:14', 5, 'Usuario', 7, 'btnSalvarclick', '::1', 1),
(15, 'INSERT INTO `tipoproduto` (`descricao`, `id_owner`) VALUES (''Latinha'', null)', 'Taise Faria Alves', '2013-03-15 12:59:59', 4, 'Tipoproduto', 3, 'btnSalvarclick', '::1', 1),
(16, 'Inserido <b> Latinha</b>', 'Taise Faria Alves', '2013-03-15 12:59:59', 4, 'Tipoproduto', 7, 'btnSalvarclick', '::1', 1),
(17, 'Valor do campo <b>id_tipoproduto</b> foi alterado de <b>2</b> para <b>4</b>.', 'Taise Faria Alves', '2013-03-15 23:22:22', 2, 'Produto', 5, 'btnSalvarclick', '::1', 2),
(18, 'UPDATE `produto` SET `id_tipoproduto` = ''4'', `ativo` = ''S'', `destaque` = ''S'', `nome` = ''Cofre aes'', `descricao` = ''Cofres altamente seguros e resistentes, em diversos tamanhos para aplicacaes diferenciadas.\r\n\r\nConstruidos em ao;\r\nVarios tamanhos;\r\nFacil instalao;\r\nBloqueio eletronico apos quatro tentativas incorretas;\r\nPinos de travamento em ao;\r\n\r\nCartao de abertura emergencial (em caso de esquecimento da senha);\r\nDurabilidade da bateria de ate 18 meses;\r\nSistema anti-travamento em caso de bateria fraca.'' WHERE (1=1  and id_produto = ''2'' )', 'Taise Faria Alves', '2013-03-15 23:22:22', 2, 'Produto', 3, 'btnSalvarclick', '::1', 2),
(19, 'INSERT INTO `produto` (`titulo`, `descricao`, `destaque`, `valorvenda`, `valorcusto`) VALUES (''Latinha Rosa'', ''latinha com uma fita entorno e um adesivo no tema escolhido,'', ''S'', null, null)', 'Taise Faria Alves', '2013-03-16 05:34:46', 1, 'Produto', 3, 'btnSalvarclick', '::1', 1),
(20, 'Inserido <b> latinha com uma fita entorno e um adesivo no tema escolhido,</b>', 'Taise Faria Alves', '2013-03-16 05:34:46', 1, 'Produto', 7, 'btnSalvarclick', '::1', 1),
(21, 'INSERT INTO `materiaprima` (`nome`, `valorcusto`) VALUES (''Latinha'', ''0,20'')', 'Taise Faria Alves', '2013-03-16 05:48:34', 1, 'Materiaprima', 3, 'btnSalvarclick', '::1', 1),
(22, 'Inserido <b> </b>', 'Taise Faria Alves', '2013-03-16 05:48:34', 1, 'Materiaprima', 7, 'btnSalvarclick', '::1', 1),
(23, 'Valor do campo <b>valorcusto</b> foi alterado de <b>0.00</b> para <b>0.20</b>.', 'Taise Faria Alves', '2013-03-16 05:49:24', 1, 'Materiaprima', 5, 'btnSalvarclick', '::1', 2),
(24, 'UPDATE `materiaprima` SET `nome` = ''Latinha'', `valorcusto` = ''0.20'' WHERE (1=1  and id_materiaprima = ''1'' )', 'Taise Faria Alves', '2013-03-16 05:49:24', 1, 'Materiaprima', 3, 'btnSalvarclick', '::1', 2),
(25, 'INSERT INTO `materiaprima` (`nome`, `valorcusto`) VALUES (''Fitilho'', ''0.05'')', 'Taise Faria Alves', '2013-03-16 05:49:49', 2, 'Materiaprima', 3, 'btnSalvarclick', '::1', 1),
(26, 'Inserido <b> </b>', 'Taise Faria Alves', '2013-03-16 05:49:49', 2, 'Materiaprima', 7, 'btnSalvarclick', '::1', 1),
(27, 'INSERT INTO `materiaprima` (`nome`, `valorcusto`) VALUES (''Tops'', ''1.90'')', 'Taise Faria Alves', '2013-03-16 05:50:20', 3, 'Materiaprima', 3, 'btnSalvarclick', '::1', 1),
(28, 'Inserido <b> </b>', 'Taise Faria Alves', '2013-03-16 05:50:20', 3, 'Materiaprima', 7, 'btnSalvarclick', '::1', 1),
(29, 'Valor do campo <b>medida</b> foi alterado de <b>vazio</b> para <b>unidade</b>.', 'Taise Faria Alves', '2013-03-16 05:56:18', 1, 'Materiaprima', 5, 'btnSalvarclick', '::1', 2),
(30, 'UPDATE `materiaprima` SET `nome` = ''Latinha'', `valorcusto` = ''0.20'', `medida` = ''unidade'' WHERE (1=1  and id_materiaprima = ''1'' )', 'Taise Faria Alves', '2013-03-16 05:56:18', 1, 'Materiaprima', 3, 'btnSalvarclick', '::1', 2),
(31, 'Valor do campo <b>valorcusto</b> foi alterado de <b>0.05</b> para <b>2.80</b>. <br /> Valor do campo <b>medida</b> foi alterado de <b>vazio</b> para <b>rolo</b>.', 'Taise Faria Alves', '2013-03-16 05:56:38', 2, 'Materiaprima', 5, 'btnSalvarclick', '::1', 2),
(32, 'UPDATE `materiaprima` SET `nome` = ''Fitilho'', `valorcusto` = ''2.80'', `medida` = ''rolo'' WHERE (1=1  and id_materiaprima = ''2'' )', 'Taise Faria Alves', '2013-03-16 05:56:38', 2, 'Materiaprima', 3, 'btnSalvarclick', '::1', 2),
(33, 'Valor do campo <b>nome</b> foi alterado de <b>Tops</b> para <b>Lacinhos</b>. <br /> Valor do campo <b>medida</b> foi alterado de <b>vazio</b> para <b>pacote 10 unidades</b>.', 'Taise Faria Alves', '2013-03-16 05:57:01', 3, 'Materiaprima', 5, 'btnSalvarclick', '::1', 2),
(34, 'UPDATE `materiaprima` SET `nome` = ''Lacinhos'', `valorcusto` = ''1.90'', `medida` = ''pacote 10 unidades'' WHERE (1=1  and id_materiaprima = ''3'' )', 'Taise Faria Alves', '2013-03-16 05:57:01', 3, 'Materiaprima', 3, 'btnSalvarclick', '::1', 2),
(35, 'Valor do campo <b>valorvenda</b> foi alterado de <b>vazio</b> para <b>2.50</b>. <br /> Valor do campo <b>valorcusto</b> foi alterado de <b>vazio</b> para <b>.85</b>.', 'Taise Faria Alves', '2013-03-16 06:03:27', 1, 'Produto', 5, 'btnSalvarclick', '::1', 2),
(36, 'UPDATE `produto` SET `ativo` = null, `destaque` = ''S'', `titulo` = ''Latinha Rosa'', `descricao` = ''latinha com uma fita entorno e um adesivo no tema escolhido,'', `valorvenda` = ''2.50'', `valorcusto` = ''.85'' WHERE (1=1  and id_produto = ''1'' )', 'Taise Faria Alves', '2013-03-16 06:03:27', 1, 'Produto', 3, 'btnSalvarclick', '::1', 2),
(37, 'INSERT INTO `produto` (`titulo`, `descricao`, `destaque`, `valorvenda`, `valorcusto`) VALUES (''Bisnaga 15g'', ''Bisnaga estilo de pasta de dentes, recheada com brigadeiro.'', ''N'', ''2.37'', ''0.95'')', 'Taise Faria Alves', '2013-03-17 12:49:19', 2, 'Produto', 3, 'btnSalvarclick', '::1', 1),
(38, 'Inserido <b> Bisnaga estilo de pasta de dentes, recheada com brigadeiro.</b>', 'Taise Faria Alves', '2013-03-17 12:49:19', 2, 'Produto', 7, 'btnSalvarclick', '::1', 1),
(39, 'INSERT INTO `cliente` (`nome`, `email`, `fone`, `fone2`, `fone3`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`) VALUES (''LEo'', ''leo@aaaa.com'', ''(99) 9999-9999'', ''(00) 0000-0000'', ''(33) 3333-3333'', ''rua anita'', ''340'', ''ap 299'', ''pretopolis'', ''porto alegre'', ''RS'', ''99.999.999'')', 'Taise Faria Alves', '2013-03-18 03:03:59', 1, 'Cliente', 3, 'btnSalvarclick', '::1', 1),
(40, 'Inserido <b> </b>', 'Taise Faria Alves', '2013-03-18 03:03:59', 1, 'Cliente', 7, 'btnSalvarclick', '::1', 1),
(41, 'INSERT INTO `cliente` (`nome`, `email`, `fone`, `fone2`, `fone3`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`) VALUES (''Leo'', ''leo@gmail.com'', ''(09) 9999-9999'', ''(22) 2222-2222'', ''(22) 2222-2222'', ''rua dos andradas'', ''09'', ''09'', ''asv'', ''porto alegre'', ''qw'', ''22.222.222'')', 'Taise Faria Alves', '2013-03-18 04:44:27', 2, 'Cliente', 3, 'btnSalvarclick', '201.37.162.96', 1),
(42, 'Inserido <b> </b>', 'Taise Faria Alves', '2013-03-18 04:44:27', 2, 'Cliente', 7, 'btnSalvarclick', '201.37.162.96', 1),
(43, 'Valor do campo <b>nome</b> foi alterado de <b>LEo</b> para <b>Maria</b>. <br /> Valor do campo <b>email</b> foi alterado de <b>leo@aaaa.com</b> para <b>Maria@terra.com</b>.', 'Administrador', '2013-03-18 04:48:28', 1, 'Cliente', 5, 'btnSalvarclick', '201.37.162.96', 2),
(44, 'UPDATE `cliente` SET `ativo` = ''S'', `nome` = ''Maria'', `email` = ''Maria@terra.com'', `fone` = ''(99) 9999-9999'', `fone2` = ''(00) 0000-0000'', `fone3` = ''(33) 3333-3333'', `logradouro` = ''rua anita'', `numero` = ''340'', `complemento` = ''ap 299'', `bairro` = ''pretopolis'', `cidade` = ''porto alegre'', `uf` = ''RS'', `cep` = ''99.999.999'' WHERE (1=1  and id_cliente = ''1'' )', 'Administrador', '2013-03-18 04:48:28', 1, 'Cliente', 3, 'btnSalvarclick', '201.37.162.96', 2),
(45, 'INSERT INTO `cliente` (`nome`, `email`, `fone`, `fone2`, `fone3`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`) VALUES (''Fulana da Silva'', ''fulana@terra.com.br'', null, null, null, null, null, null, null, null, null, null)', 'Administrador', '2013-03-18 16:03:33', 3, 'Cliente', 3, 'btnSalvarclick', '187.53.240.123', 1),
(46, 'Inserido <b> </b>', 'Administrador', '2013-03-18 16:03:33', 3, 'Cliente', 7, 'btnSalvarclick', '187.53.240.123', 1),
(47, 'INSERT INTO `cliente` (`nome`, `email`, `fone`, `fone2`, `fone3`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`) VALUES (''asdcasd'', ''asdcdsc'', null, null, null, null, null, null, null, null, null, null)', 'Administrador', '2013-03-18 16:09:50', 4, 'Cliente', 3, 'btnSalvarclick', '187.53.240.123', 1),
(48, 'Inserido <b> </b>', 'Administrador', '2013-03-18 16:09:50', 4, 'Cliente', 7, 'btnSalvarclick', '187.53.240.123', 1),
(49, 'INSERT INTO `cliente` (`ativo`, `nome`, `email`, `fone`, `fone2`, `fone3`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`) VALUES (''S'', ''ascac'', ''sadva'', null, null, null, null, null, null, null, null, null, null)', 'Administrador', '2013-03-18 16:10:38', 5, 'Cliente', 3, 'btnSalvarclick', '187.53.240.123', 1),
(50, 'Inserido <b> </b>', 'Administrador', '2013-03-18 16:10:38', 5, 'Cliente', 7, 'btnSalvarclick', '187.53.240.123', 1),
(51, 'INSERT INTO `ordem` (`ativo`, `percentdesconto`, `valdesconto`, `percententrada`, `valentrada`, `id_cliente`, `datapedido`, `dataentrega`, `numvezes`, `totalcusto`, `totalvenda`) VALUES (''S'', ''0'', ''0'', ''0'', ''0'', null, ''2013-03-18'', ''2013-03-29'', null, ''1.9'', ''4.74'')', 'Administrador', '2013-03-18 16:28:58', 1, 'Ordem', 3, 'btnSalvarclick', '187.53.240.123', 1),
(52, 'Inserido <b> </b>', 'Administrador', '2013-03-18 16:28:58', 1, 'Ordem', 7, 'btnSalvarclick', '187.53.240.123', 1),
(53, 'INSERT INTO `ordem` (`ativo`, `percentdesconto`, `valdesconto`, `percententrada`, `valentrada`, `datapedido`, `id_cliente`, `dataentrega`, `numvezes`, `totalcusto`, `totalvenda`) VALUES (''S'', ''0'', ''0'', ''0'', ''0'', ''2013-03-18'', null, ''2013-03-21'', null, ''1.9'', ''4.74'')', 'Administrador', '2013-03-18 18:23:52', 2, 'Ordem', 3, 'btnSalvarclick', '187.53.240.123', 1),
(54, 'Inserido <b> </b>', 'Administrador', '2013-03-18 18:23:52', 2, 'Ordem', 7, 'btnSalvarclick', '187.53.240.123', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiaprima`
--

CREATE TABLE IF NOT EXISTS `materiaprima` (
  `id_materiaprima` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_bin NOT NULL DEFAULT 'NULL',
  `valorcusto` decimal(10,2) DEFAULT NULL,
  `medida` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_materiaprima`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `materiaprima`
--

INSERT INTO `materiaprima` (`id_materiaprima`, `nome`, `valorcusto`, `medida`) VALUES
(1, 'Latinha', '0.20', 'unidade'),
(2, 'Fitilho', '2.80', 'rolo'),
(3, 'Lacinhos', '1.90', 'pacote 10 unidades');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiaproduto`
--

CREATE TABLE IF NOT EXISTS `materiaproduto` (
  `id_materiaproduto` int(11) NOT NULL AUTO_INCREMENT,
  `id_materiaprima` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_materiaproduto`),
  KEY `id_materiaprima` (`id_materiaprima`),
  KEY `id_produto` (`id_produto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE IF NOT EXISTS `ordem` (
  `id_ordem` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` char(1) COLLATE utf8_bin NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `datapedido` date DEFAULT NULL,
  `dataentrega` date DEFAULT NULL,
  `percententrada` int(3) DEFAULT NULL,
  `valentrada` decimal(10,2) DEFAULT NULL,
  `numvezes` int(2) DEFAULT NULL,
  `totalcusto` decimal(10,2) DEFAULT NULL,
  `totalvenda` decimal(10,2) DEFAULT NULL,
  `percentdesconto` int(3) DEFAULT NULL,
  `valdesconto` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_ordem`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `ordem`
--

INSERT INTO `ordem` (`id_ordem`, `ativo`, `id_cliente`, `datapedido`, `dataentrega`, `percententrada`, `valentrada`, `numvezes`, `totalcusto`, `totalvenda`, `percentdesconto`, `valdesconto`) VALUES
(1, 'S', NULL, '2013-03-18', '2013-03-29', 0, '0.00', NULL, '1.90', '4.74', 0, '0.00'),
(2, 'S', NULL, '2013-03-18', '2013-03-21', 0, '0.00', NULL, '1.90', '4.74', 0, '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemproduto`
--

CREATE TABLE IF NOT EXISTS `ordemproduto` (
  `id_ordemproduto` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordem` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valortotal` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id_ordemproduto`),
  KEY `id_ordem` (`id_ordem`),
  KEY `id_produto` (`id_produto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo` int(11) DEFAULT NULL,
  `ver` char(1) DEFAULT NULL,
  `inserir` char(1) DEFAULT NULL,
  `excluir` char(1) DEFAULT NULL,
  `editar` char(1) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_permissao`),
  KEY `permissao_id_processo_fkey` (`id_processo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id_permissao`, `id_processo`, `ver`, `inserir`, `excluir`, `editar`, `id_usuario`) VALUES
(1, 1, 'S', 'S', 'S', 'S', 1),
(2, 1, 'S', 'S', 'S', 'S', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processo`
--

CREATE TABLE IF NOT EXISTS `processo` (
  `id_processo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `controladores` varchar(160) DEFAULT NULL,
  PRIMARY KEY (`id_processo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `processo`
--

INSERT INTO `processo` (`id_processo`, `nome`, `descricao`, `controladores`) VALUES
(1, 'ALL', 'Acesso total ao sistema', NULL),
(2, 'CAD_PRODUTOS', 'Cadastro de Produtos', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` char(1) COLLATE utf8_bin DEFAULT NULL,
  `destaque` char(1) COLLATE utf8_bin DEFAULT NULL,
  `titulo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `descricao` mediumtext COLLATE utf8_bin,
  `valorvenda` decimal(10,2) DEFAULT NULL,
  `valorcusto` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `ativo`, `destaque`, `titulo`, `descricao`, `valorvenda`, `valorcusto`) VALUES
(1, NULL, 'S', 'Latinha Rosa', 'latinha com uma fita entorno e um adesivo no tema escolhido,', '2.50', '0.85'),
(2, NULL, 'N', 'Bisnaga 15g', 'Bisnaga estilo de pasta de dentes, recheada com brigadeiro.', '2.37', '0.95');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoproduto`
--

CREATE TABLE IF NOT EXISTS `tipoproduto` (
  `id_tipoproduto` int(11) NOT NULL AUTO_INCREMENT,
  `id_owner` int(11) DEFAULT NULL,
  `descricao` longtext,
  PRIMARY KEY (`id_tipoproduto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tipoproduto`
--

INSERT INTO `tipoproduto` (`id_tipoproduto`, `id_owner`, `descricao`) VALUES
(1, NULL, 'Seguranca Eletronica'),
(2, NULL, 'Cofres'),
(3, NULL, 'Chaves'),
(4, NULL, 'Latinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `loginuser` varchar(25) DEFAULT NULL,
  `nomecompleto` varchar(35) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `datasenha` date DEFAULT NULL,
  `tipo` varchar(7) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senhaemail` varchar(50) DEFAULT NULL,
  `assinaturaemail` longtext,
  `smtp` varchar(255) DEFAULT NULL,
  `porta` varchar(3) DEFAULT NULL,
  `grupo` int(11) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `excluivel` char(1) DEFAULT NULL,
  `editavel` char(1) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario_loginuser_key` (`loginuser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `loginuser`, `nomecompleto`, `senha`, `datasenha`, `tipo`, `email`, `senhaemail`, `assinaturaemail`, `smtp`, `porta`, `grupo`, `ativo`, `excluivel`, `editavel`, `id_empresa`) VALUES
(1, 'admin', 'Administrador', '28335c822634cc5f5992415058957371', '2012-05-12', 'user', NULL, NULL, NULL, NULL, NULL, 1, 'S', 'N', 'N', 1),
(5, 'taise', 'Taise Faria Alves', '2f312853d785497cea6acc1babab8b4d', '2013-03-15', 'user', 'muraldaslembrancinhas@gmail,com', NULL, NULL, NULL, NULL, -1, 'S', 'S', 'S', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
