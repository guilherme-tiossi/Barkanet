DROP DATABASE IF EXISTS barkanet;
CREATE DATABASE barkanet;
USE barkanet;

CREATE TABLE `usuarios` (
 `id` int(20) NOT NULL AUTO_INCREMENT,
 `nome` varchar(30) NOT NULL,
 `email` varchar(100) NOT NULL,
 `senha` varchar(100) NOT NULL,
 `data_nasc` date NOT NULL,
 `codigo` varchar(7) NOT NULL,
 `bio` varchar(200) DEFAULT NULL,
 `profilepic` varchar(60) DEFAULT 'avatar.jpg',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`),
 UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

CREATE TABLE `tbposts` (
 `idpost` int(11) NOT NULL AUTO_INCREMENT,
 `usuario` int(20) NOT NULL,
 `nome` varchar(100) NOT NULL,
 `titulo` varchar(50) NOT NULL,
 `post` varchar(500) NOT NULL,
 `image` varchar(60) DEFAULT NULL,
 `profilepic` varchar(60) CHARACTER SET latin1 NOT NULL,
 `idgrupo` int(11) DEFAULT NULL,
 PRIMARY KEY (`idpost`),
 KEY `fk_usuario` (`usuario`),
 KEY `idgrupo` (`idgrupo`),
 CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `amigos` (
 `id` int(20) NOT NULL AUTO_INCREMENT,
 `id_de` int(20) NOT NULL,
 `id_para` int(20) NOT NULL,
 `status` int(20) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

CREATE TABLE `codes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(100) NOT NULL,
 `code` varchar(5) NOT NULL,
 `expire` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `code` (`code`),
 KEY `expire` (`expire`),
 KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `comentarios` (
 `id_com` int(11) NOT NULL AUTO_INCREMENT,
 `id_post` int(11) NOT NULL,
 `com_nome` varchar(100) NOT NULL,
 `com_user` int(20) NOT NULL,
 `comentario` text NOT NULL,
 `profilepic` varchar(60) CHARACTER SET latin1 NOT NULL,
 PRIMARY KEY (`id_com`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbgrupos` (
 `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
 `nome_grupo` varchar(60) NOT NULL,
 `descricao_grupo` text NOT NULL,
 `tipo_grupo` varchar(7) NOT NULL,
 `adm_grupo` int(20) NOT NULL,
 `foto_grupo` varchar(60) DEFAULT 'grupo.png',
 PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `membros_grupos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `id_adm` int(11) NOT NULL,
 `id_usuario` int(11) NOT NULL,
 `id_grupo` int(11) NOT NULL,
 `para` int(11) NOT NULL,
 `status` int(1) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`),
 KEY `membros_grupos_ibfk_1` (`id_usuario`),
 KEY `membros_grupos_ibfk_2` (`id_grupo`),
 CONSTRAINT `membros_grupos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
 CONSTRAINT `membros_grupos_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `tbgrupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_nasc`, `codigo`, `bio`, `profilepic`) VALUES
(31, 'Guilherme Tiossi', 'guilherme@tiossi.com', 'tiossi13y', '2005-03-28', '#4b6f1b', '', 'avatar.jpg'),
(32, 'Gabriela', 'gabitigre2015@gmail.com', 'senhagabi', '2005-01-12', '#8fc77c', '', 'avatar.jpg'),
(33, 'Kauã Pereira', 'kauapereira@gmail.com', 'kauasenha', '2005-02-15', '#f07af0', '', 'avatar.jpg'),
(34, 'Ana Luiza', 'hanahaninha@gmail.com', 'haninhasenha', '2005-01-30', '#3eee62', '', 'avatar.jpg'),
(35, 'Gustavo Gouveia', 'gustavogouveiaemail@email.com', 'gustavosenha', '2005-03-24', '#9632f0', '', 'avatar.jpg'),
(36, 'Leonardo Alves', 'leoincelironico@gmail.com', 'leozinhocenha', '2004-03-17', '#cce5f4', '', 'avatar.jpg'),
(37, 'Sol Ferreira', 'polvogemas@gmail.com', 'gemaspolvo', '2003-12-28', '#9bae43', '', 'avatar.jpg'),
(38, 'Celeste Strelow', 'cltstrelow@protonmail.com', 'senhaceleste', '2006-01-12', '#3f6430', '', 'avatar.jpg'),
(39, 'Giuliana Solange', 'giurealemo@protonmail.com', 'realemoonlyconsists', '2004-04-18', '#c159f9', '', 'avatar.jpg'),
(40, 'Henrique', 'henrique@email.com', 'henrique@email.com', '2005-04-07', '#000000', '', 'avatar.jpg');