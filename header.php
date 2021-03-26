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
                                    while ($cat = mysqli_fetch_array($c)) 
                                    {
                                    ?>
                                        <li><a href="#"><?= $cat["name"] ?></a>
                                            <?php
                                            $q = "SELECT * FROM subcategory WHERE category_id = " . $cat['id'];
                                            $sc = $db->query($q);
                                            if ($sc->num_rows > 0) 
                                            {
                                                echo "<ul class='sub-menu'>";
                                                while ($subcat = mysqli_fetch_array($sc)) 
                                                {
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
                            echo '<li>Hi, ' . $u["name"] . '
                                        <ul class="sub-menu">
                                        <li><a href="auth-user.php">Profile</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                        </ul> </li>
                                        <li><a href="cart.php" class="fa fa-shopping-cart"><span class="item-count">';
                                        if(isset($_SESSION['cart'])){
                                            echo count($_SESSION['cart']);
                                        } else {
                                            echo '0';
                                        }
                                        echo '</span></a></li>';
                        } else {
                            echo '<li><a href="signup.php">Sign up</a></li> 
                                        <li><a href="login.php">Login</a></li>';
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