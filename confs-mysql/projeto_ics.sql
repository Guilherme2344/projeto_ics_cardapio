CREATE DATABASE projeto_ics;
USE projeto_ics;

CREATE TABLE gestor (
    email VARCHAR(100) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(12) NOT NULL
);

CREATE TABLE cardapio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(50) NOT NULL,
    gestor_id INT NOT NULL,
    FOREIGN KEY (gestor_id) REFERENCES Gestor(id) ON DELETE CASCADE
);

CREATE TABLE item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    descricao VARCHAR(300)
);

CREATE TABLE cardapio_item (
    cardapio_id INT NOT NULL,
    item_id INT NOT NULL,
    PRIMARY KEY (cardapio_id, item_id),
    FOREIGN KEY (cardapio_id) REFERENCES Cardapio(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES Item(id) ON DELETE CASCADE
);