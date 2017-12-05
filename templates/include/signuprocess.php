<?php
if(isset($_POST['signup'])){
	 
	  /* declare the array for later use */
	if(isset($_POST['username']))
	{
		//the user name exists
		/*if(!ctype_alnum($_POST['username']))
		{
			$umessage = 'The username can only contain letters and digits.';
		}
		*/
		if(strlen($_POST['username']) > 30)
		{
			$umessage = 'The username cannot be longer than 30 characters.';
			
		}
		if(empty($_POST['username'])){
			$umessage = 'The username field must not be empty.';
			}
	}
	if(isset($_POST['confirmpassword']) && isset($_POST['password'])){
	
		if(strlen($_POST['password']) > 40)
		{
			$pmessage = 'The password cannot be longer than 30 characters.';
		}
		if(empty($_POST['password'])){
			$pmessage = 'The password field cannot be empty.';
		}
		if(empty($_POST['confirmpassword'])){
			$pcmessage = 'The confirm password field cannot be empty.';
		}
		if($_POST['password'] != $_POST['confirmpassword']){
			$pcmessage = 'Both passwords do not match.';
		}
		
	}
	if(isset($_POST['email'])){
		if(strlen($_POST['email']) > 90){
		   $emessage = 'The email cannot be longer than 90 characters.' ;
		}
		if(empty($_POST['email'])){
			$emessage = 'The email field cannot be empty.';
		}
		if(!preg_match("/([\w\-)]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])){
			$emessage = "Please enter a valid Email Address e.g youremail@domain.com";
				   }
		}
	 /*
	 if(isset($_FILES['avatar']['name'])){
		 
		 if(strlen($_FILES['avatar']['name']) > 80){
		  $fmessage = 'File name is too long';
		  $output_form = true;
		 }
	     if(empty($_FILES['avatar']['name'])){
		  $fmessage = 'Please select a file to upload.';
		  $output_form = true;
		 }
	 }
	 $avatar_type = $_FILES['avatar']['type'];
	 echo "$avatar_type";
	 if(isset($avatar_type)){
		 if($avatar_type!='image/jpegimage/jpeg' || $avatar_type!=='image/png' || $avatar_type!=='image/gifimage/gif' || $avatar_type!=='image/gjpeg'){
			 $fmessage = "File must be an image in JPEG, PNG or GIF format ";
			 echo "$avatar_type";
			 $output_form = true;
			 }		 
	 }
	 $avatar_size = $_FILES['avatar']['size'];
	 if($avatar_size < 0 || $avatar_size >= 300000){
		 $fmessage = "File size must not be more than" .(AV_MAXFILESIZE/1024). "kb in size";
		 $output_form = true;
		 }*/
	 /*if(isset($_POST['email'])){  
     if(!ereg('^([a-zA-Z0-9_-]+)([\.a-zA-Z0-9_-]+)@([a-zA-Z0-9_-]+)
     (\.[a-zA-Z0-9_-]+)+$', $_POST['email'])) {
       $errors[] = 'Enter valid email address.'; 
	}*/
	 $user_name = trim(mysql_prep($_POST['username']));
	 $password =  trim(mysql_prep($_POST['password']));
	 $email = trim(mysql_prep($_POST['email']));
	 $hashed_password =  sha1($password);
	if(empty($umessage) && empty($pmessage) && empty($emessage) && empty($pcmessage)){ 
	 $query = "INSERT INTO users (userName , hashedPassword , emailAddress)
	           VALUES ('{$user_name}', '{$hashed_password}' , '{$email}')";
			  $result = mysql_query($query);
			   
			if($result)
			   { // on success display login page to help user edit there account 
				header("location:.?action=profilelogin&success=true&user=$user_name");
			   }
			else{
				   //display error
					$message = "<p>Oops sign up failed try again after some time:</p>";
					$message .= "<p>" .mysql_error(). "</p>";
				}
	}
}
/*If form has not been posted output the form by setting output form to true*/
else{
	$user_name = "";
	$password = "";
	}
	 ?>