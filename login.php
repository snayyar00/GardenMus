<?php 
session_start();
if(isset($_SESSION['id'])) {  
header("Location:userhome.php");
}
include'connect.php';

$userexist='';
$passworderror='';
$allfields='';
if(isset($_POST['login'])){  
	$email = trim($_POST["email"]);
	$password =trim($_POST["password"]);
	$usertype='user';
		// check user  
	
	$resultemail= $conn->prepare("SELECT * FROM users WHERE email =:email and password=:password and usertype=:usertype");
	    $resultemail->bindParam(':email', $email);
	     $resultemail->bindParam(':password', $password);
	      $resultemail->bindParam(':usertype', $usertype);
	    $resultemail->execute();
	    $result=$resultemail->fetch(); 
    // check if all field are field
    if( empty($password) or empty($email)) {
  	  $allfields='Please fill all fields';
    }
    //login user
	elseif ($resultemail->rowCount() > 0) {
  	  $_SESSION['email']=$email;
  	  $_SESSION['firstname']=$result['firstname'];
  	   $_SESSION['lastname']=$result['lastname'];
  	  $_SESSION['id']=$result['id'];
	header("Location:userhome.php");
}
 else{
 	$userexist="User doen't exist";
 }
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/font-awesome/css/all.css">

	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#register").validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					password: {
						required: true,
						minlength: 6
					}
				},
				messages: {
					email: {
						email: "Please enter email",
						required: "This field is required"
					},
					password: {
						required: "This field is required",
						minlength: "Password must contain 6 or more characters"
					}
				}
			});
		});
	</script>


</head>

<body>
	<header>
		<navbar id="menu">
			<img id="btn-menu-close" src="./img/close.svg" alt="hamburger style closing button">
			<ul>
				<li class="nav-item">
					<a class="" href="index.php">HOME</a>
				</li>
				<li class="nav-item">
					<a href="login.php">LOGIN</a>
				</li>
				<li class="nav-item">
					<a href="admin.php">ADMIN</a>
				</li>
			</ul>
		</navbar>
		<div class="brand">
			<a class="nav-logo" href="index.php">
				<img id="logo" src="./img/logo.svg" alt="logo" />
			</a>
			<a class="nav-company-name" href="index.php">
				<p class="">musGarden</p>
			</a>
			<img id="btn-menu-open" src="./img/menu-open.svg" alt="hamburger closing menu" />
		</div>
	</header>
	<main>
		<section class="hero-image banner">
			<h2 class="zero-mg zero-pd banner-text light-text">Pick your own songs,<br> it's your music</h2>
		</section>

		<div class="breadcrumb light-text">
			<a class="no-decoration light-text" href="index.php">Home </a> <i class="fa fa-angle-right "></i> Login
		</div>
		<section>
			<!-- <div class="container-nogap light-bg"> -->
			<div class="container-nogap light-bg">

				<h2 class="zero-mg title light-text ">Login</h2>
				<div class="blank dark-bg"></div>
				<br>
				<form action="" class="form container-nogap" id="register" method="post">

					<label for="email" class="label light-text">Email</label>
					<input type="email" class="input-search" id="email" placeholder="Enter email" name="email"
						data-validation="email" required>

					<div class="blank dark-bg"></div>

					<label for="password" class="label light-text">Password</label>
					<input type="password" class="input-search" id="password" placeholder="Enter password"
						name="password" required>

					<button type="submit" name="login" class="btn btn-success dark-text">Submit</button>

				</form>

				<div class="register light-text">
					<i> Don't have Account ?</i>
					<a class="light-text dark-bg btn" href="register.php">register</a>
				</div>
			</div>
		</section>
	</main>



	<footer>
		<div align="center">
			<h6 class="light-text"> Copyright &copy;
				<script>document.write(new Date().getFullYear());</script> All rights reserved</h6>
		</div>
	</footer>
	<script src="./js/app.js"></script>

	<body />

</html>