<?php session_start(); ?>
<?php
require_once "config/database.php";
if (isset($_SESSION['user_id'])) {
	header("location: dashboard.php");
	exit();
}
?>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="form-wrapper">
		<?php
		if (empty($_GET['alert'])) {
			echo '';
		} elseif ($_GET['alert'] == 2) {

			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Register Berhasi, Silahkan tunggu admin mengaktifkan akun.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
		}
		?>
		<form action="#" method="post">
			<h3>Login Disini</h3>

			<div class="form-item">
				<input type="text" name="user" required="required" placeholder="Username" autofocus required></input>
			</div>

			<div class="form-item">
				<input type="password" name="pass" required="required" placeholder="Password" required></input>
			</div>

			<div class="button-panel">
				<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
			</div>
		</form>
		<?php
		if (isset($_POST['login'])) {
			$username = mysqli_real_escape_string($db, $_POST['user']);
			$password = mysqli_real_escape_string($db, $_POST['pass']);

			$query 		= mysqli_query($db, "SELECT * FROM user WHERE  password='$password' and username='$username'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);

			if ($num_row > 0) {
				if ($row['status'] == 'aktif') {
					$_SESSION['user_id'] = $row['id'];
					header('location:dashboard.php');
				} else {
					header('location:index.php');
				}
			} else {
				echo 'Invalid Username and Password Combination';
			}
		}
		?>
		<div class="reminder">
			<p><a href="register.php">Register</a></p>
		</div>

	</div>

</body>

</html>