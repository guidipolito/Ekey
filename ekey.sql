-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Out-2020 às 19:43
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ekey`
--
CREATE DATABASE IF NOT EXISTS `ekey` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ekey`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chave`
--

DROP TABLE IF EXISTS `chave`;
CREATE TABLE IF NOT EXISTS `chave` (
  `Id_chave` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_chave` varchar(140) NOT NULL,
  `Sobre_chave` varchar(2500) NOT NULL,
  `DataCriacao_chave` date DEFAULT current_timestamp(),
  `DataInicio_chave` date DEFAULT NULL,
  `Logo_chave` varchar(5000) DEFAULT NULL,
  `Banner_chave` varchar(5000) DEFAULT NULL,
  `NumeroTimes_chave` int(11) NOT NULL,
  `nick_link` varchar(250) NOT NULL,
  `publico` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id_chave`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chave`
--

INSERT INTO `chave` (`Id_chave`, `Nome_chave`, `Sobre_chave`, `DataCriacao_chave`, `DataInicio_chave`, `Logo_chave`, `Banner_chave`, `NumeroTimes_chave`, `nick_link`, `publico`) VALUES
(1, 'lol', 'Lol Ã© muito legal', NULL, NULL, 'https://i.pinimg.com/originals/4c/0b/51/4c0b5190cf49d2d3e16d8ab56c632b44.jpg', 'https://am-a.akamaihd.net/image?quality=preserve&f=https://lolstatic-a.akamaihd.net/frontpage/apps/prod/playnow-global/pt_BR/328566a634ec929c4fc0ec5507c3b42a3bd4fb36/assets/img/cover-1.jpg', 4, 'lolzin', 1),
(2, 'Torneio Do minnecraft', 'Ã‰ um torneio ficticio sobre minecraft', NULL, NULL, '', '', 2, 'minezito', 1),
(3, 'fdsf', 'fdsfsdf', NULL, NULL, '', 'https://am-a.akamaihd.net/image?quality=preserve&f=https://lolstatic-a.akamaihd.net/frontpage/apps/prod/playnow-global/pt_BR/328566a634ec929c4fc0ec5507c3b42a3bd4fb36/assets/img/cover-1.jpg', 2, 'fsdfsd', 1),
(4, 'Matos retardado', ' COmpetiÃ§Ã£o de quem fuma mais', NULL, NULL, '', '', 8, 'Maconha', 1),
(5, 'adasd', 'sadasd', NULL, NULL, '', '', 8, 'adasd', 1),
(6, 'testeee', 'sadsada', NULL, NULL, NULL, NULL, 4, 'sadsad', NULL),
(7, 'oieee', 'sdasdas', '2020-08-04', NULL, '', 'https://am-a.akamaihd.net/image?quality=preserve&f=https://lolstatic-a.akamaihd.net/frontpage/apps/prod/playnow-global/pt_BR/328566a634ec929c4fc0ec5507c3b42a3bd4fb36/assets/img/cover-1.jpg', 4, 'foda', 1),
(8, 'newteste', 'sadad', '2020-08-04', NULL, '', 'https://docplayer.com.br/docs-images/91/107509434/images/64-1.jpg', 2, 'dasa', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `Id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `Id_chave` int(11) DEFAULT NULL,
  `Nome_equipe` varchar(200) NOT NULL,
  `ImagemLink_equipe` varchar(5000) DEFAULT NULL,
  `Desc_equipe` varchar(450) DEFAULT NULL,
  `Email_equipe` varchar(500) DEFAULT NULL,
  `Numero_equipe` varchar(18) DEFAULT NULL,
  `Discord_equipe` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_equipe`),
  KEY `Id_chave` (`Id_chave`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`Id_equipe`, `Id_chave`, `Nome_equipe`, `ImagemLink_equipe`, `Desc_equipe`, `Email_equipe`, `Numero_equipe`, `Discord_equipe`) VALUES
