<?php include "header.php";?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top navbar-shrink" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h4>WISATA NGAWI</h4></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php#wisata">Tempat Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#layanan">Mengapa Melalui Kami?</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" href="#tiket_saya">Tiket Saya</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="page-section bg-light">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Form Pemesanan Tiket Wisata</h2>
                <h3 class="section-subheading text-muted">Isi data dengan benar. (*) menandakan bahwa kotak harus diisi.</h3>
            </div>
            <?php
                foreach($db->index_tiket() as $tiket){
            ?>
            <form id="contactForm" action="php/cek_proses.php?proses=pesan&tiket=<?php echo $tiket['id_tiket']; ?>" method="POST">
                <div class="row d-flex justify-content-center mb-4">
                    <div class="col-md-8">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Nomor Tiket</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tiket" name="tiket" value="<?php echo $tiket['id_tiket'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Nama Lengkap</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $tiket['nama_lengkap'];?>" placeholder="Nama Lengkap" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Nomor Identitas</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="nomor_identitas" name="nomor_identitas" value="<?php echo $tiket['nomor_identitas'];?>" placeholder="Nomor Identitas" minlength="16" maxlength="16" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>No. HP</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh isian 8577769012" maxlength="12" value="<?php echo $tiket['no_hp'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Tempat Wisata</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tempat_wisata" name="tempat_wisata" value="<?php echo $tiket['tempat_wisata'];?>" readonly>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Tanggal Kunjungan</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" value="<?php echo $tiket['tgl_kunjungan'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Jumlah Pengunjung Dewasa</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="pengunjung_dewasa" name="pengunjung_dewasa" placeholder="Jumlah Pengunjung Dewasa" value="<?php echo $tiket['pengunjung_dewasa'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Jumlah Pengunjung Anak-anak</label>
                                <span><small>Usia dibawah 12 tahun</small></span>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="pengunjung_anak" name="pengunjung_anak" placeholder="Jumlah Pengunjung Anak-anak" value="<?php echo $tiket['pengunjung_anak'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-4">
                            <div class="col-md-4">
                                <label>Harga Tiket</label>
                            </div>
                            <div class="col-md-8">
                                <li>Pengunjung Dewasa Rp<?php echo number_format($tiket['biaya'], 0, ".", ".")?></li>
                                <li>Pengunjung Anak-anak setengah harga tiket dewasa</li>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Total Bayar</label>
                            </div>
                            <div class="col-md-8">
                                <label><strong>Rp<?php echo number_format($tiket['total_bayar'], 0, ".", ".")?></strong></label>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ya" id="setuju" checked disabled>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Saya dan/atau rombongan telah membaca, memahami, dan setuju berdasarkan syarat dan ketentuan yang telah ditetapkan.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-stretch  d-flex justify-content-center">
                    <div class="col-md-8 d-flex justify-content-around">
                        <button class="btn btn-primary btn-xl text-uppercase" id="hitung" disabled>Hitung Total Bayar</button>
                        <button class="btn btn-primary btn-xl text-uppercase" id="pesan" type="submit" <?php echo $tiket['status'] == 'Menghitung' ? '' : 'disabled'; ?>><?php echo $tiket['status'] == 'Menghitung' ? 'Pesan Tiket' : 'Status: '.$tiket['status']; ?></button>
                        <a class="btn btn-primary btn-xl text-uppercase <?php echo $tiket['status'] == 'Dibatalkan' ? 'disabled' : ''; ?>" href="php/cek_proses.php?proses=batal&tiket=<?php echo $tiket['id_tiket']; ?>" >Batalkan</a>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </section>
<?php include "footer.php";?>

