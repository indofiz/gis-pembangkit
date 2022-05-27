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
        $tipe   = $data['tipe'];
        $isolated   = $data['isolated'];
        $bahan_bakar   = $data['bahan_bakar'];
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
                            <input type="text" value="<?= $nama_pembangkit; ?>" name="nama-pembangkit" class="form-control" id="nama-pembangkit" placeholder="Masukan Nama Pembangkit" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" value="<?= $perusahaan; ?>" name="nama-perusahaan" class="form-control" id="nama-perusahaan" placeholder="Masukan Nama Perusahaan" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Kapasitas <span class="text-danger">*</span></label>
                            <input type="number" value="<?= $kapasitas; ?>" name="kapasitas" class="form-control" id="kapasitas" placeholder="Masukan Besaran Kapasitas" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Bahan bakar <span class="text-danger">*</span></label>
                            <input type="text" name="bahan_bakar" class="form-control" id="bahan_bakar" placeholder="Masukan Bahan Bakar" value="<?=$bahan_bakar;?>" required="">
                        </div>

                        <div class="form-group">
                            <label for="nama-perusahaan">Tipe Pembangkit <span class="text-danger">*</span></label>
                            <select class="form-control" id="tipe_pembangkit" name="tipe">
                              <option value="1" <?=($tipe == 1) ? 'selected' : null?>>Pembelian IPP</option>
                              <option value="2" <?=($tipe == 2) ? 'selected' : null?>>Pembangkit Grid Sendiri</option>
                              <option value="3" <?=($tipe == 3) ? 'selected' : null?>>Pembangkit Sewa</option>
                            </select>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" name="isolated" type="checkbox" value="true" id="isIsolated" <?=($isolated == true) ? 'checked' : 'disabled'?>>
                            <label class="form-check-label" for="isIsolated">
                                Apakah Ini Pembangkit Isolated?
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Arus <span class="text-danger">*</span></label>
                            <input type="number" value="<?= $arus; ?>" name="arus" class="form-control" id="arus" placeholder="Masukan Besaran Arus" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama-perusahaan">Tegangan <span class="text-danger">*</span></label>
                            <input type="number" value="<?= $tegangan; ?>" name="tegangan" class="form-control" id="tegangan" placeholder="Masukan Besaran Tegangan" required="">
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="longitude_input">Longitude <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $longitude; ?>" class="form-control" id="longitude_input" placeholder="Longitude" value="<?= isset($_POST['longitude_input']) ? $_POST['longitude_input'] : ""; ?>" disabled>
                                    <input type="hidden" value="<?= $longitude; ?>" name="longitude_input" id="longitude_input_h" required="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="latitude_input">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $latitude; ?>" class="form-control" id="latitude_input" placeholder="Latitude" value="<?= isset($_POST['latitude_input']) ? $_POST['latitude_input'] : ""; ?>" disabled>
                                    <input type="hidden" value="<?= $latitude; ?>" name="latitude_input" id="latitude_input_h" required="">
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
    $bahan_bakar_u        = mysqli_real_escape_string($db, $_POST['bahan_bakar']);
    $tipe_u               = mysqli_real_escape_string($db, $_POST['tipe']);
    $isolated_u           = (isset($_POST['isolated']) == true) ? true : false;
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
                                                 bahan_bakar = '$bahan_bakar_u',
                                                 tipe = '$tipe_u',
                                                 isolated = '$isolated_u',
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


<script type="text/javascript">
    const tipe_pembangkit = document.getElementById('tipe_pembangkit');
    const isolated = document.getElementById('isIsolated');

    tipe_pembangkit.addEventListener('change', function(event) {
        event.preventDefault();
        let tipe = this.value;
        if (tipe == 2) {
            isolated.disabled = false;
        }else{
            isolated.disabled = true;
        }
    });


</script>