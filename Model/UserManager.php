<?php

require 'vendor/autoload.php';

class UserManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Fonction pour connecter un utilisateur
    public function login(User $user): mixed
    {
        $collection = $this->db->selectCollection('users');
        $userDocument = $collection->findOne(['email' => $user->getEmail()]);

        if ($userDocument && password_verify($user->getPassword(), $userDocument['password'])) {
            return $userDocument;
        }
        return false;
    }

    // verifier si un utilisateur existe en fonction de son email
    public function findByEmail($email)
    {
        $collection = $this->db->selectCollection('users');
        return $collection->findOne(['email' => $email]);
    }

    // creer un nouvel utilisateur
    public function create(User $user)
    {
        $collection = $this->db->selectCollection('users');
        try {
            $result = $collection->insertOne([
                'lastName' => $user->getLastName(),
                'firstName' => $user->getFirstName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);

            // Ajoute un log pour verifier si l'insertion a reussi
            if ($result->getInsertedCount() > 0) {
                echo "Utilisateur créé avec succès!";
            } else {
                echo "Erreur lors de l'ajout de l'utilisateur.";
            }
        } catch (Exception $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
        }
    }


    // recupere tous les utilisateurs
    public function findAll(): array
    {
        $collection = $this->db->selectCollection('users');
        // Retourne un tableau brut
        return $collection->find()->toArray(); 
    }

    // Fonction qui trouve un utilisateur par son ID
    public final function findOne($id)
    {
        $collection = $this->db->selectCollection('users');
        // Recherchez par '_id' en tant que chaine
        $userDocument = $collection->findOne(['_id' => $id]);
    
        if ($userDocument) {
            return $userDocument; 
        }
        return null; 
    }

}
