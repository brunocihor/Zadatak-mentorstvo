<!DOCTYPE html>
<?php 
include 'connection.php'; 
if (isset($_GET['kod']))
{
	$kod = $_GET['kod'];
	$query = "DELETE FROM `prijava` WHERE `prijava`.`kod` = '".$kod."'";
	$result = mysqli_query($conn,$query);
	header("location: lista.php");
}
?>
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
			<h1>Lista prijava</h1>	
			<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Vrijeme prijave</th>
					<th>Email</th>
					<th>PHP verzija</th>
					<th>Kod</th>
					<th>Kratak opis</th>
					<th>Brisanje</th>
					<th>Detaljni prikaz</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$query="SELECT `prijava`.`id`, `prijava`.`vrijeme`, `prijava`.`email`, `prijava`.`php`, `prijava`.`kod`, `prijava`.`opis`
						FROM `prijava`
						ORDER BY `prijava`.`vrijeme` DESC";
				$result = mysqli_query($conn,$query);
				$rb = 1;
				while($row = mysqli_fetch_array($result)) { 
					echo '
						<tr>
							<th scope="row">'.$rb.'</th>
							<td>'.$row['vrijeme'].'</td>
							<td> <a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>
							<td>'.$row['php'].'</td>
							<td>'.$row['kod'].'</td>
							<td>'.substr($row['opis'], 0,50).'</td>
							<td><a class="btn btn-danger" href="lista.php?kod='.$row['kod'].'">Brisanje</a></td>
							<td><a class="btn btn-success" href="profil.php?kod='.$row['kod'].'">Detaljni prikaz</a></td>
						</tr>';
					$rb++; } ?>
			</tbody>
			</table>
		</div>
	</body>
</html>