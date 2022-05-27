<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIS Pembangkit | Taruna</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="assets/css/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/adminlte/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

    <script nonce="85602695-ec9e-49c7-9350-3b138abd3660">
        (function(w, d) {
            ! function(a, e, t, r) {
                a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zaraz = {
                    deferred: []
                }, a.zaraz.q = [], a.zaraz._f = function(e) {
                    return function() {
                        var t = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e,
                            a: t
                        })
                    }
                };
                for (const e of ["track", "set", "ecommerce", "debug"]) a.zaraz[e] = a.zaraz._f(e);
                a.addEventListener("DOMContentLoaded", (() => {
                    var t = e.getElementsByTagName(r)[0],
                        z = e.createElement(r),
                        n = e.getElementsByTagName("title")[0];
                    for (n && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.x = Math.random(), a.zarazData.w = a.screen.width, a.zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a.zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a.zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.zarazData.q = []; a.zaraz.q.length;) {
                        const e = a.zaraz.q.shift();
                        a.zarazData.q.push(e)
                    }
                    z.defer = !0;
                    for (const e of [localStorage, sessionStorage]) Object.keys(e).filter((a => a.startsWith("_zaraz_"))).forEach((t => a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))));
                    z.referrerPolicy = "origin", z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData))), t.parentNode.insertBefore(z, t)
                }))
            }(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <span class="brand-text font-weight-bold">Gis Pembangkit</span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Halaman 2</a>
                        </li>
                    </ul>
                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="login.php">
                            <i class="fas fa-sign-in"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="content-wrapper pb-5">

            <div class="content-header">

            </div>


            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4" id="side_info" style="transition: display ease-in-out 0.3s">
                            <div class="card card-primary card-outline">
                                <div class="card-body" id="card_pembangkit">
                                    <div class="row">
                                        <h5 class="card-title d-block col-12 mb-4 font-weight-bold text-center" id="card_nama_pembangkit"></h5>
                                        <img src="" class="img-fluid col-12 mb-3" id="card_gambar" alt="Pembangkit" style="display: none;">
                                        <div class="col-6 px-1">
                                            <div class="bg-light px-3 py-2 border border-primary rounded">
                                                <h6 class="font-weight-bold">Tegangan</h6>
                                                <h4><span id="tegangan"></span> V</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 px-1">
                                            <div class="bg-light px-3 py-2 border border-success rounded">
                                                <h6 class="font-weight-bold">Arus</h6>
                                                <h4><span id="arus"></span> I</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 px-1">
                                            <div class="bg-light mt-2 px-3 py-2 border border-success rounded">
                                                <h6 class="font-weight-bold">Kapasitas</h6>
                                                <h4><span id="kapasitas"></span> MW</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 px-1">
                                            <div class="bg-light mt-2 px-3 py-2 border border-primary rounded">
                                                <h6 class="font-weight-bold">Bahan Bakar</h6>
                                                <h4><span id="bahan_bakar"></span></h4>
                                            </div>
                                        </div>
                                        <div class="col-6 px-1">
                                            <div class="bg-light mt-2 px-3 py-2 border border-primary rounded">
                                                <h6 class="font-weight-bold">Tipe</h6>
                                                <h4><span id="tipe"></span></h4>
                                            </div>
                                        </div>
                                        <div class="col-6 px-1">
                                            <div class="bg-light mt-2 px-3 py-2 border border-success rounded">
                                                <h6 class="font-weight-bold">Isolated</h6>
                                                <h4><span id="isolated"></span></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-8" id="map_container" style="transition: all ease-in-out 0.1s">
                            <div id="map_info" style="width: 100%; height: 550px;"></div>
                        </div>

                    </div>

                </div>
            </div>

        </div>


        <aside class="control-sidebar control-sidebar-dark">

        </aside>


        <footer class="main-footer">
            <strong>Copyright &copy; 2022 Taruna.</strong> All rights reserved.
        </footer>
    </div>



    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/adminlte/js/adminlte.min.js?v=3.2.0"></script>
    <script>
        const side_info = document.getElementById('side_info');
        const kapasitas_i = document.getElementById('kapasitas');
        const tegangan_i = document.getElementById('tegangan');
        const arus_i = document.getElementById('arus');
        const bahan_bakar_i = document.getElementById('bahan_bakar');
        const tipe_i = document.getElementById('tipe');
        const isolated_i = document.getElementById('isolated');
        side_info.style.display = 'none'
        const map_container = document.getElementById('map_container');
        map_container.classList.replace('col-lg-8','col-lg-12');
        //Nampilin Peta
        var map = L.map('map_info').setView([-2.120096, 106.113553], 9);

        var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'GIS',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);

        //Ambil Data Pembangkit
        async function getPembangkit() {
            let url = 'data/list_pembangkit.php';
            try {
                let res = await fetch(url);
                return await res.json();
            } catch (error) {
                console.log(error);
            }
        }
        async function renderPembangkit() {
            let pembangkit = await getPembangkit();
            let html = '';
            let marker;
            if (pembangkit.status == 200) {
                pembangkit.data.forEach(pem => {
                    const id_pembangkit = pem.id_pembangkit;
                    const nama_pembangkit = pem.nama_pembangkit;
                    const gambar = pem.gambar;
                    const perusahaan = pem.perusahaan;
                    const tegangan = pem.tegangan;
                    const arus = pem.arus;
                    const bahan_bakar = pem.bahan_bakar;
                    const tipe = (pem.tipe == 1) ? 'Pembelian IPP' : (pem.tipe == 2) ? 'Pembangkit Sendiri Grid' : 'Pembangkit Sewa';
                    const isolated = (pem.isolated == true) ? 'Sistem Bangka Isolated' : '-';
                    const kapasitas = pem.kapasitas;
                    // DOCUMENT
                    const card_nama_pembangkit = document.getElementById('card_nama_pembangkit');
                    const card_gambar = document.getElementById('card_gambar');
                    marker = new L.marker([pem.latitude, pem.longitude])
                    .bindPopup(pem.nama_pembangkit)
                    .addTo(map).on('click', function(e) {
                        map_container.classList.replace('col-lg-12','col-lg-8');
                        side_info.style.display = 'block';
                        card_nama_pembangkit.innerHTML = nama_pembangkit;
                        kapasitas_i.innerHTML = kapasitas;
                        arus_i.innerHTML = arus;
                        tegangan_i.innerHTML = tegangan;
                        bahan_bakar_i.innerHTML = bahan_bakar;
                        tipe_i.innerHTML = tipe;
                        isolated_i.innerHTML = isolated;
                        card_gambar.style.display = 'block';
                        card_gambar.src = gambar;
                    });
                });
            }
            
        }
        renderPembangkit();
    </script>

</body>

</html>