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

<div id="main">
    <h2> Current Rooms Avaliable </h2>

    </dl>

    <form method="post" action="validateAddRooms.php" id="staffRoomEdit" novalidate>
        <fieldset>
        <p><b>Add Rooms Here:</b></p>
        <br>

            <dl id="roomList">

            </dl>
        <p>
            <label for="number">Room Number:</label>
            <input type="text" name="number" <?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['number'])) {
                $number = $_SESSION['number'];
                echo "value='$number'";
            } ?> >
        </p>
        <p>
            <!--
            Javascript is used on roomType input to duplicate
            data that is made on "keydown" so it is coppied over to
            the hidden input below
            -->
            <label for="roomType">Room Type:</label>
            <input type="text" name="roomType" id="roomType"<?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['roomType'])) {
                $roomType = $_SESSION['roomType'];
                echo "value='$roomType'";
            } ?> >
        <script>
            $("#roomType").on('keyup',function(){
                $("#id").val($(this).val());
            });
        </script>
        </input>
        </p>
        <p>
            <label for="description">Description:</label>
            <input type="text" name="description"<?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['description'])) {
                $description = $_SESSION['description'];
                echo "value='$description'";
            } ?> >
        </p>
        <p>
            <label for="pricePerNight">Price Per Night $:</label>
            <input type="text" name="pricePerNight" id="pricePerNight"<?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['pricePerNight'])) {
                $pricePerNight = $_SESSION['pricePerNight'];
                echo "value='$pricePerNight'";
            } ?> >
        </p>
        <p>
            <!--
            made a hidden input for the id tag and roomType
            tag as they share the same values so I have made it hidden
            for the user to avoid confusion and potential spelling errors
            -->
            <input type="hidden" name="id" id="id"<?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                echo "value='$id'";
            } ?> >
            </input>
        </p>
        <p>
            <label for="description2">Description:</label>
            <input type="text" name="description2"<?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['description2'])) {
                $description2 = $_SESSION['description2'];
                echo "value='$description2'";
            } ?> >
        </p>
        <p>
            <label for="maxGuests">Max Guests:</label>
            <input type="text" name="maxGuests"<?php
                // Check to see if they have already tried to validate. If so refil the form with their info.
                if (isset($_SESSION['maxGuests'])) {
                    $maxGuests = $_SESSION['maxGuests'];
                    echo "value='$maxGuests'";
                } ?> >
        </p>
        <input type="submit" value="Create Room" name="add">
        </fieldset>
    </form>




</div>