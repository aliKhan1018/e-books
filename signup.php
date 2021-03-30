<?php
include "./inc/database.inc.php";
$db = new database();
if (isset($_POST["reg"])) {
    $n = $_POST["name"];
    $p = $_POST["pswd"];
    $e = $_POST["email"];
    $dob = $_POST["dob"];
    $cc = $_POST["cc"];
    $a = $_POST["address"];
    $cn = $_POST["contact"];
    $g = $_POST["gender"];

    $now = date("Y-m-d");

    $user = $db->user_exists($e);
    if ($user) {
        echo Utility::alert("This email is already in use.");
        header("signup.php");
        die;
    } else {
        $img = $_FILES["image"]["name"];
        $path = "./img/uploaded/" . $img;
        move_uploaded_file($_FILES["image"]["tmp_name"], $path);

        $q = "insert into user(name, email, password, dob, creditcard, image, address, contactnumber, gender, isadmin, isseller, createdon)
            values('$n', '$e', '$p', '$dob', '$cc', '$img', '$a', '$cn', '$g', 0, 0, '$now')";
        $res = $db->query($q);
        if ($res) {
            echo Utility::alert("Account Created!");
        } else {
            echo Utility::alert("Error! Check console.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "./head.php"; ?>


</head>

<body>
    <?php include "./header.php"; ?>

    <section class="login-section">
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <h1>Sign Up!</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Name: </label>
                    </td>
                    <td><input type="text" name="name" id="" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Email: </label>
                    </td>
                    <td><input type="email" name="email" placeholder="Enter your email" id=""></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Password: </label>
                    </td>
                    <td><input type="password" name="pswd" placeholder="Enter your password" pattern="[0-9a-zA-Z1@#$%^&]{8, 255}" id=""></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Contact Number: </label>
                    </td>
                    <td><input type="tel" name="contact" placeholder="Enter your contact number" id=""></td>
                </tr>
                <tr>
                    <td><label for="">Address <small>(optional)</small>: </label></td>
                    <td>
                        <input type="text" name="address" placeholder="Enter your address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Preferred Credit Card # <small>(optional)</small>: </label>
                    </td>
                    <td><input type="text" name="cc" id="" placeholder="Enter your credit card #" pattern="[0-9]{16}" title="credit card must exactly be 16 digits long" required></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Gender <small>(optional)</small>: </label>
                    </td>
                    <td>
                        <select name="gender" id="">
                            <option value="Not specified">Select Gender...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Date of Birth <small>(optional)</small>: </label>
                    </td>
                    <td><input type="date" max="<?php echo Utility::get_date_formatted(); ?>" name="dob" id=""></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Image <small>(optional)</small>: </label>
                    </td>
                    <td>
                        <div class="imgbox"><img src="" id="output" alt="Upload an image!"></div>
                        <input type="file" name="image" accept="image/*" id="file" onchange="loadFile(event)">
                    </td>
                </tr>
                <tr>
                    <td><label for="" style="text-decoration: underline; color:tomato;">Do you agree with our terms of use?</label> </td>
                    <td><input type="checkbox" name="terms" id="" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="./login.php">Already have an account?</a></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><input type="submit" value="Sign Up!" id="modal-6" name="reg" class="submit"></td>
                </tr>
            </table>
        </form>
    </section>
    <?php include "./footer.php"; ?>
</body>
<script src="assets/bundles/lib.vendor.bundle.js"></script>
<script src="js/CodiePie.js"></script>

<!-- JS Libraies -->
<script src="assets/modules/prism/prism.js"></script>

<!-- Page Specific JS File -->
<script src="js/page/bootstrap-modal.js"></script>

<!-- Template JS File -->
<script src="js/scripts.js"></script>
<script src="js/custom.js"></script>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

</html>