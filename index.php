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
		<?php  
		include 'connection.php'; 
		include 'functions.php';
		?>
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
						<li class="active"><a href="index.php">Prijava <span class="sr-only">(current)</span></a></li>
						<li><a href="lista.php">Lista prijava</a></li></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<h1>Prijava</h1>
			<p>Ovo je stranica za prijavu korisnika za korištenje servera.</p>
			<p>
				Potrebno je unesti sljedece podatke za prijavu:
			</p>
			<form action="" method="POST">
				<div class="form-group">
					<label for="email">Email adresa</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Unesite email za prijavu">
					<label class="error" for="email">
						<?php if(isset($_POST['prijava']) && empty($_POST['email'])) { echo 'Potrebno je upisati email adresu'; } ?>
					</label>
					<label  class="error" for="email">
						<?php if(isset($_POST['prijava']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['email'])) { echo 'Krivo ste napisali format maila'; } ?>	
					</label>
				</div>
				<div class="form-group">
					<label for="php">PHP verzija</label>
					<select class="form-control" name="version">
						<option></option>
						<option>7.0</option>
						<option>7.1</option>
						<option>7.2</option>
					</select>
					<label  class="error" for="php">
						<?php if(isset($_POST['prijava']) && empty($_POST['version'])) { echo 'Unesite svoju verziju php-a'; } ?>
					</label>
				</div>
				<div class="form-group">
					<label for="mysql">Kratak opis prijave</label>
					<textarea class="form-control" rows="3" name="opis" maxlength="200" placeholder="Upisite opis vaše prijave!"></textarea>
					<label  class="error" for="mysql">
						<?php if(isset($_POST['prijava']) && empty($_POST['opis'])) { echo 'Unesite opis za vašu prijavu'; } ?>
					</label>
					<p class="help-block">Do 200 znakova.</p>
				</div>
				<button type="submit" class="btn btn-info" name="prijava">Prijava</button>
			</form>
		</div>
		<?php  
		if (isset($_POST["prijava"]))
		{	
			$mail = $_POST["email"];
			$version = $_POST["version"];
			$opis = $_POST["opis"];
			date_default_timezone_set("Europe/Zagreb");
			$time = date("d.m.Y. H:i",time());
			$code = random_code(8);
			$error=array();
			if (empty($mail)) {array_push($error, 'Unesite svoj email');}
			if (empty($version)){array_push($error, 'Unesite svoju verziju php-a');}
			if (empty($opis)){array_push($error, 'Unesite opis za vašu prijavu');}
			if (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($_POST['email'])) {array_push($error, 'Krivo ste napisali format maila');}
			if (count($error) == 0)
				{	
					$query = "INSERT INTO `prijava` (`id`, `vrijeme`, `email`, `php`, `kod`, `opis`) VALUES (NULL, '".$time."' , '".$mail."', '".$version."', '".$code."', '".$opis."')";
					$result = mysqli_query($conn,$query);
						header("location: lista.php");
				}
			} 
			?>
	</body>
</html>
