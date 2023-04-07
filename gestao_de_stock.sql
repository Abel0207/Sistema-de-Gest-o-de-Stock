-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07-Abr-2023 às 07:40
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestao_de_stock`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(255) NOT NULL,
  `data_categoria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome_categoria`, `data_categoria`) VALUES
(4, 'Educação', '2023-04-05 12:58:06'),
(1, 'Industrial', '2023-04-05 12:57:29'),
(2, 'Comércio', '2023-04-05 12:57:29'),
(3, 'Prestação de Serviços', '2023-04-05 12:58:06'),
(5, 'Saúde', '2023-04-05 13:00:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `cod_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(400) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `telefone_cliente` varchar(9) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `nome_cliente`, `email_cliente`, `telefone_cliente`, `data_registro`) VALUES
(1, 'Vanda Pedro', 'vandapedro@gmail.com', '911782114', '2023-04-03 13:01:18'),
(2, 'André Mário', 'andretext@gmail.com', '911872114', '2023-04-03 14:36:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `decretos`
--

DROP TABLE IF EXISTS `decretos`;
CREATE TABLE IF NOT EXISTS `decretos` (
  `id_decreto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_decreto` varchar(255) NOT NULL,
  `pdf_decreto` varchar(255) NOT NULL,
  `numero_decreto` varchar(255) NOT NULL,
  `ambito_decreto` int(11) NOT NULL,
  `desc_decreto` varchar(1000) NOT NULL,
  `cria_decreto` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_decreto`),
  KEY `ambito_decreto` (`ambito_decreto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(500) NOT NULL,
  `logo_empresa` varchar(255) NOT NULL,
  `numero_empresa` varchar(9) NOT NULL,
  `email_empresa` varchar(255) NOT NULL,
  `endereco` varchar(500) NOT NULL,
  `nif_empresa` varchar(10) NOT NULL,
  `id_user_empresa` int(11) NOT NULL,
  `categoria_empresa` int(11) NOT NULL,
  `ramo_empresa` int(11) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `cad_empresa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_empresa`),
  KEY `id_user_empresa` (`id_user_empresa`),
  KEY `categoria_empresa` (`categoria_empresa`),
  KEY `ramo_empresa` (`ramo_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nome_empresa`, `logo_empresa`, `numero_empresa`, `email_empresa`, `endereco`, `nif_empresa`, `id_user_empresa`, `categoria_empresa`, `ramo_empresa`, `descricao`, `cad_empresa`) VALUES
(1, 'Catoca, LDA.', '642f4da2a12c6.png', '911872114', 'catocalda.geral@gmail.com', 'Rua Amilcar Cabral', '5554367821', 2, 1, 1, '<p>A Sociedade Mineira de Catoca Lda. &eacute; uma empresa angolana de prospec&ccedil;&atilde;o, explora&ccedil;&atilde;o, recupera&ccedil;&atilde;o e comercializa&ccedil;&atilde;o de diamantes.</p>\r\n<p>Constitu&iacute;da pela Endiama (Angola), Alrosa (R&uacute;ssia), e Lev Leviev International &ndash; LLI (China), Catoca &eacute; a quarta maior mina do Mundo explorado a c&eacute;u aberto e a maior empresa no subsector diamant&iacute;fero em Angola, sendo respons&aacute;vel pela extrac&ccedil;&atilde;o de mais de 75% dos diamantes angolanos.</p>', '2023-04-07 00:05:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id_forn` int(11) NOT NULL AUTO_INCREMENT,
  `nome_forn` varchar(255) NOT NULL,
  `tipo_forn` varchar(255) NOT NULL,
  `provincia_forn` varchar(255) NOT NULL DEFAULT '',
  `email_forn` varchar(255) NOT NULL,
  `telefone_forn` int(11) NOT NULL,
  `cadastro_forn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_forn`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id_forn`, `nome_forn`, `tipo_forn`, `provincia_forn`, `email_forn`, `telefone_forn`, `cadastro_forn`) VALUES
(1, 'Angoalissar', 'Empresa', 'Luanda', 'angoalissar@gmail.com', 942578818, '2023-01-16 14:15:27'),
(2, 'Apple', 'Empresa', 'Luanda', 'apple@exemplo.com', 911872114, '2023-03-29 19:58:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `nome_prod` varchar(255) NOT NULL,
  `imagem_prod` varchar(255) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `quantidade_prod` int(11) NOT NULL,
  `preco_compra` float NOT NULL,
  `preco_prod` float NOT NULL,
  `estado_prod` varchar(255) NOT NULL DEFAULT 'Em stock',
  `validade` timestamp NOT NULL,
  `criado_prod` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria` int(11) DEFAULT NULL,
  `fornecedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_prod`),
  KEY `categoria` (`categoria`),
  KEY `fornecedor` (`fornecedor`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_prod`, `nome_prod`, `imagem_prod`, `descricao`, `quantidade_prod`, `preco_compra`, `preco_prod`, `estado_prod`, `validade`, `criado_prod`, `categoria`, `fornecedor`) VALUES
(1, 'Maionese Delícia', '63b9d9e937932.png', 'Mayonese', 5, 1500, 2100, 'Em stock', '2024-01-06 23:00:00', '2023-01-07 00:00:00', 1, 0),
(8, 'Molho de Tomate ', '63c1368344565.jpg', 'Marca: Fugini', 0, 900, 1260, 'Em stock', '2023-01-11 23:00:00', '2023-01-13 00:00:00', 1, 0),
(3, 'Iphone 14', '63babbb2a70fb.jpg', 'Iphone 14 ', 2, 490000, 686000, 'Em stock', '2023-01-30 23:00:00', '2023-01-08 00:00:00', 2, 0),
(6, 'Iphone 14 Pro Max', '63c1234966748.jpg', 'Memória: 128G ', 2, 550000, 770000, 'Em stock', '2023-01-29 23:00:00', '2023-01-13 00:00:00', 2, 0),
(7, 'Cabo USB(Apple)', '63c12538676d5.jpg', 'Cor: Branca', 8, 3600, 5040, 'Em stock', '2023-01-13 23:00:00', '2023-01-13 00:00:00', 4, 0),
(9, 'Fone de Ouvido JBL', '63c6636bb0c5d.jpg', 'Cor: Preta', 3, 10000, 14000, 'Em stock', '2026-10-16 23:00:00', '2023-01-17 09:59:23', 4, NULL),
(10, 'MacBook Pro', '63c927023d89c.jpg', 'Cor: Branca', 2, 999990, 1399990, 'Em stock', '2025-12-18 23:00:00', '2023-01-19 12:18:26', 18, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ramos`
--

DROP TABLE IF EXISTS `ramos`;
CREATE TABLE IF NOT EXISTS `ramos` (
  `id_ramo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ramo` varchar(255) NOT NULL,
  `referencia_categoria` int(11) NOT NULL,
  `cad_ramo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ramo`),
  KEY `referencia_categoria` (`referencia_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ramos`
--

INSERT INTO `ramos` (`id_ramo`, `nome_ramo`, `referencia_categoria`, `cad_ramo`) VALUES
(1, 'Minas', 1, '2023-04-05 14:29:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `bi` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` int(11) NOT NULL,
  `nasc` date NOT NULL,
  `genero` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `acesso` varchar(255) NOT NULL DEFAULT 'Cliente',
  `data_cad` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nome`, `bi`, `email`, `telefone`, `nasc`, `genero`, `senha`, `acesso`, `data_cad`) VALUES
(1, 'Abel0207', 'Abel Nkele Canas', '000222185CA034', 'abelcanas92@gmail.com', 911872114, '2003-07-02', 'Masculino', '3a9805e668f25f61707342231c04e303', 'Admin', '2023-04-05 11:27:14'),
(2, 'Domingos16', 'Domingos Canas', '011222185CA034', 'domingos92@gmail.com', 933221037, '2017-03-15', 'Masculino', '25d55ad283aa400af464c76d713c07ad', 'Cliente', '2023-04-05 11:52:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `comprador` int(11) NOT NULL,
  `nome_comprador` varchar(255) NOT NULL,
  `vend` varchar(255) NOT NULL,
  `vendedor` varchar(255) NOT NULL,
  `qtd` int(11) NOT NULL,
  `preco_stock` float NOT NULL,
  `preco_pedido` float NOT NULL,
  `total` float NOT NULL,
  `cod_fat` varchar(8) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pedido`),
  KEY `id_produto` (`id_produto`),
  KEY `comprador` (`comprador`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id_pedido`, `id_produto`, `comprador`, `nome_comprador`, `vend`, `vendedor`, `qtd`, `preco_stock`, `preco_pedido`, `total`, `cod_fat`, `data_registro`) VALUES
(28, 6, 7, 'Domingos Canas', '1', 'Abel Canas', 1, 550000, 770000, 770000, '61354e9d', '2023-03-28 22:22:13'),
(26, 10, 7, 'Domingos Canas', '1', 'Abel Canas', 1, 999990, 1399990, 1399990, 'ae1e6fa0', '2023-03-28 21:16:00'),
(27, 9, 7, 'Domingos Canas', '1', 'Abel Canas', 1, 10000, 14000, 14000, 'ae1e6fa0', '2023-03-28 21:16:00'),
(29, 9, 7, 'Domingos Canas', '1', 'Abel Canas', 1, 10000, 14000, 14000, '61354e9d', '2023-03-28 22:22:13'),
(30, 7, 7, 'Domingos Canas', '1', 'Abel Canas', 1, 3600, 5040, 5040, '61354e9d', '2023-03-28 22:22:13'),
(31, 9, 7, 'Domingos Canas', '1', 'Abel Canas', 6, 10000, 14000, 84000, 'eb8a60fb', '2023-03-28 22:47:47'),
(32, 7, 1, 'Abel Canas', '1', 'Abel Canas', 1, 3600, 5040, 5040, '36d4f670', '2023-04-03 14:20:56'),
(33, 10, 1, 'Abel Canas', '1', 'Abel Canas', 1, 999990, 1399990, 1399990, 'e8414ebd', '2023-04-03 14:28:11'),
(34, 8, 1, 'Vanda Pedro', '1', 'Abel Canas', 1, 900, 1260, 1260, 'a28f6ecc', '2023-04-03 14:34:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
