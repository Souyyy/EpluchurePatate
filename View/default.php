<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning Epluchage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://projet-web-training.ovh/licence00/userAuthentication/View/style/header-footer.css" rel="stylesheet" type="text/css">
    <link href="https://projet-web-training.ovh/licence00/userAuthentication/View/style/mainSection.css" rel="stylesheet" type="text/css">
    <style>
        header #banner-bloc {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        header {
            padding-bottom: 0px !important;
            height: auto !important;
        }

    </style>
</head>
<body class="flex flex-col min-h-screen">

<?php
include_once "header.php" ?>
<main id="main-section">
        <?php 
        if (isset($page)) {
            if ($page == 'home')
                require("./View/home.php");
            else
                require("./View/" . $page . ".php");
        }
        ?>
</main>
<?php include_once "footer.php" ?>

</body>
</html>