<?php
require "header.php";
?>

    <main>  
    <h1>Registrera ny användare:</h1>
    <form action="includes/register_code.php" method ="post">
    <input type="text" name="userMail" placeholder="E-post">
    <input type="password" name="userPassword" placeholder="Lösenord">
    <button type="submit" name="registerSubmit">Skapa</button>
    </form>
    <a href='index.php'>Tillbaka</a>
    </main>

<?php
require "footer.php";
?>