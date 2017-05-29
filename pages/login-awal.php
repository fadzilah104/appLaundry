<?php
	require '../functions/functions.php';
	if (isset($_SESSION["username"])) {
		header("Location: home.php");
	}

	if (isset($_POST["submit"])) {
		if ( login($_POST) ) {
			echo "
				<script>
					alert('Login Gagal');
				</script>
			";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - Laundry Mamah Cantik</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="container body-color">
		<div class="body-color">
			<div class="login-container">
				<div class="border">
					<img src="../images/logo.png" class="center-block logo" alt="Saban Hari Laundry">
					<form action="" method="post" class="form-signin">
				        <h2 class="form-signin-heading">Log In</h2>
				        <label for="inputUser" class="sr-only">Username</label>
				        <input name="username" type="text" id="inputUser" class="form-control input-lg username" placeholder="Username" required autofocus>
				        <label for="inputPassword" class="sr-only">Password</label>
				        <input name="password" type="password" id="inputPassword" class="form-control input-lg password" placeholder="Password" required>
				        <button class="btn btn-lg btn-info btn-block button" name="submit" type="submit">Log in</button>
				    </form>
				</div>	
			</div>
		</div>
	</div>
</body>
</html>