<?php
session_start(); 
if(isset($_SESSION['id'])) {  
header("Location:userhome.php");
}
include 'connect.php';
// fetch video and audio
$resulttop10= $conn->prepare("SELECT * FROM `files` ORDER BY `files`.`Rating`  Limit 3  ");
$resulttop10->execute(['audio']);
$numtop10 = $resulttop10->rowCount();
$resultaudio= $conn->prepare("SELECT * FROM files where type=? ORDER BY id DESC Limit 6 ");
$resultaudio->execute(['audio']);
$numaudio= $resultaudio->rowCount();  

$resultGenre= $conn->prepare("SELECT * FROM `files` WHERE Genre ='Slow' ORDER BY `files`.`Genre` ASC ");
$resultGenre->execute(['audio']);
$numresult = $resultGenre->rowCount();

$resultRB= $conn->prepare("SELECT * FROM `files` WHERE Genre ='R&B' ORDER BY `files`.`Genre` ASC Limit 2 ");
$resultRB->execute(['audio']);
$numRB = $resultRB->rowCount();

$resultAc= $conn->prepare("SELECT * FROM `files` WHERE Genre ='Acoustic' ORDER BY `files`.`Genre` ASC Limit 2 ");
$resultAc->execute(['audio']);
$numA = $resultAc->rowCount();



$resultHip= $conn->prepare("SELECT * FROM `files` WHERE Genre ='Hip Hop' ORDER BY `files`.`Genre` ASC Limit 2 ");
$resultHip->execute(['audio']);
$numH = $resultHip->rowCount();






	


?>

