-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Fev-2022 às 18:32
-- Versão do servidor: 10.5.13-MariaDB-cll-lve
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u779945524_b`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carro`
--

CREATE TABLE `carro` (
  `id_carro` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `placa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int(11) NOT NULL,
  `imagem` varchar(9999) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `carro`
--

INSERT INTO `carro` (`id_carro`, `id_usuario`, `placa`, `modelo`, `cor`, `ano`, `imagem`) VALUES
(11, 7, 'MKAVW33H', 'Fusca', 'Amarelo', 2005, 'files/image_picker1580136261526175824.jpg'),
(13, 7, 'HKJ-2384', 'Ferrari', 'Vermelho', 2007, 'files/image_picker2973468780435794086.jpg'),
(14, 10, 'NNN-0000', 'Mercedes', 'Roxo', 2019, 'files/image_picker8473595603083669593.jpg'),
(18, 7, 'HJD-9233', 'Gurgel', 'Azul', 1990, 'files/image_picker4667831757868020845.png'),
(19, 8, 'POX4G21', 'Gol', 'Prata', 2020, 'files/image_picker330902642.jpg'),
(22, 8, 'BRA3R52', 'Argo', 'Vermelho', 2017, 'files/image_picker-1449149324.jpg'),
(23, 7, 'OWA3581', 'Prisma', 'Preta', 2014, 'files/image_picker6304754993033564497.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id_mensagem` bigint(20) UNSIGNED NOT NULL,
  `id_roubo` bigint(20) UNSIGNED DEFAULT NULL,
  `id_usuario_enviou` bigint(20) UNSIGNED NOT NULL,
  `id_usuario_recebeu` bigint(20) UNSIGNED DEFAULT NULL,
  `mensagem` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(9999) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`id_mensagem`, `id_roubo`, `id_usuario_enviou`, `id_usuario_recebeu`, `mensagem`, `imagem`) VALUES
