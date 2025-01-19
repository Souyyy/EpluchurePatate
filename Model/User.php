<?php 
class User {
    private $id;
    private $firstName;
    private $email;
    private $password;
    private $usersCount;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data) {
        foreach ($data as $key => $value) {
            $this->{'set' .ucwords($key)}($value);
        }
    }
    public final function set_Id($id) {
        $this->id=$id;
    }
    public final function getId(){
        return $this->id;
    }
    public final function setFirstName($firstName) {
        $this->firstName=$firstName;
    }
    public final function getFirstName(){
        return $this->firstName;
    }
    public final function setEmail($email) {
        $this->email=$email;
    }
    public final function getEmail(){
        return $this->email;
    }
    public final function setPassword($password) {
        $this->password=$password;
    }
    public final function getPassword(){
        return $this->password;
    }
    public final function setUsersCount($usersCount) {
        $this->usersCount = $usersCount;
    }

    public final function getUsersCount() {
        return $this->usersCount;
    }
}