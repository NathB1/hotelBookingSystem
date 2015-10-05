<!DOCTYPE html>

<head>
    <title>Dunedin Hotel</title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">

    <?php
    if (isset($scriptList) && is_array($scriptList)) {
        foreach ($scriptList as $script) {
            echo "<script src='$script'></script>";
        }
    }
    ?>
</head>

<body>

<header>
    <h1>Dunedin Hotel</h1>

</header>

<nav>
    <ul>
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']);
        $linkList = array(
            "admin.php" => "View / Delete Bookings",
            "addRooms.php" => "Create Rooms",
            "deleteRooms.php" => "Delete Rooms",
            "editRooms.php" => "Edit Rooms"
        );
        if (isset($scriptList) && is_array($scriptList)) {
            foreach ($linkList as $link => $title) {
                if ($currentPage != ($link)) {
                    echo "<li> <a href='$link'>$title</a>";
                } else {
                    echo "<li> $title";
                }
            }
        }
        ?>
    </ul>


</nav>

