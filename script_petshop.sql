create database petshop;
use petshop;
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    telefone VARCHAR(100),
    endereco VARCHAR(100),
    cep VARCHAR(100),
    senha VARCHAR(100),
    situacao INT,
    tipo_usuario VARCHAR(3)
);
##situacao 0 PENDENTE 1 APROVADO 2 BLOQUEADO
##tipo_usuario ADM É O ADMINISTRADOR, FUN É O FUNCIONARIO E CLI É CLIENTE

CREATE TABLE categoria_produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE categoria_animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE marca_produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE produto (
  id int auto_increment primary key,
  nome_produto varchar(100),
  imagem varchar(200),
  descricao varchar(200),
  nome_categoria_produto int,
  nome_categoria_animal int,
  nome_marca_produto int,
  valor varchar(100),
  estoque varchar(100),
    FOREIGN KEY (nome_categoria_produto)
        REFERENCES categoria_produto (id),
	FOREIGN KEY (nome_categoria_animal)
        REFERENCES categoria_animal (id),
	FOREIGN KEY (nome_marca_produto)
        REFERENCES marca_produto (id)
)