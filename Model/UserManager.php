<?php 
class UserManager{
    private $db;
    public function __construct($db)
    {
        $this->db=$db;
    }

    public function login($user) {
      $query = new MongoDB\Driver\Query([
        'email' => $user->getEmail(),
        'password' => md5($user->getPassword()),
      ]);
      $cursor = $this->db->executeQuery("Planning.users", $query);
      foreach ($cursor as $userLogin) {
        return $userLogin;
      }
    }

    public function create(User $user) {
      $document = array (
        'firstName' => $user->getFirstName(),
        'email' => $user->getEmail(),
        'password' => md5($user->getPassword()),
      );

      $builkWrite = new MongoDB\Driver\BulkWrite();
      $builkWrite->insert($document);
      $this->db->executeBulkWrite('Planning.users', $builkWrite);
    }

    public function findAll() {
      $query = new MongoDB\Driver\Query([]);
      $cursor = $this->db->executeQuery("Planning.users", $query);
      $users = array();
      foreach($cursor as $user) {
        $users[] = $user;
      }
      return $users;
    }

  public function findByEmail($email) {
    $query = new MongoDB\Driver\Query(['email' => $email]);
    $cursor = $this->db->executeQuery("Planning.users", $query);
    $result = current($cursor->toArray());
    return $result;
}

public function getUserById($userId) {
  $query = new MongoDB\Driver\Query(['_id' => new MongoDB\BSON\ObjectId($userId)]);
  $rows = $this->db->executeQuery('Planning.users', $query);

  foreach ($rows as $row) {
      $user = new stdClass;
      $user->_id = $row->_id;
      $user->firstName = $row->firstName;
      return $user;
  }
  return null;
}
}
?>

