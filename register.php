<?php 
include'connect.php';
$userexist='';
$passworderror='';
$allfields='';
if(isset($_POST['register'])){    
	$firstname =trim($_POST["firstname"]);
	$lastname =trim($_POST["lastname"]);
	$email = trim($_POST["email"]);
	$password =trim($_POST["password"]);
	$passwordrept =trim($_POST["passwordrept"]);
	$usertype='user';
	
		// check first before add
	
	$resultemail= $conn->prepare("SELECT * FROM users WHERE email =:email");
	    $resultemail->bindParam(':email', $email);
	    $resultemail->execute();
	if ($resultemail->rowCount() > 0) {
  	  $userexist='The email already exist in our system';
     
       }
     //check if password match
     elseif($passwordrept!=$password) {
  	  $passworderror='The passwords do not match';
    }
    // check if all field are field
    elseif(empty($passwordrept) or empty($password) or empty($email) or empty($firstname) or empty($lastname)) {
  	  $allfields='Please fill all fields';
    }
     //add user
         else { 
         	 
    $query=$conn->prepare("INSERT into users(firstname,lastname,email,password,usertype) 
	values(:firstname,:lastname,:email,:password,:usertype)");     	
$query->bindParam(':firstname',$firstname);
$query->bindParam(':lastname',$lastname); 
$query->bindParam(':password',$password);
$query->bindParam(':email',$email);
$query->bindParam(':usertype',$usertype);
if($query->execute());

	{ 
	
	header("Location:userhome.php");


}
}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
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
					firstname: {
						required: true,
						minlength: 3
					},
					lastname: {
						required: true,
						minlength: 3
					},
					email: {
						required: true,
						email: true
					},
					password: {
						required: true,
						minlength: 6
					},
					passwordrept: {
						required: true,
						equalTo: "#password"
					}
				},
				messages: {
					firstname: {
						minlength: "Name should be at least 3 characters",
						required: "This field is required"
					},
					lastname: {
						minlength: "Name should be at least 3 characters",
						required: "This field is required"
					},
					email: {
						email: "Please enter email",
						required: "This field is required"
					},
					password: {
						required: "This field is required",
						minlength: "Password must contain 6 or more characters"
					},
					passwordrept: {
						required: "This field is required",
						equalTo: "Password don't match"
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
	<section class="hero-image banner">
		<h2 class="zero-mg zero-pd banner-text light-text">Pick your own songs,<br> it's your music</h2>
	</section>
	<section class="breadcrumb light-text">
		<a class="no-decoration light-text" href="index.php">Home </a> <i class="fa fa-angle-right "></i> Register
	</section>

	<section>
		<div class="container-nogap light-bg">
			<h2 class="zero-mg title light-text ">Register</h2>
			<div class="blank dark-bg"></div>
			<?php if ($userexist){
				 echo '<h4 class="error">' . $userexist . '</h4>'; 
			} ?>
			<?php if ($allfields){
				echo '<h4 class="error">' . $allfields . ' ?</h4>'; 
			} ?>
			<?php if ($passworderror){
					echo '<h4 class="error">' . $passworderror . '</h4>'; 
			} ?>

			<!-- <h4 class="error">user exists</h4> -->
			<!-- <h4 class="error">password error !!!</h4> -->
			<!-- <h4 class="error">all fields?</h4> -->
			<br>
			<form action="" class="form container-nogap" id="register" method="post">
				<label class="label light-text" for="firstname">Firstname</label>
				<input type="text" class="input-search" id="firstname" placeholder="Enter first name" name="firstname"
					required>

				<div class="blank dark-bg"></div>

				<label class="label light-text" for="lastname">Lastname</label>
				<input type="text" class="input-search" id="lastname" placeholder="Enter last name" name="lastname"
					required>

				<div class="blank dark-bg"></div>

				<label class="label light-text" for="email">Email</label>
				<input type="email" class="input-search" id="email" placeholder="Enter email" name="email" required>

				<div class="blank dark-bg"></div>

				<label class="label light-text" for="password">Password</label>
				<input type="password" class="input-search" id="password" placeholder="Enter password" name="password"
					required>

				<div class="blank dark-bg"></div>

				<label class="label light-text" for="password">Re-enter Password</label>
				<input type="password" class="input-search" id="passwordrept" placeholder="Enter password again"
					name="passwordrept" required>
				<div class="blank dark-bg"></div>

				<button type="submit" name="register" class="btn btn-success dark-text">Submit</button>

			</form>
			<!-- <div class="register light-text">
				<i> Don't have Account ?</i>
				<a class="light-text dark-bg btn" href="register.php">register</a>
			</div> -->
		</div>
	</section>
	<footer>
		<div align="center">
			<h6 class="light-text"> Copyright &copy;
				<script>document.write(new Date().getFullYear());</script> All rights reserved</h6>
		</div>
	</footer>
	<script src="./js/app.js"></script>
</body>

</html>