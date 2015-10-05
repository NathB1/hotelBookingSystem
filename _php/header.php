<?php
session_start();

function login(){
$loginUser = $_POST['loginUser'];
$loginPassword = $_POST['loginPassword'];

$_SESSION['loginUser'] = $loginUser;
$_SESSION['loginPassword'] = $loginPassword;
    if ($loginUser === "admin" && $loginPassword === "admin") {
        die('<script type="text/javascript">window.location.href="' . "http://localhost:63342/hotelBookingSystem/admin.php" . '";</script>');
    } else {
        die('<script type="text/javascript">window.location.href="' . "http://localhost:63342/hotelBookingSystem/admin.php" . '";</script>');
    }
}
?>

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

    <div id="login">
        <form id="loginForm" action="">
            <fieldset>
                <legend>Login</legend>
                <label for="loginUser">Username: </label>
                <input type="text" name="loginUser" id="loginUser"><br>
                <label for="loginPassword">Password: </label>
                <input type="password" name="loginPassword" id="loginPassword"><br>
                <input type="submit" id="loginSubmit" value="Login" onclick="login()">
            </fieldset>
        </form>
    </div>

    <!--
    <div id="logout">
        <p>Welcome, <span id="logoutUser"></span>

        <p>

        <form id="logoutForm">
            <input type="submit" id="logoutSubmit" value="Logout">
        </form>
    </div>
    -->

</header>

<nav>
    <ul>
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']);
        $linkList = array(
            "index.php" => "Home",
            "rooms.php" => "Rooms",
            "book.php" => "Book",
            "admin.php" => "Administrator"
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

