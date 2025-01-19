<?php 
class UserController {
    private $userManager;
    private $user;
    private $db;

    public function __construct($db) {
        require('./Model/UserManager.php');
        $this->db = $db;
        $this->userManager = new UserManager($db);
    }

    public function login() {
        $page = 'login';
        require('./View/default.php');
    }

    public function create() {
        $page = "create";
        require('./View/default.php');
}

    public function doLogin() {
       require('./Model/User.php');
        if (
            ( isset($_POST['email']) && !empty($_POST['email'])) && 
            ( isset($_POST['password']) && !empty ($_POST['password'])) 
        ){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User(['email' => $email, 'password' => $password]);
            $result = $this->userManager->login($user);
            if ($result) {
                $_SESSION['user'] = $result;
                $page = 'home';
            } else {
                unset($_SESSION['user']);
                $info = 'Identifiants incorrects';
                $page = 'home';
            }
        }
        require('./View/default.php');
    } 

    public function doCreate(){
    if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['firstName']) 
 ) {
    $alreadyExist = $this->userManager->findByEmail($_POST['email']);
    if (!$alreadyExist) {
        require('./Model/User.php');
        $user = new User([
            'firstName' => $_POST['firstName'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);
        $this->userManager->create($user);
        $page = 'login';
    } else {
        $error = "ERROR : This email (" . $_POST['email'] . ") is used by another user";
        $page = 'create';
    }
}
    require('./View/default.php');
}

public function doDisconnect() {
    $page = 'home';
    $user = $_SESSION['user'];
    unset($_SESSION['user']);
    require('./View/default.php');
}

public function usersList() {
   $users = $this->userManager->findAll();
   if (!empty($users)) {
    $data = array('users' => $users);
    $page = 'usersList';
    require('./View/default.php');
   } else {
    $page = 'home';
    require('./View/default.php');
   }      
 } 
}
