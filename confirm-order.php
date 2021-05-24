<?php
include "./inc/database.inc.php";
session_start();
$db = new database();

// Otp Verification
if (isset($_POST["confirm"])) {
    $order_id = $_GET["order_id"];
    $order = $db->get_entity('order', $order_id);
    
    $otp = $_POST["otp"];
    $q = "SELECT `id`, `otp` from `otp` where `order_id` = $order_id";
    $res = $db->query($q);
    if($res){
        if($res->fetch_assoc()["otp"] == $otp){
            $db->update_entity('order', 'status', 'confirmed', $order_id);
            $db->delete_entity('otp', $res->fetch_assoc()["id"]);
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Head -->
    <?php include "./head.php"; ?>
</head>

<body>
<!-- Header -->
    <?php include "./header.php"; ?>
<!-- Login Section -->
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
                        <label for="">Email: </label>
                    <td><input type="email" name="email" placeholder="Enter your email" id=""></td>
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
    <!-- Footer -->
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