(1, 1, 'Piracanjuba', 'https://upload.wikimedia.org/wikipedia/commons/7/75/Logo_piracanjuba.jpg', 'time da piracanjuba\r\n', NULL, NULL, NULL),
(12, 1, 'paina', '', '                      dsad\r\n           	\r\n           	', 'guilherme@hotmail.com', '', ''),
(3, 2, 'Milena', 'https://img.elo7.com.br/product/original/2695B09/papel-de-parede-unicornio-andressa-papel-de-parede-personalizado-com-foto.jpg', '', NULL, NULL, NULL),
(4, 2, 'pain', '', 'dsfd', NULL, NULL, NULL),
(5, 2, 'pain', '', 'dsfd', NULL, NULL, NULL),
(6, 3, 'PIKA', '', 'foda\r\n', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogadores`
--

DROP TABLE IF EXISTS `jogadores`;
CREATE TABLE IF NOT EXISTS `jogadores` (
  `Id_jogador` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_jogador` varchar(250) NOT NULL,
  `Desc_jogador` varchar(100) DEFAULT NULL,
  `NickGame_jogador` varchar(100) NOT NULL,
  `Numero_jogador` char(11) DEFAULT NULL,
  `Email_jogador` varchar(350) DEFAULT NULL,
  `Id_equipe` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_jogador`),
  KEY `Id_equipe` (`Id_equipe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `Id_usuario` int(11) DEFAULT NULL,
  `Id_chave` int(11) DEFAULT NULL,
  `Nivel_permissao` int(11) DEFAULT NULL,
  KEY `Id_usuario` (`Id_usuario`),
  KEY `Id_chave` (`Id_chave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`Id_usuario`, `Id_chave`, `Nivel_permissao`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(2, 6, 1),
(1, 7, 1),
(1, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissaotemporaria`
--

DROP TABLE IF EXISTS `permissaotemporaria`;
CREATE TABLE IF NOT EXISTS `permissaotemporaria` (
  `Codigo` varchar(20) NOT NULL,
  `Id_equipe` int(11) DEFAULT NULL,
  `Tempo` datetime DEFAULT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Id_equipe` (`Id_equipe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posicao`
--

DROP TABLE IF EXISTS `posicao`;
CREATE TABLE IF NOT EXISTS `posicao` (
  `id` varchar(10) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `id_chave` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posicao`
--

INSERT INTO `posicao` (`id`, `valor`, `id_chave`) VALUES
('j1t1', 0, 3),
('j1t2', 0, 2),
('j1t1', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

DROP TABLE IF EXISTS `solicitacao`;
CREATE TABLE IF NOT EXISTS `solicitacao` (
  `Id_solicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `Id_chave` int(11) DEFAULT NULL,
  `Email_solicitacao` varchar(250) NOT NULL,
  `Mensagem_solicitacao` varchar(500) NOT NULL,
  `Numero_solicitacao` char(11) DEFAULT NULL,
  `Discord_solicitacao` varchar(130) DEFAULT NULL,
  `ImagemLink_solicitacao` int(11) NOT NULL,
  `lida` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id_solicitacao`),
  KEY `Id_chave` (`Id_chave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `Id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_usuario` varchar(250) NOT NULL,
  `Senha_usuario` varchar(150) NOT NULL,
  `Nick_usuario` varchar(100) NOT NULL,
  `ImagemLink_usuario` varchar(5000) DEFAULT NULL,
  `Sobre_usuario` varchar(500) DEFAULT NULL,
  `DataEntrada_usuario` date DEFAULT current_timestamp(),
  `Email_usuario` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`Id_usuario`),
  UNIQUE KEY `Nick_usuario` (`Nick_usuario`),
  UNIQUE KEY `Email_usuario` (`Email_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`Id_usuario`, `Nome_usuario`, `Senha_usuario`, `Nick_usuario`, `ImagemLink_usuario`, `Sobre_usuario`, `DataEntrada_usuario`, `Email_usuario`) VALUES
(1, 'Guilherme', '54a4f116f738f5baa1c0fbdaab98c56b', 'guidipolito', NULL, NULL, '2020-03-26', 'guilhermepereiradipolito@hotmail.com'),
(2, 'MARIA', '81dc9bdb52d04dc20036dbd8313ed055', 'maria', NULL, NULL, '2020-07-20', 'mariablabla@hotmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
