<?php
if (isset($_SESSION["user_id"])) {
    $u = $db->get_entity('user', $_SESSION["user_id"]);
}
?>
<div class="wrap">
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button id="primary-nav-button" type="button">Menu</button>
                    <a href="index.html">
                        <div class="logo">
                            <!-- <img src="img/logo.png"  alt="Venue Logo"> -->
                        </div>
                    </a>
                    <nav id="primary-nav" class="dropdown cf">
                        <ul class="dropdown menu">
                            <li class='active'><a href="index.php">Home</a></li>

                            <li><a href="books.php">Books</a>
                                <ul class="sub-menu">
                                    <?php
                                    $c = $db->get_entities('category');
                                    while ($cat = mysqli_fetch_array($c)) {
                                    ?>
                                        <li><a href="books-<?= strtolower($cat["name"]) ?>.php?category_id=<?= $cat["id"] ?>"><?= $cat["name"] ?></a>
                                            <?php
                                            $q = "SELECT * FROM subcategory WHERE category_id = " . $cat['id'];
                                            $sc = $db->query($q);
                                            if ($sc->num_rows > 0) {
                                                echo "<ul class='sub-menu'>";
                                                while ($subcat = mysqli_fetch_array($sc)) {
                                            ?>
                                        <li><a href="#"><?= $subcat['name'] ?></a></li>
                                <?php }
                                                echo "</ul>";
                                            } ?>
                            </li>
                            </li>
                        <?php } ?>
                        </ul>
                        </li>



                        <li>
                            <a href="#">About</a>
                            <ul class="sub-menu">
                                <li><a href="about-us.php">About Us</a></li>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="terms.php">Terms</a></li>
                            </ul>
                        </li>

                        <li><a href="contact.php">Contact Us</a></li>
                        <?php
                        if (isset($_SESSION["user_id"])) {
                        ?>
                            <li>Hi, <?= $u["name"] ?>
                                <ul class="sub-menu">
                                    <li><a href="auth-user.php">Profile</a></li>
                                    <li><a href="my-books.php">My Books</a></li>
                                    <li><a href="my-orders.php">My Orders</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="cart.php" class="fa fa-shopping-cart">
                                    <span class="item-count">
                                        <?php
                                        if (isset($_SESSION['cart'])) {
                                            echo count($_SESSION['cart']);
                                        } else {
                                            echo '0';
                                        } ?>
                                    </span>
                                </a>
                                <ul class="cart-dropdown">
                                    <table class="cart-table">
                                        <tr>
                                            <th>Book</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </tr>
                                        <?php
                                        if (isset($_SESSION['cart'])) {
                                            $total_price = 0;
                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                $book = $db->get_entity('book', $key);
                                                $total_price += $book["price"] * $value["qty"];
                                        ?>
                                                <tr class="cart-item">
                                                    <td>
                                                        <div class="imgbox-sm"><img src="./img/uploaded/<?= $book["image"] ?>" alt=""></div>
                                                    </td>
                                                    <td>
                                                        <?= $value["qty"] ?>
                                                        <!-- <input type="number" min="0" value="<?= $value["qty"]; ?>" name="quantity" id=""> -->
                                                    </td>
                                                    <td>$<?= $book["price"] ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <?php
                                                if (isset($_SESSION['cart'])) {
                                                ?>
                                                    <td style="padding: 20px;"><b>Total: $<?= $total_price ?></b></td>
                                            <?php
                                                }
                                            }

                                            ?>

                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <?php
                                                    if (isset($_SESSION["cart"])) {
                                                    ?>
                                                        <div class="btn-checkout">
                                                            <a href="#" class=""><b>Proceed to Checkout</b></a>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                    </table>

                                </ul>
                            </li>
                        <?php
                        } else { ?>
                            <li><a href="signup.php">Sign up</a></li>
                            <li><a href="login.php">Login</a></li>
                        <?php
                        }
                        ?>



                        <!-- <li><a href="checkout.php">Checkout</a></li> -->
                        </ul>
                    </nav><!-- / #primary-nav -->
                </div>
            </div>
        </div>
    </header>
</div>