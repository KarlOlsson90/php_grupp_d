<?php
include_once './includes/autoloader.php';
session_start();

$user = new User();
$user->logout();
header('Location: index.php');
