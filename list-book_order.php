<?php
include './inc/database.inc.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- components-table.html  Tue, 07 Jan 2020 03:37:12 GMT -->

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

            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Book Order List</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="admin-index.php">Dashboard</a></div>
                            <div class="breadcrumb-item">Book Order List</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">Book Order</h2>

                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Book Order</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-md v_center">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Book Name</th>
                                                    <th>Order Name</th>
                                                </tr>
                                                <?php
                                                $res = $db->get_entities('book_order');
                                                while ($row = mysqli_fetch_array($res)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $row["id"] ?></td>
                                                        <td>
                                                            <?php
                                                            $_book_id = $row["book_id"];
                                                            $book = $db->get_entity('book', $_book_id);
                                                            echo $book["title"]
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $_genre_id = $row["order_id"];
                                                            $genre = $db->get_entity('order', $_book_id);
                                                            echo $genre["name"]
                                                            ?>
                                                        </td>
                                                        <td><a href="details-book-order.php?id=<?= $row["id"] ?>" class="btn btn-secondary">Detail</a> / <a href="delete-confirm-book-order.php?id=<?= $row["id"] ?>" class="btn btn-danger">Delete</a></td>
                                                    </tr>
                                                    <?php } if($res->num_rows == 0){
                                                    echo "<tr><td colspan='7'><div class='alert alert-danger'>No book_order entity found!</div></td></tr>";
                                                }?>

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
                    <div class="bullet"></div> Iqra - Buy & Sell E-books
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
    <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="js/page/components-table.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- components-table.html  Tue, 07 Jan 2020 03:37:13 GMT -->

</html>


<!-- Start app main Content -->