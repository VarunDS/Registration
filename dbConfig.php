<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23/02/17
 * Time: 3:16 PM
 */


 $db_host = "localhost";
 $db_name = "UserPortal_DB";
 $db_user = "root";
 $db_pass = "root";

$con = mysqli_connect ($db_host, $db_user, $db_pass, $db_name)//Connecting to the Database.mysqli_connect('ip address/localhost','username','password','DatabaseName')
or die('Error connecting to the MYSQL server ');
?>