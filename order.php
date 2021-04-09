<?php
include "./inc/database.inc.php";
session_start();
$db = new database();

$order_id = $_GET["id"];

$q = "SELECT * FROM book_order WHERE order_id = $order_id";
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
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = mysqli_fetch_array($res)) {
                                $book = $db->get_entity('book', $row["book_id"]);
                            ?>
                                <tr>
                                    <td><div class="imgbox-sm"><img src="./img/uploaded/<?=$book["image"]?>" alt=""></div></td>
                                    <td><?=$row["quantity"]?></td>
                                    <td><?=$book["price"]  * $row["quantity"]?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>

        </div>
    </section>

    <?php include "./footer.php"; ?>
    <script>
        // function updatePrice(price) {
        //      let qty = document.getElementById("qty").value;
        //      let total = parseFloat(price) * parseFloat(qty);
        //      document.getElementById("price").innerText = total;
        // }
    </script>
</body>

</html>