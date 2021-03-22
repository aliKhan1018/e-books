<div class="wrap">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <button id="primary-nav-button" type="button">Menu</button>
                        <a href="index.html"><div class="logo">
                            <!-- <img src="img/logo.png"  alt="Venue Logo"> -->
                        </div></a>
                        <nav id="primary-nav" class="dropdown cf">
                            <ul class="dropdown menu">
                                <li class='active'><a href="index.php">Home</a></li>

                                <li><a href="books.php">Books</a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Novels</a>
                                            <ul class="sub-menu">
                                                <li><a href="#">Fiction</a></li>
                                                <li><a href="#">Non-Fiction</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Comics</a>
                                            <ul class="sub-menu">
                                                <li><a href="#">Marvel</a></li>
                                                <li><a href="#">DC</a></li>
                                                <li><a href="#">Manga</a></li>
                                            </ul></li>
                                        <li><a href="#">General Knowledge</a></li>
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
                                    if(isset($_SESSION["user_id"])){
                                        echo '<li>Hi, ' .$u["name"] . '
                                        <ul class="sub-menu">
                                        <li><a href="auth-user.php">Profile</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                        </ul> </li>
                                        <li><a href="cart.php" class="fa fa-shopping-cart"><span class="item-count">0</span></a></li>';
                                    }
                                    else{
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