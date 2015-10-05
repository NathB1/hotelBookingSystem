<?php
session_start();
$scriptList = array(
    "js/jquery-1.11.3.min.js",
    "css/style.css",
    "js/admin.js",
    "js/listRooms.js"
);
include("_php/headerAdmin.php");

?>

<?php
if(isset($_POST['add'])) {
//retreive xml file

    $item_id = $_POST['roomType'];
    $item_id2 = $_POST['id'];

    $xml1 = new DOMDocument;
    $xml1->load("xml/hotelRooms.xml");


    $xpath = new DOMXpath($xml1);
    foreach ($xpath->query("/hotelRooms/hotelRoom[roomType = '$item_id']") as $node) {
        $node->parentNode->removeChild($node);
        $bookings->formatoutput = true;
    }
    $xml1->save("xml/hotelRooms.xml");

//retreive xml file
    $xml2 = new DOMDocument;
    $xml2->load("xml/roomTypes.xml");

    $item_id2 = $_POST['id'];
    $xpath2 = new DOMXpath($xml2);
    foreach ($xpath2->query("/roomTypes/roomType[id = '$item_id2']") as $node2) {
        $node2->parentNode->removeChild($node2);
        $bookings->formatoutput = true;
    }
    $xml2->save("xml/roomTypes.xml");
}

?>

<div id="main" xmlns="http://www.w3.org/1999/html">
    <h2> Delete Rooms </h2>


    <dl id="roomList">

    </dl>


    <form method="POST" action="validateDeleteRooms.php">
        <p><b>Delete Room Here:</b></p>
        <br>
        <label for="roomType">Room Number:</label>
        <input type="text" name="roomType" id="roomType">
        <script>
            $("#roomType").on('keyup',function(){
                $("#id").val($(this).val());
            });



        </script>
        <!--
        Hidden input here so that both the rooms + details from
        both roomTypes and hotelRooms are deleted.
        -->
        <input type="hidden" name="id" id="id"> </input>
        <input type="submit" value="Delete" name="add">
    </form>



</div>