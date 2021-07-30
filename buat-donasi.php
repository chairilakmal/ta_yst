<?php

    session_start();
    include 'config/connection.php';


    if(!isset($_SESSION["username"])) {
        header('Location: login.php?status=restrictedaccess');
        exit;
    }

    include "config/connection.php";
    $id_program_donasi = $_GET["id"];

    $query      = mysqli_query($conn, "SELECT * FROM t_program_donasi WHERE id_program_donasi = $id_program_donasi");
    $result     = mysqli_fetch_array($query);

     if(isset($_POST["submit"])) {
        
        $id_program_donasi        = $_GET["id"];
        $status_donasi            = "Menunggu Verifikasi";
        $nama_program_donasi      = $_POST["tb_nama_program_donasi"]; 
        $tgl_donasi               = date ('Y-m-d', time());
        $nominal1                 = $_POST["nominal1"]; 
        $nominal2                 = $_POST["nominal2"]; 
        $totalSementara             = $nominal1 + $nominal2;

        $unik  = rand(1,999);
        $belum_dibayar =  $totalSementara + $unik;

        echo "
            <script type='text/javascript'>
                var totalBayar = '<?php echo $belum_dibayar; ?>';
            </script>
        ";

        $nama_donatur             = $_POST["tb_nama_donatur"]; 
        $id_user                  = $_SESSION['id_user'];
        

        // var_dump($id_user);die;
        
        $query = "INSERT INTO t_donasi
                    VALUES 
                  ('','$status_donasi','$nama_donatur','','$id_user','$id_program_donasi',' $nama_program_donasi  ','$tgl_donasi','$belum_dibayar ')  
                    ";
     
        mysqli_query($conn,$query);
        // var_dump($query);die;

        //cek keberhasilan
        if(mysqli_affected_rows($conn) > 0 ){
            echo "
            <script>
                alert('Donasi Berhasil Dibuat !');
                window.location = 'dashboard-user.php';
            </script>
            ";
        }else{
            echo "
                <script>
                    alert('Gagal membuat donasi');
                </script>
            ";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icon Title -->
    <link rel="icon" href="img/logo-only.svg">
    <title>YST - Buat Donasi</title>
    <!-- Font Awesome
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b41ecad032.js" crossorigin="anonymous"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard-yst.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@500&display=swap" rel="stylesheet"> 

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto user-wrapper"> 
                <img src="img/user-default.jpg" width="30px" height="30px" alt="">
                <li class="nav-item dropdown user-dropdown">  
                    <a class="nav-link dropdown-toggle pr-4" href="#" id="navbarDropdownMenuLink" 
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo("{$_SESSION['username']}");?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">      
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>                   
                </li>
            </ul>
        </nav>
        <!-- /.Navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-background elevation-4">
            <!-- Brand Logo -->

            <a href="dashboard-user.php" class="brand-link">
                <img src="img/logo-only.svg"  class="brand-image mt-1">
                <span class="brand-text font-weight-bold mt-2"><i>Dashboard User</i></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
           <!-- Sidebar Menu -->
                <nav class="mt-4">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item nav-item-sidebar menu-open">
                            <a href="dashboard-user.php" class="nav-link side-icon active ">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    Donasi Saya
                                </p>
                            </a>
                        </li>
                        <li class="nav-item nav-item-sidebar">
                            <a href="program-relawan-saya.php" class="nav-link side-icon">
                                <i class="nav-icon fas fa-user-clock"></i>
                                <p>
                                    Program Relawan
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <main>
            <div class="page-title-link ml-4 mb-4">     
                        <div class="page-title-link ml-4 mb-4">     
                            <div class="page-title-link ml-4 mb-4">     
                                <a href="dashboard-user.php">
                                    <i class="nav-icon fas fa-home mr-1"></i>Dashboard user</a> > 
                                <a href="dashboard-user.php">
                                    <i class="nav-icon fas fa-user-cog mr-1"></i>Donasi saya</a> >
                                <a href="pilih-donasi.php">
                                    <i class="nav-icon fas fa-hand-holding-heart mr-1"></i>Buat Donasi</a> >
                                <a href="#" onclick="javascript:window.history.back(-1);return false;">
                                    <i class="nav-icon fas fa-info-circle mr-1"></i>Detail Donasi</a>
                            </div>
                        </div>  
                </div>               
                <div class="form-profil halaman-view">
                    <div class="mt-2 regis-title"><h3>Buat Donasi</h3></div>    
                        <form action="" enctype="multipart/form-data" method="POST">
                            <div class="form-group label-txt">
                                <div class="form-group mt-4 mb-2">
                                    <label for="tb_nama_program_donasi" class="font-weight-bold" ><span class="label-form-span">Nama Program Donasi</span></label><br>
                                    <input type="text" id="tb_nama_program_donasi" name="tb_nama_program_donasi" class="form-control" value="<?php echo $result['nama_program_donasi']?>" readonly>
                                </div>
                                <div class="form-group mt-3 mb-5 ">
                                    <label for="nominal1" class="font-weight-bold" ><span class="label-form-span">Pilih Nominal Donasi</span></label><br>

                                    <div class="radio-wrapper mt-1">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="nominal1" class="buatNominalbtn" name="nominal1" value="10000" class="form-check-input" checked>
                                            <label class="form-check-label" for="nominal1">Rp. 10.000</label>
                                        </div>
                                    </div>
                                    <div class="radio-wrapper mt-1">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="nominal1" class="buatNominalbtn" name="nominal1" value="20000" class="form-check-input">
                                            <label class="form-check-label" for="nominal1"> Rp. 20.000</label>
                                        </div>
                                    </div>
                                    <div class="radio-wrapper mt-1">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="nominal1" class="buatNominalbtn" name="nominal1" value="50000" class="form-check-input">
                                            <label class="form-check-label" for="nominal1">Rp. 50.000</label>
                                        </div>
                                    </div>
                                    <div class="radio-wrapper mt-1">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="nominal1" class="buatNominalbtn" name="nominal1" value="100000" class="form-check-input">
                                            <label class="form-check-label" for="nominal1">Rp. 100.000</label>
                                        </div>
                                    </div>
                                     <div class="radio-wrapper mt-1">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="nominal1" class="buatNominalbtn" name="nominal1" value="0" class="form-check-input">
                                            <label class="form-check-label" for="nominal1">Buat Nominal Sendiri</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mt-5 mb-2" id="buatNominal">
                                    <label for="nominal2" class="font-weight-bold" ><span class="label-form-span">Buat Nominal Donasi</span></label><br>
                                    <input type="number" id="nominal2" name="nominal2" class="form-control" placeholder="Buat Nominal Donasi" value="0">
                                </div>
                                <div class="form-group mt-3 mb-2">
                                    <label for="nama_donatur" class="font-weight-bold" ><span class="label-form-span">Nama Donatur</span></label><br>
                                    <input type="text" id="tb_nama_donatur" name="tb_nama_donatur" class="form-control" placeholder="Nama Donatur">
                                </div>           
                            </div>



                            
                            <button type="submit" name="submit" value="Simpan" 
                            class="btn btn-lg btn-primary w-100 yst-login-btn border-0 mt-4 mb-4"> 
                                <span class="yst-login-btn-fs">Lanjut</span>
                            </button>
                        </form>
                    </div>  
        </main>
        </div>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
    <footer class="main-footer">
        <center><strong> &copy; YST 2021.</strong> Yayasan Sekar Telkom </center>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <script>
        $(document).ready(function(){
        $("#buatNominal").css("display","none"); //Menghilangkan form-input ketika pertama kali dijalankan
        $(".buatNominalbtn").click(function(){ //Memberikan even ketika class detail di klik (class detail ialah class radio button)
        if ($("input[name='nominal1']:checked").val() == 0 ) { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
        $("#buatNominal").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
        } else {
        $("#buatNominal").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
        }
        });
        });
    </script>
    <script type="text/javascript" src="js/buat-donasi.js"></script>


</body>

</html>