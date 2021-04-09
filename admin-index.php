<?php
session_start();
include "./inc/database.inc.php";
$db = new database();

$orders = $db->get_entities('order');
$total_orders = $orders->num_rows;

$q = "SELECT SUM(cost) as total FROM `order` WHERE `status` = 'completed'";
$total_balance = $db->query($q)->fetch_assoc()["total"];

$q = "SELECT COUNT(id) as total FROM `order` WHERE `status` = 'pending'";
$pending_orders = $db->query($q)->fetch_assoc()["total"];

$q = "SELECT COUNT(id) as total FROM `order` WHERE `status` = 'completed'";
$completed_orders = $db->query($q)->fetch_assoc()["total"];

$q = "SELECT COUNT(id) as total from `user`";
$users = $db->query($q)->fetch_assoc()["total"];

$contacts = $db->get_entities('contact');

$q = "SELECT COUNT(id) as total from `contact`";
$contact_count = $db->query($q)->fetch_assoc()["total"];

$q = "select book.id, book.title, (book.price * book_order.quantity) as total from book
left join book_order
on book.id = book_order.book_id
where book_order.book_id = 2 and book_order.version = 'phy'";
$


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './admin-head.php'; ?>
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
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-stats">
                                    <div class="card-stats-title"> Orders
                                    </div>
                                    <div class="card-stats-items">
                                        <div class="card-stats-item">
                                            <div class="card-stats-item-count"><?= $pending_orders ?></div>
                                            <div class="card-stats-item-label">Pending</div>
                                        </div>
                                        <div class="card-stats-item">
                                            <!-- <div class="card-stats-item-count">12</div> -->
                                            <!-- <div class="card-stats-item-label">Shipping</div> -->
                                        </div>
                                        <div class="card-stats-item">
                                            <div class="card-stats-item-count"><?= $completed_orders ?></div>
                                            <div class="card-stats-item-label">Completed</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fa fa-archive"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Orders</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $total_orders ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-chart">
                                    <canvas id="balance-chart" height="80"></canvas>
                                </div>
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fa fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Balance</h4>
                                    </div>
                                    <div class="card-body">
                                        $<?= $total_balance ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-chart">
                                    <canvas id="sales-chart" height="80"></canvas>
                                </div>
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Users</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $users ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    // ? Search for group by statements.
                    // ? group books by sales  
                    <div class="row row-deck">
                        <div class="col-lg-4">
                            <div class="card gradient-bottom">
                                <div class="card-header">
                                    <h4>Top 5 Books</h4>
                                </div>
                                <div class="card-body" id="top-5-scroll">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <li class="media">
                                            <img class="mr-3 rounded" width="55" src="assets/img/products/product-3-50.png" alt="product">
                                            <div class="media-body">
                                                <div class="float-right">
                                                    <div class="font-weight-600 text-muted text-small">86 Sales</div>
                                                </div>
                                                <div class="media-title">oPhone S9 Limited</div>
                                                <div class="mt-1">
                                                    // ? see if you can work out percentages...well you can..but...yeah..this is weird. 
                                                    <div class="budget-price">
                                                        <div class="budget-price-square bg-primary" data-width="64%"></div>
                                                        <div class="budget-price-label">$68,714</div>
                                                    </div>
                                                    <div class="budget-price">
                                                        <div class="budget-price-square bg-danger" data-width="43%"></div>
                                                        <div class="budget-price-label">$38,700</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer pt-3 d-flex justify-content-center">
                                    <div class="budget-price justify-content-center">
                                        <div class="budget-price-square bg-primary" data-width="20"></div>
                                        <div class="budget-price-label">Physical Sales</div>
                                    </div>
                                    <div class="budget-price justify-content-center">
                                        <div class="budget-price-square bg-danger" data-width="20"></div>
                                        <div class="budget-price-label">PDF Sales</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card card-hero">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fa fa-question-circle"></i>
                                    </div>
                                    <h4><?= $contact_count ?></h4>
                                    <div class="card-description">Customers need help</div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="tickets-list">
                                        <?php while ($row = mysqli_fetch_array($contacts)) { ?>
                                            <a href="#" class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4><?= substr($row["message"], 0, 50) ?></h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div><?php
                                                        $user_id = $row["user_id"];
                                                        $user = $db->get_entity('user', $user_id);
                                                        echo $user["name"];
                                                    ?></div>
                                                    <div class="bullet"></div>
                                                    <div class="text-primary">1 min ago</div>
                                                </div>
                                            </a>
                                        <?php } ?>
                                        <a href="features-tickets.html" class="ticket-item ticket-more">
                                            View All <i class="fa fa-chevron-right"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row row-deck">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Best Products</h4>
                                </div>
                                <div class="card-body">
                                    <div class="owl-carousel owl-theme" id="products-carousel">
                                        <div>
                                            <div class="product-item pb-3">
                                                <div class="product-image">
                                                    <img alt="image" src="assets/img/products/product-4-50.png" class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">iBook Pro 2018</div>
                                                    <div class="product-review">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="text-muted text-small">67 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img alt="image" src="assets/img/products/product-3-50.png" class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">oPhone S9 Limited</div>
                                                    <div class="product-review">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half"></i>
                                                    </div>
                                                    <div class="text-muted text-small">86 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img alt="image" src="assets/img/products/product-1-50.png" class="img-fluid">
                                                </div>
                                                <div class="product-details">
                                                    <div class="product-name">Headphone Blitz</div>
                                                    <div class="product-review">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="text-muted text-small">63 Sales</div>
                                                    <div class="product-cta">
                                                        <a href="#" class="btn btn-primary">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Top Countries</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="text-title mb-2">July</div>
                                            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                                <li class="media">
                                                    <img class="img-fluid mt-1 img-shadow" src="http://puffintheme.com/craft/codiepie/dist/assets/modules/flag-icon-css/flags/4x3/id.svg" alt="image" width="40">
                                                    <div class="media-body ml-3">
                                                        <div class="media-title">USA</div>
                                                        <div class="text-small text-muted">3,282 <i class="fa fa-caret-down text-danger"></i></div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="img-fluid mt-1 img-shadow" src="http://puffintheme.com/craft/codiepie/dist/assets/modules/flag-icon-css/flags/4x3/my.svg" alt="image" width="40">
                                                    <div class="media-body ml-3">
                                                        <div class="media-title">Malaysia</div>
                                                        <div class="text-small text-muted">2,976 <i class="fa fa-caret-down text-danger"></i></div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="img-fluid mt-1 img-shadow" src="http://puffintheme.com/craft/codiepie/dist/assets/modules/flag-icon-css/flags/4x3/us.svg" alt="image" width="40">
                                                    <div class="media-body ml-3">
                                                        <div class="media-title">United States</div>
                                                        <div class="text-small text-muted">1,576 <i class="fa fa-caret-up text-success"></i></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 mt-sm-0 mt-4">
                                            <div class="text-title mb-2">August</div>
                                            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                                <li class="media">
                                                    <img class="img-fluid mt-1 img-shadow" src="http://puffintheme.com/craft/codiepie/dist/assets/modules/flag-icon-css/flags/4x3/id.svg" alt="image" width="40">
                                                    <div class="media-body ml-3">
                                                        <div class="media-title">USA</div>
                                                        <div class="text-small text-muted">3,486 <i class="fa fa-caret-up text-success"></i></div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="img-fluid mt-1 img-shadow" src="http://puffintheme.com/craft/codiepie/dist/assets/modules/flag-icon-css/flags/4x3/ps.svg" alt="image" width="40">
                                                    <div class="media-body ml-3">
                                                        <div class="media-title">Palestine</div>
                                                        <div class="text-small text-muted">3,182 <i class="fa fa-caret-up text-success"></i></div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <img class="img-fluid mt-1 img-shadow" src="http://puffintheme.com/craft/codiepie/dist/assets/modules/flag-icon-css/flags/4x3/de.svg" alt="image" width="40">
                                                    <div class="media-body ml-3">
                                                        <div class="media-title">Germany</div>
                                                        <div class="text-small text-muted">2,317 <i class="fa fa-caret-down text-danger"></i></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row row-deck">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Invoices</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn btn-danger">View More <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive table-invoice">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Invoice ID</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                                <td><a href="#">INV-87239</a></td>
                                                <td class="font-weight-600">Kusnadi</td>
                                                <td>
                                                    <div class="badge badge-warning">Unpaid</div>
                                                </td>
                                                <td>July 19, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">INV-48574</a></td>
                                                <td class="font-weight-600">Susie Willis</td>
                                                <td>
                                                    <div class="badge badge-success">Paid</div>
                                                </td>
                                                <td>July 21, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">INV-76824</a></td>
                                                <td class="font-weight-600">Muhamad Nuruzzaki</td>
                                                <td>
                                                    <div class="badge badge-warning">Unpaid</div>
                                                </td>
                                                <td>July 22, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">INV-84990</a></td>
                                                <td class="font-weight-600">Agung Ardiansyah</td>
                                                <td>
                                                    <div class="badge badge-warning">Unpaid</div>
                                                </td>
                                                <td>July 22, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">INV-87320</a></td>
                                                <td class="font-weight-600">Ardian Rahardiansyah</td>
                                                <td>
                                                    <div class="badge badge-success">Paid</div>
                                                </td>
                                                <td>July 28, 2018</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        </table>
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
    <script src="assets/modules/jquery.sparkline.min.js"></script>
    <script src="assets/modules/chart.min.js"></script>
    <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="assets/modules/summernote/summernote-bs4.js"></script>
    <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="js/page/index.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

<!--   Tue, 07 Jan 2020 03:35:12 GMT -->

</html>