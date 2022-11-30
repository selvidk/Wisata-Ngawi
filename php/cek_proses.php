<?php 
//menyertakan file/kode pada database.php
include 'database.php';
$db = new database(); //membuat object dari class database

$proses = $_GET['proses'];

//memilah proses
if($proses == "cek_user"){
    //untuk cek apakah user terdaftar pada database
    $db->index_user($_POST['nomor_identitas']); //memanggil function terkait dari class database pada database.php
    header("location: ../pemesanan.php?pengguna=".$_POST['nomor_identitas']);
} elseif($proses == "create_user"){ 
    //untuk membuat user baru	
    $db->create_user($_POST['nama_lengkap'], $_POST['nomor_identitas'], $_POST['no_hp']);
} elseif($proses == "hitung"){
    //untuk menghitung total yang harus dibayarkan
    $db->create_tiket($_POST['pengguna'], $_POST['tempat_wisata'], $_POST['pengunjung_dewasa'], $_POST['pengunjung_anak'], $_POST['tgl_kunjungan']);
} elseif($proses == "pesan" || $proses == "batal"){ 	
    //untuk memperbarui status tiket
    $db->update_tiket($proses, $_GET['tiket']);
} elseif ($proses == "tiket_saya"){
    //untuk melihat data pribadi dan daftar pemesanan tiket
    $db->index_user($_POST['nomor_identitas']);
    $db->index_tiket_user($_POST['nomor_identitas']);
    header("location: ../tiket_saya.php?pengguna=".$_POST['nomor_identitas']);
} elseif ($proses == "update_user"){
    //untuk memperbarui data user
    $db->index_user($_POST['nomor_identitas']);
    $db->update_user($_POST['nama_lengkap'], $_POST['nomor_identitas'], $_POST['no_hp']);
    header("location: ../tiket_saya.php?pengguna=".$_POST['nomor_identitas']);
}
?>