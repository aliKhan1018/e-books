<?php
include "./inc/database.inc.php";
$db = new database();
session_start();


if (isset($_SESSION["user_id"])) {
    $_user = $db->get_entity('user', $_SESSION["user_id"]);
} else {
    Utility::redirect_to("login.php");
}

$book_id = $_GET["id"];
$_book = $db->get_entity('book', $book_id);

if (isset($_POST['add'])) {
    $quantity = $_POST["quantity"];
    $version = $_POST["ver"];
    $new_stock = $_book["stock"] - $quantity;

    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'][$book_id]['qty'] = $_SESSION['cart'][$book_id]['qty'] + $quantity;
        $_SESSION['cart'][$book_id]['ver'] = $version;
    } else {
        $_SESSION['cart'][$book_id] = array('ver' => "$version", 'qty' => $quantity);
    }
    
    if ($version == "phy") {
        $db->update_entity('book', 'stock', $new_stock, $_book["id"]);
    }

    Utility::redirect_to("book-details.php?id=$book_id");
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
                            <img src="img/uploaded/<?= $_book["image"] ?>" alt="" class="">
                        </div>
                        <br>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <form action="" method="POST" class="book-form">
                            <h1><?= $_book['title'] ?></h1>
                            <h2><?= $_book['author'] ?></h2>
                            <h3 id="book-detail-price"><strong class="text-primary">$<?= $_book['price'] ?></strong></h3>
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
                                    <label class="control-label">Physical / PDF</label>
                                    <select name="ver" class="form-control" id="ver" onchange="showQuantity()">
                                        <option value="phy" selected>Physical</option>
                                        <option value="pdf">PDF</option>
                                    </select>
                                </div>
                            </div>

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
                                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="0" max="<?= $_book['stock'] ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="submit" name="add" value="Add to Cart">
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="review-section">

        </section>
    </main>

    <?php include "./footer.php"; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <script>
        function showQuantity() {
            let ver = document.getElementById("ver").value;
            if (ver == "phy") {
                document.getElementById("quantity").style.display = "block";
            } else if (ver == "pdf") {
                document.getElementById("quantity").style.display = "none";
                document.getElementById("quantity").value = 1;
            }
        }
    </script>
</body>

</html>