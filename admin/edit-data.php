<?php
$id = $_GET['id'];
$pembangkit = mysqli_query($db, "SELECT * FROM informasi_pembangkit WHERE id_pembangkit ='$id'") or die('Query Error : ' . mysqli_error($db));
if (mysqli_num_rows($pembangkit) > 0) {
    while ($data  = mysqli_fetch_assoc($pembangkit)) {
        $nama_pembangkit   = $data['nama_pembangkit'];
        $longitude   = $data['longitude'];
        $latitude   = $data['latitude'];
        $perusahaan   = $data['perusahaan'];
        $kapasitas   = $data['kapasitas'];
        $arus   = $data['arus'];
        $tegangan   = $data['tegangan'];
        $daya_aktif_reaktif   = $data['daya_aktif_reaktif'];
        $gambar_ori   = $data['gambar'];
        $gambar   = explode("/", $data['gambar']);
        $gambar = end($gambar);
    }
} else {
    header('location:dashboard.php');
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3 mt-5">
            <h4 class="mb-4">Edit Data <?= $nama_pembangkit; ?></h4>
            <div class="row">
                <div class="col-6">
                    <img src="<?= $gambar_ori; ?>" class="img-fluid mb-5" alt="<?= $nama_pembangkit; ?>" id="image_prev">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="gambar-pembangkit">Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                <label class="custom-file-label" for="gambar" style="overflow:hidden;"><?= $gambar; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama-pembangkit">Nama Pembangkit <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $nama_pembangkit; ?>" name="nama-pembangkit" class="form-control" id="nama-pembangkit" placeholder="Masukan Nama Pembangkit" value="<?= isset($_POST['nama-pembangkit']) ? $_POST['nama-pembangkit'] : ""; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $perusahaan; ?>" name="nama-perusahaan" class="form-control" id="nama-perusahaan" placeholder="Masukan Nama Perusahaan" value="<?= isset($_POST['nama-perusahaan']) ? $_POST['nama-perusahaan'] : ""; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Kapasitas <span class="text-danger">*</span></label>
                            <input type="number" value="<?= $kapasitas; ?>" name="kapasitas" class="form-control" id="kapasitas" placeholder="Masukan Besaran Kapasitas" value="<?= isset($_POST['kapasitas']) ? $_POST['kapasitas'] : ""; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Arus <span class="text-danger">*</span></label>
                            <input type="number" value="<?= $arus; ?>" name="arus" class="form-control" id="arus" placeholder="Masukan Besaran Arus" value="<?= isset($_POST['arus']) ? $_POST['arus'] : ""; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Tegangan <span class="text-danger">*</span></label>
                            <input type="number" value="<?= $tegangan; ?>" name="tegangan" class="form-control" id="tegangan" placeholder="Masukan Besaran Tegangan" value="<?= isset($_POST['tegangan']) ? $_POST['tegangan'] : ""; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="daya_aktif_reaktif">Daya Aktif Reaktif <span class="text-danger">*</span></label>
                            <input type="number" value="<?= $daya_aktif_reaktif; ?>" name="daya_aktif_reaktif" class="form-control" id="daya_aktif_reaktif" placeholder="Masukan Daya Aktif Reaktif" value="<?= isset($_POST['daya_aktif_reaktif']) ? $_POST['daya_aktif_reaktif'] : ""; ?>" required="">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="longitude_input">Longitude <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $longitude; ?>" class="form-control" id="longitude_input" placeholder="Longitude" value="<?= isset($_POST['longitude_input']) ? $_POST['longitude_input'] : ""; ?>" disabled>
                                    <input type="hidden" value="<?= $longitude; ?>" name="longitude_input" id="longitude_input_h" value="<?= isset($_POST['longitude_input']) ? $_POST['longitude_input'] : ""; ?>" required="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="latitude_input">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $latitude; ?>" class="form-control" id="latitude_input" placeholder="Latitude" value="<?= isset($_POST['latitude_input']) ? $_POST['latitude_input'] : ""; ?>" disabled>
                                    <input type="hidden" value="<?= $latitude; ?>" name="latitude_input" id="latitude_input_h" value="<?= isset($_POST['latitude_input']) ? $_POST['latitude_input'] : ""; ?>" required="">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-outline-secondary mr-3">Reset</button>
                            <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan Data</button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <div id="map_edit" style="width: 100%; height: 550px;"></div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if (document.getElementById('map_edit')) {
        var map = L.map('map_edit').setView([<?= $latitude; ?>, <?= $longitude; ?>], 13);

        var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 20,
            attribution: 'GIS',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);

        var marker = L.marker([<?= $latitude; ?>, <?= $longitude; ?>]).addTo(map)
            .bindPopup(`Latitude: <?= $latitude; ?> <br /> Longitude: <?= $longitude; ?>`).openPopup();
        console.log(marker)
        map.on('click', function(e) {
            if (marker != undefined) {
                map.removeLayer(marker);
            }
            longitude.value = e.latlng.lng;
            longitude_h.value = e.latlng.lng;
            latitude.value = e.latlng.lat;
            latitude_h.value = e.latlng.lat;
            marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)
                .bindPopup(`Latitude: ${e.latlng.lat} <br /> Longitude: ${e.latlng.lng}`).openPopup();
        });
    }
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("gambar").files[0].name;
        document.getElementById("image_prev").src = URL.createObjectURL(document.getElementById("gambar").files[0]);
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
</script>
<?php
if (isset($_POST['submit'])) {

    $nama_pembangkit_u    = mysqli_real_escape_string($db, $_POST['nama-pembangkit']);
    $nama_perusahaan_u    = mysqli_real_escape_string($db, $_POST['nama-perusahaan']);
    $kapasitas_u          = mysqli_real_escape_string($db, $_POST['kapasitas']);
    $arus_u               = mysqli_real_escape_string($db, $_POST['arus']);
    $tegangan_u           = mysqli_real_escape_string($db, $_POST['tegangan']);
    $daya_aktif_reaktif_u = mysqli_real_escape_string($db, $_POST['daya_aktif_reaktif']);
    $longitude_u          = mysqli_real_escape_string($db, $_POST['longitude_input']);
    $latitude_u           = mysqli_real_escape_string($db, $_POST['latitude_input']);
    if ($_FILES['gambar']['name'] == "") {
        $dst_db = $gambar_ori;
    } else {
        $var1 = rand(1111, 9999);  // generate random number
        $var2 = rand(1111, 9999);  // generate random number

        $var3 = $var1 . $var2;  // Gabung var1 var3
        $var3 = md5($var3);   // convert $var3 jadi md5

        $fnm = $_FILES["gambar"]["name"];    // get image name
        $dst = "assets/img/foto/" . $var3 . $fnm;  // storing image path into the {all_images} folder with 32 characters hex number and file name
        $dst_db = "assets/img/foto/" . $var3 . $fnm; // storing image path into the database with 32 characters hex number and file name
        if ($gambar_ori != "assets/img/foto/default.jpg") {
            unlink($foto);
        }
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $dst);
    }
    $query = mysqli_query($db, "UPDATE informasi_pembangkit SET nama_pembangkit = '$nama_pembangkit_u',
                                                 longitude = '$longitude_u',
                                                 latitude = '$latitude_u',
                                                 perusahaan = '$nama_perusahaan_u',
                                                 kapasitas = '$kapasitas_u',
                                                 arus = '$arus_u',
                                                 tegangan = '$tegangan_u',
                                                 daya_aktif_reaktif = '$daya_aktif_reaktif_u',
                                                 gambar = '$dst_db' WHERE id_pembangkit = '$id'");

    // cek hasil query
    if ($query) {
        // jika berhasil tampilkan pesan berhasil insert data
        echo '<script type="text/javascript">';
        echo "Swal.fire({
            title: 'Berhasil di ubah!',
            text: 'Kembali Ke halaman dashboard!',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
            window.location = 'dashboard.php';
            }
          })";
        echo "</script>";
    } else {
        // jika gagal tampilkan pesan kesalahan
        echo '<script type="text/javascript">';
        echo "Swal.fire({
            title: 'Gagal di ubah!',
            text: 'Periksa Kembali data!',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          })";
        echo "</script>";
    }
}
?>