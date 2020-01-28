<?php
include_once './includes/autoloader.php';
session_start();
spl_autoload_register('myAutoLoader');

use User\User;

$user = new User();
$user->logout();
header('Location: index.php');
