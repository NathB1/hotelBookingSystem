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
    $number = $_POST['number'];
    $roomType = $_POST['roomType'];
    $description = $_POST['description'];
    $pricePerNight = $_POST['pricePerNight'];
    $id = $_POST['id'];
    $description2 = $_POST['description2'];
    $maxGuests = $_POST['maxGuests'];


    //session stuff
    $_SESSION['number'] = $number;
    $_SESSION['roomType'] = $roomType;
    $_SESSION['description'] = $description;
    $_SESSION['pricePerNight'] = $pricePerNight;
    $_SESSION['id'] = $id;
    $_SESSION['description2'] = $description2;
    $_SESSION['maxGuests'] = $maxGuests;


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


    if (isEmpty($number)) {
        echo "<p>number cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($roomType)) {
        echo "<p>Room type cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($description)) {
        echo "<p>Description cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($pricePerNight)) {
        echo "<p>Price Per Night cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($id)) {
        echo "<p>id cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($description2)) {
        echo "<p>description2 cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($maxGuests)) {
        echo "<p>max guests cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if ($passCounter === 7) {

        //load first xml file which is roomTypes
        if(isset($_POST['add'])) {
            $_SESSION = array();
            session_destroy();

            $xml = new DOMDocument("1.0", "UTF-8");
            $xml->load("xml/hotelRooms.xml");

            $rootTag = $xml->getElementsByTagName("hotelRooms")->item(0);

            $infoTag = $xml->createElement("hotelRoom");
            $aTag = $xml->createElement("number", $number);
            $bTag = $xml->createElement("roomType", $roomType);
            $cTag = $xml->createElement("description", $description);
            $dTag = $xml->createElement("pricePerNight", $pricePerNight);

            //first part of form for hotelRooms xml
            $infoTag->appendChild($aTag);
            $infoTag->appendChild($bTag);
            $infoTag->appendChild($cTag);
            $infoTag->appendChild($dTag);

            $rootTag->appendChild($infoTag);
            $xml->save("xml/hotelRooms.xml");

            //load second xml file which is roomTypes
            $xmlTwo = new DOMDocument("1.0", "UTF-8");
            $xmlTwo->load("xml/roomTypes.xml");

            //second part of form creates nodes for roomTypes xml
            $rootTagTwo = $xmlTwo->getElementsByTagName("roomTypes")->item(0);

            $infoTagTwo = $xmlTwo->createElement("roomType");
            $eTag = $xmlTwo->createElement("id", $id);
            $fTag = $xmlTwo->createElement("description", $description2);
            $gTag = $xmlTwo->createElement("maxGuests", $maxGuests);

            //second part of form for roomTypes xml
            $infoTagTwo->appendChild($eTag);
            $infoTagTwo->appendChild($fTag);
            $infoTagTwo->appendChild($gTag);

            $rootTagTwo->appendChild($infoTagTwo);
            $xmlTwo->save("xml/roomTypes.xml");
            }

        echo "<p><a href=\"addRooms.php\">Return to add room page</a></p>";


        //destroy session so that no duplicates will be made in xml

    } else {

        echo "<p><a href=\"addRooms.php\">Return to add room page</a></p>";

    }
    ?>
</div>
