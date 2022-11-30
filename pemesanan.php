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
                if ($db->index_user($_GET['pengguna']) == null) {
            ?>
                <div class="row d-flex justify-content-center mb-4" >
                    <div class="col-md-8">
                        <h3 class="section-subheading text-muted text-center">Nomor pengguna Anda tidak terdaftar</h3>
                    </div>
                </div>
            <?php
                } else {
                    foreach($db->index_user($_GET['pengguna']) as $user){
            ?>
                <form id="contactForm" action="php/cek_proses.php?proses=hitung" method="POST">
                    <div class="row d-flex justify-content-center mb-4">
                        <div class="col-md-8">
                            <input type="hidden" id="pengguna" name="pengguna" value="<?php echo $user['id_user']?>">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $user['nama_lengkap'];?>" placeholder="Nama Lengkap" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Nomor Identitas</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="nomor_identitas" name="nomor_identitas" value="<?php echo $user['nomor_identitas'];?>" placeholder="Nomor Identitas" minlength="16" maxlength="16" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>No. HP</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh isian 8577769012" maxlength="12" value="<?php echo $user['no_hp'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Tempat Wisata*</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select name="tempat_wisata" id="tempat_wisata" onchange="myFunction()" class="form-select" required>
                                        <option selected disabled>Pilih Tempat Wisata</option>
                                        <?php
                                            foreach($db->index_wisata() as $wisata){
                                        ?>
                                            <option value="<?php echo $wisata['id_tempat']; ?>"><?php echo $wisata['nama']; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Tanggal Kunjungan*</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" placeholder="dd-mm-yyyy" min="<?php echo date('Y-m-d'); ?>" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Jumlah Pengunjung Dewasa*</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="pengunjung_dewasa" name="pengunjung_dewasa" placeholder="Jumlah Pengunjung Dewasa" value="" required>
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
                                        <input type="number" class="form-control" id="pengunjung_anak" name="pengunjung_anak" placeholder="Jumlah Pengunjung Anak-anak" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row  mb-4">
                                <div class="col-md-4">
                                    <label>Harga Tiket</label>
                                    <?php
                                        foreach($db->index_wisata() as $harga){
                                    ?>
                                        <input type="hidden" id="<?php echo $harga['id_tempat']; ?>" value="<?php echo number_format($harga['biaya'], 0, ".", ".")?>">
                                    <?php } ?>
                                </div>
                                <div class="col-md-8">
                                    <li id="harga">Pengunjung Dewasa Rp-</li>
                                    <li>Pengunjung Anak-anak setengah harga tiket dewasa</li>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Total Bayar</label>
                                </div>
                                <div class="col-md-8">
                                    <label><strong>Rp-</strong></label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="ya" id="setuju" required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Saya dan/atau rombongan telah membaca, memahami, dan setuju berdasarkan syarat dan ketentuan yang telah ditetapkan.*
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-stretch  d-flex justify-content-center">
                        <div class="col-md-8 d-flex justify-content-around">
                            <button class="btn btn-primary btn-xl text-uppercase" id="hitung" type="submit">Hitung Total Bayar</button>
                            <button class="btn btn-primary btn-xl text-uppercase" id="pesan" type="submit" disabled>Pesan Tiket</button>
                            <a class="btn btn-primary btn-xl text-uppercase" href="index.php">Batalkan</a>
                        </div>
                    </div>
                </form>
            <?php 
                    }
                } 
            ?>            
        </div>
    </section>
<?php include "footer.php";?>
