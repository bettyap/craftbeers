-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.14-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela craftbeers.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoria_usuario` (`usuario_id`),
  CONSTRAINT `FK_categoria_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela craftbeers.categoria: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `usuario_id`, `descricao`) VALUES
	(1, 1, 'Pilsen'),
	(2, 1, 'Alê'),
	(3, 1, 'Bock'),
	(4, 1, 'Lager'),
	(5, 1, 'Altbier'),
	(6, 1, 'Marzen'),
	(7, 6, 'Black'),
	(19, 6, 'Pilsen'),
	(30, 1, 'teste'),
	(31, 1, 'vamo q vamo'),
	(32, 8, 'Pilsen'),
	(33, 8, 'teste'),
	(34, 8, 't'),
	(35, 9, 'Pilsen'),
	(36, 9, 'T'),
	(37, 9, 'teste');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela craftbeers.etapa_producao
DROP TABLE IF EXISTS `etapa_producao`;
CREATE TABLE IF NOT EXISTS `etapa_producao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_processo` int(11) DEFAULT NULL,
  `tempo_restante` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_etapa_producao_usuario` (`id_usuario`),
  KEY `FK_etapa_producao_processo` (`id_processo`),
  CONSTRAINT `FK_etapa_producao_processo` FOREIGN KEY (`id_processo`) REFERENCES `processo` (`id`),
  CONSTRAINT `FK_etapa_producao_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela craftbeers.etapa_producao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `etapa_producao` DISABLE KEYS */;
INSERT INTO `etapa_producao` (`id`, `id_usuario`, `id_processo`, `tempo_restante`) VALUES
	(1, 1, 1, '00:01:00'),
	(2, 6, 2, '00:05:00');
/*!40000 ALTER TABLE `etapa_producao` ENABLE KEYS */;

-- Copiando estrutura para tabela craftbeers.processo
DROP TABLE IF EXISTS `processo`;
CREATE TABLE IF NOT EXISTS `processo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `tempo` time NOT NULL DEFAULT '00:00:00',
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_processo_categoria` (`id_categoria`),
  KEY `FK_processo_usuario` (`id_usuario`),
  CONSTRAINT `FK_processo_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `FK_processo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela craftbeers.processo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `processo` DISABLE KEYS */;
INSERT INTO `processo` (`id`, `id_categoria`, `nome`, `tempo`, `id_usuario`) VALUES
	(1, 1, 'pilsen', '00:02:10', 1),
	(2, 19, 'fermentacao', '00:15:00', 6);
/*!40000 ALTER TABLE `processo` ENABLE KEYS */;

-- Copiando estrutura para tabela craftbeers.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `num_telefone` varchar(50) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela craftbeers.usuario: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `num_telefone`, `senha`, `email`, `data_nasc`) VALUES
	(1, 'Elisabeth', '11973705483', '202cb962ac59075b964b07152d234b70', 'elis@hotmail.com', '1998-11-05'),
	(2, '2', '2', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'a@w', '2020-09-10'),
	(3, 'Rafa and Danailo', '11973705483', '81dc9bdb52d04dc20036dbd8313ed055', 'rafaedan@hotmail.com', '2020-09-05'),
	(4, 'Rafa and Danailo', '11973705483', '81dc9bdb52d04dc20036dbd8313ed055', 'rafaedan@hotmail.com', '2020-09-05'),
	(5, 'raffa and dan', '11973705483', '81dc9bdb52d04dc20036dbd8313ed055', 'raffaedan@live.com', '2020-09-08'),
	(6, 'Vitor', '2342344', '202cb962ac59075b964b07152d234b70', 'vitor@gmail', '1992-06-12'),
	(7, 'everson', '11111111', '81dc9bdb52d04dc20036dbd8313ed055', 'everson@gmail.com', '1992-01-14'),
	(8, 'Carlos', '11111111', '391194fb765414b6f32b76631d533f13', 'carlos@gmail.com', '1990-11-23'),
	(9, 'carlos', '11111111', '202cb962ac59075b964b07152d234b70', 'carlos@live.com', '2020-09-23');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
