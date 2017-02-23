<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/02/17
 * Time: 4:58 PM
 */

require_once "dbConfig.php";

$Fname = mysqli_escape_string ($con, $_POST['Fname']);
$Lname = mysqli_escape_string ($con, $_POST['Lname']);
$Date = mysqli_escape_string ($con, $_POST['datepicker']);
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
$ID = md5 ($Password, false);

$insert_query = "INSERT INTO Users" .
                " VALUES('" . $Fname . "','" . $Lname . "','" . $Date . "','" . $Address . "','" . $Phone . "','" . $Email .
                "','" . $Zip . "','" . $Username . "','" . $Password . "',0,'" . $ID . "')";
$result = mysqli_query ($con, $insert_query)
or die("Query couldn't be processed");


// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags (trim ($Fname ." ". $Lname));
    $name = str_replace (array("\r", "\n"), array(" ", " "), $name);
    $email = filter_var (trim ($Email), FILTER_SANITIZE_EMAIL);

    // Set the email subject.
    $subject = "Registration from $name";

    // Build the email content.
    $email_content = "Dear $name\n\n";
    $email_content .= "Thank you for registering with the email : $email\n\n";
    $email_content .= "Your credentials are : \n";
    $email_content .= "Username : $Username\n";
    $email_content .= "Password : $Password\n";

    // Build the email headers.
    $email_headers = "From: Varun Gupta <varungupta.masters@gmail.com>";

    // Send the email.
    if (mail ($email, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code (200);
        echo "Thank You! Check your inbox.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code (500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code (403);
    echo "There was a problem with your submission, please try again.";
}

?>

