-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/04/2024 às 06:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_aliquotas`
--
CREATE DATABASE IF NOT EXISTS `db_aliquotas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_aliquotas`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_aliquotas`
--

CREATE TABLE IF NOT EXISTS `tb_aliquotas` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `codigo_municipio` int(10) NOT NULL,
  `data_vigencia` date NOT NULL,
  `codigo_servico` int(10) NOT NULL,
  `descricao_aliquota` varchar(30) DEFAULT NULL,
  `percentual_aliquota` decimal(5,2) DEFAULT NULL,
  `data_manutencao` date DEFAULT NULL,
  `hora_manutencao` time DEFAULT NULL,
  `usuario_manutencao` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`codigo_municipio`,`data_vigencia`,`codigo_servico`),
  KEY `indice` (`codigo_municipio`,`data_vigencia`,`codigo_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_aliquotas`
--

INSERT INTO `tb_aliquotas` (`id`, `codigo_municipio`, `data_vigencia`, `codigo_servico`, `descricao_aliquota`, `percentual_aliquota`, `data_manutencao`, `hora_manutencao`, `usuario_manutencao`) VALUES
(1, 12, '2025-01-12', 12, 'A primeira aliquota cadastrada', 37.00, '2024-02-12', '17:06:05', 'Kauê Catto'),
(3, 9131390, '2005-04-12', 9131390, 'Essa é um adescrição alterada', 45.00, '2005-01-12', '17:05:00', 'Kauê Catto'),
(5, 14, '2026-04-22', 11, 'Está é uma Aliquota', 25.00, '2024-04-22', '17:05:00', 'Kauê'),
(6, 11, '2025-04-28', 9, 'Está é uma Aliquota :)', 35.00, '2024-04-28', '19:24:00', 'Jorge');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_conta`
--

CREATE TABLE IF NOT EXISTS `tb_conta` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `codigo_municipio` int(10) NOT NULL,
  `data_vigencia` date NOT NULL,
  `conta` int(6) NOT NULL,
  `codigo_servico` int(10) NOT NULL,
  `data_manutencao` date DEFAULT NULL,
  `hora_manutencao` time DEFAULT NULL,
  `usuario_manutencao` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`codigo_municipio`,`data_vigencia`,`conta`),
  KEY `fk_tb_conta_tb_aliquotas` (`codigo_municipio`,`data_vigencia`,`codigo_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_conta`
--

INSERT INTO `tb_conta` (`id`, `codigo_municipio`, `data_vigencia`, `conta`, `codigo_servico`, `data_manutencao`, `hora_manutencao`, `usuario_manutencao`) VALUES
(1, 12, '2025-01-12', 120105, 12, '2024-02-12', '17:06:00', 'Kauê Catto');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_conta`
--
ALTER TABLE `tb_conta`
  ADD CONSTRAINT `fk_tb_conta_tb_aliquotas` FOREIGN KEY (`codigo_municipio`,`data_vigencia`,`codigo_servico`) REFERENCES `tb_aliquotas` (`codigo_municipio`, `data_vigencia`, `codigo_servico`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
