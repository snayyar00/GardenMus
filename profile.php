<?php
session_start();
if(!isset($_SESSION['id'])) {  
header("Location:login.php");
}
 
include'connect.php';
$success='';
if(isset($_POST['update'])){    
	$firstname =trim($_POST["firstname"]);
	$lastname =trim($_POST["lastname"]);	 
	 //update         	 
    $query=$conn->prepare("UPDATE users set firstname=:firstname, lastname=:lastname where id=:id");
$query->bindParam(':firstname',$firstname);
$query->bindParam(':lastname',$lastname);
$query->bindParam(':id',$_SESSION['id']);
if($query->execute());
	{
$success='Your information was updated succesfully';
}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Profile</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/font-awesome/css/all.css">
	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
					<a class="" href="profile.php">PROFILE</a>
				</li>
				<li class="nav-item">
					<a href="logout.php">LOGOUT</a>
				</li>
				<!-- <li class="nav-item">
					<a href="admin.php">ADMIN</a>
				</li> -->
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
		<a class="no-decoration light-text" href="index.php">Home </a> <i class="fa fa-angle-right "></i> Profile
		(logged in)
	</section>
	<section>
		<div class="container-nogap light-bg">
			<h2 class="zero-mg title light-text">Your Profile</h2>

			<?php if ($success){
				echo '<h4 class="btn-success">' . $success . '</h4>'; 
			} ?>

			<form action="" class="form container-nogap" id="register" method="post">

				<label class="label light-text" for="firstname">Firstname:</label>
				<input class="input-search" type="text" id="firstname" value="<?php echo $_SESSION['firstname'] ?>"
					name="firstname" required>

				<label class="label light-text" for="lastname">Lastname:</label>
				<input class="input-search" type="text" id="lastname" value="<?php echo $_SESSION['lastname'] ?>"
					name="lastname" required>

				<label class="label light-text" for="firstname">Email:</label>
				<input class="input-search" type="email" id="email" readonly value="<?php echo $_SESSION['email'] ?>"
					name="email" required>
				<button type="submit" name="update" class="btn btn-success">Update</button>
			</form>
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