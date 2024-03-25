CREATE DATABASE IF NOT EXISTS SistemaDeGerenciamento;
 
USE SistemaDeGerenciamento;
 
CREATE TABLE IF NOT EXISTS Usuario (
    id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(50) NOT NULL,
    sobrenome_usuario VARCHAR(50),
    email_usuario VARCHAR(100),
    telefone_usuario VARCHAR(20),
    login_usuario VARCHAR(30) NOT NULL UNIQUE,
    senha_usuario VARCHAR(100) NOT NULL,
    foto_usuario VARCHAR(255), -- Novo campo para armazenar o nome do arquivo da foto de perfil
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);
select * from Usuario;
 
CREATE TABLE IF NOT EXISTS Projeto (
    ID_Projeto INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Projeto VARCHAR(100) UNIQUE NOT NULL,
    Tipo_Projeto VARCHAR(100) NOT NULL,
    Data_inicio_Projeto DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    Data_Fim_Projeto DATETIME,
    Status_Projeto VARCHAR(20) NOT NULL,
    Resumo_Projeto TEXT NOT NULL,
    Riscos_Projeto TEXT NOT NULL,
    Orcamento_Projeto DECIMAL(10, 2) NOT NULL,
    Recursos_Projeto TEXT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);
 
CREATE TABLE IF NOT EXISTS Tarefa (
    ID_tarefa INT AUTO_INCREMENT PRIMARY KEY,
    Projeto_tarefa INT NOT NULL,
    Nome_tarefa VARCHAR(100) NOT NULL,
    Data_inicio_Tarefa DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    Data_Fim_Tarefa DATETIME,
    Obs_tarefa TEXT NOT NULL,
    Status_tarefa VARCHAR(20) NOT NULL,
    Responsavel_tarefa INT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Projeto_tarefa) REFERENCES Projeto(ID_Projeto),
    FOREIGN KEY (Responsavel_tarefa) REFERENCES Usuario(id_usuario)
);
 
CREATE TABLE IF NOT EXISTS Chat (
    ID_chat INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario1_chat INT NOT NULL,
    id_usuario2_chat INT NOT NULL,
    CONSTRAINT FK_id_usuario1_chat FOREIGN KEY (id_usuario1_chat) REFERENCES Usuario(id_usuario),
    CONSTRAINT FK_id_usuario2_chat FOREIGN KEY (id_usuario2_chat) REFERENCES Usuario(id_usuario),
    data_ultima_mensagem DATETIME,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);
 
CREATE TABLE IF NOT EXISTS Mensagem (
    id_mensagem INT AUTO_INCREMENT PRIMARY KEY,
    id_chat_mensagem INT NOT NULL,
    id_usuario_mensagem INT NOT NULL,
    texto_mensagem TEXT NOT NULL,
    data_mensagem DATETIME DEFAULT CURRENT_TIMESTAMP,
    status_mensagem VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_chat_mensagem) REFERENCES Chat(ID_chat),
    FOREIGN KEY (id_usuario_mensagem) REFERENCES Usuario(id_usuario)
);
 
CREATE TABLE IF NOT EXISTS Equipe (
    equipe_id INT AUTO_INCREMENT PRIMARY KEY,
    equipe_nome VARCHAR(100) NOT NULL,
    equipe_descricao TEXT,
    equipe_lider_id INT,
    Projeto_atribuido_ID INT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_Equipe_Lider FOREIGN KEY (equipe_lider_id) REFERENCES Usuario(id_usuario),
    CONSTRAINT FK_Projeto_atribuido FOREIGN KEY (Projeto_atribuido_ID) REFERENCES Projeto(ID_Projeto)
);
 
CREATE TABLE IF NOT EXISTS Calendario (
    ID_calendario INT AUTO_INCREMENT PRIMARY KEY,
    Data DATE,
    Evento VARCHAR(255),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);
