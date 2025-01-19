<!-- Code CSS pour le style -->
<style>
    p {
        margin: 5px;
    }

    table, th, td {
        border: 1px solid black;
    }

    .statistics {
        margin-top: 20px;
    }

    .color-red {
        background-color: red;
        color: white;
    }

    .color-green {
        background-color: green;
        color: white;
    }

    .color-yellow {
        background-color: yellow;
        color: black;
    }

    .color-blue {
        background-color: blue;
        color: white;
    }

    .color-orange {
        background-color: orange;
        color: white;
    }

    #main-section {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>

<h1>Planning des corvées d'épluchage</h1>

<!-- Formulaire pour le changement d'annee -->
<form method="GET" action="index.php">
    <input type="hidden" name="ctrl" value="planning">
    <input type="hidden" name="action" value="voirPlanning">
    <div style="margin-bottom: 1rem;">
        <label for="year">Année :</label>
        <select name="year" id="year" onchange="this.form.submit()">
            <?php for ($i = 2014; $i <= 2030; $i++): ?>
                <option value="<?= $i ?>" <?= ($i == $anneeSelectionne) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>
</form>

<!-- Formulaire pour assigner des utilisateurs -->
<form method="POST" action="index.php?ctrl=planning&action=assignerUtilisateur">
    <input type="hidden" name="year" value="<?= $anneeSelectionne ?>">

    <table style="max-width: 900px;">
        <thead></thead>
        <tbody>
            <tr>
                <!-- Boucle 52 weeks -->
                <?php for ($week = 1; $week <= 52; $week++): ?>
                    <?php if (($week - 1) % 4 === 0 && $week > 1): ?>
            </tr>
            <tr>
            <?php endif; ?>
            <td>
                <div style="display: flex; align-items: center; justify-content: center; padding: 0 1rem;">
                    <p><?= $weeksDates[$week] ?></p>
                    <!-- Systeme de selection -->
                    <select name="assignements[<?= $week ?>]" style="background-color: <?= isset($planning[$week]['color']) ? $planning[$week]['color'] : 'white' ?>;">
                        <option value="">personne</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= (string)$user['_id'] ?>" <?= (isset($planning[$week]['userId']) && (string)$planning[$week]['userId'] === (string)$user['_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user['firstName']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </td>
        <?php endfor; ?>
            </tr>
        </tbody>
    </table>

    <button style="margin-top: 1rem;" type="submit">Valider le planning</button>
</form>

<div class="statistics">
    <h2>Statistiques des utilisateurs</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nombre de semaines</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ajout des statistiques -->
            <?php foreach ($statistiques as $stat): ?>
                <tr>
                    <td><?= htmlspecialchars($stat['lastName']) ?></td>
                    <td><?= htmlspecialchars($stat['firstName']) ?></td>
                    <td><?= $stat['weeksCount'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>