<?php
class PlanningController {
    private $planningManager;
    private $userManager;
    private $db;

    public function __construct($db) {
      require('./Model/PlanningManager.php');
      require('./Model/UserManager.php');
      $this->db = $db;
      $this->userManager = new UserManager($this->db);
      $this->planningManager = new PlanningManager($this->db, $this->userManager);
    }
    
    public function seePlanning() {
      $defaultYear = date('Y');
      $annee = isset($_POST['annee']) ? $_POST['annee'] : (isset($_SESSION['year']) ? $_SESSION['year'] : $defaultYear);
      $_SESSION['year'] = $annee;
      $weeks = $this->getWeeksOfYear($annee);
      $users = $this->userManager->findAll(); 
      $bddWeeks = $this->planningManager->findAll($annee);
      $weeksCount = $this->planningManager->findUsersByWeekCount($annee);
      foreach ($weeksCount as $weekCount) {
        $user = $this->userManager->getUserById($weekCount->user_id);
        if ($user) {
            $weekCount->user = $user;
            $weekCount->firstName = $user->firstName;
        }
    }
      $page = 'planning';
      require('./View/default.php');
    }

    private function getWeeksOfYear($year = null) {
      if (!$year) {
          $year = date('Y');
      }
      $date = new DateTime();
      $date->setISODate($year, 1);
      $weeks = array();
      for ($i = 0; $i <= 51; $i++) {
        $debut_semaine = clone $date;
        $fin_semaine = clone $date;
        $fin_semaine->modify('+6days');
        $weeks[] = array(
          'end_date' =>  $fin_semaine,
          'week_id' => $i,
          'year' => $year,
        );
        $date->modify('1 week');
      }
      return $weeks;
  }

public function assignUserToWeek() {
  $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
  $weekId = isset($_POST['week_id']) ? $_POST['week_id'] : null;
  $year = isset($_SESSION['year']) ? $_SESSION['year'] : date('Y');
  $selectedUser = isset($_SESSION['user']) ? $_SESSION['user']->_id : null;

  if($userId && $weekId) {
      foreach ($userId as $weekId => $userId)  {
          $this->planningManager->assignUserToWeek($weekId, $userId, $year );
      }
      if ($selectedUser && $weekId) {
        $this->planningManager = new PlanningManager($this->db);
  }  }
  $this->seePlanning();
} 
}
?>