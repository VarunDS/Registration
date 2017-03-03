<?php session_start (); ?>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/loader.css">
    <link rel="stylesheet" href="styles/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="scripts/src/home.js"></script>
</head>
<body style="background: url('images/whiteGrad.jpg')">
<div class="loader">
</div>

<form method="post" action="Logout.php">
    <div class="vcenter" style="">Welcome<?php echo ", " . $_SESSION['name'] . " !"; ?>
        <input type="image" src='images/power.png' ;>
    </div>
</form>


</body>
</html>


<?php


require_once 'dbConfig.php';
if (session_status () == 1) {

    if (isset($_SESSION['id'])) {
        echo $_SESSION['id'];
    } else {
        echo "Some issue is there";
    }

}
?>
