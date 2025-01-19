<?php
require_once 'vendor/autoload.php';

class UserController
{
    private $userManager;
    private $user;
    private $db;


    public function __construct($db)
    {
        // Inclut les fichiers nécessaires
        require('./Model/User.php');
        require_once('./Model/UserManager.php');

        // Init
        $this->userManager = new UserManager($db);
        $this->db = $db;
    }


    //fonction afficher la page de connexion
    public function login()
    {
        // Vérifier si l'utilisateur est déjà connecté
        if (isset($_SESSION['user'])) {
            header('Location: index.php?ctrl=planning&action=voirPlanning&year=2025');
            exit();
        }

        // Si l'utilisateur n'est pas connecté -> afficher la page de connexion
        $page = 'login';
        require('./View/default.php');
    }


    // fonction pour gérer la connexion d'un user
    public function doLogin()
    {
        $this->user = new User();
        $this->user->setEmail($_POST['email']);
        $this->user->setPassword($_POST['password']);

        // verifier les identifiants
        $result = $this->userManager->login($this->user);
        if ($result):
            $info = "Connexion reussie";
            $_SESSION['user'] = $result;
            header('Location: index.php?ctrl=planning&action=voirPlanning&year=2025');
            exit();
        else:
            echo "Identifiants incorrects.";
        endif;
        // Recharge la vue par défaut
        require('./View/default.php');
    }


    // Affiche la page de création d'un compte
    public function create()
    {
        $page = 'createAccount';
        require('./View/default.php');
    }


    // Creation d'un compte utilisateur
    public function doCreate()
    {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['lastName']) && isset($_POST['firstName'])) {
            $alreadyExist = $this->userManager->findByEmail($_POST['email']);
            if (!$alreadyExist) {
                $newUser = new User($_POST);

                // Hachage du mot de passe avant d'enregistrer
                $hashedPassword = password_hash($newUser->getPassword(), PASSWORD_BCRYPT);
                $newUser->setPassword($hashedPassword);

                // Si un utilisateur es deja connecter
                if (isset($_SESSION['user'])) {
                    $this->userManager->create($newUser);
                    $info = "Compte crée";
                    header('Location: index.php?ctrl=user&action=userList');
                    exit();
                    // Sinon
                } else {
                    $this->userManager->create($newUser);
                    $info = "Compte crée, vous pouvez vous connecter";
                    $page = 'login';
                }
            } else {
                $error = "l'email est déjà utilisé (" . $_POST['email'] . ").";
                $page = 'createAccount';
            }
        }
        require('./View/default.php');
    }


    // Affiche la liste des utilisateurs
    public function userList()
    {
        $users = $this->userManager->findAll();
        $page = 'usersList';
        require('./View/default.php');
    }


    // Déconnecte l'utilisateur
    public function logout()
    {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header('Location: index.php?ctrl=user&action=login');
        exit();
    }
}
