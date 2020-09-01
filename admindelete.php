<?php 
session_start();
if(!isset($_SESSION['admin'])) {  
header("Location:admin.php");
}
include'connect.php';



$success='';
$fail='';
if(isset($_POST['delete'])){
	$delid=$_POST['delid'];
$result = $conn->prepare("DELETE FROM files WHERE id =:delid");
$result->bindParam(':delid',$delid);
	if($result->execute()) 
		{ $success= "File Deleted"; }
	else
	 { $fail='File NOT Deleted';}
	}
 

?>
<!DOCTYPE html>
<html>

<head>
	<title>GOD MODE (admin)</title>
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
		&NonBreakingSpace;destruction
	</section>
	<?php if ($success){
		echo '<h4 class="btn-success">' . $success . ' </h4>'; 
	} ?>
	<?php if ($fail){
		echo '<h4 class="error">' . $fail . ' ?</h4>'; 
	} ?>
	<section class="container">

		<?php
		$result= $conn->prepare("SELECT * FROM files");
		$result->execute();
	$num = $result->rowCount();
	
	if ($num > 0 ) {
	while($resultall= $result->fetch(PDO::FETCH_ASSOC)) {
		$id = $resultall["id"];
		
		$pathfile = $resultall["pathfile"];
		$title =$resultall["title"];
		$Genre= $resultall["Genre"];
		  
	?>
		<div class="card light-bg">
			<div class="card-topbar light-text">
				<p><span class="">PATH: </span><?php echo $pathfile; ?></p>
			</div>
			<div class="card-bottombar light-text">
				<div class="title cardtitle zero-mg deletecard"><?php echo $title?>
					<form action="" method="post">
						<input type="number" hidden value="<?php echo $id ?>" name="delid">
						<button class="btn error no-decoration" type="submit" name="delete">Delete</button>
				</div>
				<p class="genre zero-mg"><?php echo $Genre?></p>

			</div>

			<br>
			<div class=" blank"></div>
		</div>
		<?php			 
  }} else { echo '<h4 class="error">Nothing found!!!</h4>'; } 
?>
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