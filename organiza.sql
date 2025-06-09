CREATE DATABASE organiza;
use organiza;

-- Tabelas

-- Tabela: tipo_users
CREATE TABLE tipo_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_descricao TEXT
);


-- Tabela: users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vc_nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    dt_data_registro DATETIME NOT NULL,
    it_id_tipo_user INT,
    FOREIGN KEY (it_id_tipo_user) REFERENCES tipo_users(id)
);

-- Laravel Default Tables Start:
CREATE TABLE `password_reset_tokens` (
    `email` VARCHAR(255) PRIMARY KEY,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL
);

CREATE TABLE `sessions` (
    `id` VARCHAR(255) PRIMARY KEY,
    `user_id` BIGINT UNSIGNED NULL,
    `ip_address` VARCHAR(45) NULL,
    `user_agent` TEXT NULL,
    `payload` LONGTEXT NOT NULL,
    `last_activity` INT NOT NULL,
    INDEX `sessions_user_id_index` (`user_id`),
    INDEX `sessions_last_activity_index` (`last_activity`)
);

CREATE TABLE `cache` (
    `key` VARCHAR(255) PRIMARY KEY,
    `value` MEDIUMTEXT NOT NULL,
    `expiration` INT NOT NULL
);

CREATE TABLE `cache_locks` (
    `key` VARCHAR(255) PRIMARY KEY,
    `owner` VARCHAR(255) NOT NULL,
    `expiration` INT NOT NULL
);

CREATE TABLE `jobs` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `queue` VARCHAR(255) NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `attempts` TINYINT UNSIGNED NOT NULL,
    `reserved_at` INT UNSIGNED NULL,
    `available_at` INT UNSIGNED NOT NULL,
    `created_at` INT UNSIGNED NOT NULL,
    INDEX `jobs_queue_index` (`queue`)
);

