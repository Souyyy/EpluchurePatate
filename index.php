<?php
// Afficher les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarre une session
session_start();

// Connexion a la BDD
require_once('Model/Connection.php');
$pdoBuilder = new Connection();
$db = $pdoBuilder->getDb();

// Valeurs par défaut
$ctrl = 'user';
$action = 'login';

// Vérifie si ya des parametres crtl et action sont dans l'url
if (isset($_GET['ctrl']) && isset($_GET['action']) && !empty($_GET['ctrl']) && !empty($_GET['action'])) {
    $ctrl = $_GET['ctrl'];
    $action = $_GET['action'];

    // si l'action concerne le planning
    if ($ctrl === 'planning') {
        require_once('Controller/planningController.php');
        $planningController = new PlanningController($db);

        // Si l'action est voirPlanning
        if ($action === 'voirPlanning') {
            // Recuperer un param GET -> année si disponible, sinon l'annee actuelle
            $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
            $planningController->voirPlanning($year);
            exit;
            //Sinon si l'action est assignerUtilisateur
        } elseif ($action === 'assignerUtilisateur') {
            $planningController->assignerUtilisateur();
            exit;
        }
    }
}

require_once('./Controller/' . $ctrl . 'Controller.php');
$ctrlClass = $ctrl . 'Controller';
$controller = new $ctrlClass($db);
$controller->$action();