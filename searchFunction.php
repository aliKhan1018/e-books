<?php


function processParams($params = null) {

    if (empty($params)) {

        return array();

    }

    $paramsConverted = array();
//Using get_magic_quotes_gpc() to prevent SQL injection;

    if (get_magic_quotes_gpc() === true) {
//Checking if params is an array
        if (is_array($params)) {

            foreach($params as $key => $value) {
//striping slashes from values
                $paramsConverted[$key] = stripcslashes($value);

            }

        } else {
//striping slashes from params

            $paramsConverted[] = stripcslashes($params);

        }

    } else {

        $paramsConverted = is_array($params) ? $params : array($params);

    }

    return $paramsConverted;

}







function query($sql = null, $params = null) {

//Database Recall

    $objDb = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWORD, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));


    $statement = $objDb->prepare($sql);


    if (!$statement) {
//Generating Error on null Statement
        $errorInfo = $objDb->errorInfo();

        throw new PDOException("Database error [{$errorInfo[0]}]: {$errorInfo[2]}, driver error code is {$errorInfo[1]}");

    }


    $paramsConverted = processParams($params);


    if (
        !$statement->execute($paramsConverted) ||
        $statement->errorCode() != '00000'
    ) {

        $errorInfo = $statement->errorInfo();

        throw new PDOException(
            "Database error [{$errorInfo[0]}]: {$errorInfo[2]}, driver error code is {$errorInfo[1]} <br /> SQL: {$sql}"
        );

    }

    return $statement;

}





function fetchRecords($sql = null, $params = null) {

    try {
//Generating Error on null Statement

        if (empty($sql)) {

            throw new PDOException('The fetchRecords function failed : missing sql');

        }

        $statement = query($sql, $params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo $e->getMessage();
        exit();

    }

}




function fetchRecord($sql = null, $params = null) {

    try {
//Generating Error on null Statement

        if (empty($sql)) {

            throw new PDOException('The fetchRecord function failed : missing sql');

        }

        $statement = query($sql, $params);

        return $statement->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo $e->getMessage();
        exit();

    }

}


function isEmpty($value = null) {

    return (
        empty($value) &&
        !is_numeric($value)
    );

}


function isGet($key = null) {

    return (
        !empty($_GET) &&
        array_key_exists($key, $_GET) &&
        !isEmpty($_GET[$key])
    );

}


function getGet($key = null) {

    if (!isGet($key)) {

        return null;

    }

    return urldecode(stripslashes($_GET[$key]));

}


function isGetValue($key = null, $value = null) {

    return (
        isGet($key) &&
        $_GET[$key] == $value
    );

}


function stickyField($key = null) {

    return getGet($key);

}


function stickySelect($key = null, $value = null) {

    return isGetValue($key, $value) ? ' selected' : null;

}


// If checkbox is checked then return value if not then return null
function stickyCheckboxRadio($key = null, $value = null) {

    return isGetValue($key, $value) ? ' checked' : null;

}


//Select Options
function makeSelect(
    $records = null,
    $name = null,
    $defaultLabel = 'Select one',
    $idField = 'id',
    $nameField = 'name'
) {
//If record emty return null 
    if (empty($records)) {

        return null;

    }
//Appending values in variable $out for select options.
    $out  = '<select name="';
    $out .= $name;
    $out .= '" id="';
    $out .= $name;
    $out .= '">';
    $out .= '<option value="">';
    $out .= $defaultLabel;
    $out .= '</option>';

    foreach($records as $row) {

        $out .= '<option value="';
        $out .= $row[$idField];
        $out .= '"';
        $out .= stickySelect($name, $row[$idField]);
        $out .= '>';
        $out .= $row[$nameField];
        $out .= '</option>';

    }

    $out .= '</select>';

    return $out;

}



function fetchSearch($expected = null, $multiple = null) {

    if (empty($expected) || !is_array($expected)) {

        return null;

    }

    $multiple = is_array($multiple) ? $multiple : array($multiple);

    $out = array();

    foreach($_GET as $key => $value) {

        $keySplit = explode('-', $key);

        if (in_array($keySplit[0], $expected) && !isEmpty($value)) {

            if (in_array($keySplit[0], $multiple)) {

                $out[$keySplit[0]][$value] = $value;

            } else {

                $out[$keySplit[0]] = urldecode($value);

            }

        }

    }

    return $out;

}



function getRecords($search = null) {

    $items = array();
    $params = array();

    //using of DISTINCT (To eliminate Duplicity)&& GROUP_CONCATE is a function which concatenates/merges the data from multiple rows into one field

    $sql = "SELECT DISTINCT(`book`.`id`),
            `book`.`title` AS `Title`,
            YEAR(`book`.`publishedon`) AS Year,
            `book`.`price` AS `Price`,
            `category`.`name` AS `Category`,
            (
                SELECT
                GROUP_CONCAT(`name` ORDER BY `name` ASC SEPARATOR ', ')
                FROM `authors`
                WHERE `id` IN (
                    SELECT `author_id`
                    FROM `books_authors`
                    WHERE `book_id` = `book`.`id`
                )
            ) AS `Author`

           FROM `book`

           JOIN `category`
                ON `category`.`id` = `book`.`category_id`";
//Checking if search is not emtpy
    if (!empty($search) && is_array($search)) {
//Looping on array
        foreach($search as $key => $value) {

            switch($key) {

                case 'keyword':
                    $items[] = "`book`.`title` LIKE ?";
                    $params[] = "%{$value}%";
                    break;

                case 'category':
                    $items[] = "`category`.`id` = ?";
                    $params[] = $value;
                    break;

            
                case 'author':
                    $items[] = "`book`.`id` IN (
                                    SELECT `book_id`
                                    FROM `books_authors`
                                    WHERE `author_id` = ?
                                )";
                    $params[] = $value;
                    break;


                case 'year':
                    $items[] = "YEAR(`book`.`publishedon`) = ?";
                    $params[] = $value;
                    break;

              

            }

        }

        if (!empty($items)) {

            $sql .= " WHERE ";
            $sql .= implode(" AND ", $items);

        }

    }

    $sql .= " ORDER BY `book`.`title` ASC";

    return fetchRecords($sql, $params);

}



function getAuthors() {
		
    $sql = "SELECT *
            FROM `authors`
            ORDER BY `name` ASC";

    $records = fetchRecords($sql);

    return makeSelect($records, 'author', 'Select author');

}		
//Fetching Categories
function getCategories() {

    $sql = "SELECT *
            FROM `category`
            ORDER BY `name` ASC";

    $records = fetchRecords($sql);

    return makeSelect($records, 'category', 'Select category');

}		
//Fetching Years Published-on
function getYears() {

    $sql = "SELECT DISTINCT(YEAR(`publishedon`)) AS `year`
            FROM `book`
            ORDER BY `publishedon` ASC";

    $records = fetchRecords($sql);

    return makeSelect($records, 'year', 'Select year', 'year', 'year');
}

