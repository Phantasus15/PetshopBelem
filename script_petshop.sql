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
    tipoUsuario VARCHAR(3)
);
##situacao 0 PENDENTE 1 APROVADO 2 BLOQUEADO
##tipo_usuario ADM É O ADMINISTRADOR, FUN É O FUNCIONARIO E CLI É CLIENTE

CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagem VARCHAR(255) NOT NULL,
    nomeProduto VARCHAR(255) NOT NULL,
    descrição VARCHAR(255) NOT NULL,
    nomeCategoria INT NOT NULL,
    valor DECIMAL(10 , 2 ) NOT NULL,
    FOREIGN KEY (nomeCategoria)
        REFERENCES categoria (id)
)

#################################### COMANDOS ##########################################

#SELECT DE TABELA
select * from usuario;

#INSERIR DADOS
INSERT INTO `petshop`.`produto`
(`id`,
`imagem`,
`nomeProduto`,
`descrição`,
`nomeCategoria`,
`valor`)
VALUES
(id, "assets/produto_img2.png", "Pedigree Vital 12kg", "Ração Pedigree", 40.20);

#UPDATE DE DADOS
UPDATE  usuario 
SET situacao = '1'  
WHERE id=2;

