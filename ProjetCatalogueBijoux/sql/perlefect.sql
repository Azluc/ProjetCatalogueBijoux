-- Script SQL pour créer la base de données de notre site PERLEFect

-- Supprimer la base de données si elle existe déjà
DROP DATABASE IF EXISTS PERLEFect;

-- Création de la base de données
CREATE DATABASE PERLEFect;

-- Utilisation de la base de données créée
USE PERLEFect;

-- Création de la table des catégories
CREATE TABLE categories (
    id VARCHAR(25) PRIMARY KEY,
    nom VARCHAR(20) NOT NULL
);

-- Création de la table des produits
CREATE TABLE produits (
    id VARCHAR(10) PRIMARY KEY,
    reference VARCHAR(10) NOT NULL,
    description VARCHAR(50) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    stock INTEGER NOT NULL,
    categorie_id VARCHAR(25) NOT NULL,
    image VARCHAR(100) NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id)
);

-- Création de la table des clients
CREATE TABLE clients (
    email VARCHAR(100) PRIMARY KEY,
    mdp VARCHAR(100) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    genre ENUM('homme', 'femme') NOT NULL,
    dateDeNaissance DATE,
    UNIQUE(email) -- Permet de vérifier que l'email est unique
);
