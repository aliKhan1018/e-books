<?php
include './inc/database.inc.php';
session_start();

$db = new database();

if (isset($_POST["add"])) {
    $title =     $_POST["title"];
    $desc =      $_POST["desc"];
    $author =    $_POST["author"];
    $pubon =     $_POST["pubon"];
    $publisher = $_POST["publisher"];
    $price =     $_POST["price"];
    $stock =     $_POST["stock"];
    $category =  $_POST["category"];
    $subcat =    $_POST["subcategory"];
    $weight =    $_POST["weight"];

    $img = $_FILES["image"]["name"];
    $img_path = "./img/uploaded/" . $img;
    move_uploaded_file($_FILES["image"]["tmp_name"], $img_path);

    $pdf = $_FILES["pdf"]["name"];
    $pdf_path = "./pdf/" . $pdf;
    move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdf_path);

    // query
    $q = "INSERT INTO book (title, author, description, publishedon, publisher, price, stock, category_id, subcategory_id, weight, image, pdf) VALUES ('$title', '$author', '$desc', '$pubon','$publisher', $price, $stock, $category, $subcat,'$weight', '$img', '$pdf') ";

    $res = $db->query($q);
    if ($res) {
        // echo "<div class='alert alert-success'><b>Book Added Successfully!</b></div>";
    } else {
        echo Utility::alert("Error! Check console.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

<head>
    <?php include "./admin-head.php"; ?>
</head>

<body class="layout-4">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <?php include "./admin-header.php"; ?>

            <!-- Start app main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Add Book</h1>
                    </div>

                    <div class="section-body">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <?php if (isset($res) and $res) {
                                ?>
                                    <div class='alert alert-success'><b>Book Added Successfully!</b></div>
                                <?php } ?>

                                <div class="card-header">
                                    <h4>Enter book details</h4>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Book's Title</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-book"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Author</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="author" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-home"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="publisher" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="input-group">
                                                <textarea name="desc" id="" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-dollar"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="price" class="form-control currency">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Weight <b><sub>(in Kgs)</sub></b></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-balance-scale"></i>
                                                    </div>
                                                </div>
                                                <input type="text" pattern="[0-9.]{1,}" name="weight" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Published On</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="date" name="pubon" class="form-control" value="" max="<?= Utility::get_date_formatted(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </div>
                                                <input type="number" name="stock" class="form-control" value="0" min="0">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="sel1">Category</label>
                                                <select class="form-control" id="category" required>
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    $res = $db->get_entities('category');
                                            
                                                    while ($row = mysqli_fetch_array($res)) {
                                                    ?>
                                                        <option value="<?= $row["id"]; ?>"><?= $row["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="sel1">Sub Category</label>
                                                <select class="form-control" id="sub_category" name="subcategory" required>
                                                    <option value="">Select a category</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Genre(s)</label>
                                            <select class="form-control select2" multiple="">
                                                <?php

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div class="imgbox"><img src="" id="output" alt="Upload an image!"></div>
                                            <input type="file" class="form-control" name="image" accept="image/*" id="file" onchange="loadFile(event)">
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control" name="pdf">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Add Book" name="add" class="btn btn-secondary" style="float: right;">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </section>
            </div>

            <!-- Start app Footer part -->
            <footer class="main-footer">
                <div class="footer-left">
                    <div class="bullet"></div> <a href="templateshub.net">Templates Hub</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/CodiePie.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/cleave-js/dist/cleave.min.js"></script>
    <script src="assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
    <script src="assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="js/page/forms-advanced-forms.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var category_id = this.value;
                $.ajax({
                    url: "get_subcat.php",
                    type: "POST",
                    data: {
                        category_id: category_id
                    },
                    cache: false,
                    success: function(dataResult) {
                        $("#sub_category").html(dataResult);
                    }
                });


            });
        });
    </script>
</body>

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

</html>