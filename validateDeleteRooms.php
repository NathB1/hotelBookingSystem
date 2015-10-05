<?php
session_start();
$scriptList = array(
    "js/jquery-1.10.2.min.js",
    "js/cookie.js",
);
include("_php/headerAdmin.php");
?>

<div id="main">
    <?php
    $passCounter = 0;

    // Get the values in each field
    $item_id = $_POST['roomType'];

    //session stuff
    $_SESSION['roomType'] = $item_id;

    // Validation stuff
    function isLetters($str)
    {
        $pattern = '/[A-Za-z]+$/';
        return preg_match($pattern, $str);
    }

    function isEmpty($str) {
        return strlen(trim($str)) == 0;
    }

    echo "<p><strong>Errors:</strong></p>";

    if (isEmpty($item_id)) {
        echo "<p>Room number cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if ($passCounter === 1) {

        $_SESSION = array();
        session_destroy();

        //load first xml file which is roomTypes

            if(isset($_POST['add'])) {
                //retreive xml file

                $item_id = $_POST['roomType'];

                $xml1 = new DOMDocument;
                $xml1->load("xml/hotelRooms.xml");


                $xpath = new DOMXpath($xml1);
                foreach ($xpath->query("/hotelRooms/hotelRoom[number = '$item_id']") as $node) {
                    $node->parentNode->removeChild($node);
                    $bookings->formatoutput = true;
                }
                $xml1->save("xml/hotelRooms.xml");
            }
                echo "<p><a href=\"deleteRooms.php\">Return to delete room page</a></p>";


        //destroy session so that no duplicates will be made in xml

    } else {

        echo "<p><a href=\"deleteRooms.php\">Return to delete room page</a></p>";

    }
    ?>
</div>
