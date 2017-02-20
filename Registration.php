<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/02/17
 * Time: 4:58 PM
 */

$con = mysqli_connect ('localhost', 'root', 'root', 'UserPortal_DB')//Connecting to the Database.mysqli_connect('username','ip address/localhost''password','DatabaseName')
or die('Error connecting to the MYSQL server ');
$Fname = mysqli_escape_string ($con, $_POST['Fname']);
$Lname = mysqli_escape_string ($con, $_POST['Lname']);
$Date = mysqli_escape_string ($con, $_POST['DOB']);
$Address = mysqli_escape_string ($con, $_POST['add']);
$Phone = mysqli_escape_string ($con, $_POST['phone']);
$Email = mysqli_escape_string ($con, $_POST['email']);
$Zip = mysqli_escape_string ($con, $_POST['zip']);

$Username = $Fname . "_" . $Lname;
$Password = implode (
    '', array_map (
          function () {
              return chr (rand (0, 1) ? rand (48, 57) : rand (97, 122));
          }, range (0, 9)
      )
);
$ID=md5($Password,false);

$insert_query = "INSERT INTO Users" .
                " VALUES('" . $Fname . "','" . $Lname . "','" . $Date . "','" . $Address . "','" . $Phone . "','" . $Email .
                "','" . $Zip . "','" . $Username . "','" . $Password . "',0,'".$ID."')";
$result = mysqli_query ($con, $insert_query)
or die("Query couldn't be processed");

echo "Record entered successfully.";
?>

