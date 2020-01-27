<?php

/*-------------------------------------------
Inloggningslogiken (POST från login-formuläret)
-------------------------------------------*/

//Kör bara koden ifall användaren kommer från rätt håll, i detta fall genom en POST från login-formuläret.
if(isset($_POST["loginSubmit"])) {

    //Hämta in koden för anslutning till MySQLi, sker nedan i variabeln $connection
    require "database_code.php";

    //Hämta med variabler från formuläret (name)
    $userMail = $_POST["userMail"];
    $password = $_POST["userPassword"];

    //Om inget är ifyllt studsar requestet men med en error i URL:en
    if (empty($userMail) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();

    
    } else { 

        //Om fälten är ifyllda så kolla efter användare i databasen 
        $sql = "SELECT * FROM users WHERE userMail=?;";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();

        } else {

            //Kolla upp mailadressen i databasen
            mysqli_stmt_bind_param($stmt, "s", $userMail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            //kolla lösenord om användaren finns
            if ($row = mysqli_fetch_assoc($result)) {
                
                $passwordCheck = password_verify($password, $row["userPassword"]);

                //Error om lösenordet inte matchar
                if($passwordCheck == false){
                    header("Location: ../index.php?error=wrongpass");
                    exit();
                }

                //Starta session om lösenordet matchar
                elseif($passwordCheck == true){
                    session_start();
                    $_SESSION["userId"] = $row["userId"];
                    $_SESSION["userName"] = $row["userName"];
                    header("Location: ../index.php?login=success");
                    exit();
                }

                //Error om användaren inte finns
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} 

