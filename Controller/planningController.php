<?php

class PlanningController
{
    private $planningManager;

    public function __construct($db)
    {
        require_once('./Model/PlanningManager.php');
        $this->planningManager = new PlanningManager($db);
    }

    // Creation de la fonction pour afficher le planning
    public function voirPlanning(int $year)
    {
        $planning = $this->planningManager->PlanningAnnee($year);
        // Récupérer tous les utilisateurs
        $statistiques = $this->planningManager->LesStatistiques($year);
        $users = $this->planningManager->getAllUsers();
        $anneeSelectionne = $year;

        // Calculer le premier jour de chaque semaine
        $weeksDates = [];
        for ($week = 1; $week <= 52; $week++) {
            $weeksDates[$week] = $this->PremierJourSemaine($week, $year);
        }

        // Inclure la vue pour l'affichage
        $page = 'planning';
        require('./View/default.php');
    }

    // Fonction pour calculer le premier jour de la semaine
    private function PremierJourSemaine($week, $year)
    {
        // Créer une date avec le 1er janvier de l'année sélectionnée
        $date = new DateTime();
        $date->setDate($year, 1, 1);
        $date->modify('this monday');
        // Calculer le premier jour de la semaine et renvoyer le format jj/mm/aaaa
        $date->modify("+".($week - 1)." week"); 
        return $date->format('d/m/Y');
    }

    // Fonction pour assigner un utilisateur à une semaine
    public function assignerUtilisateur()
    {
        if (isset($_POST['assignements']) && is_array($_POST['assignements'])) {
            $year = (int)$_POST['year'];
            
            foreach ($_POST['assignements'] as $weekNumber => $userId) {
                if (!empty($userId)) {
                    $this->planningManager->assignerUtilisateurSemaine((int)$weekNumber, $userId, $year);
                }
            }

            // Rediriger vers la page de planning après l'assignation
            header("Location: index.php?ctrl=planning&action=voirPlanning&year=$year");
            exit();
        } else {
            echo "Aucune assignation à enregistrer.";
        }
    }
}
