<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 03/03/17
 * Time: 7:09 PM
 */

require_once "dbConfig.php";
session_start ();
$id = $_SESSION['id'];
$userDetailsQuery = "SELECT Fname,Lname,DOB,Address,Phone,Email,Zip FROM Users  WHERE ID='" . $id . "'";
$userDetails = mysqli_query ($con, $userDetailsQuery)
or die("Query couldn't be processed");
$userDetails_row = mysqli_fetch_array ($userDetails);
$user_notificationQuery = "SELECT status FROM Notifications WHERE user_id='" . $id . "'";
$user_notifications = mysqli_query($con,$user_notificationQuery);
$user_notification_row = mysqli_fetch_array ($user_notifications);
$ResponseArray = array("Fname" => $userDetails_row['Fname'], "Lname" => $userDetails_row['Lname'], "DOB" => $userDetails_row['DOB'], "Address" => $userDetails_row['Address'],
    "Phone" => $userDetails_row['Phone'], "Email" => $userDetails_row['Email'], "Zip" => $userDetails_row['Zip'], "notification" => $user_notification_row['status']);
echo json_encode ($ResponseArray);

?>