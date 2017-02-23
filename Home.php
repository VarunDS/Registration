<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23/02/17
 * Time: 5:57 PM
 */
session_start ();
//include('Login.php');
require_once 'dbConfig.php';
print_r ($_SESSION);
echo "\n" . session_status () . "\n\n\r";

if (session_status () == 1) {

    if (isset($_SESSION['id'])) {
        echo $_SESSION['id'];
    } else {
        echo "Some issue is there";
    }

}
?>
<html>
<form method="post" action="Logout.php"><input type="submit" value="Logout"></form>

</html>
