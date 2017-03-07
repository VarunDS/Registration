<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05/03/17
 * Time: 6:20 PM
 */

require_once "dbConfig.php";
session_start ();
$id = $_SESSION['id'];

$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$DOB = $_POST['DOB'];
$Address = $_POST['Address'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$Zip = $_POST['Zip'];

$UserUpdateQuery
    = "UPDATE Users 
SET Fname='" . $Fname . "', Lname='" . $Lname . "',DOB='" . $DOB . "',Address='" . $Address . "'" .
      ",Email='" . $Email . "',Phone='" . $Phone . "',Zip='" . $Zip . "' 
                 WHERE ID='" . $id . "' ";

$notification_id = md5 ($Password, false);
$user_id = $id;
$status = 1;
$insert_flag = 0;

$Insert_notification = "INSERT INTO NOTIFICATIONS" .
                       " VALUES('" . $notification_id . "','" . date ('Y-m-d H:i:s') . "','" . $user_id . "','" . mysqli_real_escape_string ($con,$UserUpdateQuery) . "','" . $status . "')";

$notification_update = mysqli_query ($con, $Insert_notification)
or die("Query couldn't be processed");

if ($notification_update==true) {
    $response = "Please check your inbox for details.";
    $insert_flag = 1;

}

echo json_encode (array("response" => $response, "insert_flag" => $insert_flag));


?>