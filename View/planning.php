<h1>Planning des Épluchures de Patates - Année <?= $year ?></h1>

<form action="index.php?ctrl=planning&action=assignUserToWeek&year=<?= $year ?>" method="POST">
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Semaine</th>
                <th>Utilisateur Assigné</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (range(1, 52) as $weekNumber) : ?>
                <tr>
                    <td><?= $weekNumber ?></td>
                    <td>
                        <!-- Liste déroulante pour sélectionner un utilisateur -->
                        <select name="users[<?= $weekNumber ?>]">
                            <option value="">-- Non assigné --</option>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->getEmail() ?>" 
                                    <?= isset($planning[$weekNumber]['user']) && $planning[$weekNumber]['user'] === $user->getEmail() ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($user->getName()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <!-- Bouton pour sauvegarder -->
                        <button type="submit" name="week" value="<?= $weekNumber ?>">Enregistrer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
