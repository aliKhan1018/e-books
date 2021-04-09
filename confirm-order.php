<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
if (isset($_POST["confirm"])) {
    
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
        <form action="" method="post">
            <table class="">
                <tr>
                    <td>
                        <h1 style="width: 280px;">Confirm Order</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">OTP: </label>
                    <td><input type="text" name="otp" placeholder="Enter your confirmation number" id="" required></td>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Confirm Order" name="confirm" class="submit"></td>
                </tr>
            </table>
        </form>
    </section>
    
    <?php include "./footer.php"; ?>
    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/CodiePie.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/prism/prism.js"></script>

    <!-- Page Specific JS File -->
    <script src="js/page/bootstrap-modal.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>