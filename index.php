<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

if (isset($_SESSION["userLoggedIn"])) { //kullanıcı giriş yaptıysa movies sayfasına yönlendirir
    header("Location: movies.php");
}
$account = new Account($con); //giriş yapmadıysa bu satıra geçecektir. burada giriş yapması için account classından yeni bir instance alıyoruz



if (isset($_POST["submitButton"])) { //isset submitbutton diyerek submitbuttona tıklanıp tıklanmadığını kontrol ediyoruz 

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]); //burada kontroller yapılıyor
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

    if ($success) {
        $_SESSION["userLoggedIn"] = $username; //eğer giriş yapıldıysa session değişkenimize kullanıcı adımızı atıyoruz ve hangi kullanıcının giriş yaptığını anlıyoruz
        header("Location: movies.php");
    }
}
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>

<body>
    <div class="signInContainer">

        <div class="column">
            <div class="header">
                <img src="https://fontmeme.com/permalink/210706/1b7bd7c714395f5af50fd1fc5bd36ad6.png" title="logo" alt="Site logo" />
                <h3>Sign Up</h3>
                <span>to continue to Netflix</span>
            </div>


            <form method="POST">

                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="First name" value="<?php getInputValue("firstname"); ?>" required>

                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Last name" value="<?php getInputValue("lastname"); ?>" required>

                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" required>

                <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email"); ?>" required>


                <input type="email" name="email2" placeholder="Confirm email" value="<?php getInputValue("email2"); ?>" required>

                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>

                <input type="password" name="password" placeholder="Password" required>

                <input type="password" name="password2" placeholder="Confirm password" required>

                <input type="submit" name="submitButton" value="SUBMIT">

            </form>

            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        </div>

    </div>
</body>

</html>