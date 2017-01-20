<?php

// Variable Declarations
$errors = array(); // set the errors array to empty, by default
$fields = array(); // stores the field values
$success_message = "";
$totallevel = 0;

		    $needed1=$_POST['needed1'];
						
        if (isset($_POST['submit']))
        {
			
            // Import the validation library
            // This is a freely distributed php script found here:
            // http://www.benjaminkeen.com/software/php_validation/
            require("validation.php");

            // Instantiate an array to store the validation rules
            $rules = array();

            // Set validation rules for the form fields
            
			if ($needed1=="on"){
			$rules[] = "required,firstName1,Please enter your first name.";
            $rules[] = "required,lastName1,Please enter your last name.";
            $rules[] = "required,gender1,Please indicate whether you are male or female.";  
            $rules[] = "required,level1,Please indicate your skill level.";
            $rules[] = "required,email1,Please enter your email address.";
            $rules[] = "valid_email,email1,Please enter a valid email address.";
            $rules[] = "required,studentID1,Please enter your UW student ID. All players MUST be a UW affiliate to participate in this tournament";
            $rules[] = "required,phone1,Please enter your phone number.";  
			$rules[] = "required,p1size,Please enter your t-shirt size.";
			}
			
			if($needed1==""){
			$rules[] = "required,firstName1,Please enter your strongest player's first name.";
            $rules[] = "required,lastName1,Please enter your strongest player's last name.";
            $rules[] = "required,gender1,Please indicate whether your strongest player is male or female.";  
            $rules[] = "required,level1,Please indicate your strongest player's skill level.";
            $rules[] = "required,email1,Please enter your strongest player's email address.";
            $rules[] = "valid_email,email1,Please enter a valid email address for your strongest player.";
            $rules[] = "required,studentID1,Please enter your strongest player's UW student ID. All players MUST be a UW affiliate to participate in this tournament";
            $rules[] = "required,phone1,Please enter your strongest player's phone number.";
			$rules[] = "required,p1size,Please enter your strongest player's t-shirt size.";			
            }
						
			$rules[] = "required,teamName,Please enter a team name.";
			
            $errors = validateFields($_POST, $rules);
            
            if (!empty($errors))
            {  
                // if there were errors, re-populate the form fields
                $fields = $_POST;
            }
            else 
            {
                // No errors! yay!
                $message = "All fields have been validated successfully!";

                // Collect values from the form post	
                $teamName           = $_POST['teamName'];

				if($needed1==""){
                $firstName1 		= $_POST['firstName1'];
				$lastName1  		= $_POST['lastName1'];
                $gender1			= $_POST['gender1'];
                $level1             = $_POST['level1'];
                $emailAddress1   	= $_POST['email1'];
                $studentId1 		= $_POST['studentID1'];
                $phoneNumber1 	    = $_POST['phone1'];
				$p1size				= $_POST['p1size'];
				}
				else if($needed1=="on" && isset($firstName1)==""){
				$firstName1="Needs Partner(s)";
				$lastName1="";
				$gender1="";
				$level1="";
				$emailAddress1="";
				$studentId1="";
				$phoneNumber1="";
				$p1size="";
				}
				
				
                $diet               = $_POST['diet'];
                $tcolour	 	    = $_POST['tcolour'];

				$headers = "MIME-Version: 1.0\r\n".
						   "Content-type: text/html; charset=utf-8\r\n".
						   "Return-Path:".$emailAddress1;
				
				$email_text = generateEmail ($teamName, $firstName1, $lastName1, $gender1, $level1, $emailAddress1, $studentId1, $phoneNumber1, $p1size,
								$diet, $tcolour, "<br />");
				
                mail( "media@iciprivatesale.com", "Test", $email_text, $headers);
                
				$headers = "MIME-Version: 1.0\r\n".
						   "Content-type: text/html; charset=utf-8\r\n".
						   "Return-Path: cassandra@iciprivatesale.com";				
				
                mail( $emailAddress1.", ".$emailAddress2.", ".$emailAddress3, "Trinity Cup W15", $email_text, $headers);                 
                                          
                echo ('Thanks for registering! A copy of the form details below has been emailed to you and your teammates for your reference.<br \><br \>');	                      
                echo (generateEmail ($teamName, $firstName1, $lastName1, $gender1, $level1, $emailAddress1, $studentId1, $phoneNumber1, $p1size,
                                      $diet, $tcolour, "<br \>"));
                   
            }            
          
        }

