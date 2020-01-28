<?php
    include_once './includes/autoloader.php';
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
        $user = new User();
        if ($user->isLoggedIn()) {
            echo '<h3 class = "login">You are logged in</h3>';
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