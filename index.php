<?php 
include("includes/config.php");

//session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("location: register.php");
}
?>

<html>
<head>
    <title>Welcome to your Music Player!</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div id="mainContainer">

        <div id="topContainer">

            <?php include("includes/navBarContainer.php") ?>

        </div>
    
        <?php include("includes/nowPlayingBarContainer.php") ?>

    </div>

</body>

</html>