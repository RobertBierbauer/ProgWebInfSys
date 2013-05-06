<!-- View to login -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php include "loginError.php";?>
	<?php include "../navbar.php";?>
	<div class="row-fluid">
		<?php include 'sidebar.php';?>
		<div class="span8">
			<?php echo $error;?>
			<legend>Login</legend>			
			<form action="login.php" method="POST">
				<label for="username">Username</label>
				<input id="username" type="text" name="username" placeholder="username"/>
				<label for="password">Password</label>
				<input id="password" type="password" name="password" placeholder="password"/>	
				<button type="submit" class="btn btn-primary">Login</button>
			</form>
		</div>
	</div>
</body>
</html>