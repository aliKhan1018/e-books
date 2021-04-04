<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
$url_id = $_GET["category_id"];

$q = "SELECT * FROM BOOK WHERE CATEGORY_ID = $url_id";
$res = $db->query($q);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./head.php"; ?>
</head>

<body>
    <?php include "./header.php"; ?>

    <main>
        <section class="featured-places">
            <div class="container">
            <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <div class="col-md-4 col-sm-6 col-xs-12" style="display: flex; justify-content:center;">
                            <div class="featured-item">
                                <div class="thumb">
                                    <img src="img/uploaded/<?= $row['image'] ?>" alt="">
                                </div>
                                <div class="back-info">
                                    <h1 class="title"><?php echo substr($row['title'], 0, 13);
                                                        if (strlen($row["title"]) > 13) {
                                                            echo "...";
                                                        } 
                                                        ?> </h1>
                                    <h2 class="author"><?= $row['author'] ?></h2>
                                    <p><?= substr($row['description'], 0, 125) ?>...</p>
                                    <a href="book-details.php?id=<?= $row['id'] ?>">
                                        <div class="buy-button" style="width: 100%;"><b>Buy Now!</b></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
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
</body>

</html>