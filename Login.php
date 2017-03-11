<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31/01/17
 * Time: 5:31 PM
 */
session_start ();


require_once 'dbConfig.php';

$Username = $_POST['username'];
$Password = $_POST['pass'];

$select_query = "Select * FROM Users WHERE Username='" . $Username . "' AND Password='" . $Password . "'";
$result = mysqli_query ($con, $select_query);
if (mysqli_num_rows ($result) > 0) {
    session_start ();
    $row = mysqli_fetch_array ($result);
    $_SESSION['id'] = $row['ID'];
    $_SESSION['name'] = $row['Fname'] . ' ' . $row['Lname'];
    $_SESSION['email'] = $row['Email'];

    $pageRedirectQuery
        = "SELECT p.page_url FROM pages p 
                          INNER JOIN pages_roles pr ON p.page_id=pr.page_id
                          INNER JOIN user_role ur ON pr.role_id=ur.role_id 
                          WHERE ur.user_id='" . $row['ID'] . "'";
    $pageRedirect= mysqli_query($con,$pageRedirectQuery);
    $page=mysqli_fetch_array($pageRedirect);
    header('Location:'.$page['page_url'],true);
} else {
    echo "User ID/password entered do not match.";
    session_destroy ();
}

?>