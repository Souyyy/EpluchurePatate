<div class="flex flex-col items-center">
    <h1>Liste des utilisateurs</h1>

    <?php if (isset($users) && !empty($users)): ?>
        <table class="m-auto table-auto border-collapse border border-slate-400">
            <thead>
                <tr>
                    <th class="border border-slate-300 px-3  text-center">ID</th>
                    <th class="border border-slate-300 px-3  text-center">Nom</th>
                    <th class="border border-slate-300 px-3  text-center">Prénom</th>
                    <th class="border border-slate-300 px-3  text-center">Email</th>
                    <th class="border border-slate-300 px-3  text-center">Admin</th>
                    <th class="border border-slate-300 px-3  text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="border border-slate-300 px-3  text-center"><?= htmlspecialchars($user['_id']) ?></td> <!-- Utilisation de __toString() -->
                        <td class="border border-slate-300 px-3  text-center"><?= htmlspecialchars($user['lastName']) ?></td>
                        <td class="border border-slate-300 px-3  text-center"><?= htmlspecialchars($user['firstName']) ?></td>
                        <td class="border border-slate-300 px-3  text-center"><?= htmlspecialchars($user['email']) ?></td>
                        <td class="border border-slate-300 px-3  text-center"><?= $user['admin'] == 1 ? 'Oui' : 'Non' ?></td>
                        <td class="border border-slate-300 px-3 text-center">
                            <a class="underline" href="index.php?ctrl=user&action=edit&id=<?= $user['email'] ?>">Modifier</a> - 
                            <?php if ($user['admin'] != 1): ?>
                                <button class="deleteBtn underline" data-user-id="<?= $user['email']; ?>">Supprimer</button>
                            <?php else: ?>
                                <span class="text-gray-500">/</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a class="btn mt-3 p-3 bg-zinc-800 text-white rounded-xl flex justify-center w-1/6" href="index.php?ctrl=user&action=create">Créer un compte</a>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</div>

<script>
    // Afficher une alerte de confirmation pour delete l'utilisateur 
    const deleteButtons = document.querySelectorAll('.deleteBtn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-user-id');
            if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.")) {
                // Si l'utilisateur confirme, rediriger vers l'URL de suppression
                window.location.href = `index.php?ctrl=user&action=delete&id=${id}`;
            }
        });
    });
</script>
