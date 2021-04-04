<?php
include './inc/database.inc.php';
session_start();
$db = new database();
$url_id = $_GET["id"];
$_book = $db->get_entity('book', $url_id);
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
                    <h1>Book Details</h1>
                </div>

                <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?=$_book["title"]?></h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-md v_center">
                                                <tr>
                                                    <th for="">iD</th>
                                                    <td><?= $_book["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">title</th>
                                                    <td><?= $_book["title"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">description</th>
                                                    <td><?= $_book["description"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">price</th>
                                                    <td><?= $_book["price"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">author</th>
                                                    <td><?= $_book["author"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">publisher</th>
                                                    <td><?= $_book["publisher"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">published on</th>
                                                    <td><?= $_book["publishedon"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">stock</th>
                                                    <td><?= $_book["stock"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">category</th>
                                                    <td><?php
                                                    $idd = $_book["category_id"];
                                                    $c = $db->get_entity('category', $idd);
                                                    echo $c['name'];
                                                    ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">image</th>
                                                    <td><div class="imgbox"><img src="./img/uploaded/<?php echo $_book['image']?>"></div></td>
                                                </tr>
                                                <tr>
                                                    <th for="">rating</th>
                                                    <td><?= $_book["rating"];  ?></td>
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
                 <div class="bullet"></div>  <a href="templateshub.net">Templates Hub</a>
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