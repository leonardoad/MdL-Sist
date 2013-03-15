-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `topchaves`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99993 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

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
-- Estrutura da tabela `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `trocasenhatempo` char(1) DEFAULT NULL,
  `tempotrocasenha` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nomefantasia`, `razaosocial`, `endereco`, `cidade`, `bairro`, `uf`, `cep`, `telefone`, `fax`, `cnpj`, `inscricaoestadual`, `email`, `site`, `embratur`, `iata`, `snea`, `abav`, `responsavel`, `principal`, `editavel`) VALUES
(1, 'Sleifer Desenvolvimento', 'Sleifer Desenvolvimento', 'Rua Sudeo, 203', 'Viameo', 'Santa Isabel', 'RS', '94.480.450', '(51) 8575-9375', NULL, NULL, NULL, 'ismaelsleifer@gmail.com', 'www.sleifer.com.br', NULL, NULL, NULL, NULL, 'Ismael Sleifer', 'N', 'N'),
(3, 'Top Chaves', 'Top Chaves', 'rua tal', 'poa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdvsdavasds', 'N', 'S');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id_permissao`, `id_processo`, `ver`, `inserir`, `excluir`, `editar`, `id_usuario`) VALUES
(1, 1, 'S', 'S', 'S', 'S', 1),
(4, 1, 'S', 'S', 'S', 'S', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id_tipoproduto` int(11) DEFAULT NULL,
  `ativo` char(1) DEFAULT 'S',
  `destaque` char(1) DEFAULT 'S',
  `nome` varchar(50) DEFAULT NULL,
  `descricao` longtext,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `id_tipoproduto`, `ativo`, `destaque`, `nome`, `descricao`) VALUES
(1, 1, 'S', 'S', 'Video Porteiros', 'O Vedeo Porteiro e  um novo sistema de intercomunicaeo, atraves do qual identifica-se visualmente o visitante.'),
(2, 2, 'S', 'S', 'Cofre aes', 'Cofres altamente seguros e resistentes, em diversos tamanhos para aplicacaes diferenciadas.\r\n\r\nConstruidos em ao;\r\nVarios tamanhos;\r\nFacil instalao;\r\nBloqueio eletronico apos quatro tentativas incorretas;\r\nPinos de travamento em ao;\r\n\r\nCartao de abertura emergencial (em caso de esquecimento da senha);\r\nDurabilidade da bateria de ate 18 meses;\r\nSistema anti-travamento em caso de bateria fraca.'),
(3, 3, 'S', 'N', 'Chave em Oito', NULL),
(4, 2, 'S', 'N', 'Super megaboga Cofre', 'Feito de Aco inoxidavel ele nao inferroja nunca!'),
(5, 2, 'S', 'N', 'Caixa magnetica', 'Sim, magnetica!!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoproduto`
--

CREATE TABLE IF NOT EXISTS `tipoproduto` (
  `id_tipoproduto` int(11) NOT NULL AUTO_INCREMENT,
  `id_owner` int(11) DEFAULT NULL,
  `descricao` longtext,
  PRIMARY KEY (`id_tipoproduto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipoproduto`
--

INSERT INTO `tipoproduto` (`id_tipoproduto`, `id_owner`, `descricao`) VALUES
(1, NULL, 'Seguranca Eletronica'),
(2, NULL, 'Cofres'),
(3, NULL, 'Chaves');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `loginuser`, `nomecompleto`, `senha`, `datasenha`, `tipo`, `email`, `senhaemail`, `assinaturaemail`, `smtp`, `porta`, `grupo`, `ativo`, `excluivel`, `editavel`, `id_empresa`) VALUES
(1, 'admin', 'Administrador', '28335c822634cc5f5992415058957371', '2012-05-12', 'user', NULL, NULL, NULL, NULL, NULL, 1, 'S', 'N', 'N', 1),
(4, 'topchaves', 'Top chaves', 'c9c798587d38c675db95f1a321cb4692', '2012-07-08', 'user', 'topchaves@topchaves.com.br', NULL, NULL, NULL, NULL, -1, 'S', 'S', 'S', 3);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `permissao`
--
ALTER TABLE `permissao`
  ADD CONSTRAINT `permissao_id_processo_fkey` FOREIGN KEY (`id_processo`) REFERENCES `processo` (`id_processo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
