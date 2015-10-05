<?php
session_start();
$scriptList = array(
    "js/jquery-1.11.3.min.js",
    "js/listRooms.js",
    "css/style.css",
    "js/admin.js",
);
include("_php/headerAdmin.php");

?>

<div id="main">
    <h2> Edit Rooms </h2>

    <dl id="roomList">
    </dl>

    <form method="POST" action="validateEditRooms.php" id="staffRoomEdit">
        <fieldset>
        <p><b>Please enter the ROOM NUMBER you wish to edit here:</b></p>
        <br>
            <p>
        <label for="number">Room Number:</label>
        <input type="text" name="number1" id="number1"<?php
        // Check to see if they have already tried to validate. If so refil the form with their info.
        if (isset($_SESSION['number1'])) {
            $number1 = $_SESSION['number1'];
            echo "value='$number1'";
        } ?> >
            </p>

        <!--
        Hidden input here so that both the rooms + details from
        both roomTypes and hotelRooms are deleted.
        -->
        <input type="hidden" name="id1" id="id1"<?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['id1'])) {
                $id1 = $_SESSION['id1'];
                echo "value='$id1'";
            } ?> > </input>
            <br>
            <br>
            <br>

        <!--
        remainder of form
        ---------------------------------------------------------------
        ---------------------------------------------------------------
        -->

        <br>
        <p><b>Put in changes you want to make here:</b></p>
        <br>
        <p>
            <label for="number">Room Number:</label>
            <input type="text" name="number"<?php
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
            <input type="text" name="pricePerNight"<?php
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
            } ?> > </input>
        </p>
        <p>
            <label for="descriptionTwo">Description:</label>
            <input type="text" name="descriptionTwo"<?php
            // Check to see if they have already tried to validate. If so refil the form with their info.
            if (isset($_SESSION['descriptionTwo'])) {
                $descriptionTwo = $_SESSION['descriptionTwo'];
                echo "value='$descriptionTwo'";
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
        <input type="submit" value="Create Room" name="edit">

        </fieldset>
    </form>
</div>
