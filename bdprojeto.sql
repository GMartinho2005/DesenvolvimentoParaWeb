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

-- A despejar estrutura para tabela web2.autores
DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `biografia` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela web2.autores: ~43 rows (aproximadamente)
INSERT INTO `autores` (`id`, `nome`, `biografia`) VALUES
	(1, 'João Tordo', 'João Tordo nasceu em Lisboa em 1975. Venceu o Prémio Literário José Saramago em 2009. É autor de vários romances de sucesso.'),
	(2, 'Armando Côrtes-Rodrigues', 'Poeta, dramaturgo e etnógrafo açoriano (1891-1971). Foi uma figura central do modernismo em Portugal e dedicou grande parte da sua vida ao estudo das tradições e do folclore dos Açores.'),
	(3, 'Arthur Conan Doyle', 'Escritor e médico britânico (1859-1930), mundialmente famoso por ter criado a personagem Sherlock Holmes. Além de policiais, escreveu ficção científica, peças de teatro e romances históricos.'),
	(4, 'Edgar Wallace', 'Jornalista, romancista e dramaturgo inglês (1875-1932). Um dos escritores mais prolíficos do século XX, conhecido pelos seus thrillers emocionantes e por ser um dos criadores de King Kong.'),
	(5, 'Arthur Machen', 'Autor e místico galês (1863-1947), conhecido pelas suas histórias de horror sobrenatural e fantástico. A sua obra influenciou grandemente H.P. Lovecraft.'),
	(6, 'G.A. Henty', 'Correspondente de guerra e autor inglês (1832-1902), conhecido pelas suas histórias de aventura histórica e patriotismo, muito populares entre os jovens da época vitoriana.'),
	(7, 'Patricia Wentworth', 'Escritora britânica de romances policiais (1878-1961). Criou a famosa personagem Miss Maud Silver, uma governanta reformada que se tornou detetive privada.'),
	(8, 'Bram Stoker', 'Romancista e contista irlandês (1847-1912), célebre mundialmente pelo seu romance gótico de 1897, "Drácula", que definiu o género de vampiros moderno.'),
	(9, 'Eça de Queirós', 'Um dos maiores escritores da literatura portuguesa (1845-1900). Mestre do realismo, conhecido pela sua fina ironia e crítica social aguçada à sociedade portuguesa do século XIX.'),
	(10, 'Luís de Camões', 'O maior poeta da língua portuguesa (c. 1524-1580). A sua vida boémia e aventureira culminou na escrita da epopeia "Os Lusíadas", que narra os descobrimentos portugueses.'),
	(11, 'Camilo Castelo Branco', 'O 1.º Visconde de Correia Botelho (1825-1890) foi um dos mais prolíficos escritores portugueses. A sua vida atribulada reflete-se na sua obra romântica e passional.'),
	(12, 'Raul Brandão', 'Militar, jornalista e escritor (1867-1930). A sua obra é marcada por um profundo lirismo e uma atenção especial ao sofrimento, aos pobres e aos humildes.'),
	(13, 'James Stephens', 'Novelista e poeta irlandês (1880-1950), conhecido pelos seus contos de fadas para adultos, misturando humor, filosofia e folclore irlandês.'),
	(14, 'L.M. Montgomery', 'Escritora canadiana (1874-1942), famosa mundialmente pela série "Anne of Green Gables". As suas obras são celebradas pela descrição da natureza e da vida em comunidade.'),
	(15, 'Lewis Carroll', 'Pseudónimo de Charles Lutwidge Dodgson (1832-1898), matemático e escritor inglês, mundialmente famoso por "Alice no País das Maravilhas".'),
	(16, 'Alexandre Herculano', 'Historiador, jornalista e poeta português (1810-1877), uma das figuras principais do Romantismo em Portugal.'),
	(17, 'Nicolau Tolentino de Almeida', 'Poeta satírico português (1740-1811), conhecido por retratar com humor e ironia a vida quotidiana e os costumes de Lisboa do seu tempo.'),
	(18, 'Francisco Ignácio Solano', 'Teórico musical e compositor português (c. 1720-1800), autor de importantes tratados sobre harmonia e contraponto no século XVIII.'),
	(19, 'Mário de Andrade', 'Poeta, musicólogo e crítico de arte brasileiro (1893-1945). Uma das figuras fundadoras do modernismo no Brasil e um estudioso profundo da música folclórica.'),
	(20, 'António José de Almeida', 'Médico e político português (1866-1929), foi o sexto Presidente da República Portuguesa e um orador eloquente sobre as questões do Estado.'),
	(21, 'João Henriques de Sousa', 'Diplomata e político (1662-1749), uma das figuras mais estrangeiradas e lúcidas do século XVIII português, com visão crítica sobre a economia do reino.'),
	(22, 'Santiago Camacho', 'Jornalista e escritor espanhol contemporâneo, especializado em temas de conspiração, biografia e atualidade económica.'),
	(23, 'Nicholas Patrick Wiseman', 'Cardeal e erudito católico (1802-1865), nascido em Sevilha. Ficou célebre pelo seu romance histórico "Fabíola", que retrata a igreja primitiva e os mártires.'),
	(24, 'Jean Cocteau', 'Poeta, romancista, dramaturgo e cineasta francês (1889-1963). Uma das figuras mais versáteis e influentes da vanguarda artística parisiense do século XX.'),
	(25, 'José de Alencar', 'Um dos maiores expoentes do romantismo brasileiro (1829-1877). A sua obra procurou fundar uma identidade nacional, destacando-se pelos romances indianistas como "O Guarani".'),
	(26, 'J.J. Benítez', 'Jornalista e escritor espanhol (n. 1946), mundialmente famoso pela saga "Cavalo de Troia" e pelas suas investigações controversas sobre ovnilogia e mistérios históricos.'),
	(27, 'Simon Schwartzman', 'Cientista social brasileiro (n. 1939), especialista em sociologia da ciência. A sua obra foca-se na história da ciência, tecnologia e educação no Brasil.'),
	(28, 'Hugo Verdera', 'Autor e investigador dedicado à cosmologia e à filosofia da ciência, explorando as grandes questões sobre a origem e o propósito do universo.'),
	(29, 'Thea Stilton', 'Pseudónimo de Elisabetta Dami. Nos livros, Thea é a irmã de Geronimo Stilton e enviada especial do "Diário dos Roedores", protagonizando aventuras cheias de mistério e amizade.'),
	(30, 'Eliezer Yudkowsky', 'Investigador de inteligência artificial e escritor norte-americano. Ficou famoso por escrever "Harry Potter e os Métodos da Racionalidade", uma obra que aplica o pensamento científico à magia.'),
	(31, 'Andrew Lang', 'Folclorista, poeta e crítico literário escocês (1844-1912). É mundialmente conhecido por colecionar contos de fadas e folclore de várias culturas nos seus "Livros das Cores".'),
	(32, 'Jean Webster', 'Escritora americana (1876-1916), conhecida pelos seus livros que retratam jovens mulheres vivazes e inteligentes, como no clássico "Daddy-Long-Legs".'),
	(33, 'Mark Twain', 'Escritor e humorista norte-americano (1835-1910). Conhecido como o "pai da literatura americana", famoso pelas aventuras de Tom Sawyer e Huckleberry Finn.'),
	(34, 'J.S. Fletcher', 'Jornalista e escritor inglês (1863-1935). Foi um dos autores mais prolíficos da "Idade de Ouro" da ficção policial, escrevendo mais de 230 livros.'),
	(35, 'Edith Nesbit', 'Autora e poetisa inglesa (1858-1924). Embora famosa pela literatura juvenil e fantasia, as suas obras contêm frequentemente elementos de mistério e aventura.'),
	(36, 'George Bernard Shaw', 'Dramaturgo, crítico e polemista irlandês (1856-1950). Vencedor do Prémio Nobel, é conhecido pelo seu espírito satírico e crítica social aguçada, usando o humor para desmontar convenções.'),
	(37, 'William Shakespeare', 'Poeta e dramaturgo inglês (1564-1616), frequentemente considerado o maior escritor de língua inglesa. Embora famoso pelas tragédias, as suas comédias são repletas de jogos de palavras e situações hilariantes.'),
	(38, 'George Barr McCutcheon', 'Romancista e dramaturgo norte-americano (1866-1928). Foi autor de vários best-sellers no início do século XX, conhecido por histórias leves, divertidas e de ritmo acelerado.'),
	(39, 'Booker T. Washington', 'Educador, autor e orador americano (1856-1915). Nascido escravo, tornou-se uma das figuras mais influentes da comunidade afro-americana no final do século XIX e início do século XX.'),
	(40, 'Solomon Northup', 'Abolicionista e autor americano (c. 1808-1863). Nascido livre em Nova Iorque, foi raptado e vendido como escravo, experiência que relatou nas suas memórias.'),
	(41, 'Santo Agostinho', 'Teólogo e filósofo (354-430), bispo de Hipona. Uma das figuras mais importantes no desenvolvimento do cristianismo ocidental e da filosofia.'),
	(42, 'Clifford Whittingham Beers', 'Fundador do movimento de higiene mental americano (1876-1943). A sua autobiografia detalha a sua luta contra a doença mental e o tratamento desumano nas instituições psiquiátricas da época.'),
	(43, 'Henry David Thoreau', 'Ensaísta, poeta e filósofo americano (1817-1862). Um transcendentalista conhecido pelo seu livro "Walden", uma reflexão sobre a vida simples em ambientes naturais.'),
	(44, 'Domício da Gama', 'Jornalista, contista e diplomata brasileiro (1862-1925). Membro fundador da Academia Brasileira de Letras, destacou-se pela sua escrita elegante e pela sua carreira diplomática em Washington.'),
	(45, 'Aquilino Ribeiro', 'Escritor português (1885-1963), proposto para o Prémio Nobel. Mestre da língua portuguesa, retratou como ninguém a vida rural, as tradições e a natureza, muitas vezes com uma linguagem rica e vernácula.'),
	(46, 'Johanna Spyri', 'Escritora suíça (1827-1901), mundialmente conhecida pela criação da personagem Heidi. As suas histórias retratam a vida nos Alpes com uma sensibilidade única para a psicologia infantil.'),
	(47, 'António de Serpa Pimentel', 'Político e escritor português (1825-1900). Além da sua carreira política como Ministro e Conselheiro, dedicou-se à poesia lírica, refletindo o gosto romântico da sua época.'),
	(48, 'Teste', 'Teste'),
	(49, 'Baguete', ''),
	(50, 'Baguete3', 'babaabaysdvsydvasd'),
	(51, 'autor', 'bio');

