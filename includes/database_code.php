<?php

/*-------------------------------------------
Connection till databasen (lokalt)
-------------------------------------------*/

$servername = "localhost";
$DBusername = "root";
$DBPassword = "";
$DBName ="phplogin";

$connection = mysqli_connect($servername, $DBusername, $DBPassword, $DBName);