CREATE TABLE `job_batches` (
    `id` VARCHAR(255) PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` LONGTEXT NOT NULL,
    `options` MEDIUMTEXT NULL,
    `cancelled_at` INT NULL,
    `created_at` INT NOT NULL,
    `finished_at` INT NULL
);

CREATE TABLE `failed_jobs` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `uuid` VARCHAR(255) NOT NULL UNIQUE,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Laravel Default Tables End:

-- Tabela: workplace
CREATE TABLE workplaces (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_descricao TEXT,
    dt_data_criacao DATETIME NOT NULL,
    it_id_user_criador INT,
    FOREIGN KEY (it_id_user_criador) REFERENCES users(id)
);

-- Tabela: quadros
CREATE TABLE quadros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_workplace INT,
    it_id_user_criador INT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_descricao TEXT,
    dt_data_criacao DATETIME NOT NULL,
    vc_visibilidade VARCHAR(50) NOT NULL,
    FOREIGN KEY (it_id_workplace) REFERENCES workplaces(id),
    FOREIGN KEY (it_id_user_criador) REFERENCES users(id)
);

-- Tabela: listas
CREATE TABLE listas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    vc_nome VARCHAR(255) NOT NULL,
    it_ordem INT NOT NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id)
);

-- Tabela: cartoes
CREATE TABLE cartaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_lista INT,
    it_id_user_criador INT,
    vc_titulo VARCHAR(255) NOT NULL,
    vc_descricao TEXT,
    dt_data_criacao DATETIME NOT NULL,
    dt_data_vencimento DATE,
    it_ordem INT NOT NULL,
    FOREIGN KEY (it_id_lista) REFERENCES listas(id),
    FOREIGN KEY (it_id_user_criador) REFERENCES users(id)
);

-- Tabela: etiqueta
CREATE TABLE etiquetas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_cor VARCHAR(7) NOT NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id)
);

-- Tabela: anexo
CREATE TABLE anexos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_user_upload INT,
    vc_nome_arquivo VARCHAR(255) NOT NULL,
    vc_caminho_arquivo VARCHAR(255) NOT NULL,
    dt_data_upload DATETIME NOT NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_user_upload) REFERENCES users(id)
);

-- Tabela: comentario
CREATE TABLE comentarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_user_autor INT,
    vc_texto TEXT NOT NULL,
    dt_data_criacao DATETIME NOT NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_user_autor) REFERENCES users(id)
);

-- Tabela: membro_quadro
CREATE TABLE membro_quadros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    it_id_user INT,
    vc_funcao VARCHAR(255) NOT NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id),
    FOREIGN KEY (it_id_user) REFERENCES users(id)
);

-- Tabela: cartao_etiqueta
CREATE TABLE cartao_etiquetas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_etiqueta INT,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_etiqueta) REFERENCES etiquetas(id)
);

-- Tabela: chat_mensagem
CREATE TABLE chat_mensagems (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    it_id_user_autor INT,
    vc_texto_mensagem TEXT NOT NULL,
    dt_data_envio DATETIME NOT NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id),
    FOREIGN KEY (it_id_user_autor) REFERENCES users(id)
);

-- Tabela: chat_anexo
CREATE TABLE chat_anexos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_chat_mensagem INT,
    it_id_user_upload INT,
    vc_nome_arquivo VARCHAR(255) NOT NULL,
    vc_caminho_arquivo VARCHAR(255) NOT NULL,
    dt_data_upload DATETIME NOT NULL,
    FOREIGN KEY (it_id_chat_mensagem) REFERENCES chat_mensagems(id),
    FOREIGN KEY (it_id_user_upload) REFERENCES users(id)
);

-- Tabela: membros_cartao
CREATE TABLE membro_cartaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_user INT,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_user) REFERENCES users(id)
);

-- Tabela: listas_verificacoes
CREATE TABLE listas_verificacaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    vc_nome VARCHAR(255) NOT NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id)
);

-- Tabela: itens_lista_verificacoes
CREATE TABLE itens_lista_verificacaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_lista_verificacao INT,
    vc_texto VARCHAR(255) NOT NULL,
    bt_completo BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (it_id_lista_verificacao) REFERENCES listas_verificacaos(id)
);

-- Tabela: membros_workplace
CREATE TABLE membro_workplaces (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_workplace INT,
    it_id_user INT,
    vc_funcao VARCHAR(255) NOT NULL,
    FOREIGN KEY (it_id_workplace) REFERENCES workplaces(id),
    FOREIGN KEY (it_id_user) REFERENCES users(id)
);

-- Tabela: membro_quadro_convites
CREATE TABLE membro_quadro_convites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    it_id_user_convidado INT,
    it_id_user_convidador INT,
    vc_status VARCHAR(50) NOT NULL,
    dt_data_envio DATETIME NOT NULL,
    dt_data_expiracao DATETIME,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id),
    FOREIGN KEY (it_id_user_convidado) REFERENCES users(id),
    FOREIGN KEY (it_id_user_convidador) REFERENCES users(id)
);

-- Tabela: membro_workplace_convites
CREATE TABLE membro_workplace_convites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_workplace INT,
    it_id_user_convidado INT,
    it_id_user_convidador INT,
    vc_status VARCHAR(50) NOT NULL,
    dt_data_envio DATETIME NOT NULL,
    dt_data_expiracao DATETIME,
    FOREIGN KEY (it_id_workplace) REFERENCES workplaces(id),
    FOREIGN KEY (it_id_user_convidado) REFERENCES users(id),
    FOREIGN KEY (it_id_user_convidador) REFERENCES users(id)
);




-- Inserts

-- Inserções para tipo_users
INSERT INTO tipo_users (vc_nome, vc_descricao) VALUES
('Administrador', 'Utilizador com permissões completas'),
('User', 'Utilizador com permissões básicas'),


-- Inserções para users
INSERT INTO users (vc_nome, email, password, dt_data_registro, it_id_tipo_user) VALUES
('Administrador', 'admin@email.com', '12345678', '2025-01-01 10:00:00', 1),
('Silvia Clara', 'clara@email.com', 'senha123', '2025-01-01 10:00:00', 1),
('Januário dos Santos', 'bruno.costa@email.com', 'abc123', '2025-01-02 14:30:00', 2),
('Dário Budjurra', 'budjurra@email.com', 'xyz123', '2025-01-03 09:15:00', 1),
('Isidro de Oliveira', 'isidro@email.com', 'pass2025', '2025-01-04 16:45:00', 2),
('Eva Pereira', 'eva@email.com', 'eva321', '2025-01-05 11:20:00', 1),
('Horácio Manuel', 'horacio@email.com', '12345678', '2025-01-06 13:10:00', 2);

-- Inserções para workplace
INSERT INTO workplaces (vc_nome, vc_descricao, dt_data_criacao, it_id_user_criador) VALUES
('Equipa Marketing', 'Espaço para campanhas de marketing', '2025-01-10 09:00:00', 1),
('Projecto TI', 'Gestão de desenvolvimento de software', '2025-01-11 14:00:00', 2),
('Plano Académico', 'Organização de tarefas escolares', '2025-01-12 10:30:00', 3),
('Evento Corporativo', 'Planeamento de eventos', '2025-01-13 15:15:00', 4),
('Design Gráfico', 'Projetos de design e branding', '2025-01-14 11:45:00', 5),
('Gestão Financeira', 'Controlo de orçamentos', '2025-01-15 13:20:00', 6);

-- Inserções para quadros
INSERT INTO quadros (it_id_workplace, it_id_user_criador, vc_nome, vc_descricao, dt_data_criacao, vc_visibilidade) VALUES
(1, 1, 'Campanha Janeiro', 'Planeamento da campanha de início de ano', '2025-01-16 08:00:00', 'privado'),
(1, 2, 'Redes Sociais', 'Gestão de posts e conteúdos', '2025-01-17 12:00:00', 'público'),
(2, 3, 'Desenvolvimento App', 'Tarefas do novo aplicativo', '2025-01-18 09:30:00', 'privado'),
(3, 4, 'Trabalhos Escolares', 'Organização de entregas', '2025-01-19 14:45:00', 'público'),
(4, 5, 'Evento Anual', 'Planeamento logístico', '2025-01-20 10:15:00', 'privado'),
(5, 6, 'Logotipo Novo', 'Criação de identidade visual', '2025-01-21 16:00:00', 'público');

-- Inserções para listas
INSERT INTO listas (it_id_quadro, vc_nome, it_ordem) VALUES
(1, 'A Fazer', 1),
(1, 'Em Progresso', 2),
(2, 'Ideias', 1),
(3, 'Backlog', 1),
(4, 'Pendentes', 1),
(5, 'Concluídos', 1);

-- Inserções para cartoes
INSERT INTO cartaos (it_id_lista, it_id_user_criador, vc_titulo, vc_descricao, dt_data_criacao, dt_data_vencimento, it_ordem) VALUES
(1, 1, 'Criar Banner', 'Banner para campanha de Janeiro', '2025-01-22 09:00:00', '2025-01-30', 1),
(2, 2, 'Reunião Equipa', 'Discutir progresso', '2025-01-23 14:00:00', '2025-01-25', 1),
(3, 3, 'Post Instagram', 'Publicar teaser da campanha', '2025-01-24 10:30:00', NULL, 1),
(4, 4, 'Corrigir Bugs', 'Resolver erros no app', '2025-01-25 15:00:00', '2025-02-01', 1),
(5, 5, 'Planeamento Catering', 'Definir menu do evento', '2025-01-26 11:00:00', '2025-02-05', 1),
(6, 6, 'Aprovar Design', 'Revisão final do logotipo', '2025-01-27 13:00:00', '2025-01-31', 1);

-- Inserções para etiqueta
INSERT INTO etiquetas (it_id_quadro, vc_nome, vc_cor) VALUES
(1, 'Urgente', '#FF0000'),
(2, 'Social Media', '#00FF00'),
(3, 'Prioridade Alta', '#FF4500'),
(4, 'Baixa Prioridade', '#87CEEB'),
(5, 'Logística', '#FFD700'),
(6, 'Design', '#800080');

-- Inserções para anexo
INSERT INTO anexos (it_id_cartao, it_id_user_upload, vc_nome_arquivo, vc_caminho_arquivo, dt_data_upload) VALUES
(1, 1, 'banner_draft.jpg', '/uploads/banner_draft.jpg', '2025-01-28 09:30:00'),
(2, 2, 'agenda.pdf', '/uploads/agenda.pdf', '2025-01-28 14:15:00'),
(3, 3, 'teaser.png', '/uploads/teaser.png', '2025-01-28 10:45:00'),
(4, 4, 'bug_report.docx', '/uploads/bug_report.docx', '2025-01-28 15:30:00'),
(5, 5, 'menu_proposta.pdf', '/uploads/menu_proposta.pdf', '2025-01-28 11:20:00'),
(6, 6, 'logo_v1.png', '/uploads/logo_v1.png', '2025-01-28 13:10:00');

-- Inserções para comentario
INSERT INTO comentarios (it_id_cartao, it_id_user_autor, vc_texto, dt_data_criacao) VALUES
(1, 2, 'O banner precisa de mais contraste.', '2025-01-29 09:00:00'),
(2, 3, 'Confirmada para as 14h.', '2025-01-29 14:00:00'),
(3, 4, 'A imagem está pronta?', '2025-01-29 10:30:00'),
(4, 5, 'Corrigi dois bugs hoje.', '2025-01-29 15:00:00'),
(5, 6, 'Sugiro adicionar sobremesa.', '2025-01-29 11:15:00'),
(6, 1, 'Aprovado com ajustes menores.', '2025-01-29 13:20:00');

-- Inserções para membro_quadro
INSERT INTO membro_quadros (it_id_quadro, it_id_user, vc_funcao) VALUES
(1, 1, 'Administrador'),
(1, 2, 'Editor'),
(2, 3, 'Membro'),
(3, 4, 'Gestor'),
(4, 5, 'Editor'),
(5, 6, 'Administrador');

-- Inserções para cartao_etiqueta
INSERT INTO cartao_etiquetas (it_id_cartao, it_id_etiqueta) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- Inserções para chat_mensagem
INSERT INTO chat_mensagems (it_id_quadro, it_id_user_autor, vc_texto_mensagem, dt_data_envio) VALUES
(1, 1, 'Equipa, precisamos acelerar.', '2025-01-30 09:00:00'),
(2, 2, 'Alguém viu o plano?', '2025-01-30 12:00:00'),
(3, 3, 'Reunião amanhã às 12h:30min.', '2025-01-30 10:30:00'),
(4, 4, 'Progresso está fixe!', '2025-01-30 15:00:00'),
(5, 5, 'Confio no vosso trabalho, acho kkk.', '2025-01-30 11:00:00'),
(6, 6, 'Design finalizado hoje?', '2025-01-30 13:00:00');

-- Inserções para chat_anexo
INSERT INTO chat_anexos (it_id_chat_mensagem, it_id_user_upload, vc_nome_arquivo, vc_caminho_arquivo, dt_data_upload) VALUES
(1, 1, 'plano.jpg', '/uploads/plano.jpg', '2025-01-30 09:05:00'),
(2, 2, 'posts.csv', '/uploads/posts.xlsx', '2025-01-30 12:05:00'),
(3, 3, 'descriao?projecto.pdf', '/uploads/agenda_chat.pdf', '2025-01-30 10:35:00'),
(4, 4, 'print_do_bug.png', '/uploads/screenshot.png', '2025-01-30 15:05:00'),
(5, 5, 'nota.txt', '/uploads/nota.txt', '2025-01-30 11:05:00'),
(6, 6, 'logo_final.png', '/uploads/logo_final.png', '2025-01-30 13:05:00');

-- Inserções para membros_cartao
INSERT INTO membro_cartaos (it_id_cartao, it_id_user) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 1);

-- Inserções para listas_verificacao
INSERT INTO listas_verificacaos (it_id_cartao, vc_nome) VALUES
(1, 'Design do esquema da DB'),
(2, 'Reunião'),
(3, 'Revisão do esquema da BD'),
(4, 'Resolução de bugs'),
(5, 'Revisão da correçã de gugs'),
(6, 'Revisão final');

-- Inserções para itens_lista_verificacao
INSERT INTO itens_lista_verificacaos (it_id_lista_verificacao, vc_texto, bt_completo) VALUES
(1, 'Escolher cores', TRUE),
(2, 'Confirmar participantes', FALSE),
(3, 'Aprovar texto', TRUE),
(4, 'Testar funcionalidade', FALSE),
(5, 'Contactar fornecedor', TRUE),
(6, 'Verificar tipografia', FALSE);

-- Inserções para membros_workplace
INSERT INTO membro_workplaces (it_id_workplace, it_id_user, vc_funcao) VALUES
(1, 1, 'Administrador'),
(2, 2, 'Gestor'),
(3, 3, 'Membro'),
(4, 4, 'Editor'),
(5, 5, 'Administrador'),
(6, 6, 'Membro');

-- Inserções para membro_quadro_convites
INSERT INTO membro_quadro_convites (it_id_quadro, it_id_user_convidado, it_id_user_convidador, vc_status, dt_data_envio, dt_data_expiracao) VALUES
(1, 2, 1, 'aceite', '2025-02-01 09:00:00', '2025-02-08 09:00:00'),
(2, 3, 2, 'pendente', '2025-02-01 12:00:00', '2025-02-08 12:00:00'),
(3, 4, 3, 'recusado', '2025-02-01 10:30:00', '2025-02-08 10:30:00'),
(4, 5, 4, 'aceite', '2025-02-01 15:00:00', '2025-02-08 15:00:00'),
(5, 6, 5, 'pendente', '2025-02-01 11:00:00', '2025-02-08 11:00:00'),
(6, 1, 6, 'aceite', '2025-02-01 13:00:00', '2025-02-08 13:00:00');

-- Inserções para membro_workplace_convites
INSERT INTO membro_workplace_convites (it_id_workplace, it_id_user_convidado, it_id_user_convidador, vc_status, dt_data_envio, dt_data_expiracao) VALUES
(1, 3, 1, 'aceite', '2025-02-02 09:00:00', '2025-02-09 09:00:00'),
(2, 4, 2, 'pendente', '2025-02-02 12:00:00', '2025-02-09 12:00:00'),
(3, 5, 3, 'recusado', '2025-02-02 10:30:00', '2025-02-09 10:30:00'),
(4, 6, 4, 'aceite', '2025-02-02 15:00:00', '2025-02-09 15:00:00'),
(5, 1, 5, 'pendente', '2025-02-02 11:00:00', '2025-02-09 11:00:00'),
(6, 2, 6, 'aceite', '2025-02-02 13:00:00', '2025-02-09 13:00:00');