-- Script SQL permettant d'utiliser la base de données de notre site PERLEFect

-- Utilisation de la base de données créée
USE PERLEFect;

-- Insertion des catégories 
INSERT INTO categories (id, nom) VALUES 
	('idBracelet', 'Bracelets'), 
	('idCollier', 'Colliers'), 
	('idBague', 'Bagues');

-- Insertion des produits 
INSERT INTO produits (id, reference, description, prix, stock, categorie_id, image) VALUES 
    -- Insertion des Bracelets
    ('Br01', 'OR1852', 'Bracelet Collection 1976 Or', 150, 20, 'idBracelet', 'img/bracelet1.jpg'),
    ('Br02', 'OR464', 'Bracelet en Or AMAR', 110, 6, 'idBracelet', 'img/bracelet2.jpg'),
    ('Br03', 'OR315', 'Bracelet Or Rigide', 270, 27, 'idBracelet', 'img/bracelet3.jpg'),
    ('Br04', 'ORA515', 'Bracelet Or The Perlefect', 70, 10, 'idBracelet', 'img/bracelet4.jpg'),
    ('Br05', 'ORA315', 'Bracelet Collection Iris', 60, 55, 'idBracelet', 'img/bracelet5.jpg'),

    -- Insertion des Colliers
    ('Co01', 'OR1864', 'Collier Or Pendentif Or', 1500, 4, 'idCollier', 'img/colier1.jpg'),
    ('Co02', 'PRL1895', 'Le The Perlefect 1', 1100, 16, 'idCollier', 'img/colier2.jpg'),
    ('Co03', 'ORA315', 'Collier Or Pendentif Serpent', 470, 39, 'idCollier', 'img/colier3.jpg'),
    ('Co04', 'OR726', 'Collier Or Le Simple', 700, 10, 'idCollier', 'img/colier4.jpg'),
    ('Co05', 'NR578', 'Collier en Brin Noir et Or', 560, 13, 'idCollier', 'img/colier5.jpg'),
    
    -- Insertion des Bagues
    ('Ba01', 'ARG264', 'Bague Argent Blanc', 350, 10, 'idBague', 'img/bague1.jpg'),
    ('Ba02', 'DIA315', 'Bague Solitaire Diamant', 120, 10, 'idBague', 'img/bague2.jpg'),
    ('Ba03', 'OR758', 'Bague Collection 1976 Or', 890, 20, 'idBague', 'img/bague3.jpg'),
    ('Ba04', 'ALL963', 'Alliance Blanc', 330, 10, 'idBague', 'img/bague4.jpg'),
    ('Ba05', 'ROS421', 'Bague Couronne Rose', 200, 40, 'idBague', 'img/bague5.jpg');

