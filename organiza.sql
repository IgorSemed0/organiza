drop database organiza;
CREATE DATABASE organiza;
USE organiza;

-- Tabela: tipo_users
CREATE TABLE tipo_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_descricao TEXT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL
);

-- Tabela: users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vc_nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    it_id_tipo_user INT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
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

-- Tabela: workplaces
CREATE TABLE workplaces (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_descricao TEXT,
    it_id_user_criador INT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_user_criador) REFERENCES users(id)
);

-- Tabela: quadros
CREATE TABLE quadros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_workplace INT,
    it_id_user_criador INT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_descricao TEXT,
    vc_visibilidade VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_workplace) REFERENCES workplaces(id),
    FOREIGN KEY (it_id_user_criador) REFERENCES users(id)
);

-- Tabela: listas
CREATE TABLE listas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    vc_nome VARCHAR(255) NOT NULL,
    it_ordem INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id)
);

-- Tabela: cartaos
CREATE TABLE cartaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_lista INT,
    it_id_user_criador INT,
    vc_titulo VARCHAR(255) NOT NULL,
    vc_descricao TEXT,
    dt_data_vencimento DATE,
    it_ordem INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_lista) REFERENCES listas(id),
    FOREIGN KEY (it_id_user_criador) REFERENCES users(id)
);

-- Tabela: etiquetas
CREATE TABLE etiquetas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    vc_nome VARCHAR(255) NOT NULL,
    vc_cor VARCHAR(7) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id)
);

-- Tabela: anexos
CREATE TABLE anexos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_user_upload INT,
    vc_nome_arquivo VARCHAR(255) NOT NULL,
    vc_caminho_arquivo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_user_upload) REFERENCES users(id)
);

-- Tabela: comentarios
CREATE TABLE comentarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_user_autor INT,
    vc_texto TEXT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_user_autor) REFERENCES users(id)
);

-- Tabela: membro_quadros
CREATE TABLE membro_quadros (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    it_id_user INT,
    vc_funcao VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id),
    FOREIGN KEY (it_id_user) REFERENCES users(id)
);

-- Tabela: cartao_etiquetas
CREATE TABLE cartao_etiquetas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_etiqueta INT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_etiqueta) REFERENCES etiquetas(id)
);

-- Tabela: chat_mensagems
CREATE TABLE chat_mensagems (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_quadro INT,
    it_id_user_autor INT,
    vc_texto_mensagem TEXT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_quadro) REFERENCES quadros(id),
    FOREIGN KEY (it_id_user_autor) REFERENCES users(id)
);

-- Tabela: chat_anexos
CREATE TABLE chat_anexos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_chat_mensagem INT,
    it_id_user_upload INT,
    vc_nome_arquivo VARCHAR(255) NOT NULL,
    vc_caminho_arquivo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_chat_mensagem) REFERENCES chat_mensagems(id),
    FOREIGN KEY (it_id_user_upload) REFERENCES users(id)
);

-- Tabela: membro_cartaos
CREATE TABLE membro_cartaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    it_id_user INT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id),
    FOREIGN KEY (it_id_user) REFERENCES users(id)
);

-- Tabela: listas_verificacaos
CREATE TABLE listas_verificacaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_cartao INT,
    vc_nome VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_cartao) REFERENCES cartaos(id)
);

-- Tabela: itens_lista_verificacaos
CREATE TABLE itens_lista_verificacaos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_lista_verificacao INT,
    vc_texto VARCHAR(255) NOT NULL,
    bt_completo BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_lista_verificacao) REFERENCES listas_verificacaos(id)
);

-- Tabela: membro_workplaces
CREATE TABLE membro_workplaces (
    id INT PRIMARY KEY AUTO_INCREMENT,
    it_id_workplace INT,
    it_id_user INT,
    vc_funcao VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
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
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
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
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (it_id_workplace) REFERENCES workplaces(id),
    FOREIGN KEY (it_id_user_convidado) REFERENCES users(id),
    FOREIGN KEY (it_id_user_convidador) REFERENCES users(id)
);

-- Inserções para tipo_users
INSERT INTO tipo_users (vc_nome, vc_descricao) VALUES
('Administrador', 'Utilizador com permissões completas'),
('User', 'Utilizador com permissões básicas');

-- Inserções para users
INSERT INTO users (vc_nome, email, password, it_id_tipo_user) VALUES
('Administrador', 'admin@email.com', '$2y$12$QBPtRH9DrUtz/6i3gRS9VOijOAKDM/FYJ6Dldb6wbN.ITYg3cPMLC', 1),
('Silvia Clara', 'clara@email.com', '$2y$12$QBPtRH9DrUtz/6i3gRS9VOijOAKDM/FYJ6Dldb6wbN.ITYg3cPMLC', 2),
('Januário dos Santos', 'bruno.costa@email.com', '$2y$12$QBPtRH9DrUtz/6i3gRS9VOijOAKDM/FYJ6Dldb6wbN.ITYg3cPMLC', 2),
('Dário Budjurra', 'budjurra@email.com', '$2y$12$QBPtRH9DrUtz/6i3gRS9VOijOAKDM/FYJ6Dldb6wbN.ITYg3cPMLC', 2),
('Isidro de Oliveira', 'isidro@email.com', '$2y$12$QBPtRH9DrUtz/6i3gRS9VOijOAKDM/FYJ6Dldb6wbN.ITYg3cPMLC', 2),
('Eva Pereira', 'eva@email.com', '$2y$12$QBPtRH9DrUtz/6i3gRS9VOijOAKDM/FYJ6Dldb6wbN.ITYg3cPMLC', 2),
('Horácio Manuel', 'horacio@email.com', '$2y$12$QBPtRH9DrUtz/6i3gRS9VOijOAKDM/FYJ6Dldb6wbN.ITYg3cPMLC', 2);

-- Inserções para workplaces
INSERT INTO workplaces (vc_nome, vc_descricao, it_id_user_criador) VALUES
('Equipa Marketing', 'Espaço para campanhas de marketing', 1),
('Projecto TI', 'Gestão de desenvolvimento de software', 2),
('Plano Académico', 'Organização de tarefas escolares', 3),
('Evento Corporativo', 'Planeamento de eventos', 4),
('Design Gráfico', 'Projetos de design e branding', 5),
('Gestão Financeira', 'Controlo de orçamentos', 6);

-- Inserções para quadros
INSERT INTO quadros (it_id_workplace, it_id_user_criador, vc_nome, vc_descricao, vc_visibilidade) VALUES
(1, 1, 'Campanha Janeiro', 'Planeamento da campanha de início de ano', 'privado'),
(1, 2, 'Redes Sociais', 'Gestão de posts e conteúdos', 'público'),
(2, 3, 'Desenvolvimento App', 'Tarefas do novo aplicativo', 'privado'),
(3, 4, 'Trabalhos Escolares', 'Organização de entregas', 'público'),
(4, 5, 'Evento Anual', 'Planeamento logístico', 'privado'),
(5, 6, 'Logotipo Novo', 'Criação de identidade visual', 'público');

-- Inserções para listas
INSERT INTO listas (it_id_quadro, vc_nome, it_ordem) VALUES
(1, 'A Fazer', 1),
(1, 'Em Progresso', 2),
(2, 'Ideias', 1),
(3, 'Backlog', 1),
(4, 'Pendentes', 1),
(5, 'Concluídos', 1);

-- Inserções para cartaos
INSERT INTO cartaos (it_id_lista, it_id_user_criador, vc_titulo, vc_descricao, dt_data_vencimento, it_ordem) VALUES
(1, 1, 'Criar Banner', 'Banner para campanha de Janeiro', '2025-01-30', 1),
(2, 2, 'Reunião Equipa', 'Discutir progresso', '2025-01-25', 1),
(3, 3, 'Post Instagram', 'Publicar teaser da campanha', NULL, 1),
(4, 4, 'Corrigir Bugs', 'Resolver erros no app', '2025-02-01', 1),
(5, 5, 'Planeamento Catering', 'Definir menu do evento', '2025-02-05', 1),
(6, 6, 'Aprovar Design', 'Revisão final do logotipo', '2025-01-31', 1);

-- Inserções para etiquetas
INSERT INTO etiquetas (it_id_quadro, vc_nome, vc_cor) VALUES
(1, 'Urgente', '#FF0000'),
(2, 'Social Media', '#00FF00'),
(3, 'Prioridade Alta', '#FF4500'),
(4, 'Baixa Prioridade', '#87CEEB'),
(5, 'Logística', '#FFD700'),
(6, 'Design', '#800080');

-- Inserções para anexos
INSERT INTO anexos (it_id_cartao, it_id_user_upload, vc_nome_arquivo, vc_caminho_arquivo) VALUES
(1, 1, 'banner_draft.jpg', '/uploads/banner_draft.jpg'),
(2, 2, 'agenda.pdf', '/uploads/agenda.pdf'),
(3, 3, 'teaser.png', '/uploads/teaser.png'),
(4, 4, 'bug_report.docx', '/uploads/bug_report.docx'),
(5, 5, 'menu_proposta.pdf', '/uploads/menu_proposta.pdf'),
(6, 6, 'logo_v1.png', '/uploads/logo_v1.png');

