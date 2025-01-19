<?php if (!empty($users) && isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
<h2>Planning</h2>
<form method="POST" action="index.php?ctrl=planning&action=seePlanning">
    <label for="annee"> Selelectionner une année: </label>
    <input type="number" id="annee" name="annee" min="2021" max="2024" value="<?php echo $annee ?>">
    <input type="submit" value="Afficher">
</form>

<form method="POST" action="index.php?ctrl=planning&action=assignUserToWeek">

<input type="hidden" name="year" value="<?php echo $annee ?>">
 <table>
    <?php 
      $nbCols = 4;
      foreach ($weeks as $key => $week) {
        if ($key % $nbCols == 0) {
          echo '<tr>';
        }
        
        echo '<td><input type="hidden" name="week_id[]" value="' . $week['week_id']. '">'. $week['end_date']->format('d/m/Y') .' </td>';
        echo '<td><select name="user_id[]"><option value="">Choisir le patatier</option>';
        foreach ($users as $user) {
            $isUser = false;
            foreach ($bddWeeks as $bddWeek) {
                if ($bddWeek->week_id == $week['week_id'] && $bddWeek->user_id == $user->_id) {
                  $isUser = true;
                  break;
                }
            }
            
            echo '<option ' . ($isUser ? 'selected' : '')  .' value="' . $user->_id .'" >' . $user->firstName . '</option>';
        }
        echo '</select></td>';
        if ($key % $nbCols == $nbCols - 1) {
          echo '</tr>';
        }
        }
      ?>
  </table>
  <input type="submit" value="Valider le planning">
    </form>


    <h2>Nombre de semaines mis dans le planning par patatier triées par ordre croissant</h2>
      <?php if (!empty($weeksCount)): ?>
        <?php foreach ($weeksCount as $count): ?>
        <li><?php echo $count->firstName . " : " . $count->usersCount . " semaines"; ?></li>
      <?php endforeach; ?>
      <?php else: ?>
    <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>

    <?php else: ?>
    <?php echo 'Connectez-vous Monsieur ou Madame Patate pour avoir accès au planning des patatiers'; ?>
    <?php endif; ?>

