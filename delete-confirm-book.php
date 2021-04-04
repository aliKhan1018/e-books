<?php
include './inc/database.inc.php';
session_start();
$db = new database();
$id = $_GET["id"];
$book_to_delete = $db->get_entity('book', $id);
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
                        <h2 class="section-title">Are you sure you want to delete this book?</h2>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?=$book_to_delete["title"]?></h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-md v_center">
                                                <tr>
                                                    <th for="">iD</th>
                                                    <td><?= $book_to_delete["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">title</th>
                                                    <td><?= $book_to_delete["title"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">description</th>
                                                    <td><?= $book_to_delete["description"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">price</th>
                                                    <td><?= $book_to_delete["price"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">author</th>
                                                    <td><?= $book_to_delete["author"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">publisher</th>
                                                    <td><?= $book_to_delete["publisher"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">published on</th>
                                                    <td><?= $book_to_delete["publishedon"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">stock</th>
                                                    <td><?= $book_to_delete["stock"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">category</th>
                                                    <td><?php
                                                    $idd = $book_to_delete["category_id"];
                                                    $c = $db->get_entity('category', $idd);
                                                    echo $c['name'];
                                                    ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">image</th>
                                                    <td><div class="imgbox"><img src="./img/uploaded/<?php echo $book_to_delete['image']?>"></div></td>
                                                </tr>
                                                <tr>
                                                    <th for="">rating</th>
                                                    <td><?= $book_to_delete["rating"];  ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><a class="btn btn-danger" href="./delete-book.php?id=<?=$book_to_delete['id']?>">Confirm Delete</a></td>
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