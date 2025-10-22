-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/10/2025 às 03:45
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
-- Banco de dados: `filmes`
--
CREATE DATABASE IF NOT EXISTS `filmes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `filmes`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `ID_filme` int(11) NOT NULL,
  `NOME_filme` varchar(50) NOT NULL,
  `DURACAO_filme` time NOT NULL,
  `PRECO_filme` decimal(10,2) NOT NULL,
  `IMAGEM_filme` varchar(255) NOT NULL,
  `TEMA_filme` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`ID_filme`, `NOME_filme`, `DURACAO_filme`, `PRECO_filme`, `IMAGEM_filme`, `TEMA_filme`) VALUES
(1, 'macacolandia', '02:10:00', 19.20, 'img/macacolandia.jpg', 'terror'),
(2, 'casa lombrada', '05:00:00', 50.00, 'img/casalombrada.webp', 'comedia'),
(3, 'missão impossivel', '01:20:00', 24.00, 'img/missaoimpossivel.jpeg', 'ação'),
(6, 'panteras', '00:00:00', 76.90, 'img/pantera.jpg', 'terror');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`ID_filme`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `ID_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
