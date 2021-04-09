<?php
include "./inc/database.inc.php";
session_start();
$db = new database();


if (isset($_POST["confirm"])) {

     $u_id = $_SESSION["user_id"];
     $zip = $_POST["zip"];
     $pay = $_POST["payment"];
     $name = $_POST["name"];
     $email = $_POST["email"];
     $address = $_POST["address"];
     $phone = $_POST["phone"];
     $grand_total = $_POST["grandtotal"];
     $cc = $_POST["cc"];

     // genreate and check if the order number exists...keep repeating the process as long as it exists.
     do {
          $generated_order_number = Utility::generateOrderNumber();

          $q = "SELECT id FROM `order` WHERE order_number = '$generated_order_number'";
          $res = $db->query($q);
     } while ($res === TRUE);

     // TODO order status based on version being either physical or digital.
     $date = Utility::get_date_formatted();
     $q = "INSERT INTO `order` (`user_id`, `payment`, `zip`, `status`, `order_number`, `cost`, `orderedon`) VALUES ($u_id, '$pay', '$zip', '$status', '$generated_order_number', $grand_total, '$date');";
     $res = $db->query($q);

     // if the book has been inserted sucessfully..
     if ($res) {
          // Get the inserted order's id
          $order_id = $db->get_link()->insert_id;
          // echo Utility::alert($order_id);
          // loop over all the items in the cart to make relation b/w order and book.
          foreach ($_SESSION['cart'] as $key => $value) {
               $book = $db->get_entity('book', $key);
               $book_qty = $value['qty'];
               $version = $value["ver"];
               $q = "INSERT INTO `book_order` (`order_id`, `book_id`, `quantity`, `version`) VALUES  ($order_id, $key, $book_qty, '$version');";
               $res = $db->query($q);
          }
          unset($_SESSION["cart"]);

          // generate one-time pass code.
          do {
               $otp = Utility::generateRandomString(6);

               $q = "SELECT id FROM otp WHERE otp = '$otp'";
               $res = $db->query($q);
          } while ($res === TRUE);


          $q = "INSERT INTO otp (`user_id`, `otp`) VALUES ($u_id, '$otp')";
          $res = $db->query($q);


          // Utility::redirect_to("order.php?id=".$order_id);
     } else {
          echo Utility::alert('Order not processed!');
     }
}

?>

<!DOCTYPE html>
<html>

<head>
     <?php include "./head.php"; ?>
</head>

<body ng-app="">

     <?php include "./header.php"; ?>

     <main>

          <section class="featured-places">
               <div class="container">
                    <div class="row">
                         <section class="books-section">
                              <div class="container">
                                   <div class="table-responsive">
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
                                                       // variable declaration
                                                       $total_price = 0;
                                                       $total_weight = 0;
                                                       // loop over all the book ids
                                                       foreach ($_SESSION['cart'] as $key => $value) {
                                                            // get the book
                                                            $book = $db->get_entity('book', $key);
                                                            // add the product of its price and quantity
                                                            $total_price += $book["price"] * $value["qty"];
                                                            // add the product of its weight and quantity
                                                            $total_weight += $book["weight"] * $value["qty"];
                                                  ?>
                                                            <tr>
                                                                 <td>
                                                                      <?php 
                                                                           if($value["ver"] == "phy"){
                                                                                echo $book["title"];
                                                                           }
                                                                           else if($value["ver"] == "pdf") {
                                                                                echo $book["title"] . " (pdf ver.)";
                                                                           }
                                                                      ?>
                                                                 </td>
                                                                 <td><?= $value['qty'] ?></td>
                                                                 <td>$<span id="price"><?= $book["price"] * $value['qty'] ?></span></td>
                                                                 <td></td>
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
                                                       <td>
                                                            <p>Total Price: $<?= $total_price ?></p>
                                                       </td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>

                              </div>
                         </section>
                    </div>
               </div>
               <div class="container">
                    <div class="row">
                         <div class="col-lg-4 col-md-5 pull-right">
                              <ul class="list-group">
                                   <li class="list-group-item">
                                        <div class="row">
                                             <div class="col-xs-6">
                                                  <em>Sub-total</em>
                                             </div>

                                             <div class="col-xs-6 text-right">
                                                  <strong>$ <?= $total_price ?></strong>
                                             </div>
                                        </div>
                                   </li>

                                   <li class="list-group-item">
                                        <div class="row">
                                             <div class="col-xs-6">
                                                  <em>Weight</em>
                                             </div>

                                             <div class="col-xs-6 text-right">
                                                  <strong><?= $total_weight ?> Kgs</strong>
                                             </div>
                                        </div>
                                   </li>

                                   <li class="list-group-item">
                                        <div class="row">
                                             <div class="col-xs-6">
                                                  <em>Transport Cost <small>(Based on weight)</small></em>
                                             </div>

                                             <div class="col-xs-6 text-right">
                                                  <strong>$ <?php
                                                            $transport_cost = 0;
                                                            if ($total_weight <= 1) {
                                                                 $transport_cost = 2;
                                                            } else if ($total_weight > 1 and $total_weight <= 5) {
                                                                 $transport_cost = 5;
                                                            } else if ($total_weight > 5) {
                                                                 $transport_cost = 7;
                                                            }
                                                            echo $transport_cost;
                                                            ?></strong>
                                             </div>
                                        </div>
                                   </li>

                                   <li class="list-group-item">
                                        <div class="row">
                                             <div class="col-xs-6">
                                                  <em>Total</em>
                                             </div>

                                             <div class="col-xs-6 text-right">
                                                  <strong>$ <?php
                                                            $grand_total = $total_price + $transport_cost;
                                                            echo $grand_total;
                                                            ?></strong>
                                             </div>
                                        </div>
                                   </li>




                              </ul>
                         </div>

                         <div class="col-lg-8 col-md-7">
                              <form action="" method="post">
                                   <input type="hidden" name="grandtotal" value="<?= $grand_total ?>">
                                   <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Name:</label>
                                                  <input type="text" value="<?= $u["name"] ?>" name="name" class="form-control">
                                             </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Email:</label>
                                                  <input type="text" value="<?= $u["email"] ?>" name="email" class="form-control">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Phone:</label>
                                                  <input type="text" value="<?= $u["contactnumber"] ?>" name="phone" pattern="[+0-9]{0,15}" class="form-control">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-sm-6 col-md-12 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Address:</label>
                                                  <input type="text" value="<?= $u["address"] ?>" name="address" class="form-control">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-sm-6 col-md-12 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Zip:</label>
                                                  <input type="text" name="zip" class="form-control" required>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-sm-6 col-md-12 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Credit Card:</label>
                                                  <input type="text" name="cc" value="<?= $u["creditcard"] ?>" class="form-control">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Payment method</label>

                                                  <select name="payment" class="form-control" required>
                                                       <option value="">-- Choose --</option>
                                                       <option value="cod">Cash On Delivery</option>
                                                       <option value="cc">Credit Card</option>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="form-group">
                                        <label class="control-label">
                                             <input type="checkbox" name="terms" required>
                                             I agree with the <a href="terms.html" target="_blank">Terms &amp; Conditions</a>
                                        </label>
                                   </div>

                                   <div class="clearfix">
                                        <div class="blue-button pull-left">
                                             <a href="./cart.php">Back</a>
                                        </div>

                                        <div class="blue-button pull-right">
                                             <input type="submit" value="Confirm" name="confirm" class="submit">
                                        </div>
                                   </div>
                              </form>
                         </div>
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
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</body>

</html>