-- Inserções para comentarios
INSERT INTO comentarios (it_id_cartao, it_id_user_autor, vc_texto) VALUES
(1, 2, 'O banner precisa de mais contraste.'),
(2, 3, 'Confirmada para as 14h.'),
(3, 4, 'A imagem está pronta?'),
(4, 5, 'Corrigi dois bugs hoje.'),
(5, 6, 'Sugiro adicionar sobremesa.'),
(6, 1, 'Aprovado com ajustes menores.');

-- Inserções para membro_quadros
INSERT INTO membro_quadros (it_id_quadro, it_id_user, vc_funcao) VALUES
(1, 1, 'Administrador'),
(1, 2, 'Editor'),
(2, 3, 'Membro'),
(3, 4, 'Gestor'),
(4, 5, 'Editor'),
(5, 6, 'Administrador');

-- Inserções para cartao_etiquetas
INSERT INTO cartao_etiquetas (it_id_cartao, it_id_etiqueta) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- Inserções para chat_mensagems
INSERT INTO chat_mensagems (it_id_quadro, it_id_user_autor, vc_texto_mensagem) VALUES
(1, 1, 'Equipa, precisamos acelerar.'),
(2, 2, 'Alguém viu o plano?'),
(3, 3, 'Reunião amanhã às 12h:30min.'),
(4, 4, 'Progresso está fixe!'),
(5, 5, 'Confio no vosso trabalho, acho kkk.'),
(6, 6, 'Design finalizado hoje?');

-- Inserções para chat_anexos
INSERT INTO chat_anexos (it_id_chat_mensagem, it_id_user_upload, vc_nome_arquivo, vc_caminho_arquivo) VALUES
(1, 1, 'plano.jpg', '/uploads/plano.jpg'),
(2, 2, 'posts.csv', '/uploads/posts.xlsx'),
(3, 3, 'descriao?projecto.pdf', '/uploads/agenda_chat.pdf'),
(4, 4, 'print_do_bug.png', '/uploads/screenshot.png'),
(5, 5, 'nota.txt', '/uploads/nota.txt'),
(6, 6, 'logo_final.png', '/uploads/logo_final.png');

-- Inserções para membro_cartaos
INSERT INTO membro_cartaos (it_id_cartao, it_id_user) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 1);

-- Inserções para listas_verificacaos
INSERT INTO listas_verificacaos (it_id_cartao, vc_nome) VALUES
(1, 'Design do esquema da DB'),
(2, 'Reunião'),
(3, 'Revisão do esquema da BD'),
(4, 'Resolução de bugs'),
(5, 'Revisão da correçã de gugs'),
(6, 'Revisão final');

-- Inserções para itens_lista_verificacaos
INSERT INTO itens_lista_verificacaos (it_id_lista_verificacao, vc_texto, bt_completo) VALUES
(1, 'Escolher cores', TRUE),
(2, 'Confirmar participantes', FALSE),
(3, 'Aprovar texto', TRUE),
(4, 'Testar funcionalidade', FALSE),
(5, 'Contactar fornecedor', TRUE),
(6, 'Verificar tipografia', FALSE);

-- Inserções para membro_workplaces
INSERT INTO membro_workplaces (it_id_workplace, it_id_user, vc_funcao) VALUES
(1, 1, 'Administrador'),
(2, 2, 'Gestor'),
(3, 3, 'Membro'),
(4, 4, 'Editor'),
(5, 5, 'Administrador'),
(6, 6, 'Membro');

-- Inserções para membro_quadro_convites
INSERT INTO membro_quadro_convites (it_id_quadro, it_id_user_convidado, it_id_user_convidador, vc_status) VALUES
(1, 2, 1, 'aceite'),
(2, 3, 2, 'pendente'),
(3, 4, 3, 'recusado'),
(4, 5, 4, 'aceite'),
(5, 6, 5, 'pendente'),
(6, 1, 6, 'aceite');

-- Inserções para membro_workplace_convites
INSERT INTO membro_workplace_convites (it_id_workplace, it_id_user_convidado, it_id_user_convidador, vc_status) VALUES
(1, 3, 1, 'aceite'),
(2, 4, 2, 'pendente'),
(3, 5, 3, 'recusado'),
(4, 6, 4, 'aceite'),
(5, 1, 5, 'pendente'),
(6, 2, 6, 'aceite');