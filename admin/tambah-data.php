<div class="row">
     <div class="col-md-12">
         <div class="mb-3 mt-5">
             <h4 class="mb-4">Data Pembangkit</h4>
             <div class="row">
                 <div class="col-6">
                     <form method="POST" action="#">
                         <div class="form-group">
                            <label for="nama-pembangkit">Nama Pembangkit <span class="text-danger">*</span></label>
                            <input type="text" name="nama-pembangkit" class="form-control" id="nama-pembangkit" placeholder="Masukan Nama Pembangkit" value="<?= isset($_POST['nama-pembangkit']) ? $_POST['nama-pembangkit'] : "" ;?>" required="">
                         </div>
                         <div class="form-group">
                            <label for="nama-perusahaan">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="nama-perusahaan" class="form-control" id="nama-perusahaan" placeholder="Masukan Nama Perusahaan" value="<?= isset($_POST['nama-perusahaan']) ? $_POST['nama-perusahaan'] : "" ;?>" required="">
                         </div>
                         <div class="form-group">
                            <label for="nama-perusahaan">Kapasitas <span class="text-danger">*</span></label>
                            <input type="number" name="kapasitas" class="form-control" id="kapasitas" placeholder="Masukan Besaran Kapasitas" value="<?= isset($_POST['kapasitas']) ? $_POST['kapasitas'] : "" ;?>" required="">
                         </div>
                         <div class="form-group">
                            <label for="nama-perusahaan">Arus <span class="text-danger">*</span></label>
                            <input type="number" name="arus" class="form-control" id="arus" placeholder="Masukan Besaran Arus" value="<?= isset($_POST['arus']) ? $_POST['arus'] : "" ;?>" required="">
                         </div>
                         <div class="form-group">
                            <label for="nama-perusahaan">Tegangan <span class="text-danger">*</span></label>
                            <input type="number" name="tegangan" class="form-control" id="tegangan" placeholder="Masukan Besaran Tegangan" value="<?= isset($_POST['tegangan']) ? $_POST['tegangan'] : "" ;?>" required="">
                         </div>
                         <div class="form-group">
                            <label for="daya_aktif_reaktif">Daya Aktif Reaktif <span class="text-danger">*</span></label>
                            <input type="number" name="daya_aktif_reaktif" class="form-control" id="daya_aktif_reaktif" placeholder="Masukan Daya Aktif Reaktif" value="<?= isset($_POST['daya_aktif_reaktif']) ? $_POST['daya_aktif_reaktif'] : "" ;?>" required="">
                         </div>
                         <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                    <label for="longitude_input">Longitude <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="longitude_input" placeholder="Longitude" value="<?= isset($_POST['longitude_input']) ? $_POST['longitude_input'] : "" ;?>" disabled>
                                    <input type="hidden" name="longitude_input" id="longitude_input_h" value="<?= isset($_POST['longitude_input']) ? $_POST['longitude_input'] : "" ;?>" required="">
                                 </div>
                             </div>
                             <div class="col">
                                 <div class="form-group">
                                    <label for="latitude_input">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="latitude_input" placeholder="Latitude" value="<?= isset($_POST['latitude_input']) ? $_POST['latitude_input'] : "" ;?>" disabled>
                                    <input type="hidden" name="latitude_input" id="latitude_input_h" value="<?= isset($_POST['latitude_input']) ? $_POST['latitude_input'] : "" ;?>" required="">
                                 </div>
                             </div>
                         </div>
                         <div class="d-flex justify-content-end gap-3">
                             <button type="reset" class="btn btn-outline-secondary mr-3">Reset</button>
                             <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-save"></i>  Simpan</button>
                         </div>
                     </form>
                 </div>
                 <div class="col-6">
                     <div id="map" style="width: 100%; height: 550px;"></div>

                 </div>
             </div>
         </div>
     </div>
 </div>


<?php
    if (isset($_POST['submit'])) {
        $nama_pembangkit    = mysqli_real_escape_string($db, $_POST['nama-pembangkit']);
        $nama_perusahaan    = mysqli_real_escape_string($db, $_POST['nama-perusahaan']);
        $kapasitas          = mysqli_real_escape_string($db, $_POST['kapasitas']);
        $arus               = mysqli_real_escape_string($db, $_POST['arus']);
        $tegangan           = mysqli_real_escape_string($db, $_POST['tegangan']);
        $daya_aktif_reaktif = mysqli_real_escape_string($db, $_POST['daya_aktif_reaktif']);
        $longitude          = mysqli_real_escape_string($db, $_POST['longitude_input']);
        $latitude           = mysqli_real_escape_string($db, $_POST['latitude_input']);
        $query = mysqli_query($db, "INSERT INTO informasi_pembangkit(nama_pembangkit,
                                                 longitude,
                                                 latitude,
                                                 perusahaan,
                                                 kapasitas,
                                                 arus,
                                                 tegangan,
                                                 daya_aktif_reaktif) 
                                          VALUES('$nama_pembangkit',
                                                 '$longitude',
                                                 '$latitude',
                                                 '$nama_perusahaan',
                                                 '$kapasitas',
                                                 '$arus',
                                                 '$tegangan',
                                                 '$daya_aktif_reaktif')");

        // cek hasil query
        if ($query) {
            // jika berhasil tampilkan pesan berhasil insert data
            echo '<script type="text/javascript">';
            echo "Swal.fire(
              'Sukses!',
              'Data berhasil ditambah!',
              'success'
            )";
            echo "</script>";
        } else {
            // jika gagal tampilkan pesan kesalahan
            echo '<script type="text/javascript">';
            echo "Swal.fire(
              'Gagal!',
              'Data gagal ditambah!',
              'error'
            )";
            echo "</script>";
        }
    }
?>