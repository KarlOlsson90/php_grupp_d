<?php

/*-------------------------------------------
Avsluta session (endast funktioner som redan är inbyggda i php)
-------------------------------------------*/

session_start();
session_unset();
session_destroy();
header("Location: ../index.php");