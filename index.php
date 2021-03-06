<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
if (isset($_SESSION["user_id"])) {
    $u = $db->get_entity('user', $_SESSION["user_id"]);
    if ($u["isadmin"] == 1) {
        header("location: admin-index.php");
        die;
    }
}

$date = Utility::get_date_formatted();
$q = "SELECT * FROM `competition` where `start_time` > '$date'";
$upcoming_competitions = $db->query($q);

$q = "SELECT * FROM `competition` where `start_time` = '2021-04-06'";
$res = $db->query($q);

$ongoing_competition = $res->fetch_assoc();

$q = "SELECT count(id) as total FROM `participant` where competition_id = " . $ongoing_competition["id"];
$participant_count = $db->query($q)->fetch_assoc()["total"];



?>

<!DOCTYPE html>
<html>

<head>
    <?php include "./head.php"; ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400&display=swap" rel="stylesheet">
</head>

<body>

    <?php include "./header.php"; ?>

    <section class="banner" id="top" style="background-image: url(img/_/floating-book.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <h2 style="font-family: 'Playfair Display'; font-weight:800; font-size:6rem;">IQRA</h2>
                        <!-- <h4 style="font-family: 'Playfair Display'; font-weight:300; font-size:2rem;"> Book ki Daraz </h4> -->
                        <h2 style="font-family: 'Nunito', sans-serif; font-weight:500;">Reading Evolved</h2>
                        <div class="line-dec"></div>
                        <div class="blue-button">
                            <a href="#about">Learn More!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="our-services" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="left-content">
                        <br>
                        <h4 class="heading">Ongoing Competitions</h4>
                        <?php
                        if ($ongoing_competition) {
                        ?>
                            <p>Previous Winner: [name here]</p>
                            <strong>
                                <p>Topic: <?= $ongoing_competition["topic"] ?></p>
                                <p>Lasts till: <?= $ongoing_competition["end_time"] ?></p>
                                <p>Participants: <?= $participant_count ?></p>
                            </strong>

                            <div class="submit" style="float: left;">
                                <a href="participate.php?id=<?= $ongoing_competition["id"] ?>">Participate Now</a>
                            </div>
                        <?php
                        }
                        ?>
                        <br>
                    </div>
                </div>
                <div class="col-md-5">
                    <h2>Upcoming</h2>

                    <?php
                    if ($upcoming_competitions) {
                        $i = 0;
                        while ($row = mysqli_fetch_array($upcoming_competitions)) {
                            $i++;
                    ?>
                            <p><?= $i ?>. <?= $row["topic"] ?></p>
                            <p><?= $row["start_time"] ?> - <?= $row["end_time"] ?></p>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section> -->

    <main>



        <section class="our-services" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="left-content">
                            <br>
                            <h4 class="heading">About us</h4>
                            <p>Iqra is the leading creator and provider of premium storytelling, enriching the lives of our millions of readers every day. With our customer-centric approach to technological innovation and superior programming, Iqra has reinvented a how you read.</p>

                            <p>Iqra's People Principles celebrate who we are and where we???ve been, and guide the way we work shoulder to shoulder to enhance the lives of our customers. They reflect and apply to everyone who works at the entrepreneurs and operators, the dreamers and the doers, those who have worked here for 20 years and those who have arrived in the past few weeks and months.</p>

                            <p>We believe a company can have a heart, soul, and mission. We strive to be a leader in urban revitalization, leveraging our entrepreneurial spirit to make a positive impact in the communities in which we operate.</p>
                            <!-- <div class="blue-button">
                                <a href="about-us.html">Discover More</a>
                            </div> -->

                            <br>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="img/_/spencer-K5h_45qTybI-unsplash.jpg" height="400px" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-places">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <span>New Releases</span>
                            <h2>GET 'EM NOW!</h2>
                            <!-- TODO add logic to show only 3 latest releases products -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php

                    // $res = $db->get_entities('book');
                    $q = "SELECT * from `book` order by `publishedon` desc limit 3";
                    $res = $db->query($q);
                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <div class="col-md-4 col-sm-6 col-xs-12" style="display: flex; justify-content:center;">
                            <div class="featured-item">
                                <div class="thumb">
                                    <img src="img/uploaded/<?= $row['image'] ?>" alt="">
                                </div>
                                <div class="back-info">
                                    <h1 class="title"><?php echo substr($row['title'], 0, 13);
                                                        if (strlen($row["title"]) > 13) {
                                                            echo "...";
                                                        }
                                                        ?> </h1>
                                    <h2 class="author"><?= $row['author'] ?></h2>
                                    <p><?php echo substr($row['description'], 0, 125);
                                        if (strlen($row["description"]) > 125) {
                                            echo "...";
                                        }
                                        ?> </p>
                                    <a href="book-details.php?id=<?= $row['id'] ?>">
                                        <div class="buy-button" style="width: 100%;"><b>Buy Now!</b></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section id="video-container">
            <div class="video-overlay"></div>
            <div class="video-content">
                <div class="inner">
                    <div class="section-heading">
                        <span>Contact Us</span>
                        <h2>Have an issue? Want to suggest something? We are always listening to what our customers have to say.</h2>
                    </div>

                    <div class="blue-button">
                        <a href="contact.php">Give us your feedback</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="popular-places" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <span>Testimonials</span>
                            <h2></h2>
                        </div>
                    </div>
                </div>

                <div class="owl-carousel owl-theme">
                    <div class="item popular-item">
                        <div class="thumb">
                            <img src="img/popular_item_1.jpg" alt="">
                            <div class="text-content">
                                <h4>John Doe</h4>
                                <span>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</span>
                            </div>
                            <div class="plus-button">
                                <a href="testimonials.html"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <img src="img/popular_item_2.jpg" alt="">
                            <div class="text-content">
                                <h4>John Doe</h4>
                                <span>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</span>
                            </div>
                            <div class="plus-button">
                                <a href="testimonials.html"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <img src="img/popular_item_3.jpg" alt="">
                            <div class="text-content">
                                <h4>John Doe</h4>
                                <span>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</span>
                            </div>
                            <div class="plus-button">
                                <a href="testimonials.html"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <img src="img/popular_item_4.jpg" alt="">
                            <div class="text-content">
                                <h4>John Doe</h4>
                                <span>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</span>
                            </div>
                            <div class="plus-button">
                                <a href="testimonials.html"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <img src="img/popular_item_5.jpg" alt="">
                            <div class="text-content">
                                <h4>John Doe</h4>
                                <span>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</span>
                            </div>
                            <div class="plus-button">
                                <a href="testimonials.html"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <img src="img/popular_item_1.jpg" alt="">
                            <div class="text-content">
                                <h4>John Doe</h4>
                                <span>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</span>
                            </div>
                            <div class="plus-button">
                                <a href="testimonials.html"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <img src="img/popular_item_2.jpg" alt="">
                            <div class="text-content">
                                <h4>John Doe</h4>
                                <span>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</span>
                            </div>
                            <div class="plus-button">
                                <a href="testimonials.html"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </main>

    <?php
    include "./footer.php";
    ?>

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