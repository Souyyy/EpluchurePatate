<?php
class User {
    private $id;
    private $lastName;
    private $firstName;
    private $email;
    private $password;
    private $admin;

    // Constructeur pour initialiser les propriétés
    public function __construct(array $data = []) {
        $this->hydrate($data); 
    }

    // Getters
    public function getId(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    // public function getAdmin(){
    //     return $this->admin;
    // }

    // Setters
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
        return $this;
    }

    // public function setAdmin($admin){
    //     $this->admin = $admin;
    //     return $this;
    // }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key); 
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}