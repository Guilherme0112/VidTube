-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/10/2024 às 02:43
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
-- Banco de dados: `vidtube`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `emailAdmin` varchar(50) NOT NULL,
  `timeAdmin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ajuda`
--

CREATE TABLE `ajuda` (
  `idAjuda` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `textAjuda` text DEFAULT NULL,
  `timeAjuda` timestamp NOT NULL DEFAULT current_timestamp(),
  `situacao` varchar(20) DEFAULT 'Não Respondido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `idComment` int(11) NOT NULL,
  `idUserComment` int(11) NOT NULL,
  `idVideoComment` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `timeComment` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunidade`
--

CREATE TABLE `comunidade` (
  `idPost` int(11) NOT NULL,
  `idPostUser` int(11) DEFAULT NULL,
  `post` varchar(50) DEFAULT NULL,
  `descPost` text DEFAULT NULL,
  `timePost` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `likes`
--

CREATE TABLE `likes` (
  `idLike` int(11) NOT NULL,
  `videoLike` int(11) DEFAULT NULL,
  `userLike` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `respajuda`
--

CREATE TABLE `respajuda` (
  `idRespAjuda` int(11) NOT NULL,
  `idPostAjuda` int(11) DEFAULT NULL,
  `respAjuda` text DEFAULT NULL,
  `timePostAjuda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `seguir`
--

CREATE TABLE `seguir` (
  `idSeguir` int(11) NOT NULL,
  `idSeguindo` int(11) NOT NULL,
  `idSeguidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `photoProfile` varchar(60) DEFAULT '../styles/icons/user.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `videos`
--

CREATE TABLE `videos` (
  `idVideo` int(11) NOT NULL,
  `video` varchar(100) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `thumb` varchar(60) DEFAULT NULL,
  `userVideo` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Índices de tabela `ajuda`
--
ALTER TABLE `ajuda`
  ADD PRIMARY KEY (`idAjuda`),
  ADD KEY `idUser` (`idUser`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `idUserComment` (`idUserComment`);

--
-- Índices de tabela `comunidade`
--
ALTER TABLE `comunidade`
  ADD PRIMARY KEY (`idPost`);

--
-- Índices de tabela `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idLike`);

--
-- Índices de tabela `respajuda`
--
ALTER TABLE `respajuda`
  ADD PRIMARY KEY (`idRespAjuda`);

--
-- Índices de tabela `seguir`
--
ALTER TABLE `seguir`
  ADD PRIMARY KEY (`idSeguir`),
  ADD KEY `idSeguindo` (`idSeguindo`),
  ADD KEY `idSeguidor` (`idSeguidor`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`idVideo`),
  ADD KEY `userVideo` (`userVideo`);

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
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `comunidade`
--
ALTER TABLE `comunidade`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `likes`
--
ALTER TABLE `likes`
  MODIFY `idLike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `respajuda`
--
ALTER TABLE `respajuda`
  MODIFY `idRespAjuda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `seguir`
--
ALTER TABLE `seguir`
  MODIFY `idSeguir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `idVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ajuda`
--
ALTER TABLE `ajuda`
  ADD CONSTRAINT `ajuda_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idUserComment`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `seguir`
--
ALTER TABLE `seguir`
  ADD CONSTRAINT `seguir_ibfk_1` FOREIGN KEY (`idSeguindo`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguir_ibfk_2` FOREIGN KEY (`idSeguidor`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`userVideo`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
