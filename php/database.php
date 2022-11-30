<?php
class database{
  //Variable koneksi dengan database mysql
  var $host   = "localhost";
  var $user   = "root";
  var $pass   = "";
  var $db     = "wisata_ngawi";

  
  //function __construct() untuk kode yang dieksekusi pertama dan selalu dieksekusi dalam file database.php
  function __construct(){
    //periksa koneksi, jika gagal akan menampilkan pesan error
    $this->koneksi = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
    if(!$this->koneksi){
      echo "Koneksi database mysql dan php gagal.";
    }
  }

  //function yang menampung kode program untuk mendapatkan data dari tabel tempat_wisata
  public function index_wisata(){
    $data = mysqli_query($this->koneksi, "select * from tempat_wisata");
    while($d = mysqli_fetch_array($data)){
			$hasil[] = $d;
		}
		return $hasil;
  }

  //function yang menampung kode program untuk membuat user baru
  public function create_user($nama_lengkap, $nomor_identitas, $no_hp){
    // cek data user pada database
    $cek_user   = "SELECT * FROM user WHERE nomor_identitas=".$nomor_identitas;
    $hasil      = mysqli_query($this->koneksi, $cek_user);

    if ($hasil->num_rows == 0) {
      mysqli_query($this->koneksi, "insert into user values('','$nama_lengkap','$nomor_identitas','$no_hp')");
    }

    $db = new Database();
    $db->index_user($nomor_identitas);
    header("location: ../pemesanan.php?pengguna=".$nomor_identitas);
  }

  //function yang menampung kode program untuk mendapatkan data user dari tabel user
  public function index_user($nomor_identitas){
    $user         = "SELECT * FROM user WHERE nomor_identitas=".$nomor_identitas;
    $hasil_user   = mysqli_query($this->koneksi, $user);
    $result       = null;
    while($d = mysqli_fetch_array($hasil_user)){
			$result[] = $d;
		}
		return $result;
  }

  //function yang menampung kode program untuk memperbarui data user
  public function update_user($nama_lengkap, $nomor_identitas, $no_hp)
  {
      mysqli_query($this->koneksi, "UPDATE user SET nama_lengkap = '$nama_lengkap', no_hp = '$no_hp' WHERE nomor_identitas = '$nomor_identitas'");
  }

  //function yang menampung kode program untuk mendapatkan data dari tabel tempat_wisata
  public function index_tiket()
  {
    $id_tiket     = $_GET['tiket'];
    $cek_tiket    = "SELECT tiket.*, tempat_wisata.nama as tempat_wisata, tempat_wisata.biaya as biaya, user.* FROM tiket JOIN tempat_wisata ON tempat_wisata.id_tempat = tiket.wisata JOIN user ON user.id_user = tiket.id_user WHERE id_tiket=".$id_tiket;
    $tiket        = mysqli_query($this->koneksi, $cek_tiket);
    $hasil        = null;
    while($d = mysqli_fetch_array($tiket)){
			$hasil[] = $d;
		}
		return $hasil;
  }

  //function yang menampung kode program untuk mendapatkan data tiket per user dari tabel tiket
  public function index_tiket_user($pengguna)
  {
    $cek_tiket    = "SELECT tiket.*, tempat_wisata.nama as tempat_wisata FROM tiket JOIN tempat_wisata ON tempat_wisata.id_tempat = tiket.wisata JOIN user ON user.id_user = tiket.id_user WHERE user.nomor_identitas=".$pengguna;
    $tiket        = mysqli_query($this->koneksi, $cek_tiket);
    $hasil       = null;
    while($d = mysqli_fetch_array($tiket)){
			$hasil[] = $d;
		}
		return $hasil;
  }

  //function yang menampung kode program untuk membuat tiket baru
  public function create_tiket($pengguna, $tempat_wisata, $pengunjung_dewasa, $pengunjung_anak, $tgl_kunjungan)
  {
    //cek harga tiket
    $cek_biaya    = "SELECT biaya FROM tempat_wisata WHERE id_tempat=".$tempat_wisata;
    $hasil        = mysqli_query($this->koneksi, $cek_biaya);
    $biaya        = mysqli_fetch_array($hasil);

    //menghirung biaya
    $harga_dewasa = $pengunjung_dewasa*$biaya['biaya'];
    $harga_anak   = $pengunjung_dewasa*($biaya['biaya']/2);
    $total_bayar  = $harga_dewasa+$harga_anak;

    $tanggal      = explode('-',$tgl_kunjungan);
    
    //membuat id tiket
    $id_tiket     = $pengguna.$tempat_wisata.substr($tanggal[0], 2, 2).$tanggal[1].$tanggal[2];

    //insert data ke database
    mysqli_query($this->koneksi, "INSERT INTO tiket VALUES('$id_tiket','$pengguna', '$tempat_wisata', '$pengunjung_dewasa', '$pengunjung_anak', '$tgl_kunjungan', '$total_bayar', 'Menghitung')");

    header("location: ../data_pemesanan.php?tiket=".$id_tiket);
  }

  //function yang menampung kode program untuk memperbarui status tiket
  public function update_tiket($proses, $tiket)
  {
    if ($proses == "pesan") {
      mysqli_query($this->koneksi, "UPDATE tiket SET status='Akan Berkunjung'");
    } else {
      mysqli_query($this->koneksi, "UPDATE tiket SET status='Dibatalkan'");
    }
    header("location: ../data_pemesanan.php?tiket=".$tiket);
  }
}
?>