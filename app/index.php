<?php
    include_once './includes/autoloader.php';
    spl_autoload_register('myAutoLoader');

    use Session\Session;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Group exercise </title>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class = "container mt-5 bg-light rounded p-5">
    <?php
    if ($user->isLoggedIn()) {
        echo '<h3 class = "login">Hi ' . Session::get('user') . '! You are logged in</h3>';
        echo '<h3 class = "login">Your mail adress is: ' . Session::get('email') . '</h3>';
    } else {
        echo '<h3 class = "logout">You are logged out</h3>';
    }
    if (Session::exists('success')) {
        $message = Session::flashMessage('success');
        echo "<h6 class = 'text-success'>{$message}</h6>";
    }
    ?>
    </div>

  </body>
</body>
</html>