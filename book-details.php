<?php
include "./inc/database.inc.php";
$db = new database();
session_start();
$book_id = $_GET["id"];
$_book = $db->get_entity('book', $book_id);

if(isset($_SESSION["user_id"])){
    $u = $db->get_entity('user', $_SESSION["user_id"]);
}

if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $_SESSION['cart'][$book_id]['qty'] = $_SESSION['cart'][$book_id]['qty']+1;
    }
    else{
        $_SESSION['cart'] = array('qty' => 1);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include "./head.php"; ?>
</head>

<body>

    <?php include "./header.php"; ?>

    <main>
        <section class="featured-places">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="">
                            <img src="img/uploaded/<?=$_book["image"]?>" alt="" class="">
                        </div>
                        <br>
                        <!-- <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <img src="img/product-1-720x480.jpg" alt="" class="img-responsive">
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <img src="img/product-2-720x480.jpg" alt="" class="img-responsive">
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <img src="img/product-3-720x480.jpg" alt="" class="img-responsive">
                            </div>
                        </div> -->
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <form action="" method="POST" class="form">
                            <h1><?= $_book['title'] ?></h1>
                            <h1><?= $_book['author'] ?></h1>
                            <h2><strong class="text-primary">$<?= $_book['price'] ?></strong></h2>
                            <h3>publisher: <?= $_book['publisher'] ?></h3>
                            <h3>published on<small>
                                <sub>yyyy-mm-dd</sub>
                            </small>: <?= $_book['publishedon'] ?> </h3>

                            <br>

                            <p class="lead text-justify" style="font-size: 1.5rem;">
                                <?= $_book['description'] ?>
                            </p>

                            <br>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="control-label">Stock</label>
                                    <b>Available: <?= $_book["stock"] ?></b>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="control-label">Quantity</label>
                                    <div class="form-group">
                                        <input type="number" class="form-control" value="1" min="0" max="<?= $_book['stock'] ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="" name="add" value="Add to Cart">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="about-veno">
                        <div class="logo">
                            <img src="img/footer_logo.png" alt="Venue Logo">
                        </div>
                        <p>Mauris sit amet quam congue, pulvinar urna et, congue diam. Suspendisse eu lorem massa. Integer sit amet posuere tellustea dictumst.</p>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="useful-links">
                        <div class="footer-heading">
                            <h4>Useful Links</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="inde.html"><i class="fa fa-stop"></i>Home</a></li>
                                    <li><a href="about.html"><i class="fa fa-stop"></i>About</a></li>
                                    <li><a href="contact.html"><i class="fa fa-stop"></i>Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="products.html"><i class="fa fa-stop"></i>Products</a></li>
                                    <li><a href="testimonials.html"><i class="fa fa-stop"></i>Testimonials</a></li>
                                    <li><a href="blog.html"><i class="fa fa-stop"></i>Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="footer-heading">
                            <h4>Contact Information</h4>
                        </div>
                        <p><i class="fa fa-map-marker"></i> 212 Barrington Court New York, ABC</p>
                        <ul>
                            <li><span>Phone:</span><a href="#">+1 333 4040 5566</a></li>
                            <li><span>Email:</span><a href="#">contact@company.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="sub-footer">
        <p>Copyright © 2020 Company Name - Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>