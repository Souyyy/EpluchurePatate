
<header>
    <div id="banner-bloc">
        <h1>Planning corvées de patates</h1>
    </div>

    <div id="account_bar">
        <div class="connection center">
            <?php
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                    echo "<a href=\"./index.php?ctrl=user&action=doDisconnect\">
                            <div class=\"text\">Disconnect</div>
                        </a>";
                } else {
                    echo "<a href=\"./index.php?ctrl=user&action=login\">
                            <div class=\"text\">Login</div>
                        </a>";
                }
            ?>
        </div>
    </div>

    <ul id="menu_bar">
        <a href="./index.php?ctrl=user&action=usersList"><li>Liste des ceuilleurs de patates</li></a>
        <a href="./index.php?ctrl=planning&action=seePlanning"><li>Planning</li></a>

    </ul>
</header>