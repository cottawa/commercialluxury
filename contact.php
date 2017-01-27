<?php

require("../PHPMailer_5.2.0/class.phpmailer.php");
// Variable Declarations
$errors = array(); // set the errors array to empty, by default
$fields = array(); // stores the field values
$success_message = "";
$totallevel = 0;

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

if (isset($_POST['submit'])) {

	// Import the validation library
	// This is a freely distributed php script found here:
	// http://www.benjaminkeen.com/software/php_validation/
	require("validation.php");

	// Instantiate an array to store the validation rules
	$rules = array();

	// Set validation rules for the form fields
	$rules[] = "required,name, Please enter your name.";
	$rules[] = "required,email, Please enter your email address.";
	$rules[] = "valid_email,email, Please enter a valid email address.";
	$rules[] = "required,phone, Please enter your phone number.";
	$rules[] = "required,message, Please enter a message.";

	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->Port = 587;
	$mail->SMTPSecure = "tls";
	$mail->Username = "contactuslori@gmail.com";
	$mail->Password = "loricommercial2017";

	$mail->From("contactuslori@gmail.com");
	$mail->AddAddress("contactuslori@gmail.com");
	$mail->Subject = "Contact Form";
	$mail->Body = "Name " . $name . " Email " . $email . " Phone " $phone . "Message " $message;

	if(!$mail->Send()) {
		echo "Mail has not been sent. <p>";
		exit;
	}

	echo "Thank You!" . " -" . "<a href='home.html' style='text-decoration:none;color:#ff0099;'> Return Home</a>";

  #echo ('Thanks for registering! A copy of the form details below has been emailed to you and your teammates for your reference.<br \><br \>');

}


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="../Templates/UW_uwaterloo.dwt.php" codeOutsideHTMLIsLocked="false" -->

<style type="text/css">
<!--
.error {
  border: 1px solid red;
  background-color: #ffffee;
  color: #660000;
  width: 400px;
  padding: 5px;
}
-->
</style>

<!-- InstanceBeginEditable name="primarycontent" -->

<?php
    // if $errors is not empty, the form must have failed one or more validation
    // tests. Loop through each and display them on the page for the user
    if (!empty($errors))
    {
      echo "<div class='error' style='width:100%;'>Please fix the following error(s) in the contact form:\n<ul>";
      foreach ($errors as $error)
        echo "<li>$error</li>\n";

      echo "</ul></div>";

      echo ('<p><a href="javascript:javascript:history.go(-1)">Back</a></p>');
    }
?>

<!-- InstanceEndEditable --></div></div><script type="text/javascript">
