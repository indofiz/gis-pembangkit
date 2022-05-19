<?php
require_once "config/database.php";
include('session.php');

$result = mysqli_query($db, "select * from user where id='$session_id'") or die('Error In Session');
$row = mysqli_fetch_array($result);
if ($row['status'] == 'nonaktif') {
  header("location: index.php");
  exit();
}
if ($row['level'] == 'user') {
  $level = 'user';
} elseif ($row['level'] == 'admin') {
  $level = 'admin';
} else {
  header("location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Aplikasi Direktori Kampus</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link href="assets/css/fontawesome/css/all.min.css" rel="stylesheet" />
  <link href="assets/sweetalert/sweetalert2.min.css" rel="stylesheet" />
  <script src="assets/sweetalert/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>


  <!-- styles -->
  <!-- <link href="assets/css/style.css" rel="stylesheet"> -->

  <!-- Fungsi untuk membatasi karakter yang diinputkan -->
  <script language="javascript">
    function getkey(e) {
      if (window.event)
        return window.event.keyCode;
      else if (e)
        return e.which;
      else
        return null;
    }

    function goodchars(e, goods, field) {
      var key, keychar;
      key = getkey(e);
      if (key == null) return true;

      keychar = String.fromCharCode(key);
      keychar = keychar.toLowerCase();
      goods = goods.toLowerCase();

      // check goodkeys
      if (goods.indexOf(keychar) != -1)
        return true;
      // control keys
      if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
        return true;

      if (key == 13) {
        var i;
        for (i = 0; i < field.form.elements.length; i++)
          if (field == field.form.elements[i])
            break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
      };
      // else return false
      return false;
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-dark bg-primary">
    <div class="container">
      <span class="navbar-brand mb-0 h1">
        <a href="index.php" style="color: #fff;font-weight:600">
          GIS PEMBANGKIT
        </a>
      </span>
      <div class="row">
        <div class="col">
          <a href="dashboard.php?url=tampil" class="btn btn-warning">Dashboard</a>
          <a href="dashboard.php?url=tambah" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Pembangkit</a>
          <a href="logout.php" class="btn btn-danger"> <i class="fa fa-sign-out"></i> Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php
    if (isset($_GET['url'])) {
      $url = $_GET['url'];
      if ($url == 'tampil') {
        include "admin/tampil-list.php";
      } elseif ($url == 'detail') {
        include "admin/lihat-data-pembangkit.php";
      } elseif ($url == 'tambah') {
        include "admin/tambah-data.php";
      } elseif ($url == 'edit') {
        include "admin/edit-data.php";
      }
    } else {
      header('location: dashboard.php?url=tampil');
    }

    ?>
  </div> <!-- /.container-fluid -->

  <footer class="footer p-2 mt-5" style="border-top: 1px solid #ddd;">
    <div class="container">
      <p class="text-muted text-center">&copy; 2022 Taruna</p>
    </div>
  </footer>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>


  <!-- MAP -->
  <script>
    //INSERT DATA
    const longitude = document.getElementById('longitude_input');
    const longitude_h = document.getElementById('longitude_input_h');
    const latitude = document.getElementById('latitude_input');
    const latitude_h = document.getElementById('latitude_input_h');
    if (document.getElementById('map')) {
      var map = L.map('map').setView([-2.120096, 106.113553], 13);

      var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 20,
        attribution: 'GIS',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
      }).addTo(map);

      var marker = {};
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
  </script>
</body>

</html>