-- A despejar estrutura para tabela web2.avaliacoes
DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `livro_id` int NOT NULL,
  `user_id` int NOT NULL,
  `estrelas` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela web2.avaliacoes: ~48 rows (aproximadamente)
INSERT INTO `avaliacoes` (`id`, `livro_id`, `user_id`, `estrelas`) VALUES
	(1, 1, 10, 5),
	(2, 1, 25, 4),
	(3, 1, 12, 1),
	(4, 1, 13, 5),
	(5, 1, 13, 5),
	(6, 1, 17, 5),
	(7, 1, 6, 3),
	(8, 1, 6, 3),
	(9, 1, 6, 5),
	(10, 1, 5, 5),
	(11, 1, 8, 1),
	(12, 27, 6, 5),
	(13, 26, 6, 1),
	(14, 23, 6, 2),
	(15, 24, 6, 3),
	(16, 25, 6, 4),
	(17, 28, 6, 4),
	(18, 29, 6, 5),
	(19, 30, 6, 5),
	(20, 30, 5, 5),
	(21, 29, 5, 3),
	(22, 58, 5, 5),
	(23, 76, 9, 2),
	(24, 30, 9, 1),
	(25, 27, 9, 1),
	(26, 58, 9, 5),
	(27, 29, 9, 4),
	(28, 72, 6, 3),
	(29, 36, 6, 1),
	(30, 63, 6, 4),
	(31, 78, 6, 2),
	(32, 78, 5, 5),
	(33, 63, 5, 3),
	(34, 25, 5, 5),
	(35, 28, 5, 5),
	(36, 27, 5, 1),
	(37, 46, 5, 1),
	(38, 47, 5, 3),
	(39, 48, 5, 2),
	(40, 79, 5, 5),
	(41, 76, 5, 4),
	(42, 80, 5, 2),
	(43, 80, 6, 5),
	(44, 74, 6, 4),
	(45, 81, 6, 5),
	(46, 82, 6, 5),
	(47, 52, 6, 1),
	(48, 25, 11, 5),
	(49, 62, 11, 5);

