<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
error_reporting(0);

if(isset($_GET['email'])){
    $url_email = $_GET['email'];
}

if (isset($_POST["login"])) {
    $e = $_POST["email"];
    $p = $_POST["pswd"];

    $valid = $db->login_user($e, $p);
    if ($valid) {
        $q = "Select * from user where email='$e' and password='$p'";
        $res = $db->query($q);
        $user = $res->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        if ($user["isadmin"] == 1) {
            header("location: admin-index.php");
            die();
        }
        header("location: index.php");
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "./head.php"; ?>

</head>

<body>
    <?php include "./header.php"; ?>

    <section class="login-section">
    <?php
    if(!$valid){
        echo "<div class='alert alert-danger'><b>Login failed!</b> Incorrect email or password.</div>";
    }
    ?>
        <form action="" method="post">
            <table>
                <tr>
                    <td>
                        <h1>Login</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Email: </label>
                    <td><input type="email" name="email" value="<?php if(isset($url_email)) { echo $url_email; }?>" placeholder="Enter your email" id="" required></td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Password: </label>
                    </td>
                    <td>
                        <input type="password" name="pswd" placeholder="Enter your password" id="" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Remember Me <sub>(for 30 days)</sub>: </label>
                    </td>
                    <td><input type="checkbox" name="rem" id=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href="./signup.php">Don't have an account?</a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Login" name="login" class="submit"></td>
                </tr>
            </table>
        </form>
    </section>
    
    <?php include "./footer.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>