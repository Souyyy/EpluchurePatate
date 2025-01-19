<?php
use MongoDB\BSON\ObjectId;

class PlanningManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Récupère le planning pour une année spécifique
    public function getPlanningByYear($year): array
    {
        $collection = $this->db->selectCollection('planning');
        $cursor = $collection->find(['year' => (int)$year]);
        
        $planning = [];
        foreach ($cursor as $doc) {
            $planning[$doc['NumWeek']] = [
                'userId' => $doc['users_id'] ?? null,
            ];
        }
    
        return $planning;
    }
    
    // Assigne un utilisateur à une semaine spécifique
public function assignUserToWeek(int $weekNumber, string $userId, int $year)
{
    $collection = $this->db->selectCollection('planning');
    $collection->updateOne(
        ['NumWeek' => $weekNumber, 'year' => $year],
        ['$set' => ['users_id' => new MongoDB\BSON\ObjectId($userId)]],
        ['upsert' => true] // Crée un document si aucun n'existe
    );
}

    // Récupère la liste des utilisateurs assignés à une année et une semaine
    public function getUserAssignments($week, $year)
    {
        $collection = $this->db->selectCollection('planning');
        return $collection->find(['week' => $week, 'year' => (int)$year])->toArray();
    }
}
