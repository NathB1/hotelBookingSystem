<?php

function isDigits($str) {
    $pattern='/^[0-9]+$/';
    return preg_match($pattern, $str);
}

function isEmpty($str) {
    return strlen(trim($str)) == 0;
}

function checkLength($str, $len) {
    return strlen(trim($str)) === $len;
}

function checkDetails($checkinDate, $checkoutDate)
{
    $errors = array();

    // card expiry date depends on current date
    $todaysdate = date("Y-m-d");

    if ($checkinDate < $todaysdate) {
        array_push($errors, "You cant book in the past");
    } elseif ($checkoutDate < $checkinDate) {
        array_push($errors, "You can't check out before you check in.");
    } elseif ($checkoutDate === $checkinDate) {
        array_push($errors, "You must book for at least one night" . $checkinDate . " " . $checkoutDate);
    }
    return $errors;
}
?>