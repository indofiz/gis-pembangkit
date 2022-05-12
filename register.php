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
        } elseif ($_GET['alert'] == 1) {

            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Register Gagal, Silahkan Coba.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        ?>
        <form action="#" method="post">
            <h3>Register here</h3>

            <div class="form-item">
                <input type="text" name="username" required="required" placeholder="Username" autofocus required></input>
            </div>

            <div class="form-item">
                <input type="password" name="pass" required="required" placeholder="Password" required></input>
            </div>

            <div class="button-panel">
                <input type="submit" class="button" title="Register" name="register" value="Register"></input>
            </div>
        </form>
        <?php
        if (isset($_POST['register'])) {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['pass']);
            $status = 'nonaktif';
            $level = 'user';
            $query = mysqli_query($db, "INSERT INTO user(username,
													 password,
													 status,
													 level)	
											  VALUES('$username',
													 '$password',
													 '$status',
													 '$level')");

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil insert data
                header('location: index.php?alert=2');
            } else {
                // jika gagal tampilkan pesan kesalahan
                header('location: register.php?alert=1');
            }
        }
        ?>
        <div class="reminder">
            <p><a href="index.php">Halaman Depan</a></p>
        </div>

    </div>

</body>

</html>