<?php 
require 'function.php';

    $id = $_GET['id'];

    if(deleteData($id) > 0) {
        echo "<script> alert('Data berhasil dihapus'); document.location.href='viewData.php';</script>";
    } else {
        echo "<script> alert('Data gagal dihapus'); document.location.href='viewData.php';</script>";
    }
?>