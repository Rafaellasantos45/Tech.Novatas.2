-- Apaga o banco de dados caso ele já exista:
DROP DATABASE IF EXISTS technovatas;

-- Cria o banco de dados usando UTF-8 e buscas case-insensitive:
CREATE DATABASE technovatas CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Selecionar o banco de dados:
USE technovatas;

-- Cria a tabela 'users':
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type ENUM ('admin', 'author', 'moderator', 'user') DEFAULT 'user',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,    
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    birth DATE,
    photo VARCHAR(255),
    bio TEXT,
    last_login DATETIME,
    status ENUM ('online', 'offline', 'deleted') DEFAULT 'online'
);

-- Insere usuários para testes:
INSERT INTO users (
    type,
    name,
    email,
    password,
    birth,
    photo,
    bio
) VALUES (
    'author',
    'Joca da Silva',
    'joca@silva.com',
    SHA1('senha123'),
    '1998-10-14',
    'https://randomuser.me/api/portraits/men/57.jpg',
    'Encanador, escultor, programador e enrolador.'
), (
    'author',
    'Marineuza Siriliano',
    'mari@neuza.com',
    SHA1('senha123'),
    '2000-12-23',
    'https://randomuser.me/api/portraits/women/57.jpg',
    'Pintora, escultora, organizadora, produtora, catadora.'
);

-- Cria a tabela articles:
CREATE TABLE articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    thumbnail VARCHAR(255) NOT NULL,
    resume VARCHAR(255) NOT NULL,
    author INT NOT NULL,
    views INT DEFAULT 0,
    status ENUM ('online', 'offline', 'deleted') DEFAULT 'online',
    FOREIGN KEY (author) REFERENCES users(id)
);

-- Insere artigos para testes: