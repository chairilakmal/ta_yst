<?php

    session_start();
    include 'config/connection.php';


    if(!isset($_SESSION["username"])) {
        header('Location: login.php?status=restrictedaccess');
        exit;
    }

     
    $id_user           = $_SESSION['id_user'];

    $queryUser      = mysqli_query($conn, "SELECT * FROM t_user WHERE id_user=$id_user");
    $data_user      = mysqli_fetch_array($queryUser);

     //User
    // function queryUser($query){
    //     global $conn;
    //     $result = mysqli_query($conn,$query); 
    //     $rows = [];
    //     while($row = mysqli_fetch_assoc($result)){
    //         $rows[] = $row;
    //     }
    //     return $rows;
    // }

    // $data_user = queryUser("SELECT * FROM t_user WHERE id_user=$id_user");
    

    $id_program_relawan = $_GET["id"];

    $id_user           = $_SESSION['id_user'];

    $queryProgram      = mysqli_query($conn, "SELECT * FROM t_program_relawan  WHERE id_program_relawan=$id_program_relawan");
    $data_program     = mysqli_fetch_array($queryProgram);
    //Program Relawan
    // function queryRelawan($query){
    //     global $conn;
    //     $result = mysqli_query($conn,$query); 
    //     $rows = [];
    //     while($row = mysqli_fetch_assoc($result)){
    //         $rows[] = $row;
    //     }
    //     return $rows;
    // }

    // $programRelawan = queryRelawan("SELECT * FROM t_program_relawan  WHERE id_program_relawan=$id_program_relawan");
    // $query      = mysqli_query($conn, "SELECT * FROM  t_program_relawan 
    //                            INNER JOIN t_user
    //                            WHERE id_program_relawan=$id_program_relawan");
    // $result     = mysqli_fetch_array($query);

    // var_dump($result);die;

     if(isset($_POST["submit"])) {
        
        $status_relawan           = "Menunggu Seleksi";
        $id_user                  = $_SESSION['id_user'];
        $id_program_relawan       = $_GET["id"];
        $nama_program_relawan     = $_POST["tb_nama_program_relawan"]; 
        $tgl_pelaksanaan          = $_POST["tb_tgl_pelaksanaan"];
        $domisili                 = $_POST["tb_domisili"];
        $nama_lengkap              = $_POST["tb_nama_lengkap"];
        $no_hp                    = $_POST["tb_no_hp"];
        $tgl_daftar               = date ('Y-m-d', time());
        
        
        

        // var_dump($id_user);die;
        
        $query = "INSERT INTO t_relawan
                    VALUES 
                  ('','$status_relawan','$id_user','$id_program_relawan ','$nama_program_relawan','$tgl_pelaksanaan','$domisili','$nama_lengkap','$no_hp ','$tgl_daftar ')  
                    ";
     
        mysqli_query($conn,$query);
        // var_dump($query);die;

        //cek keberhasilan
        if(mysqli_affected_rows($conn) > 0 ){
            echo "
            <script>
                alert('Pendaftaran sukses !');
                window.location = 'program-relawan-saya.php';
            </script>
            ";
        }else{
            echo "
                <script>
                    alert('Pendaftaran gagal !');
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
    <title>YST - Daftar Relawan</title>
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
                        <li class="nav-item nav-item-sidebar ">
                            <a href="dashboard-user.php" class="nav-link side-icon  ">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    Donasi Saya
                                </p>
                            </a>
                        </li>
                        <li class="nav-item nav-item-sidebar menu-open">
                            <a href="program-relawan-saya.php" class="nav-link side-icon active">
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
                                <a href="program-relawan-saya.php">
                                <i class="nav-icon fas fa-user-cog mr-1"></i>Program relawan Saya</a> >
                            <a href="pilih-relawan.php">
                                <i class="nav-icon fas fa-user-cog mr-1"></i>Pilih Program relawan</a>
                                <a href="#" onclick="javascript:window.history.back(-1);return false;">
                                    <i class="nav-icon fas fa-hand-holding-heart mr-1"></i>Daftar Relawan</a>
                            </div>
                        </div>  
                </div>               
                <div class="form-profil halaman-view">
                    <div class="mt-2 regis-title"><h3>Daftar Relawan</h3></div>    
                        <form action="" enctype="multipart/form-data" method="POST">
                            <div class="form-group label-txt">
                                <div class="form-group mt-4 mb-2">
                                    <label for="tb_nama_program_relawan" class="font-weight-bold" ><span class="label-form-span">Program Pilihan</span></label><br>
                                    <input type="text" id="tb_nama_program_relawan" name="tb_nama_program_relawan" class="form-control" value="<?php echo $data_program['nama_program_relawan']?>" readonly>
                                </div>
                                <div class="form-group mt-4 mb-3">
                                <label for="tb_tgl_pelaksanaan" class="font-weight-bold" ><span class="label-form-span">Tanggal Pelaksanaan</span></label><br>
                                    <input type="date" id="tb_tgl_pelaksanaan" name="tb_tgl_pelaksanaan" class="form-control" value="<?= $data_program["tgl_pelaksanaan"]; ?>" readonly>
                                </div>
                                 <div class="form-group mt-4 mb-2">
                                    <label for="tb_lokasi_program" class="font-weight-bold" ><span class="label-form-span">Lokasi Pelaksanaan</span></label><br>
                                    <input type="text" id="tb_lokasi_program" name="tb_lokasi_program" class="form-control" value="<?php echo $data_program['lokasi_program']?>" readonly>
                                </div>
                                 <div class="form-group mt-4 mb-2">
                                    <label for="tb_lokasi_awal" class="font-weight-bold" ><span class="label-form-span">Titik Kumpul</span></label><br>
                                    <input type="text" id="tb_lokasi_awal" name="tb_lokasi_awal" class="form-control" value="<?php echo $data_program['lokasi_awal']?>" readonly>
                                </div>
                                <div class="form-group mt-4 mb-2">
                                    <label for="tb_nama_lengkap" class="font-weight-bold" ><span class="label-form-span">Nama Relawan</span></label><br>
                                    <input type="text" id="tb_nama_lengkap" name="tb_nama_lengkap" class="form-control" value="<?php echo $data_user['nama_lengkap']?>" readonly>
                                </div>
                                <div class="form-group mt-4 mb-2">
                                    <label for="tb_no_hp" class="font-weight-bold" ><span class="label-form-span">Nomor Telepon</span></label><br>
                                    <input type="number" id="tb_no_hp" name="tb_no_hp" class="form-control" value="<?php echo $data_user['no_hp']?>" readonly>
                                </div>      
                                <div class="form-group mt-3 mb-2">
                                    <label for="tb_domisili" class="font-weight-bold" ><span class="label-form-span">Kota Domisili</span></label><br>
                                    <input type="text" id="tb_domisili" name="tb_domisili" class="form-control" placeholder="Kota domisili saat ini, contoh : Kota Bandung">
                                </div>           
                            </div>
                            
                            <button type="submit" name="submit" value="Simpan" 
                            class="btn btn-lg btn-primary w-100 yst-login-btn border-0 mt-4 mb-4" onclick="handleSubmit()"> 
                                <span class="yst-login-btn-fs">Daftar</span>
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