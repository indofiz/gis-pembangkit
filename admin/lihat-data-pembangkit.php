<?php
$id = $_GET['id'];
if ($id) {
    $query = mysqli_query($db, "SELECT * FROM informasi_pembangkit WHERE id_pembangkit ='$id'")
        or die('Ada kesalahan pada query informasi_pembangkit: ' . mysqli_error($db));
    if(mysqli_num_rows($query) < 1){
        echo '<h3 class="text-center">Belum Ada Data</h3>';
    }else{
        $data  = mysqli_fetch_assoc($query);
        $nama_pembangkit    = $data['nama_pembangkit'];
        $longitude          = $data['longitude'];
        $latitude           = $data['latitude'];
        $perusahaan         = $data['perusahaan'];
        $kapasitas          = $data['kapasitas'];
        $arus               = $data['arus'];
        $tegangan           = $data['tegangan'];
        $gambar             = $data['gambar'];
        $daya_aktif_reaktif = $data['daya_aktif_reaktif'];
    ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="font-weight-bold mt-4 mb-2">Nama Pembangkit:</div>
            <?=$nama_pembangkit;?>
            <div class="font-weight-bold mt-4 mb-2">Nama Perusahaan:</div>
            <?=$perusahaan;?>
            <div class="font-weight-bold mt-4 mb-2">Kapasitas:</div>
            <?=$kapasitas;?>
            <div class="font-weight-bold mt-4 mb-2">Arus:</div>
            <?=$arus;?>
            <div class="font-weight-bold mt-4 mb-2">Tegangan:</div>
            <?=$tegangan;?>
            <div class="font-weight-bold mt-4 mb-2">Daya Aktif Reaktif:</div>
            <?=$daya_aktif_reaktif;?>
            <div class="font-weight-bold mt-4 mb-2">Lokasi:</div>
            <div id="map_detail" style="width: 100%; height: 450px;"></div>
            <script>
                var map = L.map('map_detail').setView([<?=$latitude;?>, <?=$longitude;?>], 13);

                var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                  maxZoom: 20,
                  attribution: 'GIS',
                  id: 'mapbox/streets-v11',
                  tileSize: 512,
                  zoomOffset: -1
                }).addTo(map);
                marker = L.marker([<?=$latitude;?>, <?=$longitude;?>]).addTo(map)
                      .bindPopup(`Latitude: ${<?=$latitude;?>} <br /> Longitude: ${<?=$longitude;?>}`).openPopup();
            </script>
        </div>
    </div>
        
    <?php }
}
?>

