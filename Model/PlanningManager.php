<?php
class PlanningManager {
    private $db; 

    public function __construct($db) {
        $this->db=$db;
    }
    
    public function assignUserToWeek($week_id, $user_id, $year) {
        $bulk = new MongoDB\Driver\BulkWrite();
        $bulk->update(
            ['week_id' => $week_id, 'year' => $year],
            ['$set' => ['user_id' => $user_id, 'year' => $year]],
            ['upsert' => true]
        );
        $this->db->executeBulkWrite('Planning.weeks', $bulk);
    }  

    public function findAll($year) {
        $query = new MongoDB\Driver\Query(['year' => $year]);
        $cursor = $this->db->executeQuery("Planning.weeks", $query);
        $weeks = array();
        foreach($cursor as $week) {
          $weeks[] = $week;
        }
        return $weeks;
      }

      public function findUsersByWeekCount($year) {
        $pipeline = [
            ['$match' => ['year' => $year, 'user_id' => ['$ne' => '']]],
            ['$group' => ['_id' => '$user_id', 'count' => ['$sum' => 1]]],
            ['$sort' => ['count' => -1]],
            ['$project' => ['_id' => 0, 'user_id' => '$_id', 'usersCount' => '$count']]
        ];
    
        $executeCommand = new MongoDB\Driver\Command([
            'aggregate' => 'weeks',
            'pipeline' => $pipeline,
            'cursor' => new stdClass,
        ]);
    
        $cursor = $this->db->executeCommand('Planning', $executeCommand);
        $usersCount = array();
        foreach ($cursor as $document) {
            $usersCount[] = $document;
        }
        return $usersCount;
    }
}
?>
