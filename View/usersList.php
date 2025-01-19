<?php if (!empty($users) && isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
<table>
  <thead>
    <tr>
      <th>Prénom</th>
      <th>email</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    if (!empty($data['users'])) {
        foreach ($data['users'] as $user):
            echo '<tr>
            <td>' . $user->firstName . '</td>
            <td>' . $user->email . '</td>';
        endforeach;
     } else {
            echo 'Pas de ceuilleurs de patates trouvés';
          }
          ?>
    </tbody>
    </table>
    <?php else: ?>
    <?php echo 'Connectez-vous Monsieur ou Madame Patate pour avoir accès à la liste des patatiers'; ?>
    <?php endif; ?>
