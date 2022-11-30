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
    <section class="page-section">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Data Saya</h2>
                <h3 class="section-subheading text-muted">Kami melindungi data Anda.</h3>
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
                <form id="contactForm" action="php/cek_proses.php?proses=update_user" method="POST">
                    <div class="row d-flex justify-content-center mb-4">
                        <div class="col-md-8">
                        <?php
                            foreach($db->index_user($_GET['pengguna']) as $user){
                        ?>
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
                            <input type="hidden" id="pengguna" name="pengguna" value="<?php echo $user['id_user']?>">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $user['nama_lengkap'];?>" placeholder="Nama Lengkap" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>No. HP</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh isian 8577769012" maxlength="12" value="<?php echo $user['no_hp'];?>" required>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <button class="btn btn-primary btn-xl text-uppercase float-end" id="update_user" type="submit">Perbarui Data</button>
                        </div>
                    </div>
                </form>
            <?php
                }
            }
            ?>    
        </div>
    </section>
    <section class="page-section bg-light">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Daftar Tiket Saya</h2>
                <h3 class="section-subheading text-muted">Kami melindungi data Anda.</h3>
            </div>
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tempat Wisata</th>
                                <th scope="col">Tanggal Kunjungan</th>
                                <th scope="col">Status Kunjungan</th>
                                <th scope="col">Tiket</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($db->index_tiket_user($_GET['pengguna']) == null) {
                        ?>
                            <tr>
                                <td colspan=5>Data Tidak ada</td>
                            </tr>
                        <?php
                            } else {
                                $no = 1;
                                foreach($db->index_tiket_user($_GET['pengguna']) as $tiket){
                        ?>
                            <tr>
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?php echo $tiket['tempat_wisata']; ?></td>
                                <td><?php echo $tiket['tgl_kunjungan']; ?></td>
                                <td><?php echo $tiket['status']; ?></td>
                                <td><a href="data_pemesanan.php?tiket=<?php echo $tiket['id_tiket']; ?>">Lihat Detail</a></td>
                            </tr>
                        <?php 
                            }
                        } 
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php include "footer.php";?>

