        <div class="modal" tabindex="-1" id="tiket_saya">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tiket Saya</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="cekTiket" action="php/cek_proses.php?proses=tiket_saya" method="POST" onsubmit="return validate_form()">
                        <div class="modal-body">
                            <div class="row d-flex justify-content-center mb-4">
                                <p>Isi data untuk melanjutkan ke pemesanan</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="nomor_identitas" name="nomor_identitas" value="" placeholder="Nomor Identitas/Nomor KTP" required>
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button id="submit" type="submit" class="btn btn-primary" >Cek Tiket</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Wisata Ngawi 2022</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="https://twitter.com/pemkabngawi" aria-label="Twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="https://web.facebook.com/pemkabngawi?_rdc=1&_rdr" aria-label="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/ngawikab_/" aria-label="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">V 1.0</a>
                        <!-- <a class="link-dark text-decoration-none" href="#!">Terms of Use</a> -->
                    </div>
                </div>
            </div>
        </footer> 
        <script>
            function myFunction() {
                var wisata = document.getElementById("tempat_wisata").value;
                var biaya  = document.getElementById(wisata).value;
                document.getElementById("harga").innerHTML = "Pengunjung Dewasa: Rp" + biaya;
            }
            function validate_form() {
                let x = document.forms["cekTiket"]["nomor_identitas"].value;
                let y = document.forms["formLama"]["nomor_identitas"].value;
                let z = document.forms["formBaru"]["nomor_identitas"].value;
                if (x.length == 16 || y.length == 16 || z.length == 16) {
                    return true;
                } else {
                    alert("Nomor identitas harus berjumlah 16 angka");
                    return false;
                }
            }
            // function validate_form(cekTiket){
            //     let nomor_indetitas = document.cekTiket.nomor_pengguna.value;
            //     valid = true;
            //     if (nomor_identitas.length != 16){
            //         alert ( "Nomor identitas atau KTP harus terdiri dari 16 angka." );
            //         valid = false;
            //     }
            //     return valid;
            // }
        </script>   
        <script>
            function offcanvas() {
                var user = document.getElementById("user");
                user.classList.replace("d-lg-none", "d-block");
                var formLama = document.getElementById("formLama");
                formLama.classList.replace("d-block", "d-lg-none");
                var formBaru = document.getElementById("formBaru");
                formBaru.classList.replace("d-block", "d-lg-none");
            }
            function userLama() {
                var user = document.getElementById("user");
                user.classList.replace("d-block", "d-lg-none");
                var form = document.getElementById("formLama");
                form.classList.replace("d-lg-none", "d-block");
            }
            function userBaru() {
                var user = document.getElementById("user");
                user.classList.replace("d-block", "d-lg-none");
                var form = document.getElementById("formBaru");
                form.classList.replace("d-lg-none", "d-block");
            }
        </script>   
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>