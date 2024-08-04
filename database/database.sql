-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/08/2024 às 02:21
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
-- Banco de dados: `acai`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `inputAdmin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ajuda`
--

CREATE TABLE `ajuda` (
  `idAjuda` int(11) NOT NULL,
  `idUserAjuda` int(11) NOT NULL,
  `titleAjuda` varchar(50) NOT NULL,
  `ajuda` text NOT NULL,
  `timeAjuda` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(40) NOT NULL DEFAULT 'Não Respondido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `idCarrinho` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `info`
--

CREATE TABLE `info` (
  `idAddress` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `endereco` text NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `rua` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `timeProduto` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Solicitado',
  `ownerProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `nomeProduct` varchar(50) NOT NULL,
  `ownerProduct` int(11) NOT NULL,
  `photoProduct` text DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `productcreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rajuda`
--

CREATE TABLE `rajuda` (
  `idResp` int(11) NOT NULL,
  `idStaff` int(11) NOT NULL,
  `resposta` text NOT NULL,
  `idPost` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `topicos`
--

CREATE TABLE `topicos` (
  `idTopico` int(11) NOT NULL,
  `userAdmin` int(11) NOT NULL,
  `titleT` varchar(50) NOT NULL,
  `topico` text NOT NULL,
  `timeTopico` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `email` varchar(55) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `timecreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `photoProfile` text NOT NULL DEFAULT '../assets/user.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `tel`, `cep`, `email`, `senha`, `timecreate`, `photoProfile`) VALUES
(2, 'Guilherme', '(63) 99132-4404', '773-10000', 'guimendesmen124@gmail.com', '12345', '2024-08-03 23:28:09', '../assets/user.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `admin` (`admin`);

--
-- Índices de tabela `ajuda`
--
ALTER TABLE `ajuda`
  ADD PRIMARY KEY (`idAjuda`),
  ADD KEY `idUserAjuda` (`idUserAjuda`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`idCarrinho`),
  ADD KEY `idProduto` (`idProduto`),
  ADD KEY `idUser` (`idUser`);

--
-- Índices de tabela `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`idAddress`),
  ADD KEY `idUser` (`idUser`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `ownerProduct` (`ownerProduct`);

--
-- Índices de tabela `rajuda`
--
ALTER TABLE `rajuda`
  ADD PRIMARY KEY (`idResp`);

--
-- Índices de tabela `topicos`
--
ALTER TABLE `topicos`
  ADD PRIMARY KEY (`idTopico`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ajuda`
--
ALTER TABLE `ajuda`
  MODIFY `idAjuda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `idCarrinho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `info`
--
ALTER TABLE `info`
  MODIFY `idAddress` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rajuda`
--
ALTER TABLE `rajuda`
  MODIFY `idResp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `topicos`
--
ALTER TABLE `topicos`
  MODIFY `idTopico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `ajuda`
--
ALTER TABLE `ajuda`
  ADD CONSTRAINT `ajuda_ibfk_1` FOREIGN KEY (`idUserAjuda`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `products` (`idProduct`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `products` (`idProduct`);

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`ownerProduct`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