-- A despejar estrutura para tabela web2.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(100) NOT NULL,
  `imagem_banner` varchar(255) DEFAULT NULL,
  `titulo_banner` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela web2.categorias: ~15 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nome`, `nome_url`, `imagem_banner`, `titulo_banner`) VALUES
	(1, 'Ficção Científica', 'ficcao', 'imgs/ficcao.jpeg', 'Para lá das estrelas, a imaginação não tem limites'),
	(2, 'Romance', 'romance', 'imgs/romance.jpeg', 'Histórias que tocam o coração'),
	(3, 'Fantasia', 'fantasia', 'imgs/fantasia.jpeg', 'Onde a magia é real e a aventura aguarda'),
	(4, 'Biografia', 'biografia', 'imgs/biografia.jpeg', 'Memórias, triunfos e lições de vida. O passado no presente'),
	(5, 'Literatura Clássica', 'classica', 'imgs/classica.jpeg', 'Obras que desafiam o tempo. Histórias que ficam para sempre'),
	(6, 'Conto', 'conto', 'imgs/conto.jpeg', 'Viagens rápidas a universos extraordinários'),
	(7, 'Finanças', 'financas', 'imgs/finan.jpeg', 'Domine o seu dinheiro. Construa o seu futuro'),
	(8, 'Especiais de Halloween', 'halloween', 'imgs/halloween.png', 'Os livros acabados de sair do caldeirão'),
	(9, 'História', 'historia', 'imgs/historia.jpeg', 'Viage no tempo. Conheça os eventos que mudaram o mundo'),
	(10, 'Humor', 'humor', 'imgs/humor.jpeg', 'A vida é melhor a rir. Encontre a sua próxima comédia'),
	(11, 'Melhor Avaliados', 'melhoravaliados', 'NULL', 'NULL'),
	(12, 'Literatura Musical', 'musica', 'imgs/musica.jpeg', 'Sinta a música em cada página'),
	(13, 'Novidades a Não Perder', 'novidadesnperder', 'NULL', 'NULL'),
	(14, 'Poesia', 'poesia', 'imgs/poesia.jpeg', 'Onde as palavras têm alma e a emoção ganha voz'),
	(15, 'Policial', 'policial', 'imgs/policial.jpeg', 'Entre no mundo dos detetives e dos segredos sombrios');

-- A despejar estrutura para tabela web2.favoritos
DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `livro_id` int NOT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_fav` (`user_id`,`livro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela web2.favoritos: ~21 rows (aproximadamente)
INSERT INTO `favoritos` (`id`, `user_id`, `livro_id`, `ativo`) VALUES
	(1, 5, 1, 1),
	(16, 6, 27, 0),
	(22, 5, 25, 0),
	(23, 5, 58, 1),
	(24, 6, 26, 0),
	(27, 6, 72, 0),
	(29, 6, 63, 0),
	(30, 6, 78, 1),
	(31, 5, 78, 0),
	(32, 5, 46, 0),
	(33, 5, 47, 0),
	(34, 5, 48, 1),
	(35, 5, 49, 0),
	(36, 5, 79, 1),
	(37, 6, 80, 0),
	(38, 6, 24, 0),
	(39, 6, 74, 0),
	(40, 6, 81, 1),
	(41, 6, 82, 1),
	(42, 11, 25, 1),
	(43, 11, 62, 1);

-- A despejar estrutura para tabela web2.livros
DROP TABLE IF EXISTS `livros`;
CREATE TABLE IF NOT EXISTS `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `descricao_curta` text,
  `sinopse_completa` text,
  `imagem_capa` varchar(255) DEFAULT NULL,
  `edicao` varchar(50) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `editora` varchar(100) DEFAULT NULL,
  `paginas` int DEFAULT NULL,
  `idioma` varchar(50) DEFAULT 'Português',
  `autor_id` int DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela web2.livros: ~59 rows (aproximadamente)
INSERT INTO `livros` (`id`, `categoria_id`, `titulo`, `autor`, `descricao_curta`, `sinopse_completa`, `imagem_capa`, `edicao`, `isbn`, `editora`, `paginas`, `idioma`, `autor_id`, `ativo`) VALUES
	(23, 8, 'A Bruxa: Scenas Açorianas', 'Armando Côrtes-Rodrigues', 'Um conto clássico sobre superstições e misticismo nos Açores.', 'Uma obra rara que mergulha nas tradições, medos e crenças do povo açoriano. Entre o real e o sobrenatural, "A Bruxa" explora o folclore local e o impacto do desconhecido numa pequena comunidade insular.', 'imgs/bruxas.jpg', 'Edição Histórica', '978-1294356496', 'Independente', 150, 'Português', 2, 1),
	(24, 8, 'Contos de Terror e Mistério', 'Arthur Conan Doyle', 'O criador de Sherlock Holmes mergulha no macabro.', 'Para além da lógica de Holmes, Conan Doyle escreveu histórias arrepiantes sobre o inexplicável. Esta coletânea reúne os seus melhores contos de horror, monstros e mistérios que desafiam a razão.', 'imgs/tales.jpg', 'Edição Internacional', '978-B0082Z3DYA', 'CreateSpace', 220, 'Inglês', 3, 1),
	(25, 8, 'O Vale do Medo', 'Arthur Conan Doyle', 'Um mistério sombrio com sociedades secretas.', 'Sherlock Holmes recebe uma mensagem cifrada que prevê um assassinato violento. A investigação leva-o a um solar antigo e a uma história pregressa de terror e sociedades secretas num vale mineiro nos EUA.', 'imgs/valley.jpg', 'Edição de Bolso', '978-1949460878', 'Penguin Books', 320, 'Inglês', 3, 1),
	(26, 8, 'O Anjo do Terror', 'Edgar Wallace', 'Uma vilã bela, fria e absolutamente letal.', 'Jean Briggerland é jovem, bonita e... perigosa. Onde quer que vá, a morte segue-a, mas ela nunca é apanhada. Um thriller de suspense clássico sobre uma das vilãs mais calculistas da literatura policial.', 'imgs/angel.jpg', 'Clássicos Crime', '978-B0F4NSDG3L', 'House of Stratus', 280, 'Inglês', 4, 1),
	(27, 8, 'O Terror: Um Mistério', 'Arthur Machen', 'Uma série de mortes inexplicáveis assombra o campo.', 'Durante a Grande Guerra, uma "onda de loucura" varre o País de Gales. Pessoas são encontradas mortas sem causa aparente. Não há suspeitos humanos. O que será que a natureza esconde nas suas sombras?', 'imgs/terrormystery.jpg', 'Horror Classics', '978-B018PL2NKA', 'Chaosium', 200, 'Inglês', 5, 1),
	(28, 8, 'No Reino do Terror', 'G.A. Henty', 'Sobrevivência durante a Revolução Francesa.', 'Um jovem inglês encontra-se em França durante o auge do Reino do Terror. Hospedado por uma família nobre, ele tem de usar toda a sua coragem para os salvar da guilhotina e da fúria de Robespierre.', 'imgs/reignofterror.jpg', 'Aventura Histórica', '978-B000HD7K6M', 'Dover Pub.', 310, 'Inglês', 6, 1),
	(29, 8, 'Casamento Sob o Terror', 'Patricia Wentworth', 'Amor e perigo nas sombras da guilhotina.', 'Um romance tenso ambientado na Revolução Francesa. Aline de Rochambeau é forçada a um casamento de conveniência para escapar à execução, mas o verdadeiro terror está apenas a começar.', 'imgs/marriage.jpg', 'Romance Histórico', '978-B00INITREG', 'Dean Street Press', 350, 'Inglês', 7, 1),
	(30, 8, 'Drácula', 'Bram Stoker', 'A obra-prima original do horror gótico.', 'A história definitiva do vampiro. Jonathan Harker viaja para a Transilvânia para fechar um negócio com o misterioso Conde Drácula, sem saber que está a libertar um mal antigo sobre a Londres vitoriana.', 'imgs/dracula.jpg', 'Edição Definitiva', '978-9354994709', 'Classics Reborn', 480, 'Inglês', 8, 1),
	(31, 5, 'Os Maias', 'Eça de Queirós', 'A obra-prima do realismo português sobre a decadência de uma família.', 'Uma sátira implacável à sociedade romântica e regeneradora do século XIX em Lisboa. A história foca-se na família Maia, especialmente no romance trágico e incestuoso entre Carlos da Maia e Maria Eduarda, tendo como pano de fundo a crítica de costumes de Eça.', 'imgs/maias.webp', 'Edição Livros do Brasil', '978-9723828399', 'Porto Editora', 700, 'Português', 9, 1),
	(32, 5, 'Os Lusíadas', 'Luís de Camões', 'A grande epopeia dos descobrimentos portugueses.', 'Publicado em 1572, este poema épico narra a viagem de Vasco da Gama à Índia, glorificando os feitos dos portugueses. Uma obra fundamental que mistura a história de Portugal com a mitologia clássica, num estilo sublime e heroico.', 'imgs/lusiadas.jpg', 'Edição Escolar', '978-9720049537', 'Porto Editora', 450, 'Português', 10, 1),
	(33, 5, 'Amor de Perdição', 'Camilo Castelo Branco', 'O derradeiro romance romântico: amor proibido e tragédia fatal.', 'A história apaixonada e trágica de Simão Botelho e Teresa de Albuquerque, membros de famílias rivais que são impedidos de se amar. Um drama intenso que leva ao exílio, à prisão e à morte, marcando o auge do Romantismo em Portugal.', 'imgs/perdicao.jpg', 'Clássicos Essenciais', '978-9896606041', 'Guerra e Paz', 220, 'Português', 11, 1),
	(34, 5, 'Os Pobres', 'Raul Brandão', 'Uma obra comovente sobre a humildade e a dor humana.', 'Um livro fragmentário e profundamente humano que dá voz aos desprotegidos, aos humilhados e aos esquecidos. Brandão utiliza uma linguagem poética e impressionista para retratar a miséria material e moral, mas também a dignidade da pobreza.', 'imgs/pobres.jpg', 'Edição Comemorativa', '978-9722100229', 'Caminho', 180, 'Português', 12, 1),
	(35, 5, 'O Mandarim', 'Eça de Queirós', 'Um conto fantástico sobre a moralidade e a cobiça.', 'Teodoro, um bacharel pobre, descobre que pode herdar uma fortuna incalculável se tocar numa campainha que matará um mandarim na China. Ele toca. Agora rico, viaja pelo mundo, mas é assombrado pela culpa do seu crime à distância.', 'imgs/mandarim.jpg', 'Bolso', '978-1903517802', 'Leya', 120, 'Português', 9, 1),
	(36, 5, 'O Pote de Ouro', 'James Stephens', 'Uma fábula irlandesa repleta de humor, filósofos e leprechauns.', 'Uma mistura única de filosofia, folclore irlandês e comédia. A história gira em torno de dois filósofos, as suas esposas, leprechauns que perderam o seu ouro e o deus Pan. Uma obra de fantasia clássica, bizarra e encantadora.', 'imgs/pote.jpg', 'Clássicos Fantasia', '978-0486415707', 'Dover Publications', 228, 'Português', 13, 1),
	(37, 5, 'Crónicas de Avonlea', 'L.M. Montgomery', 'Histórias encantadoras da vila de Anne de Green Gables.', 'Uma coleção de contos que se passam na aldeia fictícia de Avonlea. Embora Anne Shirley apareça em algumas histórias, o foco está nos habitantes peculiares e nas suas vidas comoventes, românticas e por vezes divertidas.', 'imgs/cronicas.jpg', 'Coleção Anne', '978-1442490000', 'Relógio D\'Água', 300, 'Português', 14, 1),
	(38, 5, 'Alice para os Pequenos', 'Lewis Carroll', 'A versão da Alice adaptada pelo próprio autor para crianças.', 'The Nursery "Alice" foi uma adaptação feita por Lewis Carroll para crianças até aos cinco anos. O texto é simplificado, conversando diretamente com o leitor, focando-se nas ilustrações e nos momentos mais icónicos do País das Maravilhas.', 'imgs/alice.jpg', 'Edição Ilustrada', '978-1509820500', 'Macmillan', 80, 'Português', 15, 1),
	(39, 12, 'S. Francisco de Assis', 'Alexandre Herculano', 'Uma obra que explora a vida do santo, frequentemente associada à musicalidade da sua poesia.', 'Embora Herculano seja conhecido pelos romances históricos, esta obra debruça-se sobre a figura de São Francisco. A inclusão nesta categoria deve-se à profunda ligação do santo com o "Cântico das Criaturas" e a inspiração musical que a sua vida gerou ao longo dos séculos.', 'imgs/assis.jpg', 'Edição Antiga', 'N/A', 'Livraria Bertrand', 200, 'Português', 16, 1),
	(40, 12, 'Pintura de um Outeiro Musical', 'Nicolau Tolentino de Almeida', 'Uma sátira deliciosa sobre os serões musicais da Lisboa antiga.', 'Nesta obra poética, Tolentino descreve com a sua habitual ironia um "outeiro" (serão poético-musical) às portas de Lisboa. O autor ridiculariza os costumes, a vaidade dos músicos amadores e a atmosfera social dos concertos de salão do século XVIII.', 'imgs/outeiro.jpg', 'Edição fac-similada', '978-9725650000', 'Imprensa Nacional', 80, 'Português', 17, 1),
	(41, 12, 'Nova Instrução Musical', 'Francisco Ignácio Solano', 'Um tratado fundamental sobre a teoria da música barroca portuguesa.', 'Publicado originalmente em 1764, este é um dos tratados mais importantes da história da música em Portugal. Solano expõe as regras do canto chão, do contraponto e da composição, oferecendo uma janela única para o ensino da música no século XVIII.', 'imgs/nova.jpg', 'Edição Histórica', 'N/A', 'Oficina de Miguel Manescal', 350, 'Português Antigo', 18, 1),
	(42, 12, 'Uma Arte de Música e Outros Ensaios', 'Mário de Andrade', 'Ensaios brilhantes sobre a estética musical e o modernismo.', 'Coletânea de textos onde Mário de Andrade reflete sobre a música brasileira, o folclore e a função social da arte. O livro reúne críticas, estudos técnicos e reflexões filosóficas de um dos maiores intelectuais da lusofonia.', 'imgs/arte.jpg', '1ª Edição Moderna', '978-8531400000', 'Edusp', 400, 'Português', 19, 1),
	(43, 7, 'Política e Finanças', 'António José de Almeida', 'Discursos e reflexões sobre a economia do estado português no início do séc. XX.', 'Uma recolha de intervenções parlamentares e artigos onde o estadista analisa a difícil situação financeira de Portugal na transição para a República. Uma leitura essencial para compreender a história económica portuguesa.', 'imgs/pol.jpg', 'Edição Parlamentar', 'N/A', 'Magalhães & Moniz', 300, 'Português', 20, 1),
	(44, 7, 'Discurso Político sobre o Juro', 'João Henriques de Sousa', 'Um tratado visionário do século XVIII sobre o dinheiro e a usura.', 'Neste texto clássico, o diplomata D. Luís da Cunha argumenta contra as leis que proibiam o empréstimo a juros, defendendo que a circulação de capital era essencial para o desenvolvimento económico do reino, numa visão muito à frente do seu tempo.', 'imgs/juros.jpg', 'Clássicos Economia', '978-9720000000', 'Banco de Portugal', 120, 'Português', 21, 1),
	(45, 7, 'Os Homens Mais Ricos do Mundo', 'Santiago Camacho', 'As biografias e segredos das maiores fortunas do planeta.', 'Santiago Camacho investiga a vida, as estratégias e, por vezes, os escândalos dos multimilionários que controlam a economia global. De magnatas da tecnologia a investidores lendários, o livro revela como construíram os seus impérios.', 'imgs/ricos.jpg', '1ª Edição PT', '978-9890000000', 'Esfera dos Livros', 280, 'Português', 22, 1),
	(46, 2, 'A Queda d\'um Anjo', 'Camilo Castelo Branco', 'Uma sátira mordaz à política e à corrupção moral.', 'Calisto Elói, um fidalgo conservador de província, é eleito deputado e vai para Lisboa. Na capital, o homem austero e moralista acaba por se deixar corromper pelos luxos e prazeres mundanos, transformando-se naquilo que mais criticava.', 'imgs/rom1.jpg', '5ª Edição', '978-972000001', 'Lello & Irmão', 320, 'Português', 11, 1),
	(47, 2, 'Fabíola: A Igreja das Catacumbas', 'Nicholas Patrick Wiseman', 'Um clássico romance histórico sobre a fé e o martírio na Roma Antiga.', 'A história passa-se em Roma, durante a perseguição aos cristãos sob o imperador Diocleciano. Fabíola, uma jovem nobre pagã, é tocada pela fé inabalável e pela coragem dos cristãos que a rodeiam, levando a uma profunda transformação espiritual.', 'imgs/rom2.jpg', 'Edição Clássica', '978-0332358658', 'Forgotten Books', 450, 'Português', 23, 1),
	(48, 2, 'Anathema', 'Camilo Castelo Branco', 'Um drama intenso sobre sacrifício, amor e convenções sociais.', 'Um dos romances mais emotivos de Camilo. A narrativa segue o infortúnio de personagens arrastadas por paixões avassaladoras e destinos cruéis, marcados pelo estigma social e pela tragédia romântica característica do autor.', 'imgs/rom3.jpg', '7ª Edição', '978-0366470183', 'Parceria A.M. Pereira', 280, 'Português', 11, 1),
	(49, 2, 'Os Meninos Diabólicos', 'Jean Cocteau', 'Uma obra-prima sobre a obsessão e o isolamento da juventude.', 'Paul e Elisabeth são irmãos que vivem isolados num quarto ("O Quarto"), criando um mundo de jogos privados e regras próprias. À medida que crescem, a sua relação intensa e claustrofóbica torna-se destrutiva para quem tenta entrar no seu universo.', 'imgs/rom4.jpg', '3ª Edição', '978-1020487165', 'Arcádia', 190, 'Português', 24, 1),
	(50, 2, 'O Guarany', 'José de Alencar', 'O romance fundador do indianismo brasileiro.', 'A história de amor entre Peri, um indígena goitacá, e Ceci, uma jovem branca da elite colonial. Peri é o herói idealizado que protege a sua amada contra inimigos e a natureza, simbolizando a união mítica das raças no Brasil.', 'imgs/rom5.jpg', '5ª Edição', '978-1016947135', 'B.L. Garnier', 400, 'Português', 25, 1),
	(51, 1, 'Os Astronautas de Javé', 'J.J. Benítez', 'Uma teoria controversa: seria Deus um astronauta?', 'Nesta obra audaciosa, J.J. Benítez analisa textos bíblicos e fenómenos históricos sob a ótica da ufologia. O autor propõe que muitos dos eventos atribuídos a Javé no Antigo Testamento podem ser interpretados como contactos com civilizações extraterrestres avançadas.', 'imgs/fic1.jpg', 'Edição Planeta', '978-8422632190', 'Círculo de Leitores', 350, 'Espanhol/Português', 26, 1),
	(52, 1, 'Um Espaço para a Ciência', 'Simon Schwartzman', 'A génese e evolução da comunidade científica no Brasil.', 'Uma análise profunda sobre como a ciência e a tecnologia se institucionalizaram no Brasil. O livro percorre desde as primeiras tentativas coloniais até à formação das grandes universidades e institutos de pesquisa modernos, explorando os desafios políticos e sociais da ciência.', 'imgs/fic2.jpg', '1ª Edição', '978-8570280180', 'MCT', 280, 'Português', 27, 1),
	(53, 1, 'O Universo Antrópico', 'Hugo Verdera', 'O cosmos foi afinado para a nossa existência?', 'Uma exploração fascinante do Princípio Antrópico. Verdera discute se as leis fundamentais da física e as constantes universais são uma coincidência extraordinária ou se o universo foi, de alguma forma, "desenhado" ou evoluiu especificamente para permitir o surgimento de vida inteligente.', 'imgs/fic3.jpg', 'Edição Académica', '978-1535234', 'Clave Intelectual', 220, 'Espanhol/Português', 28, 1),
	(54, 3, 'Thea Stilton e a Montanha de Fogo', 'Thea Stilton', 'As Thea Sisters embarcam numa aventura escaldante na Austrália.', 'As Thea Sisters viajam para a Austrália para investigar o desaparecimento de uma ovelha premiada num rancho. Mas a aventura torna-se perigosa quando descobrem segredos antigos e têm de enfrentar o calor do deserto e o mistério de uma montanha vulcânica.', 'imgs/fan1.jpg', 'Edição Scholastic', '978-0545150606', 'Scholastic Paperbacks', 160, 'Inglês', 29, 1),
	(55, 3, 'Harry Potter e os Métodos da Racionalidade', 'Eliezer Yudkowsky', 'E se Harry Potter fosse um génio da ciência em vez de um herói por acaso?', 'Nesta versão alternativa do universo de Hogwarts, Harry cresceu a ler livros de ciência e ficção científica. Quando descobre que é um feiticeiro, decide aplicar o método científico, a psicologia cognitiva e a racionalidade para compreender e dominar a magia.', 'imgs/fan2.jpg', 'Fanfiction HPMOR', 'N/A', 'Edição Online', 1200, 'Inglês', 30, 1),
	(56, 3, 'O Livro das Histórias de Animais', 'Andrew Lang', 'Uma coleção clássica de contos onde os animais são os protagonistas.', 'Uma antologia fascinante que reúne histórias reais e míticas sobre animais de todo o mundo. Desde a lealdade dos cães à astúcia das raposas, Lang compila narrativas que misturam o naturalismo com o encanto do folclore.', 'imgs/fan3.jpg', 'Edição Ilustrada', '978-1076075595', 'Independente', 400, 'Inglês', 31, 1),
	(57, 3, 'Quando a Patty foi para a Faculdade', 'Jean Webster', 'As peripécias divertidas e espirituosas de uma jovem universitária.', 'Embora seja mais uma obra de "college life", o tom leve e as situações quase irreais que Patty cria com a sua imaginação fértil dão-lhe um toque de fantasia do quotidiano. Acompanha as travessuras e o crescimento de uma rapariga que desafia as convenções.', 'imgs/fan4.jpg', 'Edição Clássica', '978-B0FQ3QCCX5', 'Public Domain', 250, 'Inglês', 32, 1),
	(58, 15, 'Tom Sawyer, Detetive', 'Mark Twain', 'Tom e Huck tentam resolver um mistério de roubo de diamantes e assassinato.', 'Numa paródia às novelas de detetives muito populares na época, Tom Sawyer tenta imitar Sherlock Holmes para resolver um crime complexo no Arkansas, envolvendo o roubo de diamantes e um homicídio misterioso, com a ajuda do seu fiel amigo Huck Finn.', 'imgs/pol1.jpg', 'Edição Anotada', '978-B097SLXC4X', 'L&PM', 180, 'Inglês/Português', 33, 1),
	(59, 15, 'O Mistério de Scarhaven', 'J.S. Fletcher', 'O desaparecimento de um ator famoso numa vila costeira cheia de segredos.', 'Bassett Oliver, um ator famoso, desaparece sem deixar rasto ao visitar as ruínas do castelo de Scarhaven. Copplestone, um dramaturgo, junta-se à investigação e descobre que a vila pitoresca esconde segredos sombrios, fraudes e crimes antigos.', 'imgs/pol2.jpg', 'Clássicos Crime', '978-B016NETRLO', 'Project Gutenberg', 250, 'Inglês', 34, 1),
	(60, 15, 'A História do Amuleto', 'Edith Nesbit', 'Um mistério antigo que atravessa o tempo e o espaço.', 'Cyril, Anthea, Robert e Jane encontram um amuleto egípcio antigo. Embora seja uma aventura de fantasia e viagens no tempo, a busca pela metade perdida do amuleto envolve dedução, investigação histórica e a resolução de enigmas complexos através de várias eras.', 'imgs/pol3.jpg', 'Edição Ilustrada', '978-B09K25MTRW', 'Puffin Classics', 300, 'Inglês', 35, 1),
	(61, 15, 'O Estranho Caso de Dr. Jekyll e Mr. Hyde', 'Robert Louis Stevenson', 'A investigação de um advogado sobre a ligação macabra entre um médico e um monstro.', 'O advogado Gabriel Utterson investiga a estranha relação entre o seu velho amigo, o respeitável Dr. Henry Jekyll, e o misantropo Edward Hyde. O que começa como um mistério criminal revela-se um estudo profundo sobre a dualidade da natureza humana.', 'imgs/pol4.jpg', 'Edição Bilíngue', '978-8551304968', 'Landmark', 160, 'Inglês/Português', NULL, 1),
	(62, 10, 'O Soldado de Chocolate', 'George Bernard Shaw', 'Uma sátira brilhante sobre a guerra e o romantismo idealizado.', 'Raina Petkoff está noiva de um herói de guerra, mas a sua vida muda quando um mercenário suíço invade o seu quarto. Ele carrega chocolates em vez de munições e desafia todas as noções românticas de heroísmo e amor. Uma das comédias mais espirituosas de Shaw.', 'imgs/hum1.jpg', 'Edição Teatro', '978-0486264763', 'Livros do Brasil', 120, 'Português', 36, 1),
	(63, 10, 'Os Dois Cavalheiros de Verona', 'William Shakespeare', 'Uma das primeiras comédias de Shakespeare sobre amizade, amor e um cão.', 'Proteus e Valentim são melhores amigos até se apaixonarem pela mesma mulher. Entre disfarces, traições, bandidos na floresta e as travessuras de Crab (o cão mais famoso de Shakespeare), esta peça explora de forma cómica a inconstância do coração humano.', 'imgs/hum2.jpg', 'Clássicos de Bolso', '978-972000002', 'Lello & Irmão', 180, 'Português', 37, 1),
	(64, 10, 'Os Milhões de Brewster', 'George Barr McCutcheon', 'O desafio cómico de gastar uma fortuna para herdar outra ainda maior.', 'Montgomery Brewster recebe uma herança insólita: deve gastar exatamente um milhão de dólares num ano, sem ficar com bens materiais e sem contar a ninguém, para poder herdar sete milhões. Uma corrida hilariante contra o tempo e o dinheiro.', 'imgs/hum3.jpg', 'Edição Clássica', '978-100000001', 'Europa-América', 250, 'Português', 38, 1),
	(65, 4, 'Memórias de um Negro Americano', 'Booker T. Washington', 'A inspiradora ascensão de um homem, da escravatura à liderança educacional.', 'A autobiografia clássica de Booker T. Washington, detalhando a sua experiência pessoal de ter nascido escravo durante a Guerra Civil, as dificuldades para obter educação e o seu trabalho na fundação do Instituto Tuskegee no Alabama.', 'imgs/bio1.jpg', 'Edição Clássica', '978-6556400770', 'Nova Fronteira', 240, 'Português', 39, 1),
	(66, 4, '12 Anos Escravo', 'Solomon Northup', 'O relato verídico e brutal de um homem livre raptado para a escravatura.', 'A narrativa na primeira pessoa de Solomon Northup, um cidadão livre de Nova Iorque que foi drogado, raptado e vendido como escravo no Sul profundo dos EUA, onde trabalhou em plantações durante 12 anos antes de conseguir a sua libertação.', 'imgs/bio2.jpg', 'Edição Filme', '978-1910173525', 'Penguin', 300, 'Inglês', 40, 1),
	(67, 4, 'Confissões', 'Santo Agostinho', 'A primeira autobiografia ocidental, narrando uma jornada espiritual profunda.', 'Escrito entre 397 e 400 d.C., Agostinho descreve a sua juventude pecaminosa e a sua conversão ao cristianismo. É uma obra fundamental não só para a teologia, mas como um marco na literatura autobiográfica pela sua introspeção psicológica.', 'imgs/bio3.jpg', 'Clássicos Penguin', '978-0140441147', 'Penguin Classics', 350, 'Inglês/Latim', 41, 1),
	(68, 4, 'Uma Mente Que Se Encontrou', 'Clifford Whittingham Beers', 'Um relato pioneiro sobre a doença mental e a reforma psiquiátrica.', 'A autobiografia de Clifford Beers, publicada em 1908, descreve a sua experiência como paciente em instituições psiquiátricas. O livro foi crucial para mudar a perceção pública sobre a doença mental e iniciou o movimento de reforma da saúde mental nos EUA.', 'imgs/bio4.jpg', '4ª Edição', '978-B0C5M659T6', 'Independente', 280, 'Inglês', 42, 1),
	(69, 4, 'Walden: Ou a Vida nos Bosques', 'Henry David Thoreau', 'Dois anos, dois meses e dois dias numa cabana à beira do lago.', 'Um relato da experiência de Thoreau a viver sozinho numa cabana que construiu perto do Lago Walden. O livro é parte memória pessoal e parte busca espiritual, defendendo a vida simples, a autossuficiência e a harmonia com a natureza.', 'imgs/bio5.jpg', 'Edição Anotada', '978-B0B4HJ2GJ9', 'Principis', 320, 'Inglês', 43, 1),
	(70, 9, 'História da Origem e Estabelecimento da Inquisição em Portugal', 'Alexandre Herculano', 'Uma análise histórica rigorosa e crítica sobre o tribunal do Santo Ofício.', 'Uma das obras mais polémicas e importantes da historiografia portuguesa. Herculano investiga as causas políticas e sociais que levaram à introdução da Inquisição em Portugal, desafiando as narrativas tradicionais e expondo as lutas de poder entre a Coroa e o Papado.', 'imgs/his1.jpg', 'Edição Crítica', '978-B09T6XPVS3', 'Bertrand Editora', 350, 'Português', 16, 1),
	(71, 9, 'Histórias Curtas', 'Domício da Gama', 'Narrativas breves que capturam o espírito e costumes de uma época.', 'Embora seja uma coleção de contos, esta obra é um documento histórico valioso sobre a sociedade do final do século XIX. Domício da Gama, com o seu olhar diplomático e literário, regista episódios que flutuam entre a ficção e a crónica de costumes.', 'imgs/his2.jpg', 'Edição Fac-símile', '978-1144048211', 'Nabu Press', 180, 'Português', 44, 1),
	(72, 9, 'História de Portugal', 'Alexandre Herculano', 'A obra monumental que fundou a historiografia moderna portuguesa.', 'Cobrindo desde os tempos mais remotos até ao reinado de D. Afonso III, esta obra-prima introduziu o método científico na história nacional. Herculano foca-se na vida social, municipal e política do povo, afastando-se da mera narrativa de batalhas e reis.', 'imgs/his3.jpg', 'Volume I', '978-9721000000', 'Livraria Bertrand', 500, 'Português', 16, 1),
	(73, 6, 'A Caixinha de Brinquedos', 'Aquilino Ribeiro', 'Histórias encantadoras que misturam a inocência infantil com a sabedoria popular.', 'Uma obra delicada onde Aquilino Ribeiro explora o imaginário infantil, tecendo contos que, embora pareçam simples brincadeiras, revelam a riqueza do folclore, da vida animal e das lições de vida no cenário rural português.', 'imgs/con1.jpg', 'Edição Bertrand', '978-9722524866', 'Bertrand Editora', 180, 'Português', 45, 1),
	(74, 6, 'O Castelo Encantado', 'Edith Nesbit', 'Três crianças, um castelo misterioso e um anel que concede desejos... com consequências.', 'Jerry, Jimmy e Kathleen encontram um castelo que parece saído de um conto de fadas. Lá, descobrem uma "princesa" adormecida (que é apenas a filha da governanta a brincar) e um anel mágico que torna os desejos realidade, criando situações hilariantes e por vezes assustadoras.', 'imgs/con2.jpg', 'Wordsworth Children', '978-1853261290', 'Wordsworth', 250, 'Inglês', 35, 1),
	(75, 6, 'Heidi', 'Johanna Spyri', 'A clássica história da menina órfã que vive nos Alpes suíços.', 'Heidi é enviada para viver com o seu avô recluso nas montanhas. Com a sua alegria contagiante, ela transforma a vida do avô, do pastor Pedro e da doente Clara. Uma celebração da natureza, da amizade e da bondade.', 'imgs/con3.jpg', 'Edição Ilustrada', '978-9916732574', 'Independente', 300, 'Inglês', 46, 1),
	(76, 6, 'O Mundo Perdido', 'Arthur Conan Doyle', 'Uma expedição a um planalto na Amazónia onde os dinossauros ainda vivem.', 'O Professor Challenger, um homem de temperamento explosivo, lidera uma expedição à América do Sul para provar que criaturas pré-históricas sobreviveram num planalto isolado. Uma das maiores aventuras de ficção científica e fantasia de sempre.', 'imgs/con4.jpg', 'Edição Centenário', '978-1952433210', 'SeaWolf Press', 280, 'Inglês', 3, 1),
	(77, 14, 'Poesias', 'Alexandre Herculano', 'Versos que definiram o Romantismo em Portugal, entre a fé e a pátria.', 'Nesta recolha, Herculano expressa a sua voz solene e meditativa. Os poemas abordam temas como a morte, a religiosidade profunda, o exílio e o amor à liberdade, marcando a transição para uma poesia mais introspetiva e social.', 'imgs/poe1.jpg', 'Edição Digital', '978-B004TY1S3Q', 'Porto Editora', 150, 'Português', 16, 1),
	(78, 14, 'Poesias: Líricas e Satíricas', 'António de Serpa Pimentel', 'Uma coleção rara de versos de uma figura proeminente do século XIX.', 'Esta obra reúne a produção poética de Serpa Pimentel, revelando uma faceta menos conhecida do político. Os seus versos flutuam entre o lirismo romântico típico da época e observações mais agudas sobre a sociedade em que vivia.', 'imgs/poe2.jpg', 'Classic Reprint', '978-0366348574', 'Forgotten Books', 120, 'Português', 47, 1),
	(79, 4, 'Teste', 'Teste', 'Teste Teste Teste Teste TesteTesteTesteTesteTesteTeste', 'TesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTesteTeste', 'imgs/livro_693d7d6fe7765.png', '1ª', '111-111111', 'Teste', 100, 'Português', 48, 0),
	(80, 2, 'Teste2', 'Baguete', 'RRRRRRRR', 'RRRRRRRRRRRRRRRRsafsafasafafasfsafas', 'imgs/livro_693d8b7db83f1.png', '4ª', '1111111111', 'RRRRRRRR', 102, 'Pt-Br', 49, 0),
	(81, 4, 'teste3', 'Baguete3', 'wqeqeqwqe qweqwewqe wqeqeq', 'wqeqeqwqe qweqwewqe wqeqeqwqeqeqwqe qweqwewqe wqeqeqwqeqeqwqe qweqwewqe wqeqeqwqeqeqwqe qweqwewqe wqeqeqwqeqeqwqe qweqwewqe wqeqeqwqeqeqwqe qweqwewqe wqeqeqwqeqeqwqe qweqwewqe wqeqeq', 'imgs/livro_693d913b20270.png', '4ª', '222222222', 'Teste', 12, 'Pt-Pt', 50, 0),
	(82, 14, 'novoteste', 'autor', '12313 eqweweqwqew ewqeq', ' eqweweqwqew ewqeq eqweweqwqew ewqeq eqweweqwqew ewqeq eqweweqwqew ewqeq  eqweweqwqew ewqeq eqweweqwqew ewqeq eqweweqwqew ewqeq  eqweweqwqew ewqeq', 'imgs/livro_693d92ed81b70.png', '1ª', '213123', 'ed', 123, 'Português', 51, 0);

-- A despejar estrutura para tabela web2.utilizador
DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_utilizador` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `data_registo` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_utilizador` (`nome_utilizador`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela web2.utilizador: ~10 rows (aproximadamente)
INSERT INTO `utilizador` (`id`, `nome_utilizador`, `email`, `password_hash`, `data_registo`, `ativo`) VALUES
	(1, 'Marco', '2@gmail.com', '$2y$10$zae.3cXRL5.ArZKTK/keLuOtSJZNDX7gqGRorPU.Ai4WJc2EoX9Ny', '2025-11-06 22:15:03', 1),
	(2, 'a', '21@gmail.com', '$2y$10$JW4WsTBG8OYnR9F0FXVLuu1HaILJeNBJJjmooXg8nr0BP0c/f4MXG', '2025-11-10 14:59:18', 1),
	(3, 'teste', 'teste@gmail.com', '$2y$10$2q2EWHcuje/3lzGUZbRaIOdbwAoUGLy6hpRvl02/OIBsfX0qZ.P0S', '2025-11-10 15:09:34', 1),
	(5, 'M', '1@gmail.com', '$2y$10$o.UQXZr4AFJpTPO3TKs8U.1jLG9FWsk8zNUwDCqzonxvljIizu5fy', '2025-11-12 09:32:08', 1),
	(6, 'N', 'N@gmail.com', '$2y$10$2uROZqEbxF0NRBbYDinXrOTlfO5KpwEGJAJHk413dg1a4DvRQzv1m', '2025-11-13 16:27:23', 1),
	(7, 'andre', 'andre@gmail.com', '$2y$10$YFsvRUZSViEMjHyADD6r5uSqP/Kr0EKp7FtJj57FVlrRHXXfBlB4y', '2025-11-17 15:22:11', 1),
	(8, 'B', 'b@gmail.com', '$2y$10$aV9PwlLgsPPoaQFSnWAwCu/UE.NUmcjBf2sOE2uBwgzwf/tJhhBM2', '2025-11-24 15:04:56', 1),
	(9, 's', 's@gmail.com', '$2y$10$LnDPur7IDNojk/l9eHwEwOKEvIzxi8bBnnLh7xXej6X3wfTaZNMdS', '2025-12-02 11:56:28', 1),
	(10, 'Dibola', 'D@gmail.com', '$2y$10$cL.j9K/Tlq1ofVv0QT/2Tu8ZFoAtmOzo4PXq0ejcpTUG/EwMfN8R2', '2025-12-13 16:40:08', 0),
	(11, 'V', 'V@gmail.com', '$2y$10$.l/50r3zwgVLdGdULctCq.XzL3hey4lkuvIByAteCltTMXMsdkMmq', '2025-12-13 16:51:04', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
