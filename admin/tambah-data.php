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
                         <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                    <label for="longitude-input">Longitude <span class="text-danger">*</span></label>
                                    <input type="text" name="longitude-input" class="form-control" id="longitude-input" placeholder="Longitude" value="<?= isset($_POST['longitude-input']) ? $_POST['longitude-input'] : "" ;?>" disabled="" required>
                                 </div>
                             </div>
                             <div class="col">
                                 <div class="form-group">
                                    <label for="latitude-input">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" name="latitude-input" class="form-control" id="latitude-input" placeholder="Latitude" value="<?= isset($_POST['latitude-input']) ? $_POST['latitude-input'] : "" ;?>" disabled="" required>
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
                     <div id="map" style="width: 600px; height: 400px;"></div>

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
        $longitude          = mysqli_real_escape_string($db, $_POST['longitude-input']);
        $latitude           = mysqli_real_escape_string($db, $_POST['latitude-input']);
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