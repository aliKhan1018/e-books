<?php
include './inc/database.inc.php';
session_start();
$db = new database();
$id = $_GET["id"];
$user_to_delete = $db->get_entity('user', $id);
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
                        <h1>Confirm Delete</h1>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">Are you sure you want to delete this user?</h2>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?=$user_to_delete["name"]?></h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-md v_center">
                                                <tr>
                                                    <th for="">ID</th>
                                                    <td><?= $user_to_delete["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Name</th>
                                                    <td><?= $user_to_delete["name"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Gender</th>
                                                    <td><?= $user_to_delete["gender"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Email</th>
                                                    <td><?= $user_to_delete["email"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Password</th>
                                                    <td><?= $user_to_delete["password"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Contact Number</th>
                                                    <td><?= $user_to_delete["contactnumber"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Address</th>
                                                    <td><?= $user_to_delete["address"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Credit Card</th>
                                                    <td><?= $user_to_delete["creditcard"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Is Seller</th>
                                                    <td><?php $is = $user_to_delete["isseller"]; echo $is ? "TRUE" : "FALSE"; ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><a class="btn btn-danger" href="./delete-user.php?id=<?=$user_to_delete['id']?>">Confirm Delete</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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