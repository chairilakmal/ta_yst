<?php
include "config/connection.php";

$type = $_GET['type'];





if ($type == 'pdonasi'){
    //ambil id program di URL
    $id_program_donasi = $_GET["id_program_donasi"];

    mysqli_query($conn, "DELETE FROM t_program_donasi
                        WHERE  	id_program_donasi = $id_program_donasi");

    header('Location: dashboard-admin.php?status=deletesuccess');
    exit(); 
    }elseif ($type == 'prelawan'){
        //ambil id program di URL
        $id_program_relawan = $_GET["id_program_relawan"];

        mysqli_query($conn, "DELETE FROM t_program_relawan
                            WHERE  	id_program_relawan = $id_program_relawan");

        header('Location: kelola-p-relawan.php?status=deletesuccess');
        exit(); 
    }elseif ($type == 'donasi'){
        //ambil id program di URL
        $id_donasi = $_GET["id_donasi"];

        mysqli_query($conn, "DELETE FROM t_donasi
                            WHERE  	id_donasi = $id_donasi");

        header('Location: kelola-donasi.php?status=deletesuccess');
        exit(); 
    }


?>