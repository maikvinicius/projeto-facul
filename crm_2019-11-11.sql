# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.38)
# Database: crm
# Generation Time: 2019-11-11 07:13:50 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Categoria_Cliente
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Categoria_Cliente`;

CREATE TABLE `Categoria_Cliente` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Categoria_Produto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Categoria_Produto`;

CREATE TABLE `Categoria_Produto` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Cliente
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Cliente`;

CREATE TABLE `Cliente` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `FK_Usuario_codigo` int(11) DEFAULT NULL,
  `FK_Captacao_codigo` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Contato
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Contato`;

CREATE TABLE `Contato` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `responsavel` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Empresa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Empresa`;

CREATE TABLE `Empresa` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Endereco
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Endereco`;

CREATE TABLE `Endereco` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `uf` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Etapa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Etapa`;

CREATE TABLE `Etapa` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordem` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ultima` int(11) NOT NULL DEFAULT '0',
  `inicial` int(11) NOT NULL DEFAULT '0',
  `final` int(11) NOT NULL DEFAULT '0',
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Item_Cat_Cliente
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Item_Cat_Cliente`;

CREATE TABLE `Item_Cat_Cliente` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FK_Categoria_Cliente_codigo` int(11) DEFAULT NULL,
  `FK_Cliente_codigo` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Item_Cat_Produto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Item_Cat_Produto`;

CREATE TABLE `Item_Cat_Produto` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FK_Categoria_Produto_codigo` int(11) DEFAULT NULL,
  `FK_Produto_codigo` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Item_Contato
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Item_Contato`;

CREATE TABLE `Item_Contato` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FK_Cliente_codigo` int(11) DEFAULT NULL,
  `FK_Contato_codigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Item_Endereco
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Item_Endereco`;

CREATE TABLE `Item_Endereco` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FK_Cliente_codigo` int(11) DEFAULT NULL,
  `FK_Endereco_codigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Item_Etapa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Item_Etapa`;

CREATE TABLE `Item_Etapa` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data_inicial` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_final` datetime DEFAULT NULL,
  `descricao` text,
  `FK_Usuario_Codigo` int(11) DEFAULT NULL,
  `FK_Etapa_Codigo` int(11) DEFAULT NULL,
  `FK_Venda_Codigo` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Item_Venda
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Item_Venda`;

CREATE TABLE `Item_Venda` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `desconto` double DEFAULT NULL,
  `FK_Venda_codigo` int(11) DEFAULT NULL,
  `FK_Produto_codigo` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Permissao
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Permissao`;

CREATE TABLE `Permissao` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `cat_cliente` varchar(255) DEFAULT NULL,
  `cronograma` varchar(255) DEFAULT NULL,
  `etapa` varchar(255) DEFAULT NULL,
  `projeto` varchar(255) DEFAULT NULL,
  `produto` varchar(255) DEFAULT NULL,
  `cat_produto` varchar(255) DEFAULT NULL,
  `relatorio` varchar(255) DEFAULT NULL,
  `FK_Usuario_codigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Produto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Produto`;

CREATE TABLE `Produto` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `preco` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `FK_Usuario_codigo` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Usuario`;

CREATE TABLE `Usuario` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `responsavel` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Venda
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Venda`;

CREATE TABLE `Venda` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `data_inicial` datetime DEFAULT NULL,
  `data_final` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `FK_Cliente_codigo` int(11) DEFAULT NULL,
  `FK_Usuario_codigo` int(11) DEFAULT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
