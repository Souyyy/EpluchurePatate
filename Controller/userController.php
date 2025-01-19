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


    // // Méthode pour afficher la page de connexion
    // public function login()
    // {
    //     // Vérifier si l'utilisateur est déjà connecté
    //     if (isset($_SESSION['user'])) {
    //         header('Location: index.php?ctrl=user&action=userList');
    //         exit();
    //     }

    //     // Si l'utilisateur n'est pas connecté, afficher la page de connexion
    //     $page = 'login';
    //     require('./View/default.php');
    // }


    // // Méthode pour gérer la connexion d'un user
    // public function doLogin()
    // {
    //     $this->user = new User();
    //     $this->user->setEmail($_POST['email']);
    //     $this->user->setPassword($_POST['password']);

    //     // Vérifie les identifiants
    //     $result = $this->userManager->login($this->user);
    //     if ($result):
    //         $info = "Connexion reussie";
    //         $_SESSION['user'] = $result;
    //         header('Location: index.php?ctrl=planning&action=planning');
    //         exit();
    //     else:
    //         echo "Identifiants incorrects.";
    //     endif;
    //     // Recharge la vue par défaut
    //     require('./View/default.php');
    // }


    // Affiche la page de création d'un compte
    public function create()
    {
        $page = 'createAccount';
        require('./View/default.php');
    }


    // Méthode pour traiter la création d'un compte utilisateur
    public function doCreate()
    {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['lastName']) && isset($_POST['firstName'])) {
            $alreadyExist = $this->userManager->findByEmail($_POST['email']);
            if (!$alreadyExist) {
                $newUser = new User($_POST);

                // Hachage du mot de passe avant d'enregistrer
                $hashedPassword = password_hash($newUser->getPassword(), PASSWORD_BCRYPT);
                $newUser->setPassword($hashedPassword);

                // Si un utilisateur est déjà connecté
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


    // // Vérifie si l'utilisateur actuel est un admin
    // private function isAdmin()
    // {
    //     return isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1;
    // }


    // // Formulaire d'edit pour d'un utilisateur
    // public function edit($id)
    // {
    //     if (!isset($_SESSION['user']) || $_SESSION['user']['admin'] != 1) {
    //         echo "Vous n'avez pas les permissions nécessaires.";
    //         return;
    //     }
    //     // Récupère les informations de l'utilisateur à modifier
    //     $user = $this->userManager->findOne($id);
    //     if ($user) {
    //         $page = 'editAccount';
    //         require('./View/default.php');
    //     } else {
    //         echo "Utilisateur introuvable.";
    //     }
    // }

    
    
//     // Modification des informations d'un users
//     // Modification des informations d'un utilisateur
//     public function doEdit()
// {
//     // Vérification des permissions
//     if (!$this->isAdmin() && !isset($_SESSION['user'])) {
//         echo "Vous n'avez pas les permissions nécessaires pour modifier un utilisateur.";
//         exit;
//     }

//     // Vérifie si l'ID est passé dans le formulaire
//     if (isset($_POST['id']) && !empty($_POST['id'])) {
//         $user = $this->userManager->findOne($_POST['id']);
        
//         // Vérifie si l'utilisateur existe
//         if ($user) {
//             // Vérifie si l'email est déjà pris par un autre utilisateur
//             $existingUser = $this->userManager->findByEmail(htmlspecialchars(trim($_POST['email'])));
//             if ($existingUser && $existingUser['id'] != $user->getId()) {
//                 $error = "Cet email est déjà utilisé par un autre utilisateur.";
//                 $page = 'editAccount';
//                 require('./View/default.php');
//                 return;
//             }

//             // Mise à jour des informations utilisateur
//             $user->setFirstName(htmlspecialchars(trim($_POST['firstName'])))
//                 ->setLastName(htmlspecialchars(trim($_POST['lastName'])))
//                 ->setEmail(htmlspecialchars(trim($_POST['email'])));

//             // Mise à jour du mot de passe si fourni
//             if (!empty($_POST['password'])) {
//                 $user->setPassword(sha1(trim($_POST['password'])));
//             }

//             // Mise à jour de l'utilisateur dans la base de données
//             $this->userManager->update($user);
//             $info = "Compte mis à jour avec succès.";
//             header('Location: index.php?ctrl=user&action=userList');
//             exit();
//         } else {
//             echo "Utilisateur introuvable.";
//         }
//     } else {
//         echo "L'ID de l'utilisateur n'est pas défini.";
//     }

//     require('./View/default.php');
// }

    




    // Supprime un utilisateur
    public function delete($id)
    {
        // Vérifie si l'utilisateur est un administrateur
        if (!isset($_SESSION['user']) || $_SESSION['user']['admin'] != 1) {
            echo "Vous n'avez pas les permissions nécessaires.";
            return;
        }
        $user = $this->userManager->findOne($id);
        if ($user) {
            $this->userManager->delete($user);
            echo "Utilisateur supprimé avec succès.";
        } else {
            echo "Utilisateur non trouvé.";
        }
        header("Location: index.php?ctrl=user&action=userList");
        exit();
    }


//     // Déconnecte l'utilisateur en détruisant la session
//     public function logout()
//     {
//         session_start();
//         unset($_SESSION['user']);
//         session_destroy();
//         header('Location: index.php?ctrl=user&action=login');
//         exit();
//     }
}
