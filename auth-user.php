<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
$u = $db->get_entity('user', $_SESSION["user_id"]);

if (isset($_POST["confirm"])) {
    $p = $_POST["pswd"];
    if($p == $u["password"]){
        header("location: profile.php");
        die();
    }
    else{
        echo Utility::alert("Wrong Password!");
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
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <h1>Verify</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Password: </label>
                    </td>
                    <td><input type="password" name="pswd" placeholder="Enter your password" pattern="[0-9a-zA-Z1@#$%^&]{8, 255}" id=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Confirm Password" name="confirm" class="submit"></td>
                </tr>
            </table>
        </form>
    </section>
    <?php include "./footer.php"; ?>
</body>
</html>