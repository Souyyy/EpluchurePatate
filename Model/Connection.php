<?php

require 'vendor/autoload.php'; // Charger la bibliothèque MongoDB

class Connection
{
    // Déclaration des propriétés pour la base de données
    private $connectionString;
    private $client;
    private $db;

    // Le constructeur initie la connexion à MongoDB
    public function __construct()
    {
        // Connexion à MongoDB avec la chaîne de connexion
        $this->connectionString = 'mongodb+srv://protheodisy:root123@cluster0.opkcf.mongodb.net/';
    
        try {
            // Initialiser le client MongoDB
            $this->client = new MongoDB\Client($this->connectionString);

            // Définir la base de données à utiliser (ici, 'planning')
            $this->db = $this->client->selectDatabase('planning');
        } catch (Exception $e) {
            echo 'Erreur de connexion à MongoDB : ' . $e->getMessage();
        }
    }

    // Méthode pour obtenir l'objet base de données MongoDB
    public function getDb()
    {
        return $this->db;
    }
}
?>
