<?php 
if(isset($_POST['subscribe'])){
	$full_name = $_POST['fullname'];
	$email = $_POST['email'];
	if(isset($full_name)){
		if(strlen($full_name) > 200){
			$nmessage = 'The name field cannot contain more than 100 characters.';
			
		}
		if(empty($full_name)){
			$nmessage = 'The name field must not be empty.';
			}
		if($full_name=="Full Name"){
			$nmessage = 'Please enter your Own Name.';
			}	
	}
	if(isset($email)){
		if(strlen($email) > 100)
		{
			$emessage = 'Your email address cannot be longer than 70 characters .';
			
		}
		if(empty($email)){
			$emessage = 'The email field must not be empty.';
			}
		if($email=="Email Address"){
			$emessage = 'Please enter your Own email.';
			}
			
		if(!preg_match("/([\w\-)]+\@[\w\-]+\.[\w\-]+)/",$email)){
			$emessage = "Please enter a valid Email Address e.g youremail@domain.com";
				   }		
	}
	if(empty($nmessage) && empty($emessage)){ 
	 $query = "INSERT INTO email_subscribers (fullName , emailAddress)
	           VALUES ('{$full_name}', '{$email}')";
			  $result = mysql_query($query);
			   
			if($result){
				 $success = "Thanks for subscribing to the Newsletter ".$full_name." an email will be sent to you soon";
                 $from = 'al-ameen@letuslearnit.com';
                 $subject = "Thank you signing up for the website's newsletter";
				 $to = $_POST['email'];
				 $text = "We will start sending you messages ";
                 $msg = "Dear $full_name,\n$text";
                 mail($to, $subject, $msg, 'From:' . $from);
                 echo 'Email sent to ' . $to . '<br />';
			   }
			else{} 
	}
}
?>