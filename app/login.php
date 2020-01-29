<?php
include './includes/header.php';
require_once './includes/autoloader.php';
spl_autoload_register('myAutoLoader');

use Input\Input;
use Token\Token;
use Validate\Validate;
use User\User;
use Session\Session;

if (Input::exists()) {
    if (Token::check(Input::get("token"))) {
        $validate = new Validate();
        $validate->check($_POST, array(
            "username" => array(
                'required' => true
            ),
            'password' => array(
                'required' => true
            )
        ));
        
        if ($validate->passed()) {
            $user = new User();
            $login = $user->login(
                Input::get('username'),
                Input::get('password')
            );
            if ($login) {
                header('Location: index.php');
            }
        } else {
            Session::flashMessage('error', $validate->error());
        }
    }
}
?>

<div class="container mt-5 bg-light rounded p-5">
    <form action = "login.php" class="d-flex flex-column my-2 my-lg-0 pl-5 pr-5" method = "POST">
        <h1 class="register-title">Sign In</h1>
        <input class="form-control mr-sm-2 my-2" type="text" name = "username" placeholder="Username">
        <input class="form-control mr-sm-2 my-2" type="password" name = "password" placeholder="Password">
        <input type = "hidden" name = "token" value = "<?php echo Token::generate(); ?>">
        <?php
        if (Session::exists('error')) {
            $message = Session::flashMessage('error');
            echo "<h6 class = 'text-danger'>{$message}</h6>";
        }
        ?>
        <button class="btn bg-dark text-white my-2 btn-lg" name = "register-submit" type="submit">Sign in</button>
    </form>
</div>