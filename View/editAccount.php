<?php if (isset($user)): ?>
    <form method="POST" action="index.php?ctrl=user&action=doEdit" class="bg-zinc-200 p-6 rounded-xl w-1/3 m-auto flex flex-col gap-3">
        <h1>Modifier l'utilisateur</h1>

        <input type="hidden" name="id" value="<?= $user->getId() ?>" />
        <label for="firstName">Prénom</label>
        <input type="text" name="firstName" value="<?= htmlspecialchars($user->getFirstName()) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />

        <label for="lastName">Nom</label>
        <input type="text" name="lastName" value="<?= htmlspecialchars($user->getLastName()) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />

        <label for="password">Mot de passe (laisser vide pour ne pas modifier)</label>
        <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

        <button type="submit" class="rounded-2xl bg-zinc-900 px-3 py-2 m-auto text-white my-3">Enregistrer</button>
    </form>
<?php else: ?>
    <p>Utilisateur introuvable.</p>
<?php endif; ?>