<?php
include './inc/database.inc.php';
session_start();

$db = new database();

if (isset($_POST["add"])) {
    $topic = $_POST["topic"];
    $prize = $_POST["prize"];
    $start = $_POST["starttime"];
    $end = $_POST["endtime"];

    $pdf = $_FILES["pdf"]["name"];
    $path = "./pdf/" . $pdf;
    move_uploaded_file($_FILES["pdf"]["tmp_name"], $path);

    $q = "INSERT INTO competition (topic, prize, start_time, end_time, research) VALUES ('$topic', '$prize', '$start', '$end', '$pdf')";
    $res = $db->query($q);
    if ($res) {
    } else {
        echo Utility::alert("Error! Check console.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

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
                        <h1>Add Competition</h1>
                    </div>

                    <div class="section-body">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <?php if (isset($res)) {
                                ?>
                                    <div class='alert alert-success'><b>Competition Added Successfully!</b></div>
                                <?php } ?>

                                <div class="card-header">
                                    <h4>Enter competition details</h4>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Topic</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-book"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="topic" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Prize</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-dollar"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="prize" pattern="[0-9.]{1,}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Research Material</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-flask"></i>
                                                    </div>
                                                </div>
                                                <input type="file" name="pdf" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Start Time</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" min="<?=Utility::get_date_formatted()?>" name="starttime" id="start-time" onchange="updateDate()">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-sm-12 col-md-6">
                                                <label>End Time</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="date" name="endtime" id="end-time">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value="Add Competition" name="add" class="btn btn-secondary" style="float: right;">
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

        function updateDate(){
            let startDate = document.getElementById("start-time").value;
            document.getElementById("end-time").min = startDate;
        }
    </script>
</body>

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

</html>