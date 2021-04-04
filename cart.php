<?php
include "./inc/database.inc.php";
session_start();
$db = new database();

if (isset($_POST['rem'])) {
     // echo Utility::alert($_POST['rem']);
     $rem_id = $_POST['rem'];
     $book_to_remove = $db->get_entity('book', $rem_id);

     unset($_SESSION['cart'][$rem_id]);
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
                                        <th>Book</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   // $res = $db->get_entities('book');

                                   if (isset($_SESSION["cart"])) {
                                        $total_price = 0;
                                        foreach ($_SESSION['cart'] as $key => $value) {
                                             $book = $db->get_entity('book', $key);
                                             $total_price += $book["price"] * $value["qty"];

                                   ?>
                                             <tr>
                                                  <td>
                                                       <div class="book-img"><img width="100px" height="150px" src="./img/uploaded/<?= $book["image"] ?>" alt=""></div>
                                                  </td>
                                                  <td><input type="number" name="quantity" value="<?= $value['qty'] ?>" min="0" max="<?= $book['stock'] ?>" id="qty" onchange="updatePrice(<?= $book['price'] ?>)"></td>
                                                  <td>$<span id="price"><?= $book["price"] ?></span></td>
                                                  <td><button type="submit" class="btn btn-danger" name="rem" value="<?= $key ?>">Remove Book</button></td>
                                             </tr>
                                        <?php }
                                   } else {
                                        ?>
                                        <tr>
                                             <td colspan="4">
                                                  <div class="alert alert-danger">
                                                       <p><b>Cart Empty!</b></p>
                                                  </div>
                                             </td>
                                        </tr>
                                   <?php
                                   }
                                   ?>
                                   <tr>
                                        <td colspan="3"></td>
                                        <td><p>Total Price: $<?=$total_price?></p></td>
                                   </tr>
                                   <tr>
                                        <td colspan="3"></td>
                                        <td><a href="./checkout.php">Checkout</a></td>
                                   </tr>
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