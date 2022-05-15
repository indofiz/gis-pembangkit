
<?php
// Panggil koneksi database
require_once "../config/database.php";

if (isset($_GET['id'])) {

	$id = $_GET['id'];
	// $image = mysqli_query($db, "SELECT * FROM user_data WHERE id ='$id'") or die('Query Error : ' . mysqli_error($db));
	// if(mysqli_num_rows($image) > 0){
	// 	while ($data  = mysqli_fetch_assoc($image)) {
	// 		$foto             = $data['foto'];
	// 		$ijazah           = $data['ijazah'];
	// 	}
	// 	if ($foto != "assets/img/default.png") {
	// 		unlink("../" .$foto);
	// 	}
	// 	if ($ijazah != "assets/img/default-ijazah.png") {
	// 		unlink("../" .$ijazah);
	// 	}
	// }
        
	$query = mysqli_query($db, "DELETE FROM informasi_pembangkit WHERE id_pembangkit='$id'");

	// cek hasil query
	if ($query) {
		// jika berhasil tampilkan pesan berhasil delete data
		header('location: ../dashboard.php?alert=4');
	} else {
		// jika gagal tampilkan pesan kesalahan
		header('location: ../dashboard.php?alert=1');
	}	
}							
?>