<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
$user_id = $_SESSION["user_id"];
if (isset($_SESSION["user_id"])) {
  $u = $db->get_entity('user', $_SESSION["user_id"]);
}

if (isset($_POST["add"])) {
  $name = $_POST["name"];
  $subject = $_POST["subject"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  $q = "INSERT INTO `contact` (`user_id`, `subject`, `email`, `message`) VALUES($user_id, '$subject', '$email', '$message')";
  $res = $db->query($q);
}
?>

<!DOCTYPE html>
<html>

<head>
  <?php include "./head.php"; ?>
</head>

<body>
  <?php include "./header.php"; ?>
  <main>
    <section class="popular-places">
      <div class="container">
        <h1>CONTACT US</h1>
        <div class="contact-content">
          <div class="row">
            <form action="" method="POST">
              <div class="col-md-8">
                <div class="left-content">
                  <div class="row">
                    <div class="col-md-6">
                      <fieldset>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Your name..." pattern="[A-Za-z ]{3,255}">
                      </fieldset>
                    </div>
                    <div class="col-md-6">
                      <fieldset>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email..." required="">
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject..." required="">
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your message..." required=""></textarea>
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <input type="submit" value="Send" name="add" class="submit">
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="right-content">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="content">
                        <b>If you have any concerns, feel free to contact us.</b>
                        <ul>
                          <li><span>Phone:</span><a href="#">+92 300 1018420</a></li>
                          <li><span>Email:</span><a href="mailto:iqra@info.com">iqra@info.com</a></li>
                          <li><span>Address:</span><i class="fa fa-map-marker"></i> 13/E Gulshan-e-Iqbal Karachi</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <?php include "./footer.php"; ?>
  </footer>
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