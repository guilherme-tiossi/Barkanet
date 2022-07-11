DROP DATABASE IF EXISTS barkanet;
CREATE DATABASE barkanet;
USE barkanet;

CREATE TABLE `usuarios` (
 `id` int(20) NOT NULL AUTO_INCREMENT,
 `nome` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `senha` varchar(100) NOT NULL,
 `data_nasc` date NOT NULL,
 `codigo` varchar(7) NOT NULL,
 `bio` text DEFAULT NULL,
 `profilepic` varchar(60) DEFAULT 'avatar.jpg',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`),
 UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

CREATE TABLE `tbposts` (
 `idpost` int(11) NOT NULL AUTO_INCREMENT,
 `usuario` int(20) NOT NULL,
 `nome` varchar(100) NOT NULL,
 `titulo` varchar(50) DEFAULT NULL,
 `post` varchar(100) DEFAULT NULL,
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
 PRIMARY KEY (`id_com`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbgrupos` (
 `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
 `nome_grupo` varchar(60) NOT NULL,
 `descricao_grupo` text NOT NULL,
 `tipo_grupo` varchar(7) NOT NULL,
 `adm_grupo` int(20) NOT NULL,
 PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `membros_grupos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `id_adm` int(11) NOT NULL,
 `id_usuario` int(11) NOT NULL,
 `id_grupo` int(11) NOT NULL,
 `status` int(1) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`),
 KEY `membros_grupos_ibfk_1` (`id_usuario`),
 KEY `membros_grupos_ibfk_2` (`id_grupo`),
 CONSTRAINT `membros_grupos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
 CONSTRAINT `membros_grupos_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `tbgrupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;