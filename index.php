<?php include "header.php";?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top navbar-shrink" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><h4>WISATA NGAWI</h4></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#wisata">Tempat Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Mengapa Melalui Kami?</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" href="#tiket_saya">Tiket Saya</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Selamat Datang di. . .</div>
            <div class="masthead-heading text-uppercase">Ngawi Ramah</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#wisata">Jelajahi Tempat wisata </a>
        </div>
    </header>
    <section class="wisata-section" id="wisata">
        <div class="container px-4 px-lg-5">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Tempat Wisata</h2>
                <h3 class="section-subheading text-muted">Temukan tempatnya dan pesan tiketnya sekarang juga..</h3>
            </div>
            <!-- Featured Wisata Row-->
            <?php
                foreach($db->index_wisata() as $wisata){
            ?>
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center mt-5">
                    <div class="col-xl-8 col-lg-7">
                        <div id="carousel<?php echo $wisata['id_tempat']?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                            <?php
                                $select_gambar = mysqli_query($db->koneksi, "select * from gambar_wisata where id_tempat=".$wisata['id_tempat']);

                                for ($i=1; $i <= $select_gambar->num_rows; $i++) { 
                                    $gambar = mysqli_fetch_array($select_gambar);
                            ?>
                                <div class="carousel-item <?php if($i == 1) echo 'active'; ?>">
                                    <img class="d-block w-100" src="<?php echo $gambar['gambar']; ?>" alt="<?php echo $wisata['nama']?>"> 
                                </div>
                            <?php } ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo $wisata['id_tempat']?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo $wisata['id_tempat']?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-lg-left">
                            <h4 class="text-center"><?php echo $wisata['nama'] ?></h4>
                            <p class="text-black-50 mb-0 text-center"><?php echo $wisata['deskripsi'] ?></p>
                            <p class="text-black-50 mb-0 mt-1">Alamat:</p>
                            <a href="<?php echo $wisata['lokasi'] ?>" style="text-decoration: none;" target="_blank"><p class="lh-sm"><?php echo $wisata['alamat'] ?></p> </a>
                            <p class="text-black-50 mb-0 mt-1">Biaya Masuk:</p>
                            <ul>
                                <li class="text-black-50 mb-0">
                                    Dewasa: Rp<?php echo number_format($wisata['biaya'], 0, ".", "."); ?>
                                </li>
                                <li class="text-black-50 mb-0">
                                    Anak-anak : Rp<?php echo number_format($wisata['biaya']/2, 0, ".", "."); ?>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a class="btn btn-primary btn-xl" data-bs-toggle="modal" href="#video<?php echo $wisata['id_tempat']; ?>">Lihat Video</a>
                                <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#cek_user" role="button" aria-controls="offcanvasExample">
                                    Pesan Tiket
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="cek_user" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Data Calon Pengunjung</h5>
                            <button id="offcanvas-close" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" onclick="offcanvas()"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div id="user" class="d-block">
                                Pilih <strong>Pengguna Lama</strong> jika sudah pernah melakukan pemesanan tiket melalui Kami
                                <p class="mt-1 mb-1">atau</p>
                                Pilih <strong>Pengguna Baru</strong> jika belum pernah melakukan pemesanan tiket melalui Kami
                                <div class="dropdown mt-3">
                                    <button class="btn btn-primary btn-xl" type="button" id="user_lama" onclick="userLama()">Pengguna Lama</button>
                                    <button class="btn btn-primary btn-xl" type="button" id="user_baru" onclick="userBaru()">Pengguna Baru</button>
                                </div>
                            </div>
                            <form id="formLama" action="php/cek_proses.php?proses=cek_user" method="POST" class="d-lg-none" onsubmit="return validate_form()">
                                <div class="row d-flex justify-content-center mb-4">
                                    <p>Isi data untuk melanjutkan ke pemesanan</p>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="number" class="form-control" id="nomor_identitas" name="nomor_identitas" value="" placeholder="Nomor Identitas/Nomor KTP" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-stretch  d-flex justify-content-center">
                                    <div class="col-md-8 d-flex justify-content-around">
                                        <button class="btn btn-primary btn-xl text-uppercase" id="submit" type="submit">Lanjut ke Pemesanan</button>
                                    </div>
                                </div>
                            </form>
                            <form id="formBaru" action="php/cek_proses.php?proses=create_user" method="POST" class="d-lg-none" onsubmit="return validate_form()">
                                <div class="row d-flex justify-content-center mb-4">
                                    <p>Isi data untuk melanjutkan ke pemesanan</p>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="" placeholder="Nama Lengkap" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="number" class="form-control" id="nomor_identitas" name="nomor_identitas" value="" placeholder="Nomor Identitas/Nomor KTP" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh isian 8577769012" maxlength="12" value="" required>
                                        </div>  
                                    </div>
                                </div>
                                <div class="row align-items-stretch  d-flex justify-content-center">
                                    <div class="col-md-8 d-flex justify-content-around">
                                        <button class="btn btn-primary btn-xl text-uppercase" id="submit" type="submit">Lanjut ke Pemesanan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Video-->
                    <div class="wisata-modal modal fade" id="video<?php echo $wisata['id_tempat']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="close-modal" data-bs-dismiss="modal"><i class="fas fa-times-circle fa-2x"></i></div>
                                <div class="modal-body" id="play">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8">
                                                <h2 class="text-uppercase"><?php echo $wisata['nama']; ?></h2>
                                                <div class="ratio ratio-16x9">
                                                    <iframe class="embed-responsive-item" id="video" name="video" src="https://www.youtube.com/embed/<?php echo $wisata['video']; ?>" allowfullscreen allowscriptaccess="always" allow="autoplay">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <?php } ?>
        </div>
    </section>
    <!-- Services-->
    <section class="page-section bg-light" id="layanan">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Mengapa Harus Melalui Kami?</h2>
                <h3 class="section-subheading text-muted">Kami memberikan layanan terbaik untuk Anda</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-yellow"></i>
                        <i class="fas fa-ticket-alt fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Pesan Tiket</h4>
                    <p class="text-muted">Kami memberikan layanan pemesanan tiket untuk beberapa tempat wisata di Ngawi dengan mekanisme pemesanan yang mudah.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-yellow"></i>
                        <i class="fas fa-handshake-alt fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Mitra Wisata</h4>
                    <p class="text-muted">Kami adalah mitra dari tempat-tempat wisata Ngawi.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-yellow"></i>
                        <i class="fas fa-check-double fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Terpercaya</h4>
                    <p class="text-muted">Layanan kami terjamin keamanannya. Anda melakukan pemesanan secara online dan melakukan pembayaran langsung ditempat wisata.</p>
                </div>
            </div>
        </div>
    </section>
<?php include "footer.php";?>
