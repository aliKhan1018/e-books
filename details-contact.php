<?php
include './inc/database.inc.php';
session_start();
$db = new database();
$url_id = $_GET["id"];
$contact = $db->get_entity('contact', $url_id);
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
                        <h1>Contact Details</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <h4><?= $contact["name"] ?></h4> -->
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-md v_center">
                                                <tr>
                                                    <th for="">ID</th>
                                                    <td><?= $contact["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Name</th>
                                                    <td> <?php
                                                            $user = $db->get_entity('user', $contact["user_id"]);
                                                            echo $user["name"];
                                                            ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Subject</th>
                                                    <td><?= $contact["subject"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Email</th>
                                                    <td><?= $contact["email"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Message</th>
                                                    <td><?= $contact["message"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Issue Resolved?</th>
                                                    <td><?= $contact["resolved"] == 1 ? "Resolved" : "Not Resolved" ?></td>
                                                </tr>
                                                <tr>
                                                    <th for=""></th>
                                                    <td><a href="resolve.php?id=<?=$contact["id"]?>" class="btn btn-primary">Resolve</a></td>
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