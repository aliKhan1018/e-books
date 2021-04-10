<?php
include "./inc/database.inc.php";
session_start();
$db = new database();

$user_id = $_SESSION["user_id"];
$q = "SELECT * FROM `order` WHERE `user_id` = $user_id ORDER BY orderedon DESC";
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
                                <th>Order # </th>
                                <th>Books </th>
                                <th>Status</th>
                                <th>Cost</th>
                                <!-- // ! order orders by the date they were ordered on. -->
                                <th>Ordered On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($res)) {
                                $order_id = $row["id"];
                                $q = "SELECT book_id from `book_order` where order_id = (SELECT id from `order` where id = $order_id)";
                                $book_ids_in_order = $db->query($q);
                            ?>
                                <tr>
                                    <td><a href="order.php?id=<?= $row["id"] ?>"><?= $row["order_number"] ?></a></td>
                                    <td>
                                        <?php
                                        while ($books_row = mysqli_fetch_array($book_ids_in_order)) {
                                            $_book = $db->get_entity('book', $books_row["book_id"]);
                                        ?>
                                            <div class="imgbox-sm" style="float: left; margin-right:10px;"><img src="./img/uploaded/<?= $_book["image"] ?>" alt=""></div>
                                        <?php } ?>
                                    </td>
                                    <td><?= $row["status"] ?></td>
                                    <td>$<?= $row["cost"] ?></td>
                                    <td><?= $row["orderedon"] ?></td>
                                </tr>
                            <?php }
                            ?>
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