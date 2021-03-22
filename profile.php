<?php
include "./inc/database.inc.php";
session_start();
$db = new database();
$u_id = $_SESSION["user_id"];
if(isset($_SESSION["user_id"])){
    $u = $db->get_entity('user', $u_id);
}

if(isset($_POST["update"])){
    $n = $_POST["name"];
    $p = $_POST["pswd"];
    $e = $_POST["email"];
    $dob = $_POST["dob"];
    $cc = $_POST["cc"];
    $a = $_POST["address"];
    $cn = $_POST["contact"];
    $g = $_POST["gender"];

    $img = $_FILES["image"]["name"];
    if($img != $u["image"]){
        $path = "./img/uploaded/" . $img;
        move_uploaded_file($_FILES["image"]["tmp_name"], $path);
        $db->update_entity('user', 'image', $img, $u_id);
    }

    $db->update_entity('user', 'name', $n, $u_id);
    $db->update_entity('user', 'password', $p, $u_id);
    $db->update_entity('user', 'email', $e, $u_id);
    $db->update_entity('user', 'dob', $dob, $u_id);
    $db->update_entity('user', 'creditcard', $cc, $u_id);
    $db->update_entity('user', 'address', $a, $u_id);
    $db->update_entity('user', 'contactnumber', $cn, $u_id);
    $db->update_entity('user', 'gender', $g, $u_id);
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
                        <h1>Profile</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Name: </label>
                    </td>
                    <td><input type="text" name="name" id="" placeholder="Enter your name" value="<?=$u["name"]?>"></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Email: </label>
                    </td>
                    <td><input type="email" name="email" placeholder="Enter your email" id="" value="<?=$u["email"]?>"></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Password: </label>
                    </td>
                    <td><input type="password" name="pswd" placeholder="Enter your password" pattern="[0-9a-zA-Z1@#$%^&]{8, 255}" id="" value="<?=$u["password"]?>"></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Contact Number: </label>
                    </td>
                    <td><input type="tel" name="contact" placeholder="Enter your contact number" id="" value="<?=$u["contactnumber"]?>"></td>
                </tr>
                <tr>
                    <td><label for="">Address <small>(optional)</small>: </label></td>
                    <td>
                        <input type="text" name="address" placeholder="Enter your address" value="<?=$u["address"]?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Preferred Credit Card # <small>(optional)</small>: </label>
                    </td>
                    <td><input type="text" name="cc" id="" placeholder="Enter your credit card #" value="<?=$u["creditcard"]?>" pattern="[0-9]{16}" title="credit card must exactly be 16 digits long" required></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Gender <small>(optional)</small>: </label>
                    </td>
                    <td>
                        <select name="gender" id="" required>
                            <option value="">Select Gender...</option>
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
                    <td><input type="date" max="<?php echo Utility::get_date_formatted(); ?>" name="dob" id="" Value="<?=$u["dob"]?>"></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Image <small>(optional)</small>: </label>
                    </td>
                    <td>
                        <div class="imgbox"><img src="./img/uploaded/<?=$u["image"]?>" id="output" alt="Upload an image!"></div>
                        <input type="file" name="image" accept="image/*" id="file" onchange="loadFile(event)">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" value="Save Changes!" name="update" class="submit"></td>
                </tr>
            </table>
        </form>
    </section>
    <?php include "./footer.php"; ?>
</body>