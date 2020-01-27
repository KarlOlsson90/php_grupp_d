<?php

/*-------------------------------------------
Registrerings (POST från register-formuläret)
-------------------------------------------*/

//Kör bara koden ifall användaren kommer från rätt håll, i detta fall genom en POST från register-formuläret.
if(isset($_POST["registerSubmit"])) {

    //Hämta koden för access till databasen
    require "database_code.php";

    //Hämta parametrarna (name) från POST-requesten i register-formuläret
    $email = $_POST["userMail"];
    $password = $_POST["userPassword"];

    //Kolla databasen efter mailen(Användarnamnet)
    $sql = "SELECT userMail FROM users WHERE userMail=?";
    $stmt= mysqli_stmt_init($connection);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../register.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt); 
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) { //Error om mailen redan finns i databasen
                header("Location: ../register.php?error=mailtaken");
                exit();

                
            } else {
                //Om mailen(användarnamnet) inte redan finns så stoppas angiven mail och lösenord in i databasen
                $sql="INSERT INTO users (userMail, userPassword) VALUES (?, ?)";
                $stmt= mysqli_stmt_init($connection);

                //Error om databasen inte samarbetar
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../register.php?error=sqlerror");
                    exit();
            } else {

                //kryptera lösenordet
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
            mysqli_stmt_execute($stmt);

            //gå till registerSuccess-sidan
            header("Location: ../registerSuccess.php");
            exit();
            }
        }
    }


    
    

}
else {
    header("Location: ../register.php");
    exit();
}