CREATE DATABASE minesweeper;

USE minesweeper;

CREATE TABLE board(
	codigo int auto_increment NOT NULL,
	nome varchar(30) NULL,
	coluna int NULL,
	linha int NULL,
	bomba int NULL,
	tempo_limite int NULL,
	PRIMARY KEY (codigo)
);
CREATE TABLE partida(
	codigo int auto_increment NOT NULL,
	resultado bit NULL,
	quadrados_restantes int NULL,
	tempo int NULL,
	modo bit NULL,
	data smalldatetime NOT NULL,
	id_board int NULL,
	id_player varchar(20) NULL,
	PRIMARY KEY (codigo)
);
CREATE TABLE player(
	username varchar(20) NOT NULL,
	senha varchar(32) NOT NULL,
	nome varchar(40) NOT NULL,
	data date NOT NULL,
	cpf int NOT NULL,
	telefone varchar(15) NOT NULL,
	email varchar(100) NOT NULL,
	PRIMARY KEY (username)
);

ALTER TABLE partida ADD FOREIGN KEY(id_board)
REFERENCES board (codigo);

ALTER TABLE partida ADD FOREIGN KEY(id_player)
REFERENCES player (username);
