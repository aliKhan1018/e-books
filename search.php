<?php

include "./inc/database.inc.php";
$db = new database();

require_once("searchConfig.php");
require_once("searchFunction.php");

$params = fetchSearch(
    array(
        'keyword',
        'category',
        'cover',
        'author',
        'language',
        'year',
        'location'
    ),
    array(
        'location'
    )
);

$records = getRecords($params);

?>

<!DOCTYPE html>
<html>

<head>
    <?php include "./head.php";?>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <?php include "./header.php";?>

    <h1>Advanced Search Form</h1>

    <section>

        <form id="search_form" method="get">


            <table>
                <tr>
                    <td><label for="keyword">
                            Keyword:
                        </label></td>
                    <td>
                        <input type="text" name="keyword" id="keyword" value="<?php echo stickyField('keyword'); ?>">

                    </td>
                </tr>
                <tr>
                    <td><label for="category">
                            Category:
                        </label></td>
                    <td> <?php echo getCategories(); ?>
                    </td>
                </tr>
                <tr>
                    <td> <label for="author">
                            Author:
                        </label></td>
                    <td> <?php echo getAuthors(); ?>
                    </td>
                </tr>
                <tr>
                    <td> <label for="year">
                            Year:
                        </label></td>
                    <td> <?php echo getYears(); ?>
                    </td>
                </tr>
                <tr>
                    <td> 
                    </td>
                    <td>
                    <button  type="submit" class="submit">SUBMIT</button>
                    
                    </td>
                </tr>
            </table>






















        </form>

    </section>


    <div class="divider brtd"></div>




    <?php if (!empty($records)) { ?>
    <section class="books-section">
        <div class="container">
            <table class="table-responsive" border="1" style="width:100%;">

                <thead>
                    <tr>
                        <th>
                            Book title
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Author(s)
                        </th>
                        <th>
                            Year
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Buy Now
                        </th>
                    </tr>

                </thead>

                <?php foreach($records as $row) { ?>

                <tr>
                    <td>
                        <?php echo $row['Title']; ?>
                    </td>
                    <td>
                        <?php echo $row['Category']; ?>
                    </td>
                    <td>
                        <?php echo $row['Author']; ?>
                    </td>
                    <td>
                        <?php echo $row['Year']; ?>
                    </td>
                    <td>
                        <?php echo $row['Price']; ?>
                    </td>
                    <td>
                        <a href="book-details.php?id=<?= $row['id'] ?>">
                            <div><b>Buy Now!</b></div>
                        </a>
                    </td>

                </tr>

                <?php } ?>

            </table>
        </div>
    </section>

    <?php } else { ?>

    <p>There are no records available.</p>

    <?php } ?>



    </div>

    </div>
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