<?php
session_start();
include("connect.php");
 
//register user
if(isset($_POST['register'])){    
	$firstname =trim($_POST["firstname"]);
	$lastname =trim($_POST["lastname"]);	 
	$phone =trim($_POST["phone"]);
	$email = trim($_POST["email"]);
	$password =trim($_POST["password"]);
	$passwordrept =trim($_POST["passwordrept"]);
	
		// check first before add
	
	$resultemail= $conn->prepare("SELECT * FROM users WHERE email =:email");
	    $resultemail->bindParam(':email', $email);
	    $resultemail->execute();
	if ($resultemail->rowCount() > 0) {
  	  $userexist='The email already exist in our system';
     
       }

     // check if all fields are field
     elseif(empty($firstname) or empty($firstname)) {
  	  $passworderror='The passwords do match';
  	   }

     //check if password match
     elseif($passwordrept!=$password) {
  	  $passworderror='The passwords do match';
    }
    // check if all field are field
    elseif(empty($passwordrept) or empty($password) or empty($email) or empty($firstname) or empty($lastname)) {
  	  $allfields='Please fill all fields';
    }
     //add user
         else { 
         	 
    $query=$conn->prepare("INSERT into users(firstname,lastname,email,password) 
	values(:firstname,:lastname,:email,:password)");     	
$query->bindParam(':firstname',$firstname);
$query->bindParam(':lastname',$lastname); 
$query->bindParam(':password',$password);
$query->bindParam(':email',$email);
if($query->execute());

	{ 
	
	header("Location:userhome.html");


}
}
}