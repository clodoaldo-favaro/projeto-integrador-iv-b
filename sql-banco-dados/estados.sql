-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Abr-2021 às 20:13
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `p_int`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `idPais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`id`, `nome`, `idPais`) VALUES
(0, 'PERNAMBUCO', 1),
(1, 'ACRE', 1),
(2, 'AMAZONAS', 1),
(3, 'AMAPÁ', 1),
(4, 'PARÁ', 1),
(5, 'RONDÔNIA', 1),
(6, 'RORAIMA', 1),
(7, 'TOCANTINS', 1),
(8, 'ALAGOAS', 1),
(9, 'BAHIA', 1),
(10, 'CEARÁ', 1),
(11, 'MARANHÃO', 1),
(12, 'PARAÍBA', 1),
(13, 'PERNAMBUCO', 1),
(14, 'PIAUÍ', 1),
(15, 'RIO GRANDE DO NORTE', 1),
(16, 'SERGIPE', 1),
(17, 'GOIÁS', 1),
(18, 'MATO GROSSO DO SUL', 1),
(19, 'MATO GROSSO', 1),
(20, 'ESPÍRITO SANTO', 1),
(21, 'MINAS GERAIS', 1),
(22, 'RIO DE JANEIRO', 1),
(23, 'SÃO PAULO', 1),
(24, 'PARANÁ', 1),
(25, 'RIO GRANDE DO SUL', 1),
(26, 'SANTA CATARINA', 1),
(27, 'DISTRITO FEDERAL', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estado_pais` (`idPais`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `estados`
--
ALTER TABLE `estados`
  ADD CONSTRAINT `fk_estado_pais` FOREIGN KEY (`idPais`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
