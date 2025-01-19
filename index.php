<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Ceuilleurs de patates</title>
    </head>
    <body>
<?php
require_once('./Model/Connection.php');
$connectionDataBase = new Connection();
$db = $connectionDataBase->getDb();
if(
    ( isset($_GET['ctrl']) && !empty($_GET['ctrl'])) &&
    ( isset($_GET['action']) && !empty ($_GET['action']))
) {
    $ctrl = $_GET['ctrl'];
    $action = $_GET['action'];
    require_once('./Controller/' . $ctrl . 'Controller.php');

    $ctrl = $ctrl . 'Controller';
    $controller = new $ctrl ($db);
    $controller->$action();
} else {
    $page = 'home';
    require('./View/default.php');
}

?>
    </body>
</html>