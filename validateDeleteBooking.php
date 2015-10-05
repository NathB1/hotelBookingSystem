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
    $bookingName = $_POST['bookingName'];


    //session stuff
    $_SESSION['bookingName'] = $bookingName;

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


    if (isEmpty($bookingName)) {
        echo "<p>booking name cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if ($passCounter === 1) {

        //load first xml file which is roomTypes
            $_SESSION = array();
            session_destroy();

        //retreive xml file
        $xml = new DOMDocument;
        $xml->load("xml/roomBookings.xml");


        $xpath = new DOMXpath($xml);
        foreach($xpath->query("/bookings/booking[name = '$bookingName']") as $node) {
            $node->parentNode->removeChild($node);
            $bookings->formatoutput = true;
        }
        $xml->save("xml/roomBookings.xml");



        echo "<p><a href=\"admin.php\">Return to view / delete booking page</a></p>";


        //destroy session so that no duplicates will be made in xml

    } else {

        echo "<p><a href=\"admin.php\">Return to add / delete booking page</a></p>";

    }
    ?>
</div>