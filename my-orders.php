<?php
include "./inc/database.inc.php";
session_start();
$db = new database();

$user_id = $_SESSION["user_id"];
$q = "SELECT * FROM `order` WHERE `user_id` = $user_id ORDER BY orderedon DESC";
$res = $db->query($q);

if(isset($_POST["rem"])){
    $db->update_entity('order', 'status', 'cancelled', $_POST["rem"]);
    Utility::redirect_to("my-orders.php");
}

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
                                <th>Ordered On</th>
                                <th></th>
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
                                    <td><?php if(!($row["status"] == "confirmed" or $row["status"] == "completed")){ ?>
                                        <button type="submit" class="btn btn-danger" name="rem" value="<?= $order_id ?>">Cancel Order</button> 
                                        <?php } ?>
                                    </td>
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