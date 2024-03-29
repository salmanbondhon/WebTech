<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home | Welcome</title>
	<link rel="stylesheet" href="./styles/scss/header.css">
	<link rel="stylesheet" href="./styles/scss/index.css">
	<link rel="stylesheet" href="./styles/scss/common.css">
</head>

<body>
	<?php @include "./pages/header.php" ?>
	<div class="welcome">
		<h2>Welcome </h2>
	</div>

	<div class="quickThings">
		<h3>A Little About Us</h3>
		<p>
			<span>R</span>
		</p>

		<div class="things">
			<div class="blocks">
				<a href="./pages/registration.php">Register</a>
			</div>

			<div class="blocks">
				<a href="./pages/login.php">Login</a>
			</div>

			<div class="blocks">
				<a href="#">Done</a>
			</div>
		</div>

	</div>
	<?php @include "./pages/footer.php" ?>
</body>

</html>