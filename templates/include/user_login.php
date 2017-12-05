<?php 
if(isset($_POST['login'])){
	   
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
	if(isset($_POST['password']))
	{
		if(strlen($_POST['password']) > 40)
		{
			$pmessage = 'The password cannot be longer than 30 characters.';
		}
		if(empty($_POST['password'])){
			$pmessage = 'The password field cannot be empty.';
		}
	}      
	
	  
	if(empty($umessage) && empty($pmessage)){
		 
	 $user_name = trim(mysql_prep($_POST['username']));
	 $password =  trim(mysql_prep($_POST['password']));
	 $hashed_password =  sha1($password);
	 
	  $query = "SELECT
	                 id,
	                 userName  
	           FROM 
			         users
			   WHERE 
			       userName = '{$user_name}'
			   AND 
			       hashedPassword= '{$hashed_password}'";
	
	$login_set = mysql_query($query);
    
	  confirm_query($login_set);
		   if(mysql_num_rows($login_set)==1){
			    $found_user = mysql_fetch_array($login_set);
				$_SESSION['useridentity'] = $found_user['userName'];
				
		   }
			   /*
			    OR USE THIS QUERY 
				an set LIMIT to 1
			      if($login = mysql_fetch_array($login_set)){
			   redirect_to("admin.php");
			   }  
			   
			   */
		   
		   else{
			   $message = "Username/Password combination incorrect. <br />
			               Please make sure caps lock key is off and try again";
			   }
       }
	   else{
		     if(count($errors)==1){
				           $message = "There was 1 error in the form.";
				 }
		     else{
				 $message = "There were" .count($errors). "errors in the form.";
				 }
		   }
		   
}
 else{
	 $user_name = "";
	 $password =  ""; 
	 }
	?>

<?php
if(isset($_POST['postcomment'])){   
      
  if(empty($_POST['com_content']) || !isset($_POST['com_content'])){
	                  $message =  "Comment field must not be empty";
		}
  
	else {
	  $com_by = trim(mysql_prep($_SESSION['useridentity']));
      $com_content = trim(mysql_prep($_POST['com_content']));
	  $aId = (int)$_GET["articleId"];
	  
		$sql = "INSERT INTO 
					         comments(commentDate ,
						              commentBy ,
									  commentContent ,
									  aId) 
				VALUES (
				         NOW(),
				        '{$com_by}' ,
				        '{$com_content}' ,
						'$aId' 
						)";
		            		
		$result = mysql_query($sql);
						
		if(!$result)
		{
			$cmessage =  'Your Comment has not been posted, please try again later.';
		} 
		else
		{
			$cmessage = 'Your comment has been posted! Thank you.';
		}
	  }
	}
else{
	$user_name = "";
	$password ="";
	}	

?>