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
    $roomType1 = $_POST['roomType1'];
    $id = $_POST['id'];
    $maxGuests = $_POST['maxGuests'];
    $description = $_POST['description'];
    $id1 = $_POST['id1'];
    $number = $_POST['number'];
    $roomType = $_POST['roomType'];
    $descriptionTwo = $_POST['descriptionTwo'];
    $pricePerNight = $_POST['pricePerNight'];
    $number1 = $_POST['number1'];



    //session stuff
    $_SESSION['roomType1'] = $roomType1;
    $_SESSION['id'] = $id;
    $_SESSION['maxGuests'] = $maxGuests;
    $_SESSION['description'] = $description;
    $_SESSION['id1'] = $id1;
    $_SESSION['number'] = $number;
    $_SESSION['roomType'] = $roomType;
    $_SESSION['descriptionTwo'] = $descriptionTwo;
    $_SESSION['pricePerNight'] = $pricePerNight;
    $_SESSION['number1'] = $number1;


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


    if (isEmpty($number1)) {
        echo "<p>room Number to edit cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($maxGuests)) {
        echo "<p>max guests cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($description)) {
        echo "<p>Description cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($number)) {
        echo "<p>number cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($roomType)) {
        echo "<p>room type cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($descriptionTwo)) {
        echo "<p>description cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if (isEmpty($pricePerNight)) {
        echo "<p>price per night cannot be empty</p>";
    } else {
        $passCounter++;
    }

    if ($passCounter === 7) {

        $_SESSION = array();
        session_destroy();

        //load first xml file which is roomTypes
        if(isset($_POST['edit'])) {

            $item_id = $_POST['roomType1'];
            $id = $_POST['id'];
            $maxGuests = $_POST['maxGuests'];
            $description = $_POST['description'];
            $item_id2 = $_POST['id1'];
            $number = $_POST['number'];
            $roomType = $_POST['roomType'];
            $descriptionTwo = $_POST['descriptionTwo'];
            $pricePerNight = $_POST['pricePerNight'];
            $number1 = $_POST['number1'];

            //retreive xml file
            $xml1 = new DOMDocument;
            $xml1->load("xml/hotelRooms.xml");


            $xpath = new DOMXpath($xml1);
            foreach ($xpath->query("/hotelRooms/hotelRoom[number = '$number1']") as $node) {
                $node->parentNode->removeChild($node);
                $bookings->formatoutput = true;
            }
            $xml1->save("xml/hotelRooms.xml");

            //input in edit from here ------------>

            //load xml file to edit
            $hotelRooms = simplexml_load_file('xml/hotelRooms.xml');

            $hotelRooms->hotelRoom->number = $number;
            $hotelRooms->hotelRoom->roomType = $roomType;
            $hotelRooms->hotelRoom->description = $description;
            $hotelRooms->hotelRoom->pricePerNight = $pricePerNight;

            // save the updated document
            $hotelRooms->asXML('xml/hotelRooms.xml');
            /**
             * create rooms here
             */


            //load xml file to edit
            $roomTypes = simplexml_load_file('xml/roomTypes.xml');

            $roomTypes->roomType->id = $id;
            $roomTypes->roomType->maxGuests = $maxGuests;
            $roomTypes->roomType->description = $descriptionTwo;

            // save the updated document
            $roomTypes->asXML('xml/roomTypes.xml');
        }

        echo "<p><a href=\"editRooms.php\">Return to add room page</a></p>";


        //destroy session so that no duplicates will be made in xml

    } else {

        echo "<p><a href=\"editRooms.php\">Return to add room page</a></p>";

    }
    ?>
</div>
