<?php
// Afficher les bugs | DEBUG
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarre une session
session_start();

// Init
require_once('./Model/Connection.php');
$pdoBuilder = new Connection();
$db = $pdoBuilder->getDb();

// Vérifie si les paramètres 'ctrl' et 'action' sont définis dans l'URL
if (
    (isset($_GET['ctrl']) && !empty($_GET['ctrl'])) &&
    (isset($_GET['action']) && !empty($_GET['action']))
) {
    $ctrl = $_GET['ctrl'];
    $action = $_GET['action'];

    // // Si l'action est 'edit' et un ID est fourni -> EDIT
    // if ($ctrl == 'user' && $action == 'edit' && isset($_GET['id'])) {
    //      require_once('./Controller/userController.php');
    //      // Crée une instance du controleur UserController
    //      $controller = new UserController($db);
    //      $controller->edit($_GET['id']);
    //      exit;
    // }

    // Si l'action est 'delete' et un ID est fourni -> DELETE
    if ($ctrl == 'user' && $action == 'delete' && isset($_GET['id'])) {
        require_once('./Controller/userController.php');
        // Crée une instance du controleur UserController
        $controller = new UserController($db);
        $controller->delete($_GET['id']);
        exit;
    }

    if (isset($_GET['ctrl']) && $_GET['ctrl'] == 'planning') {
        $planningController = new PlanningController($db);
    
        if ($_GET['action'] == 'showPlanning') {
            $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y'); // Année par défaut : l'année en cours
            $planningController->showPlanning($year);
        }
    
        if ($_GET['action'] == 'assignUserToWeek') {
            $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
            $planningController->assignUserToWeek($year);
        }
    }
    
    
} else {
    // Valeurs par défaut
    $ctrl = 'planning';
    $action = 'showPlanning';
}

require_once('./Controller/' . $ctrl . 'Controller.php');
$ctrl = $ctrl . 'Controller';
$controller = new $ctrl($db);
$controller->$action();
