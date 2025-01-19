<?php
        if(isset($error) && !empty($error)) {
          echo $error;
        }
      ?>
      <div >
      <form class="form" action="index.php?ctrl=user&action=doCreate" method="POST">
        <input type="email" name="email" placeholder="Email" /><br />
        <input type="password"name="password"placeholder="Mot de passe." />
        <input type="text" name="firstName" placeholder="Prenom" />
        <br />
          <input type="submit" class="submit-btn" value="Créer/Valider" />
        </p>
      </form>
    </div>