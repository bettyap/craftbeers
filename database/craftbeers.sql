-- --------------------------------------------------------
-- Servidor:                     remotemysql.com
-- Versão do servidor:           8.0.13-4 - Percona Server (GPL), Release '4', Revision 'f0a32b8'
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela zoNxSSpW7a.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `num_telefone` varchar(50) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela zoNxSSpW7a.usuario: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `num_telefone`, `senha`, `email`, `data_nasc`) VALUES
	(1, 'Elisabeth', '11973705483', '202cb962ac59075b964b07152d234b70', 'elis@hotmail.com', '1998-11-05'),
	(2, '2', '2', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'a@w', '2020-09-10'),
	(3, 'Rafa and Danailo', '11973705483', '81dc9bdb52d04dc20036dbd8313ed055', 'rafaedan@hotmail.com', '2020-09-05'),
	(4, 'Rafa and Danailo', '11973705483', '81dc9bdb52d04dc20036dbd8313ed055', 'rafaedan@hotmail.com', '2020-09-05'),
	(5, 'raffa and dan', '11973705483', '81dc9bdb52d04dc20036dbd8313ed055', 'raffaedan@live.com', '2020-09-08');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