<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/font-awesome/css/all.css">

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
		<section class="breadcrumb light-text">
			<a class="no-decoration light-text" href="index.php">Home </a> <i class="fa fa-angle-right "></i> /
		</section>

		<form class="form" action="https://www.google.com/search" method="get" name="searchform" target="_blank">
			<input autocomplete="on" class="input-search" name="q" placeholder="Search in Google.com"
				required="required" type="text">
			<button class="btn btn-light light-text" type="submit"><i class="fa fa-search"></i> Search</button>
		</form>



		<div class="container light-bg">
			<h3 class="zero-mg title heading-bg dark-text">Latest Audios</h3>

			<?php
			
		 if ($numaudio > 0 ) {
					while( $rowaudio = $resultaudio->fetch(PDO::FETCH_ASSOC)){
						
						$audio=$rowaudio['pathfile'];
						$title=$rowaudio['title'];
						$Genre=$rowaudio['Genre'];
		 ?>
			<div class="card dark-bg">
				<div class="card-topbar">
					<audio controls controlsList="nodownload">
						<source src="<?php echo $audio ?>">
					</audio>

					<a class="download" href="login.php"><i class="fa fa-download " /></i></a>
				</div>

				<div class="card-bottombar light-text">
					<p class="title cardtitle zero-mg"><?php echo $title  ?></p>
					<p class="genre zero-mg"><?php echo $Genre  ?></p>
				</div>

				<br>
				<div class="blank"></div>
			</div>
			<?php
		} 
	}
	else{
		echo 'No latest audio';
	}
			?>

		</div>


		<div class="container light-bg">
			<h3 class="zero-mg title heading-bg dark-text">Top 3 Audio </h3>

			<?php
		if ($numtop10 > 0 ) {
                        while($rowaudio = $resulttop10->fetch(PDO::FETCH_ASSOC)){
							
							$audio=$rowaudio['pathfile'];
                        	$title=$rowaudio['title'];
							$Genre=$rowaudio['Genre'];
							$rating=$rowaudio['Rating']
							?>
			<div class="card dark-bg">
				<div class="card-topbar">
					<audio controls controlsList="nodownload">
						<source src="<?php echo $audio ?>">
					</audio>

					<a class="download" href="login.php"><i class="fa fa-download " /></i></a>
				</div>
				<div class="card-bottombar light-text">
					<p class="title cardtitle zero-mg"><?php echo $title  ?></p>
					<p class="genre zero-mg"><?php echo $Genre  ?></p>
				</div>

				<br>
				<div class="blank"></div>
			</div>
			<?php
		} 
	}
	else{
		echo 'No latest audio';
	}
			?>
		</div>


		<div class="container light-bg">
			<h3 class="zero-mg title heading-bg dark-text" >Different Genres </h3>
			<h3 class="zero-mg  heading-bg dark-text" style="color: darkblue;">Slow </h3>
			<?php
			if ($numresult > 0 ) {
				
				while($rowGen = $resultGenre->fetch(PDO::FETCH_ASSOC)){
					
					$audio=$rowGen['pathfile'];
					$title=$rowGen['title'];
					$Genre=$rowGen['Genre'];
		?>
		
			<div class="card dark-bg">
				<div>

					<div class="card-topbar">
						<audio controls controlsList="nodownload">
							<source src="<?php echo $audio ?>">
						</audio>

						<a class="download" href="login.php"><i class="fa fa-download " /></i></a>
					</div>
					<div class="card-bottombar light-text">
						<p class="title cardtitle zero-mg"><?php echo $title  ?></p>
						<p class="genre zero-mg"><?php echo $Genre  ?></p>
					</div>
					<br />

					<div class="blank"></div>
				</div>
			</div>
			<?php
				} 
			}
			else{
				echo 'No Genre audio';
			}
		?>
		<h3 class="zero-mg  heading-bg dark-text" style="color: darkblue;">R&B </h3>
		<?php
			if ($numRB > 0 ) {
				
				while($rowGen = $resultRB->fetch(PDO::FETCH_ASSOC)){
					$bool=true;
					$audio=$rowGen['pathfile'];
					$title=$rowGen['title'];
					$Genre=$rowGen['Genre'];
		?>
			<div class="card dark-bg">
				<div>

					<div class="card-topbar">
						<audio controls controlsList="nodownload">
							<source src="<?php echo $audio ?>">
						</audio>

						<a class="download" href="login.php"><i class="fa fa-download " /></i></a>
					</div>
					<div class="card-bottombar light-text">
						<p class="title cardtitle zero-mg"><?php echo $title  ?></p>
						<p class="genre zero-mg"><?php echo $Genre  ?></p>
					</div>
					<br />

					<div class="blank"></div>
				</div>
			</div>
			<?php
				} 
			}
			else{
				echo 'No Genre audio';
			}
		?>
		<h3 class="zero-mg  heading-bg dark-text" style="color: darkblue;">Hip Hop </h3>
		<?php
			if ($numH > 0 ) {
				
				while($rowGen = $resultHip->fetch(PDO::FETCH_ASSOC)){
					$bool=true;
					$audio=$rowGen['pathfile'];
					$title=$rowGen['title'];
					$Genre=$rowGen['Genre'];
		?>
			<div class="card dark-bg">
				<div>

					<div class="card-topbar">
						<audio controls controlsList="nodownload">
							<source src="<?php echo $audio ?>">
						</audio>

						<a class="download" href="login.php"><i class="fa fa-download " /></i></a>
					</div>
					<div class="card-bottombar light-text">
						<p class="title cardtitle zero-mg"><?php echo $title  ?></p>
						<p class="genre zero-mg"><?php echo $Genre  ?></p>
					</div>
					<br />

					<div class="blank"></div>
				</div>
			</div>
			<?php
				} 
			}
			else{
				echo 'No Genre audio';
			}
		?>
		<h3 class="zero-mg  heading-bg dark-text" style="color: darkblue;">Acoustic </h3>
		<?php
			if ($numA > 0 ) {
				
				while($rowGen = $resultAc->fetch(PDO::FETCH_ASSOC)){
					$bool=true;
					$audio=$rowGen['pathfile'];
					$title=$rowGen['title'];
					$Genre=$rowGen['Genre'];
		?>
			<div class="card dark-bg">
				<div>

					<div class="card-topbar">
						<audio controls controlsList="nodownload">
							<source src="<?php echo $audio ?>">
						</audio>

						<a class="download" href="login.php"><i class="fa fa-download " /></i></a>
					</div>
					<div class="card-bottombar light-text">
						<p class="title cardtitle zero-mg"><?php echo $title  ?></p>
						<p class="genre zero-mg"><?php echo $Genre  ?></p>
					</div>
					<br />

					<div class="blank"></div>
				</div>
			</div>
			<?php
				} 
			}
			else{
				echo 'No Genre audio';
			}
		?>
		</div>
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