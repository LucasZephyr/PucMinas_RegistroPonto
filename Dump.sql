-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 19/05/2024 às 00:24
-- Versão do servidor: 5.7.23-23
-- Versão do PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestaoponto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ferias`
--

CREATE TABLE `ferias` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `duracao` int(11) DEFAULT NULL,
  `adiantamento_13` enum('sim','nao') DEFAULT NULL,
  `dias_adicionais` enum('sim','nao') DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL COMMENT '1- pendente, 2-aprovado, 3-reprovado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Estrutura para tabela `registros_ponto`
--

CREATE TABLE `registros_ponto` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema`
--

CREATE TABLE `sistema` (
  `id` int(11) NOT NULL,
  `nomeSistema` varchar(50) DEFAULT NULL,
  `icone` varchar(30) DEFAULT NULL,
  `titulo` varchar(20) DEFAULT NULL,
  `subtitulo` varchar(10) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `sistema`
--

INSERT INTO `sistema` (`id`, `nomeSistema`, `icone`, `titulo`, `subtitulo`, `descricao`) VALUES
(1, 'Registro de Ponto', 'icone.png', 'Puc Minas', 'Entrar', 'Esse sistema foi criado para obter a nota final no curso Desenvolvimento FullStack da faculdade Pucminas.'),

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacaoabonos`
--

CREATE TABLE `solicitacaoabonos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `batida1` time DEFAULT NULL,
  `batida2` time DEFAULT NULL,
  `batida3` time DEFAULT NULL,
  `batida4` time DEFAULT NULL,
  `batida5` time DEFAULT NULL,
  `batida6` time DEFAULT NULL,
  `justificativa` text,
  `dia` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 - pendente, 2 - aprovado, 3 - reprovado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data_cadastro` date NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `primeiro_acesso` char(1) DEFAULT '1',
  `telefone` varchar(20) DEFAULT NULL,
  `perfil` int(11) DEFAULT '1' COMMENT '1 - usuario basico, 2 - usuario admin',
  `data_nascimento` date DEFAULT NULL,
  `setor` varchar(50) DEFAULT NULL,
  `funcao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login`, `senha`, `data_cadastro`, `ativo`, `email`, `cpf`, `nome`, `primeiro_acesso`, `telefone`, `perfil`, `data_nascimento`, `setor`, `funcao`) VALUES
(1, 'usuario1', '123456789', '2023-01-01', 1, 'teste@gmail.com', '111.111.111-11', 'zephyr', '1', '00988776655', 1, '0000-00-00', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ferias`
--
ALTER TABLE `ferias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `registros_ponto`
--
ALTER TABLE `registros_ponto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `solicitacaoabonos`
--
ALTER TABLE `solicitacaoabonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ferias`
--
ALTER TABLE `ferias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `registros_ponto`
--
ALTER TABLE `registros_ponto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `sistema`
--
ALTER TABLE `sistema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `solicitacaoabonos`
--
ALTER TABLE `solicitacaoabonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ferias`
--
ALTER TABLE `ferias`
  ADD CONSTRAINT `ferias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `registros_ponto`
--
ALTER TABLE `registros_ponto`
  ADD CONSTRAINT `registros_ponto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `solicitacaoabonos`
--
ALTER TABLE `solicitacaoabonos`
  ADD CONSTRAINT `solicitacaoabonos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