//-----------------------------------------------------------------------------
// Function Name: generateEmail
// Outputs: Parses registration into a readable format for emailing
//-----------------------------------------------------------------------------
function generateEmail ($teamName, $firstName1, $lastName1, $gender1, $level1, $emailAddress1, $studentId1, $phoneNumber1, $p1size,
	                      $diet, $tcolour, $break)
{

	$body  = "Trinity Cup - Winter 2015 Registration [Please Read Notes Below!]".$break;
    $body .= "--------------------------------------------".$break;
    $body .= "Team Name: ".$teamName.$break;
	$body .= "--------------------------------------------".$break;
    $body .= "Strongest Player".$break;
    $body .= "--------------------------------------------".$break;
	$body .= "Full Name: ".$firstName1." ".$lastName1.$break;
	$body .= "Gender: ".$gender1.$break;    
    $body .= "Skill Level: ".$level1." ".$break;
	$body .= "E-mail Address: ".$emailAddress1.$break;    
	$body .= "UW I.D.#: ".$studentId1.$break;
	$body .= "Phone Number: ".$phoneNumber1.$break;
	$body .= "T-shirt Size: ".$p1size.$break;
	$body .= "--------------------------------------------".$break;
 	$body .= "Dietary Restrictions: ".$diet.$break;
	$body .= "T-shirt colour preferences: ".$tcolour.$break;	
	$body .= "--------------------------------------------".$break;	
	$body .= "Notes:".$break;	
	$body .= "1. By seeing your team name on the registered players page
	          (https://docs.google.com/spreadsheet/pub?key=0ArnrkTakel9cdHdmMHk4QjhFc0JIQ1lFRUVSTVNHY3c&output=html), 
	          that serves as a confirmation - no additional emails will be sent.
	          This spreadsheet will be updated daily so please check it often 
	          for your team to appear on it.".
	          $break; 
	$body .= "2. Registrations are being done on a first-come, first-serve basis.
	          If registrations are already full by the time you register, you
	          will be placed on a waiting list. If you are on the waiting list,
	          you may come to the tournament at the appropriate sign-in times and 
	          if there are participants who do not show up on time, you will be
	          registered into the tournament. This email is by no means a
	          confirmation that you are registered for the tournament!".
			  $break;
	$body .= "3. Please check http://www.badmintonclub.uwaterloo.ca/events/trinity_cup.html 
	          for full tournament rules and details.".$break;
 	$body .= "4. If you are a W15 member of the UW Badminton Club, please remember to
 	          bring your membership card and $15.00 or $10.00 and a non-perishable food item.".$break;
 	$body .= "5. If you are not a W15 member, please bring $20.00 or $15.00 and a non-perishable food item. and your WATcard.".$break;
 	$body .= "6. All non-members MUST fill out a waiver form, which can be
 	          downloaded from here: http://csclub.uwaterloo.ca/~badminto/waiver.pdf.
 	          Additional forms will also be provided at the tournament.".$break;
	$body .= "--------------------------------------------".$break;	 	
 	$body .= "Submitted on ".date( "d/M/Y h:i:s" ).$break;
	$body .= "from ".$_SERVER['REMOTE_ADDR'].$break;
	$body .= "--------------------------------------------".$break;		
	return $body;
}
?>

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
      echo "<div class='error' style='width:100%;'>Please fix the following error(s) in the registration form:\n<ul>";
      foreach ($errors as $error)
        echo "<li>$error</li>\n";
    
      echo "</ul></div>"; 
      
      echo ('<p><a href="javascript:javascript:history.go(-1)">Back</a></p>');      
    } 
?>

<!-- InstanceEndEditable -->
