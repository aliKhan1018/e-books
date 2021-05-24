<?php
include "./inc/database.inc.php";
$db = new database();
session_start();

if(!isset($_SESSION["user_id"])){
    Utility::redirect_to("login.php");
}

$comp_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if (isset($_POST["part"])) {
    $q = "INSERT into `participant` (`user_id`,`competition_id`) values ($user_id, $comp_id)";
    $res = $db->query($q);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./head.php"; ?>
</head>

<body>
    <?php include "./header.php"; ?>

    <main>
        <section class="login-section">
            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            <h1 style="width: 250px;">Sure?</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Do you want to participate: </label>
                        </td>
                        <td>
                            <?php
                                $q = "SELECT id from `participant` where `user_id` = $user_id and `competition_id` = $comp_id";
                                $res = $db->query($q);
                                
                                $q = "SELECT `research` from `competition` where `id` = $comp_id";
                                $material = $db->query($q);
                                if($res){
                                    ?>
                                    <div class="alert alert-success"><p>You are already a participant. <a href="./pdf/<?=$material->fetch_assoc()["research"]?>" download="">Download Material</a></p>
                                    </div>
                                <?php
                                }
                                else{
                                    ?>
                                    <input type="submit" class="submit" name="part" value="Participate">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </section>
    </main>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
<script>
    window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
</script>


</html>