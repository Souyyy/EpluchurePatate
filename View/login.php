
    <form class="form" action="index.php?ctrl=user&action=doLogin" method="POST">
        <input type="email" name="email"placeholder="Mail" required/><br>
        <input type="password" name="password"placeholder="Password" required/><br>
        <p>
            <input type="submit" value="Connect">
        </p>
    </form>
    <p></p>
    <div >Tu n'as pas de compte ? <a href='index.php?ctrl=user&action=create'>Je crée mon compte</a> !</div>