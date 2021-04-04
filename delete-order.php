<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
$url_id = $_GET["id"];
$res = $db->delete_entity('order', $url_id);
?>
<!DOCTYPE html>
<html lang="en">

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

<head>
    <?php include "./admin-head.php"; ?>
</head>

<body class="layout-4">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <?php include "./admin-header.php"; ?>

            <!-- Start app main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>order Deleted!</h1>
                    </div>

                    <div class="section-body">
                        <?php if($res) {?>
                        <div class="alert alert-success"><b>
                                The order at index: <?= $url_id ?> has been deleted!
                            </b> <br>
                            <a href="./list-user.php">Back to list</a>
                        </div>
                        <?php } 
                            else{
                        ?>
                           <div class="alert alert-danger"><b>
                                The order at index: <?= $url_id ?> was not deleted due to error: <?php echo mysqli_errno($db->get_link())?>
                            </b> <br>
                            <a href="./list-user.php">Back to list</a>
                        </div>
                        <?php } ?>
                    </div>
                </section>
            </div>

            <!-- Start app Footer part -->
            <footer class="main-footer">
                <div class="footer-left">
                    <div class="bullet"></div> <a href="templateshub.net">Templates Hub</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/CodiePie.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

</html>