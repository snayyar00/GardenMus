<?php 
session_start();
if(!isset($_SESSION['admin'])) {  
header("Location:admin.php");
}
include'connect.php';

$success='';
$allfields='';
if(isset($_POST['upload'])){  
	$pathfile= $_FILES['file']['name'];
	$title=trim($_POST["title"]);
	$type=$_POST["optradio"];
	$genre=trim($_POST["Genre"]);
	$Rating=trim($_POST["Rating"]);
	$targetdir='uploads/';	
	$ext = pathinfo($pathfile, PATHINFO_EXTENSION);	
	$filebase=date('Ymdhis').'.'.$ext; 
	$filename= $targetdir.$filebase;
	  if( empty($title) or empty($pathfile) or empty($type) or empty($pathfile)) {
  	  $allfields='Please fill all fields';
    }
		//move to directory
	if(move_uploaded_file($_FILES['file']['tmp_name'],$filename)){
	$query=$conn->prepare("INSERT into files(type,pathfile,title,Genre,Rating) 
	values(:type,:pathfile,:title,:Genre,:Rating)");     	
$query->bindParam(':type',$type);
$query->bindParam(':pathfile',$filename);
$query->bindParam(':Genre',$genre);
$query->bindParam(':title',$title);
$query->bindParam(':Rating',$Rating);

 if ($query->execute()) {
 	$success="The file uploaded successfully";
 	
 }
}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Admin Home</title>
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
					<a class="" href="adminindex.php">HOME</a>
				</li>
				<li class="nav-item">
					<a class="" href="admindelete.php">ALL FILES</a>
				</li>
				<!-- <li class="nav-item">
					<a class="" href="profile.php">PROFILE</a>
				</li> -->
				<li class="nav-item">
					<a href="logout.php">LOGOUT</a>
				</li>
				<!-- <li class="nav-item">
					<a href="admin.php">ADMIN</a>
				</li> -->
			</ul>
		</navbar>
		<div class="brand">
			<a class="nav-logo" href="adminindex.php">
				<img id="logo" src="./img/logo.svg" alt="logo" />
			</a>
			<a class="nav-company-name" href="adminindex.php">
				<p class="">musGarden</p>
			</a>
			<img id="btn-menu-open" src="./img/menu-open.svg" alt="hamburger closing menu" />
		</div>
	</header>

	<section class="hero-image banner">
		<h2 class="zero-mg zero-pd banner-text light-text">Pick your own songs,<br> it's your music</h2>
	</section>
	<section class="breadcrumb light-text">
		<a class="no-decoration light-text" href="adminindex.php">Home </a> <i class="fa fa-angle-right "></i> Admin
		creation
	</section>
	<section>
		<div class="container-nogap light-bg">
			<h2 class="zero-mg title light-text">Upload Files</h2>

			<?php if ($success){
					echo '<h4 class="btn-success">' . $success . ' ?</h4>'; 
				} ?>
			<?php if ($allfields){
					echo '<h4 class="error">' . $allfields . ' ?</h4>'; 
				} ?>
			<form action="" class="form container-nogap" id="register" method="post" enctype="multipart/form-data">
				<label class="label light-text" for="file">File</label>
				<input class="input-search light-text" type="file" class="form-control" id="file"
					placeholder="upload file" name="file" required>
				<label class="label light-text" for="title">Title</label>
				<input class="input-search" type="text" class="form-control" id="title" placeholder="Enter title"
					name="title" required>
				<label class="label light-text" for="Genre">Genre</label>
				<input class="input-search" type="text" class="form-control" id="Genre" placeholder="Enter Genre"
					name="Genre" required>

				<label class="label light-text" for="Rating">Rating</label>
				<!-- <input class="input-search" type="number" max=5 class="form-control" id="Rating"
					placeholder="Enter Rating" name="Rating" required> -->
					<div class="dropdown">
					<select class='light-bg' name='rating' id='rating'>
						<option selected disabled name='rate'>SELECT RATING</option>
						<option value="1" name='rate'>1-low</option>
						<option value="2" name='rate'>2</option>
						<option value="3" name='rate'>3</option>
						<option value="4" name='rate'>4</option>
						<option value="5" name='rate'>5-high</option>
					</select>
				</div>



				<label class="label light-text" class="radio-inline"><input class="input-search" type="radio"
						value="Audio" name="optradio" required>Audio</label>

				<button type="submit" name="upload" class="btn btn-success">Submit</button>

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