<h1>Connexion</h1>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST" action="?page=/user/login">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Mot de passe: <input type="password" name="password" required></label><br>
    <button type="submit">Se connecter</button>
</form>
<a href="?page=/user/register">S'inscrire</a>
