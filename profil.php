<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<title>Zahtjevi za server</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php include 'connection.php';  ?>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Zahtjevi za server</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Prijava</a></li>
						<li class="active"><a href="lista.php">Lista prijava <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<h1 class="profile">Profil</h1>
			<table class="table table-striped">
			<?php 
				if(isset($_GET['kod'])){
					$kod = $_GET['kod'];
					$query = "SELECT * FROM prijava WHERE kod = '".$kod."'";
					$result = mysqli_query($conn,$query);
					while($row = mysqli_fetch_array($result)) { 
						echo '
							<tr>
								<th>Email</th>
								<td><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>
							</tr>
							<tr>
								<th>Vrijeme prijave</th>
								<td>'.$row['vrijeme'].'</td>
							</tr>
							<tr>
								<th>Verzija PHP-a</th>
								<td>'.$row['php'].'</td>
							</tr>
							<tr>
								<th>Jedinstveni kod prijave</th>
								<td>'.$row['kod'].'</td>
							</tr>
							<tr>
								<th>Opis prijave</th>
								<td>'.chunk_split($row['opis'],50).'</td>
							</tr>';
					}
				}else{
					echo '<p class="p-er text-center">Odabrali ste nepostojeću prijavu!</p>';
				} ?>
			</table>
			<div class="button text-center">
				<a class="btn btn-success" href="lista.php">Povratak</a>
			</div>
		</div>
</body>
</html>