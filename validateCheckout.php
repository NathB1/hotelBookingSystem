<?php
session_start();
$scriptList = array(
    "js/jquery-1.10.2.min.js",
    "js/cookie.js",
);
include("_php/header.php");
include("_php/validationFunctions.php");
?>

    <div id="main">
        <?php
        $passCounter = 0;

        // Get the values in each field
        $checkinday = $_POST['checkinday'];
        $checkinmonth = $_POST['checkinmonth'];
        $checkinyear = $_POST['checkinyear'];
        $checkoutday = $_POST['checkoutday'];
        $checkoutmonth = $_POST['checkoutmonth'];
        $checkoutyear = $_POST['checkoutyear'];

        $roomSelection = $_POST['roomSelection'];
        $bookingName = $_POST['bookingName'];
        $checkinDate = $_POST['checkinDate'];
        $checkoutDate = $_POST['checkoutDate'];


        //session stuff
        $_SESSION['checkinday'] = $checkinday;
        $_SESSION['checkinmonth'] = $checkinmonth;
        $_SESSION['checkinyear'] = $checkinyear;
        $_SESSION['checkoutyear'] = $checkoutyear;
        $_SESSION['checkoutmonth'] = $checkoutmonth;
        $_SESSION['checkoutday'] = $checkoutday;

        $_SESSION['roomSelection'] = $roomSelection;
        $_SESSION['bookingName'] = $bookingName;
        $_SESSION['checkinDate'] = $checkinDate;
        $_SESSION['checkoutDate'] = $checkoutDate;

        /**
        foreach($_SESSION as $value) {
            echo  'Current session variable is: ' . $value . '<br />';
        }
         */





        // Validation stuff
        function isLetters($str) {
            $pattern = '/[A-Za-z]+$/';
            return preg_match($pattern, $str);
        }
        echo "<p><strong>Errors: </strong></p>";

        // Check the bookingName
        if (isEmpty($bookingName)) {
            echo "<p>Name cannot be empty</p>";
        }else if(!isLetters($bookingName)) {
            echo "<p>Name must be letters only.</p>";
        }else {
            $passCounter ++;
        }

        if (isEmpty($roomSelection)) {
            echo "<p>Room cannot be empty</p>";
        }else {
            $passCounter ++;
        }

        // Check details of check in check out
        $errorArray = checkDetails($checkinDate, $checkoutDate);
        if ($errorArray != null) {
            foreach ($errorArray as $error) {
                echo "<p>$error</p>";
            }
        } else {
            $passCounter++;
        }
        // Cart
        $cart = json_decode($_COOKIE['bookings']);
        if ($passCounter === 3) {
            $_SESSION = array();
            session_destroy();
            ?>
            <script>

                Cookie.clear('bookings');

            </script>

        <p>Your details have been successfully validated. You can review your order below.</p>
        <table>
            <tr>
                <th>Name</th>
                <th>Check Out</th>
                <th>Check In</th>
                <th>Room Number</th>
            </tr>
            <?php
            foreach($cart as $item) {
                $name = $item->name;
                $checkout = $item->checkout;
                $checkin = $item->checkin;
                $number = $item->number;
                echo "<tr><td>$name</td><td>$checkout</td><td>$checkin</td><td>$number</td></tr>";
            }
            echo "</table>";

            /** preg_match is used on checkin and checkout dates so dates can be stored in
             * xml the same as the other bookings
             **/
            if (preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $checkinDate, $matches)) {
                $inmonth = $matches[2];
                $inday   = $matches[3];
                $inyear  = $matches[1];
            } else {
                echo 'invalid format';
            }
            if (preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $checkoutDate, $matches)) {
                $outmonth = $matches[2];
                $outday   = $matches[3];
                $outyear  = $matches[1];
            } else {
                echo 'invalid format';
            }

            // $sourceFile and $targetFile are assumed to be set
            /**creating nodes for xml and child nodes so bookings can
             * be shown.
             **/

                $bookings = simplexml_load_file('xml/roomBookings.xml');
                $newBooking = $bookings->addChild('booking');
                $newBooking->addChild("number", $roomSelection);
                $newBooking->addChild("name", $bookingName);
                $checkin = $newBooking->addChild("checkin");
                $checkin->addChild("day", $inday);
                $checkin->addChild("month", $inmonth);
                $checkin->addChild("year", $inyear);
                $checkout = $newBooking->addChild("checkout");
                $checkout->addChild("day", $outday);
                $checkout->addChild("month", $outmonth);
                $checkout->addChild("year", $outyear);

                // save targetfile
                $bookings->saveXML("xml/roomBookings.xml");


            //Clear cookies and session
            setcookie('bookings', '', time()-3600, '/');
            unset($_COOKIE['bookings']);
            echo "<p><a href=\"book.php\">Return to booking page</a></p>";
            } else {
                echo "<p><a href=\"book.php\">Return to booking page</a></p>";
            }
            ?>
    </div>