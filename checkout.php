<?php
include "./inc/database.inc.php";
session_start();
$db = new database();



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
                                        $total_weight = 0;
                                        foreach ($_SESSION['cart'] as $key => $value) {
                                             $book = $db->get_entity('book', $key);
                                             $total_price += $book["price"] * $value["qty"];
                                             $total_weight += $book["weight"] * $value["qty"];

                                   ?>
                                             <tr>
                                                  <td>
                                                       <?=$book["title"]?>
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
                                        <td><p>Total Price: $<?=$total_price?></p></td>
                                   </tr>
                              </tbody>
                         </table>
                    </form>
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
                                                  <strong>$ <?=$total_price?></strong>
                                             </div>
                                        </div>
                                   </li>

                                   <li class="list-group-item">
                                        <div class="row">
                                             <div class="col-xs-6">
                                                  <em>Weight</em>
                                             </div>

                                             <div class="col-xs-6 text-right">
                                                  <strong><?=$total_weight?> Kgs</strong>
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
                                                       if($total_weight <= 1){
                                                            $transport_cost = 2;
                                                       }
                                                       else if($total_weight > 1 and $total_weight <= 5){
                                                            $transport_cost = 5;
                                                       }
                                                       else if($total_weight > 5){
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
                                                  <strong>$ <?=$total_price + $transport_cost?></strong>
                                             </div>
                                        </div>
                                   </li>

                                   

                                   
                              </ul>
                         </div>

                         <div class="col-lg-8 col-md-7">
                              <form action="" method="POST">
                                   <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Name:</label>
                                                  <input type="text" class="form-control">
                                             </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Email:</label>
                                                  <input type="text" class="form-control">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Phone:</label>
                                                  <input type="text" pattern="[+0-9]{0,15}" class="form-control">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-sm-6 col-md-12 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Address:</label>
                                                  <input type="text" class="form-control">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-sm-6 col-md-12 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Zip:</label>
                                                  <input type="text" class="form-control">
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                             <div class="form-group">
                                                  <label class="control-label">Payment method</label>

                                                  <select class="form-control" required>
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