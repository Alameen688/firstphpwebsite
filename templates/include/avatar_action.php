<?php

if(isset($_POST['changeavatar'])){
	if(!empty($_FILES['avatar']['name'])){
		
		  if($_FILES['avatar']['size'] > 153600){
				$amessage = "Image size must not be greater than ".(AV_MAXFILESIZE/1024)." kb in size";
		  }
		  else{
		          /*store the uploaded image first so that users can see the results immediately*/     
			       storeUploadedImage( $_FILES['avatar'] );
			      /* NOW UPDATE THE FILE NAME IN THE DATABASE this happens faster */
			       $username = $_SESSION['useridentity'];
	               $fileext = strtolower( strrchr( $_FILES['avatar']['name'], '.' ) );
	               $filename = $_SESSION['useridentity'].$fileext;
	           
	               $sql = "UPDATE users SET
	                       avatar = '{$filename}'
			               WHERE userName = '{$username}'";
		      
			       $file_name = mysql_query($sql);
			       confirm_query($file_name);
	               header("location:.?action=profilelogin");
		}
	}
	 else{
		$amessage = "Please Select a file to upload";
		}
}
else{
	 $username = "";
	 $fileext = "";
	 $filename = ""; 
	}
?>
<?php
/**
  * Deletes any images and/or thumbnails associated with the article
  */	
?>
