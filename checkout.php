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
          $generated_order_number = Utility::generateRandomString('order', 11);

          $q = "SELECT id FROM `order` WHERE order_number = '$generated_order_number'";
          $res = $db->query($q);
     } while ($res === TRUE);

     $date = date("Y-m-d h:iA", time());
     $q = "INSERT INTO `order` (`user_id`, `payment`, `zip`, `order_number`, `cost`, `orderedon`) VALUES ($u_id, '$pay', '$zip', '$generated_order_number', $grand_total, '$date');";
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
               $status = "";

               if ($version == 'pdf'){
                    $status = "completed";
               }
               else if ($version == "phy"){
                    $status = "pending";
               }
               
               $q = "INSERT INTO `book_order` (`order_id`, `book_id`, `quantity`, `version`, `status`) VALUES  ($order_id, $key, $book_qty, '$version', '$status');";
               $res = $db->query($q);
          }

          $q = "SELECT * from book_order where order_id = $order_id";
          $res = $db->query($q);

          $found = false;
          while($bo = mysqli_fetch_array($res)){
               if($bo["version"] == 'phy'){
                    $found = true;
               }
          }

          $order_status = $found ? "pending" : "completed";
          $db->update_entity('order', 'status', $order_status, $order_id);
     
          // unset the cart variable in stored in session.
          unset($_SESSION["cart"]);

          // generate one-time pass code.
          do {
               $otp = Utility::generateRandomString('otp', 6);

               $q = "SELECT id FROM otp WHERE otp = '$otp'";
               $res = $db->query($q);
          } while ($res === TRUE);

          $q = "INSERT INTO otp (`otp`, `order_id`) VALUES ('$otp', $order_id)";
          $res = $db->query($q);
// email
$to = $email;
$subject = 'Order Confirmation';
$from = 'peterparker@email.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = "<html><body>";
$message .= '<h1 style="color:orange">Your order has been placed</h1>';
$message .= " <p>We are pleased to inform that your order has been placed.
We hope you are enjoying your recent purchase! Once you have a chance, we would love to hear
your shopping experience to keep us constantly improving.</p>";
$message .= '<h3 style="color:orange">Package Details</h3>';
$message .= "<tr><td><strong>Your OTP(one time password) is: $otp</strong> </td><td></td></tr>";
$message .= "<tr><td><strong>Your order number is: </strong> $generated_order_number</td><td></td></tr>";
$message .= "<tr><td><strong>Click here to confirm your order: </strong> http://localhost/e-books/confirm-order.php?order_id=$order_id</td><td></td></tr>";
$message .= '<h3 style="color:orange">Contact Details</h3>';
$message .= "<tr><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
$message .= "<tr><td><strong>Address:</strong> </td><td>" . strip_tags($_POST['address']) . "</td></tr>";
$message .= "<tr><td><strong>Contact Number:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
$message .= "</body></html>";
// Sending email
if(mail($to, $subject, $message, $headers)){
     echo "<script type='text/javascript'>alert('emailsent');</script>";
} else{
     echo "<script type='text/javascript'>alert('not emailsent');</script>";
}


// eamil ends

          Utility::redirect_to("order.php?id=".$order_id);
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
                                                  <input type="text" pattern="[0-5]*" name="zip" class="form-control" required>
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
                                             I agree with the <a href="terms.php" target="_blank">Terms &amp; Conditions</a>
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