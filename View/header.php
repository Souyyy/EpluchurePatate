<header>

    <div id="banner-bloc">
        <h1>Planning epluchage de pomme de terre</h1>
    </div>

    <div id="account_bar">
        <div class="connection center">
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="./index.php?ctrl=user&amp;action=login" class="no-deco" title="Login or create account">
                    <svg class="svg-inline--fa fa-user fa-w-16" aria-hidden="true" data-fa-processed="" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M96 160C96 71.634 167.635 0 256 0s160 71.634 160 160-71.635 160-160 160S96 248.366 96 160zm304 192h-28.556c-71.006 42.713-159.912 42.695-230.888 0H112C50.144 352 0 402.144 0 464v24c0 13.255 10.745 24 24 24h464c13.255 0 24-10.745 24-24v-24c0-61.856-50.144-112-112-112z"></path>
                    </svg><i class="fas fa-user"></i>
                    <div class="text">Login</div>
                </a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Afficher le bouton de déconnexion uniquement si l'utilisateur est connecté -->
                <a href="index.php?ctrl=user&action=logout" class="no-deco" title="Login or create account">
                    <svg class="svg-inline--fa fa-user fa-w-16" aria-hidden="true" data-fa-processed="" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M96 160C96 71.634 167.635 0 256 0s160 71.634 160 160-71.635 160-160 160S96 248.366 96 160zm304 192h-28.556c-71.006 42.713-159.912 42.695-230.888 0H112C50.144 352 0 402.144 0 464v24c0 13.255 10.745 24 24 24h464c13.255 0 24-10.745 24-24v-24c0-61.856-50.144-112-112-112z"></path>
                    </svg><i class="fas fa-user"></i>
                    <div class="text">Déco</div>
                </a>
            <?php endif; ?>
        </div>
    </div>

</header>