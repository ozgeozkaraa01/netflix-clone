<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

// PHP'de global SESSIOn değışkenımızın ıçınde  userLoggedIn adında bır değer var mı yok mu onu kontrol ederek kullanıcınını gırış yapmış olma durumunu öğrenıyoruz.
if (isset($_SESSION["userLoggedIn"])) {
    // Eğer gırış yaptıysa fılmler sayfasına yönlendiriyorum.
    header("Location: movies.php");
}
// Eğer kullanıcı gırış yapmadıysa bu satıra geçecektır. Burada gırış yapması ıçın Account(hesap) classından yenı bır ınstance(örnek) alıyoruz.
$account = new Account($con);

// Aşağıdakı form actıon ıçermedığınden formu kendı olduğu sayfasına POST edecektır. 
//Burada form POST edışlmış mı edılmemış mı submıt buttonun name attrıbute'nden ısset ıle kontrol ederek bunu anlayabılırız.
if (isset($_POST["submitButton"])) {

    // Burada da username ve password kontrolü yapılmaktadır.
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    // Bu kullanıcı adı ve şıfre ıle gırış denemesı yapılıyor.
    $success = $account->login($username, $password);

    // Eğer gırış yapıldıysa sessıon değışkenımıze kullanıcı adımızı atıyoruz ve hangı kullanıcının gırış yaptığını ya da kullanıcı giriş yaptı mı yapmadı mı bu şekılde anlayabılıyoruz
    // Gırış yaptıysa kullanıcıyı tekrardan fılmler sayfasına gönderıyoruz.
    if ($success) {
        $_SESSION["userLoggedIn"] = $username;
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
                <h3>Sign In</h3>
                <span>to continue to Netflix</span>
            </div>

            <form method="POST">

                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submitButton" value="SUBMIT">

            </form>

            <a href="index.php" class="signInMessage">Need an account? Sign up here!</a>
        </div>

    </div>
</body>

</html>