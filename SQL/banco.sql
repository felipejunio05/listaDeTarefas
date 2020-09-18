--Criando base de Dados 
CREATE DATABASE IF NOT EXISTS app_listaTaferas;

--Selecionando a base de Dados
use app_listaTaferas;

--Criando a tabela status
CREATE TABLE IF NOT EXISTS tb_status (
	id INT UNSIGNED PRIMARY  KEY AUTO_INCREMENT,
	status VARCHAR(25) not null
);

--Preenchendo tabela com os registro 'pendente, realizado'
INSERT INTO tb_status(status) VALUES ('pendente'), ('realizado');

--criando tabela tarefas
CREATE TABLE IF NOT EXISTS tb_tarefas (
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	id_status INT UNSIGNED  NOT NULL DEFAULT 1,
	FOREIGN KEY(id_status) references tb_status(id),
	tarefa TEXT NOT NULL,
	data_cadastrado DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- criando tabela de usuários
CREATE TABLE IF NOT EXISTS tb_usuarios (
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	email VARCHAR(100) NOT NULL,
	senha VARCHAR(32) NOT NULL
);

--Criando usuário de acesso a base dados com todos privilégios.
CREATE USER 'listaTarefas'@'localhost' IDENTIFIED BY 't@X3l.#$';
GRANT ALL PRIVILEGES ON app_listaTarefas.* TO 'listaTarefas'@'localhost';
FLUSH PRIVILEGES;