(1, 8, 7, 10, 'Oi', NULL),
(2, 8, 7, 10, 'Eu encontrei seu carro próxima ao cemitério da minha casa', NULL),
(3, 8, 10, 7, 'Ótimo, me passa o endereço', NULL),
(4, 8, 7, 10, 'Só um minuto', NULL),
(5, 8, 10, 7, 'Cara, muito obrigado mesmo por está me ajudando, vc não sabe o sufoco que é conseguir dinheiro para pagar a prestação.', NULL),
(6, 8, 7, 10, 'Largo da Batata, 501, Nova Horizonte, Natal-RN', NULL),
(7, 8, 10, 7, 'Muito obrigado amigo, que Deus te abençoe.', NULL),
(10, 12, 8, 7, 'Ola', NULL),
(11, 12, 8, 7, 'Encontrei seu carro! ', NULL),
(12, 12, 8, 7, 'está na Av Ayrton Senna, perto do cidade Jardim', NULL),
(13, 12, 7, 8, 'Mas ele é um Fusca Amarelo mesmo?', NULL),
(14, 12, 7, 8, 'Vc conferiu a placa direitinho?', NULL),
(15, 12, 8, 7, 'Olá', NULL),
(16, 12, 8, 7, 'sim, é o Fusca amarelo mesmo', NULL),
(17, 12, 8, 7, 'com a placa informada na descrição', NULL),
(18, 12, 8, 7, 'Olá', NULL),
(21, 12, 8, 7, 'Olá novamente', NULL),
(22, 8, 7, 10, 'de nada', NULL),
(23, 8, 7, 10, 'Até mais', NULL),
(24, 8, 7, 10, 'Oi', NULL),
(25, 8, 7, 10, 'oi', NULL),
(26, 8, 7, 10, 'oi', NULL),
(27, 8, 7, 10, 'oi', NULL),
(28, 8, 7, 10, 'teste', NULL),
(29, 12, 7, 8, 'ola', NULL),
(30, 12, 8, 7, 'achei seu carro', NULL),
(31, 12, 7, 8, 'Serio?', NULL),
(32, 16, 8, 7, 'ola', NULL),
(33, 16, 7, 8, 'Oi', NULL),
(34, 16, 8, 7, 'achei o seu carro', NULL),
(35, 16, 7, 8, 'Onde?', NULL),
(36, 16, 8, 7, 'Av Ayrton Senna', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `roubo`
--

CREATE TABLE `roubo` (
  `id_roubo` bigint(20) UNSIGNED NOT NULL,
  `id_carro` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `cep` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `complemento` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adicional` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recompensa` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `roubo`
--

INSERT INTO `roubo` (`id_roubo`, `id_carro`, `id_usuario`, `cep`, `endereco`, `bairro`, `cidade`, `estado`, `pais`, `data`, `hora`, `complemento`, `adicional`, `recompensa`) VALUES
(8, 14, 10, '5900-000', 'Rua Noroeste', 'Barro Vermelho', 'Natal', 'Rio Grande do Norte', 'Brazil', '2022-01-13', '15:19:00', 'Próximo do mercado', NULL, 200.6),
(12, 11, 7, '5911-111', 'Rua Poti', 'Areia Branca', 'Natal', 'Rio Grande do Norte', 'Brazil', '2022-02-01', '04:40:00', '', NULL, 0),
(15, 22, 8, '59088100', 'Avenida Ayrton Senna', 'Neópolis', 'Natal', 'Rio Grande do Norte', 'Brazil', '2022-02-03', '13:10:00', 'Perto da farmácia pague menos', NULL, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(9999) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `nome`, `cpf`, `cep`, `cidade`, `estado`, `imagem`) VALUES
(2, 'w@w.w', '$2y$10$FfQcMyA/25gk7cqCC64nrO96Ud7SWmY6cVssKfsN1MvVJUrZHu..i', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'w@w.w2', '$2y$10$TC25Ch4CB4OZ47j.49BaCObJX6l9YyA.ErvmqwrPelXAxlKznQAHa', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'w@w.w3', '$2y$10$TXsW1eYU8Fl4PdvvBA0uLece5Qt.yrNojDxLLXEwf2jsFHmIjSILi', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'w@w.w4', '$2y$10$WqiJdsI.3FhC2CoiFGnUH.MlRaali/OJo3Lmg0r9yWtf.A4vWdJaq', 'Www', '2147483647', '12345678', '0', '0', NULL),
(6, 'wadson@email.com', '$2y$10$5qlzX/Qr20JbrFUHS8nYbuvp9wO4Qu4.DJf0J6.pQNZFvW0b.ntgW', 'Wadson', '12345678901', '12345678', 'Natal', 'RN', NULL),
(7, 'admin', '$2y$10$viZUEosTbu3u4Y8GMh0iwuTPR7J19uaKR3HAci7D1D8MapOPJcxbS', 'Wadson Pontes', '12345678901', '12345678', 'Natal', 'Rio Grande do Norte', 'files/image_picker8648634619957130619.jpg'),
(8, 'vitorgabo@hotmail.com', '$2y$10$NC6tTohczj33j5GoJW.quO7ASP1Ta1K7Uglon8kDnZ4x5.J3/0iLS', 'Vitor', '11111111111', '11111000', 'Natal', 'RN', 'files/image_picker-550297214.jpg'),
(10, 'teste@email.com', '$2y$10$1i3O/LmRy6L1WmJORypnXOj7GAJsVM1NotISqUWzeceBvkWHTVrg.', 'Felipe Oliveira', '12345678901', '12345789', 'Natal', 'RN', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`id_carro`),
  ADD UNIQUE KEY `id_carro` (`id_carro`);

--
-- Índices para tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id_mensagem`),
  ADD UNIQUE KEY `id_mensagem` (`id_mensagem`);

--
-- Índices para tabela `roubo`
--
ALTER TABLE `roubo`
  ADD PRIMARY KEY (`id_roubo`),
  ADD UNIQUE KEY `id_roubo` (`id_roubo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carro`
--
ALTER TABLE `carro`
  MODIFY `id_carro` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id_mensagem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `roubo`
--
ALTER TABLE `roubo`
  MODIFY `id_roubo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
