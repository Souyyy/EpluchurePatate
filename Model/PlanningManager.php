<?php

use MongoDB\BSON\ObjectId;

class PlanningManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // recuperer le planning pour une année donnée
    public function PlanningAnnee(int $year): array
    {
        $collection = $this->db->selectCollection('weeks');
        $curseur = $collection->find(['year' => $year]);
        $planning = [];

        foreach ($curseur as $doc) {
            $planning[$doc['NumWeek']] = [
                'userId' => $doc['users_id'],
                'color' => isset($doc['color']) ? $doc['color'] : 'white'
            ];
        }

        return $planning;
    }

    // recuperer tout les utilisateurs
    public function getAllUsers(): array
    {
        $collection = $this->db->selectCollection('users');
        return $collection->find()->toArray();
    }

    // Assigner un utilisateur a une semaine spécifique
    public function assignerUtilisateurSemaine(int $weekNumber, string $userId, int $year): void
    {
        $collection = $this->db->selectCollection('weeks');
        
        // S'assurer que userId est une chaine de caractères
        $userIdValue = !empty($userId) ? $userId : null;
    
        $collection->updateOne(
            [
                'NumWeek' => $weekNumber,
                'year' => $year
            ],
            [
                '$set' => [
                    // Assigner l'ID utilisateur sous forme de chaine
                    'users_id' => $userIdValue, 
                    'NumWeek' => $weekNumber,
                    'year' => $year
                ]
            ],
            ['upsert' => true]
        );
    }

    // fonction pour obtenir les statistiques par utilisateur
    public function LesStatistiques(int $year): array
{
    $collection = $this->db->selectCollection('weeks');

    $pipeline = [
        [
            '$match' => ['year' => $year]
        ],
        [
            '$group' => [
                // Convertir users_id en ObjectId
                '_id' => ['$toObjectId' => '$users_id'], 
                'weeksCount' => ['$sum' => 1]
            ]
        ],
        [
            '$lookup' => [
                'from' => 'users',
                'localField' => '_id',
                'foreignField' => '_id',
                'as' => 'userDetails'
            ]
        ],
        [
            '$unwind' => [
                'path' => '$userDetails',
                'preserveNullAndEmptyArrays' => true 
            ]
        ],
        [
            '$project' => [
                // Convertir ObjectId en string
                'userId' => ['$toString' => '$_id'], 
                'weeksCount' => 1,
                'firstName' => '$userDetails.firstName',
                'lastName' => '$userDetails.lastName'
            ]
        ],
        [
            // Trier par nombre de semaines (décroissant)
            '$sort' => ['weeksCount' => -1] 
        ]
    ];

    $curseur = $collection->aggregate($pipeline);
    return iterator_to_array($curseur);
}

}