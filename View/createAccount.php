<?php if (isset($info)) : ?>
    <div class="alert alert-info">
        <?php echo $info; ?>
    </div>
<?php endif; ?>

<!-- Formulaire creation de compte -->
<form method="POST" action="index.php?ctrl=user&action=doCreate" class="bg-zinc-200 p-6 rounded-xl w-1/3 m-auto flex flex-col gap-3">
    <h1 class="text-xl p-3 text-center ">Création de compte</h1>
    <input type="text" name="lastName" placeholder="Nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    <input type="text" name="firstName" placeholder="Prénom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    <input type="email" name="email" placeholder="Email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    <input type="password" name="password" placeholder="Mot de passe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

    <button class="rounded-2xl bg-zinc-900 px-3 py-2 m-auto text-white my-3" type="submit">Créer un compte</button>
</form>