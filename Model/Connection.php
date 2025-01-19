<?php
// Charger MongoDB
require 'vendor/autoload.php'; 

class Connection {
    // Déclaration des propriétés pour la bdd
    private $connectionString;
    private $client;
    private $db;

    // Le constructeur initie la connexion a MongoDB
    public function __construct()
    {
        // Connexion à MongoDB avec la chaîne de connexion
        $this->connectionString = 'mongodb+srv://nom:mdp@cluster0.opkcf.mongodb.net/';
    
        try {
            // Initialiser le client MongoDB et commencer à utiliser la bdd planning
            $this->client = new MongoDB\Client($this->connectionString);
            $this->db = $this->client->selectDatabase('planning');
        } catch (Exception $e) {
            echo 'Erreur de connexion à MongoDB : ' . $e->getMessage();
        }
    }

    // fonction pour obtenir la bdd MongoDB
    public function getDb()
    {
        return $this->db;
    }
}

?>
