<?php
session_start();
$scriptList = array(
    "js/jquery-1.11.3.min.js",
    "css/style.css",
    "js/admin.js"
);
include("_php/headerAdmin.php");

?>

<div id="main">
    <h2> Current Bookings </h2>

    <ul id="bookingList">

    </ul>

    <form method="POST" action="validateDeleteBooking.php">
        <p><b>Delete Booking Here:</b></p>
        <br>
        Name: <input type="text" name="bookingName"/>
        <input type="submit" value="Delete" name="delete"<?php
        // Check to see if they have already tried to validate. If so refil the form with their info.
        if (isset($_SESSION['delete'])) {
            $delete = $_SESSION['delete'];
            echo "value='$delete'";
        } ?> >
    </form>



</div>