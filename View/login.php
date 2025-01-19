<section style="display:flex; align-items:center; justify-content:center;" class="bg-zinc-200 p-6 rounded-xl w-1/3 m-auto" id="main-section">
    <div class="wrapper-50 margin-auto center">
        <h2 class="text-xl mb-3">Login</h2>
        <!-- Formulaire de connexion -->
        <form class="form flex items-center flex-col" action="index.php?ctrl=user&amp;action=doLogin" method="POST">
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="email" name="email" placeholder="Mail" required=""><br>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="password" placeholder="Password" required=""><br>
            <p>
                <button type='submit' class="rounded-2xl bg-zinc-900 px-3 py-2 m-auto text-white mb-3">Connexion</button>
            </p>
        </form>
        <p></p>
        <!-- Creation de compte -->
        <div class="create-account text-center">Vous n'avez pas de compte ? <a href="index.php?ctrl=user&amp;action=create">Crée en un</a> !</div>
    </div>
</section>