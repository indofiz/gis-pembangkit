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
                     <form class="form-inline" method="post" action="dashboard.php?url=tampil">
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
             </div>
         </div>
         <div class="panel panel-default">
             <div class="panel-body">
                 <div class="table-responsive">
                     <table class="table table-striped table-hover mb-3">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Nama Pembangkit</th>
                                 <th>Kapasitas</th>
                                 <th>Arus</th>
                                 <th>Tegangan</th>
                                 <th>Daya Aktif Reaktif</th>
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

                                    echo "  <tr>
                      <td width='50' class='center'>$no</td>
                      <td width='60'>$data[nama_pembangkit]</td>
                      <td width='150'>$data[kapasitas]</td>
                      <td width='150'>$data[arus]</td>
                      <td width='150'>$data[tegangan]</td>
                      <td width='150'>$data[daya_aktif_reaktif]</td>

                      <td width='120'>
                        <div class=''>";
                                ?>
                                 <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="admin/proses-hapus.php?id=<?php echo $data['id_pembangkit']; ?>" onclick="return confirm('Anda yakin ingin menghapus user <?php echo $data['nama_pembangkit']; ?>?');">
                                     <i class="fa fa-trash"></i>
                                 </a>
                                 <a class="btn btn-success btn-sm" href="dashboard.php?url=detail&id=<?php echo $data['id_pembangkit']; ?>"><i class="fa fa-eye"></i></a>
                                 <a class="btn btn-info btn-sm" href="dashboard.php?url=edit&id=<?php echo $data['id_pembangkit']; ?>"><i class="fa fa-pencil"></i></a>
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


 <script type="text/javascript">
     const getUrl = window.location.search;
     const urlParams = new URLSearchParams(getUrl);
     const alert = urlParams.get('alert')
     let btnstatus = document.querySelectorAll('.btn-status');
     let resetPassword = document.querySelectorAll('.resetPassword');
     let dataUser = document.querySelectorAll('.dataUser');
     let passwordReset = document.getElementById('idForReset');
     let lihatDataUser = document.getElementById('lihatDataUser');

     if (alert) {
         if (alert == 4) {
             Swal.fire(
                 'Sukses!',
                 'Data berhasil dihapus!',
                 'success'
             )
         } else if (alert == 3) {
             Swal.fire(
                 'Sukses!',
                 'Data berhasil diubah!',
                 'success'
             )
         }
     }
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