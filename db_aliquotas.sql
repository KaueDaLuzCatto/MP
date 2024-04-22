-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/04/2024 às 09:30
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_aliquotas`
--

CREATE TABLE `tb_aliquotas` (
  `id` int(4) NOT NULL,
  `codigo_municipio` int(10) NOT NULL,
  `data_vigencia` date NOT NULL,
  `codigo_servico` int(10) NOT NULL,
  `descricao_aliquota` varchar(30) DEFAULT NULL,
  `percentual_aliquota` decimal(5,2) DEFAULT NULL,
  `data_manutencao` date DEFAULT NULL,
  `hora_manutencao` time DEFAULT NULL,
  `usuario_manutencao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_aliquotas`
--

INSERT INTO `tb_aliquotas` (`id`, `codigo_municipio`, `data_vigencia`, `codigo_servico`, `descricao_aliquota`, `percentual_aliquota`, `data_manutencao`, `hora_manutencao`, `usuario_manutencao`) VALUES
(1, 12, '2025-01-12', 12, 'A primeira aliquota cadastrada', 30.00, '2024-02-12', '17:05:05', 'Kauê Catto'),
(3, 9131390, '2005-04-12', 9131390, 'Essa é um adescrição alterada', 45.00, '2005-01-12', '17:05:00', 'Kauê Catto'),
(5, 14, '2026-04-22', 11, 'Está é uma Aliquota', 25.00, '2024-04-22', '17:05:00', 'Kauê');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_aliquotas`
--
ALTER TABLE `tb_aliquotas`
  ADD PRIMARY KEY (`id`,`codigo_municipio`,`data_vigencia`,`codigo_servico`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_aliquotas`
--
ALTER TABLE `tb_aliquotas`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
