 <!-- Aplikasi DIREKTORI
 ************************************************
 * Developer    : Juliansyah
 * Release Date : September 2021
 * E-mail       : juliansyah.ekt17@gmail.com
 * Phone        : +62-8317-5087-363
 * IG           : @julian.ui
 -->

 <?php
    //   $pages = $_GET['page'];
    //   $menu = $_GET['menu'];
    if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
    } else {
        $cari = "";
    }
    ?>

 <div class="row">
     <div class="col-md-12">
         <div class="mb-3 mt-5">
             <h4>Data Pembangkit</h4>
             <div class="row">
                 <div class="col">
                     <form class="form-inline" method="POST" action="dashboard.php?page=user&menu=tampil">
                         <div class="form-group">

                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon1">
                                         <i class="fa fa-search"></i>
                                     </span>
                                 </div>
                                 <input type="text" class="form-control" name="cari" placeholder="Cari ..." autocomplete="off" value="<?php echo $cari; ?>">
                             </div>
                         </div>
                     </form>
                 </div>
                 <!-- <div class="col text-right">
                   <a class="btn btn-primary" href="?page=user&menu=tambah">
                     + Tambah User
                   </a>
                 </div> -->
             </div>
         </div>

         <?php
            if (empty($_GET['alert'])) {
                echo "";
            } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-danger alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='fa fa-alert'></i> Gagal!</strong> Terjadi kesalahan.
              </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='fa fa-check-circle'></i> Sukses!</strong> Data user berhasil dihapus.
          </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='fa fa-check-circle'></i> Sukses!</strong> Data password berhasil direset.
          </div>";
            }
            ?>
         <div class="panel panel-default">
             <div class="panel-body">
                 <div class="table-responsive">
                     <table class="table table-striped table-hover mb-3">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Nama Pembangkit</th>
                                 <th>Kapasitas</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>

                         <tbody>
                             <?php
                                /* Pagination */
                                $batas = 5;

                                if (isset($cari)) {
                                    $jumlah_record = mysqli_query($db, "SELECT * FROM informasi_pembangkit WHERE nama_pembangkit LIKE '%$cari%'")
                                        or die('Ada kesalahan pada query jumlah_record: ' . mysqli_error($db));
                                } else {
                                    $jumlah_record = mysqli_query($db, "SELECT * FROM informasi_pembangkit ORDER BY id_pembangkit DESC")
                                        or die('Ada kesalahan pada query jumlah_record: ' . mysqli_error($db));
                                }

                                $jumlah  = mysqli_num_rows($jumlah_record);
                                $halaman = ceil($jumlah / $batas);
                                $page    = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
                                $mulai   = ($page - 1) * $batas;
                                /*-------------------------------------------------------------------*/
                                $no = 1;
                                if (isset($cari)) {
                                    $query = mysqli_query($db, "SELECT * FROM informasi_pembangkit
                                            WHERE nama_pembangkit LIKE '%$cari%' 
                                            ORDER BY id_pembangkit DESC LIMIT $mulai, $batas")
                                        or die('Ada kesalahan pada query pembangkit: ' . mysqli_error($db));
                                } else {
                                    $query = mysqli_query($db, "SELECT * FROM informasi_pembangkit
                                            ORDER BY id_pembangkit DESC LIMIT $mulai, $batas")
                                        or die('Ada kesalahan pada query pembangkit: ' . mysqli_error($db));
                                }

                                while ($data = mysqli_fetch_assoc($query)) {
                                    if ($data['status'] == 'aktif') {
                                        $checked = ' checked';
                                    } else {
                                        $checked = '';
                                    }

                                    echo "  <tr>
                      <td width='50' class='center'>$no</td>
                      <td width='60'>$data[username]</td>
                      <td width='150'><div class='custom-control custom-switch'>
                      <input type='checkbox' class='custom-control-input btn-status' id='$data[id]' $checked>
                      <label class='custom-control-label' id='label$data[id]' for='$data[id]'>$data[status]</label>
                    </div></td>

                      <td width='120'>
                        <div class=''>";
                                ?>
                                 <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="admin/proses-hapus-user.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus user <?php echo $data['username']; ?>?');">
                                     <i class="fa fa-trash"></i>
                                 </a>

                                 <button type="button" class="btn btn-primary btn-sm resetPassword" data-id="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#ubahPassword">
                                     <i class="fa fa-key"></i>
                                 </button>
                                 <button type="button" class="btn btn-success btn-sm dataUser" data-id="<?php echo $data['id']; ?>" id="lihat<?php echo $data['id']; ?>" data-toggle="modal" data-target="#lihatData" <?php echo ($data['status'] == 'nonaktif' ? " disabled" : ""); ?>>
                                     <i class="fa fa-eye"></i>
                                 </button>
                             <?php
                                    echo "
                        </div>
                      </td>
                    </tr>";
                                    $no++;
                                }
                                ?>
                         </tbody>
                     </table>
                     <?php
                        if (empty($_GET['hal'])) {
                            $halaman_aktif = '1';
                        } else {
                            $halaman_aktif = $_GET['hal'];
                        }
                        ?>

                     <a>
                         Halaman <?php echo $halaman_aktif; ?> dari <?php echo $halaman; ?> |
                         Total <?php echo $jumlah; ?> data
                     </a>

                     <nav>
                         <ul class="pagination mt-2">
                             <!-- Button untuk halaman sebelumnya -->
                             <?php
                                if ($halaman_aktif <= '1') { ?>
                                 <li class="page-item disabled">
                                     <a href="" aria-label="Previous" class="page-link">
                                         <span aria-hidden="true">&laquo;</span>
                                     </a>
                                 </li>
                             <?php
                                } else { ?>
                                 <li class="page-item">
                                     <a class="page-link" href="?hal=<?php echo $page - 1 ?>" aria-label="Previous">
                                         <span aria-hidden="true">&laquo;</span>
                                     </a>
                                 </li>
                             <?php
                                }
                                ?>

                             <!-- Link halaman 1 2 3 ... -->
                             <?php
                                for ($x = 1; $x <= $halaman; $x++) { ?>
                                 <li class="page-item <?php echo $x == $halaman_aktif ? 'active' : ''; ?>">
                                     <a class="page-link" href="?hal=<?php echo $x ?>"><?php echo $x ?></a>
                                 </li>
                             <?php
                                }
                                ?>

                             <!-- Button untuk halaman selanjutnya -->
                             <?php
                                if ($halaman_aktif >= $halaman) { ?>
                                 <li class="page-item disabled">
                                     <a class="page-link" href="" aria-label="Next">
                                         <span aria-hidden="true">&raquo;</span>
                                     </a>
                                 </li>
                             <?php
                                } else { ?>
                                 <li class="page-item">
                                     <a class="page-link" href="?hal=<?php echo $page + 1 ?>" aria-label="Next">
                                         <span aria-hidden="true">&raquo;</span>
                                     </a>
                                 </li>
                             <?php
                                }
                                ?>
                         </ul>
                     </nav>
                 </div>
             </div>
         </div> <!-- /.panel -->
     </div> <!-- /.col -->
 </div> <!-- /.row -->

 <div class="modal fade" id="lihatData" tabindex="-1" role="dialog" aria-labelledby="lihatData" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Data User</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="lihatDataUser">

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="ubahPassword" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form action="admin/reset-password.php" method="POST">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="password">Password Baru</label>
                         <input type="password" class="form-control" id="passwordReset" placeholder="Password" name="password" required>
                         <input type="hidden" class="form-control" id="idForReset" name="id">
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
             </div>
         </form>
     </div>
 </div>

 <script type="text/javascript">
     let btnstatus = document.querySelectorAll('.btn-status');
     let resetPassword = document.querySelectorAll('.resetPassword');
     let dataUser = document.querySelectorAll('.dataUser');
     let passwordReset = document.getElementById('idForReset');
     let lihatDataUser = document.getElementById('lihatDataUser');
     btnstatus.forEach(function(element) {
         element.addEventListener(`click`, function() {

             let data = {
                 'id': +element.id,
             };

             fetch('admin/ubah-status.php', {
                     method: 'POST',
                     headers: {
                         'Content-type': 'application/json'
                     },
                     body: JSON.stringify(data)
                 })
                 .then(res => res.text())
                 .then(teks => {
                     document.getElementById(`label${+element.id}`).innerHTML = teks;
                     const lihatBtn = document.getElementById(`lihat${+element.id}`);
                     (teks == 'aktif') ? lihatBtn.disabled = false: lihatBtn.disabled = true;
                 })
                 .catch(err => console.log(err));
         });
     });

     resetPassword.forEach(function(element) {
         element.addEventListener(`click`, function() {

             //  console.log(+this.dataset.id);
             passwordReset.value = +this.dataset.id;

         });
     });
     dataUser.forEach(function(element) {
         element.addEventListener(`click`, function() {
             //  console.log(+this.dataset.id);

             let data = {
                 'id': +this.dataset.id,
             };

             fetch('admin/lihat-data-user.php', {
                     method: 'POST',
                     headers: {
                         'Content-type': 'application/json'
                     },
                     body: JSON.stringify(data)
                 })
                 .then(res => res.text())
                 .then(teks => lihatDataUser.innerHTML = teks)
                 .catch(err => console.log(err));

         });
     });
 </script>