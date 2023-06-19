<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="{{ url('/admin') }}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class=""></i>Admin</h3>
                </a>
                {{-- <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Udin</h6>
                        <span>Admin</span>
                    </div>
                </div> --}}
                <div class="navbar-nav w-100">
                    <a href="{{ url('/admin') }}" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{ url('/admin/validasi') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Validasi</a>
                    <a href="{{ url('/admin/setupadmin') }}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Setup</a>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <a class="btn-danger rounded" href="{{ route('logout') }}">Logout</a>



                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->

            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->

            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
         <!-- Recent Sales Start -->
            <div class="container-fluid pt-3 px-3">
                <div class="bg-light text-center rounded p-3">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Permintaan Peminjaman</h6>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Peminjam</th>
                                    <th scope="col">ID Ruang</th>
                                    <th scope="col">Tanggal Meminjam</th>
                                    <th scope="col">Tanggal Akhir Meminjam</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">Keperluan</th>
                                    <th scope="col">Tujuan Peminjaman</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Kontak Peminjam</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Menggantikan koneksi dan query database dengan yang sesuai
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "test";

                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT * FROM pinjamruang";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $count = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row["id"];
                                        $nama = $row["nama"];
                                        $tanggalmulai = $row["tanggalmulai"];
                                        $tanggalselesai = $row["tanggalselesai"];
                                        $waktumulai = $row["waktumulai"];
                                        $waktuselesai = $row["waktuselesai"];
                                        $keperluan = $row["keperluan"];
                                        $tujuan = $row["tujuan"];
                                        $email = $row["email"];                                    
                                        $nohp= $row["nohp"];
                                        $status= $row["status"];

                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $nama; ?></td>
                                            <td><?php echo $tanggalmulai; ?></td>
                                            <td><?php echo $tanggalselesai; ?></td>
                                            <td><?php echo $waktumulai; ?></td>
                                            <td><?php echo $waktuselesai; ?></td>
                                            <td><?php echo $keperluan; ?></td>
                                            <td><?php echo $tujuan; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $nohp; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td>
                                                <form action="{{ route('validasiPeminjaman', $id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success text-white">Validasi</button>
                                                </form>
                                                <br>
                                                <form action="{{ route('tolakPeminjaman', $id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning text-white">Tolak</button>
                                                </form>
                                                <br>
                                                <form action="{{ route('hapusPeminjaman', $id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger text-white">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <?php
                                        $count++;
                                    }

                                } else {
                                    echo "<tr><td colspan='13'>Belum ada permintaan peminjaman ruangan</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Recent Sales End -->


            <!-- Widgets Start -->

            <!-- Widgets End -->


            <!-- Footer Start -->

            <!-- Footer End -->

            <!-- Content End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                    class="bi bi-arrow-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('js/admin/landing.js') }}"></script>
        <script>
            function validasiPeminjaman(id) {
                // Lakukan validasi peminjaman dengan ID tertentu di sini
                console.log("Validasi peminjaman dengan ID:", id);
            }
        </script>
</body>

</html>
