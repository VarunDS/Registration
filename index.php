<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/01/17
 * Time: 5:31 PM
 */

$con = mysqli_connect ('localhost', 'root', 'root', 'UserPortal_DB')//Connecting to the Database.mysqli_connect('ip address/localhost','username','password','DatabaseName')
or die('Error connecting to the MYSQL server ');
$Username = $_POST['username'];
$Password = $_POST['pass'];


$select_query = "Select * FROM Users WHERE Username='" . $Username . "' AND Password='" . $Password . "'";
$result = mysqli_query ($con, $select_query);
while ($row = mysqli_fetch_assoc ($result)) {
    echo $row['Email'];
}
If (empty($result)) {
    echo "<script type='text/javascript'>\n";
    echo "alert('User Not Found.')";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>\n";
    echo "alert('User Found.')";
    echo "</script>";
}

?>