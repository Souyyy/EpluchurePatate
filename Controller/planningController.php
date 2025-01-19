<?php

class PlanningController
{
    private $planningManager;
    private $userManager;
    private $db;

    public function __construct($db)
    {
        // Inclut les fichiers nécessaires
        require('./Model/Planning.php');
        require('./Model/PlanningManager.php');
        require('./Model/UserManager.php');

        // Init
        $this->planningManager = new PlanningManager($db);
        $this->userManager = new UserManager($db);
        $this->db = $db;
    }

    // Affiche le planning
    public function showPlanning($year)
    {
        // Récupère les semaines du planning pour l'année spécifiée
        $planning = $this->planningManager->getPlanningByYear($year);
    
        // Récupère tous les utilisateurs
        $users = $this->userManager->findAll();
    
        // Charger la vue avec les données
        $page = 'planningView';
        require('./View/default.php');
    }
    

    // Assigner un utilisateur à une semaine
    public function assignUserToWeek($week, $userEmail, $year)
    {
        $user = $this->userManager->findOne($userEmail);

        if ($user) {
            // Assigner l'utilisateur à la semaine spécifique
            $this->planningManager->assignUserToWeek($week, $user->getEmail(), $year);
            header("Location: index.php?ctrl=planning&action=showPlanning&year=" . $year);
            exit();
        } else {
            echo "Utilisateur non trouvé.";
        }
    }

    // Modifier une attribution d'utilisateur
    public function editAssignment($week, $userEmail, $year)
    {
        $user = $this->userManager->findOne($userEmail);

        if ($user) {
            // Mettre à jour l'attribution de la semaine avec l'utilisateur choisi
            $this->planningManager->assignUserToWeek($week, $user->getEmail(), $year);
            header("Location: index.php?ctrl=planning&action=showPlanning&year=" . $year);
            exit();
        } else {
            echo "Utilisateur non trouvé.";
        }
    }
}
