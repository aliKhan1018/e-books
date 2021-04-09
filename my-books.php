<?php
include "./inc/database.inc.php";
session_start();
$db = new database();

$user_id = $_SESSION["user_id"];
$q = "SELECT `order`.`id` as `order_id`, `book_order`.`book_id`from `order`
        left join `book_order`
        on `order`.`id` = `book_order`.`order_id`
        where `order`.`user_id` = $user_id AND `book_order`.`version` = 'pdf'";
$res = $db->query($q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./head.php"; ?>

</head>

<body>
    <?php include "./header.php"; ?>

    <section class="books-section">
        <div class="container">
            <div class="table-responsive">
                <form method="post" action="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Status</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($res)) {
                                $book = $db->get_entity('book', $row["book_id"]);
                                $order = $db->get_entity('order', $row["order_id"]);
                            ?>
                                <tr>
                                    <td>
                                        <div class="imgbox-sm" style="float: left;"><img src="./img/uploaded/<?= $book["image"] ?>" alt=""></div>
                                        <p style="margin: 13px 0 0 50px;"><?=$book["title"]?></p>
                                    </td>
                                    <td><?= $order["status"] ?></td>
                                    <td>
                                        <a href="./pdf/<?= $book["pdf"] ?>" download="<?= $book["title"] ?>"><?= $book["title"] ?></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>

        </div>
    </section>

    <?php include "./footer.php"; ?>
</body>

</html>