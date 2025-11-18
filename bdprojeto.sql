-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- A despejar estrutura para tabela web2.utilizador
DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_utilizador` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `data_registo` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_utilizador` (`nome_utilizador`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela web2.utilizador: ~6 rows (aproximadamente)
INSERT INTO `utilizador` (`id`, `nome_utilizador`, `email`, `password_hash`, `data_registo`) VALUES
	(1, 'Marco', '2@gmail.com', '$2y$10$zae.3cXRL5.ArZKTK/keLuOtSJZNDX7gqGRorPU.Ai4WJc2EoX9Ny', '2025-11-06 22:15:03'),
	(2, 'a', '21@gmail.com', '$2y$10$JW4WsTBG8OYnR9F0FXVLuu1HaILJeNBJJjmooXg8nr0BP0c/f4MXG', '2025-11-10 14:59:18'),
	(3, 'teste', 'teste@gmail.com', '$2y$10$2q2EWHcuje/3lzGUZbRaIOdbwAoUGLy6hpRvl02/OIBsfX0qZ.P0S', '2025-11-10 15:09:34'),
	(5, 'M', '1@gmail.com', '$2y$10$IouTJ.GCumARXcXRUiaxrejGDUV8azvU1Ej7ukglAmMvdeTp4X/O.', '2025-11-12 09:32:08'),
	(6, 'N', 'N@gmail.com', '$2y$10$6v8QrlbbEyCIqyldRH9tSOo78HMl0tfS4wVjA4QtYLBEVJMOGZeJq', '2025-11-13 16:27:23'),
	(7, 'andre', 'andre@gmail.com', '$2y$10$YFsvRUZSViEMjHyADD6r5uSqP/Kr0EKp7FtJj57FVlrRHXXfBlB4y', '2025-11-17 15:22:11');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
