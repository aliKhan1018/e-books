<?php
session_start();
include "./inc/database.inc.php";
$db = new database();

// $q = "SELECT"
$orders = $db->get_entities('order');
$total_orders = $orders->num_rows;

$q = "SELECT substring(orderedon, 1, 10) as `orderedon_date`, SUM(cost) as `total_balance`, count(id) as `total_orders` FROM `order` WHERE `status` = 'completed' or `payment` = 'cc'";
$res = $db->query($q)->fetch_assoc()["total_balance"];
$completed_orders = $db->query($q)->fetch_assoc()["total_orders"];
$orderedon_date = $db->query($q)->fetch_assoc()["orderedon_date"];
$total_balance = $res ? $res : 0;

$q = "SELECT COUNT(id) as total FROM `order` WHERE `status` = 'pending'";
$pending_orders = $db->query($q)->fetch_assoc()["total"];


$q = "SELECT COUNT(id) as total FROM `order` WHERE `status` = 'confirmed'";
$confirmed_orders = $db->query($q)->fetch_assoc()["total"];

$q = "SELECT COUNT(id) as total from `user` where `isadmin` = 0";
$users = $db->query($q)->fetch_assoc()["total"];

$q = "SELECT COUNT(id) as total from `contact`";
$contact_count = $db->query($q)->fetch_assoc()["total"];

$q = "SELECT * from `contact` where resolved = 0 order by id desc limit 3";
$contacts_limited = $db->query($q);

$q = "SELECT createdon, count(id) as registeration FROM `user` WHERE `isadmin` = 0 group by createdon";
$registration = $db->query($q);


$today = date("Y-m-d");
$upto = 30;
echo "<input type='hidden' value='$upto' id='upto'>";

for ($i = 0; $i < $upto; $i++) {
    $date = date("Y-m-d", strtotime("-$i days"));

    $q = "SELECT COUNT(id) as registrations from `user` where `createdon` = '$date'";
    $registrations = $db->query($q)->fetch_assoc()["registrations"];
    $registrations = $registrations ? $registrations : 0;

    $q = "SELECT SUM(cost) as balance from `order` where  (`status` = 'completed' or `payment` = 'cc') and SUBSTRING(`orderedon`, 1, 10) = '$date'";
    $current_balance = $db->query($q)->fetch_assoc()["balance"];
    $current_balance = $current_balance ? $current_balance : 0;

    echo "<input type='hidden' value='$registrations' name='registrations' id='registrations-$i'>";
    echo "<input type='hidden' value='$current_balance' name='earnings' id='balance-$i'>";
    echo "<input type='hidden' value='$date' name='dates' id='date-$i'>";
}


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
                                            <div class="card-stats-item-count"><?= $confirmed_orders ?></div>
                                            <div class="card-stats-item-label">Confirmed</div>
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
                                        $<?= number_format((float)$total_balance, 2, '.', ''); ?>
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

                    <!-- // ? Search for group by statements. -->
                    <!-- // ? group books by sales   -->
                    <div class="row row-deck">
                        <div class="col-lg-4">
                            <div class="card gradient-bottom">
                                <div class="card-header">
                                    <h4>Books Sales</h4>
                                </div>
                                <div class="card-body" id="top-5-scroll">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <?php
                                        $q = "SELECT * from `book`";
                                        $top_5_books = $db->query($q);

                                        // ? two loops: one for setiing variables and querying. And the other for displaying.
                                        while ($row = mysqli_fetch_array($top_5_books)) {
                                            $book_id = $row["id"];

                                            $q = "SELECT `book`.id, count(`book`.id) as phy_sales, `book`.title, sum(`book`.price * phy.quantity) as phy_total from `book`
                                                    left join `book_order` as phy 
                                                    on `book`.id = phy.book_id 
                                                    where phy.book_id = $book_id and phy.version = 'phy'";
                                            $physical = $db->query($q)->fetch_assoc();

                                            $q = "SELECT `book`.id, count(`book`.id) as pdf_sales, `book`.title, sum(`book`.price * pdf.quantity) as pdf_total from `book`
                                                    left join `book_order` as pdf
                                                    on `book`.id = pdf.book_id
                                                    where pdf.book_id = $book_id and pdf.version = 'pdf'";
                                            $pdf = $db->query($q)->fetch_assoc();

                                            $total_phy_earnings = $physical["phy_total"] ? $physical["phy_total"] : 0;
                                            $total_pdf_earnings = $pdf["pdf_total"] ? $pdf["pdf_total"] : 0;
                                            $total_earnings = $total_pdf_earnings + $total_phy_earnings;

                                            $pdf_earnings_perc = $total_earnings > 0 ? ($total_pdf_earnings / $total_earnings) * 100 : 0;
                                            $phy_earnings_perc = $total_earnings > 0 ? ($total_phy_earnings / $total_earnings) * 100 : 0;

                                            $total_sales = $physical["phy_sales"] + $pdf["pdf_sales"];
                                        ?>
                                            <li class="media">
                                                <img class="mr-3 rounded" width="55" src="./img/uploaded/<?= $row["image"] ?>" alt="product">
                                                <div class="media-body">
                                                    <div class="float-right">
                                                        <div class="font-weight-600 text-muted text-small"><?= $total_sales ?> Sales</div>
                                                    </div>
                                                    <div class="media-title"><?= $row["title"] ?></div>
                                                    <div class="mt-1">
                                                        <!-- // ? see if you can work out percentages...well you can..but...yeah..this is weird. -->
                                                        <div class="budget-price">
                                                            <div class="budget-price-square bg-primary" data-width="<?= $phy_earnings_perc ?>%"></div>
                                                            <div class="budget-price-label">$<?= number_format((float)$total_phy_earnings, 2, '.', ''); ?></div>
                                                        </div>
                                                        <div class="budget-price">
                                                            <div class="budget-price-square bg-danger" data-width="<?= $pdf_earnings_perc ?>%"></div>
                                                            <div class="budget-price-label">$<?= number_format((float)$total_pdf_earnings, 2, '.', ''); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
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
                                        <?php while ($row = mysqli_fetch_array($contacts_limited)) { ?>
                                            <a href="#" class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4><?= substr($row["subject"], 0, 50) ?></h4>
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
                                        <a href="list-contact.php" class="ticket-item ticket-more">
                                            View All <i class="fa fa-chevron-right"></i>
                                        </a>

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