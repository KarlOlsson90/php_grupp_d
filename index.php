<?php
require "header.php";
?>

    <main>

    <?php
        if (isset($_SESSION["userId"])) {
            echo "<p>Välkommen till sidan!</p>";
        }
    ?>  
    <?php
    if (isset($_SESSION['userId'])) {
        echo "<form action='includes/logout_code.php' method='post'>
        <button type='submit' name='logoutSubmit'>Logga ut</button>
        </form>";
    } else {
        echo "<h1>Logga in:</h1>
        <form action='includes/login_code.php' method='post'>
            <input type='text' name='userMail' placeholder='Mailadress'>
            <input type='password' name='userPassword' placeholder='Lösenord'>
            <button type='submit' name='loginSubmit'>Logga in</button>
            </form>
            <a href='register.php'>Registrera ny användare</a>";
    }
?>


    </main>

<?php
require "footer.php";
?>