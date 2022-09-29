<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h4>Batas Akhir Halaman</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h5>KEJAKSAAN NEGERI BOALEMO</h5>
                    <p>
                        Jl. Sis Al Jufri <br>
                        Modelomo, Tilamuta, Kab. Boalemo<br>
                        Provinsi Gorontalo <br><br>
                        <!-- <strong>Phone:</strong> +62 8574 75884 71<br> -->
                        <strong>Email:</strong> kn.boalemo@kejaksaan.go.id<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Maps</h4>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1423.8058872066651!2d122.34440699791087!3d0.5189290301515388!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3279aabb6f0d011d%3A0x290755674f34a26a!2sKejaksaan%20Negeri%20Boalemo!5e0!3m2!1sid!2sid!4v1658670414873!5m2!1sid!2sid"
                        width="100%" height="80%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Pranala Luar</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a target="_blank"
                                href="https://survey.zonaintegritas.id/form/kn-boalemo">Survei Kepuasan Masyarakat</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i> <a target="_blank"
                                href="https://t10.zonaintegritas.id/satker/kn-boalemo">Jenguk Tahanan Online</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a target="_blank"
                                href="https://portal.zonaintegritas.id/home/kn-boalemo">Portal Reformasi Birokrasi</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i> <a target="_blank"
                                href="https://tilang.kejaksaan.go.id">e-Tilang</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Media Sosial</h4>
                    <p>Temukan kami di</p>
                    <div class="social-links mt-3">
                        <a href="https://twitter.com/knboalemo" target="_blank" style="background: deepskyblue;"
                            class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="https://www.youtube.com/channel/UCQiqOW9PMhYhWF_kEVogRSQ" target="_blank"
                            style="background: red;" class="youtube"><i class="bx bxl-youtube"></i></a>
                        <a href="https://www.facebook.com/kejaksaannegeri.boalemo.1" target="_blank"
                            style="background: blue;" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/kejari.boalemo" target="_blank" style="background: deeppink;"
                            class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="mailto:kn.boalemo@kejaksaan.go.id" target="_blank" style="background: red;"
                            class="gmail"><i class="bx bxl-gmail"></i></a>
                    </div>
                    <img style="width: 100%;" src="<?php echo base_url('assets/img/footer_logo.jpg');?>" />
                </div>

            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>Daskrimti Kejaksaan Negeri Boalemo</span></strong>.
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src=<?php echo base_url("assets/js/bootstrap-3.3.7.min.js"); ?>></script>
<script src=<?php echo base_url("assets/vendor/aos/aos.js"); ?>></script>
<script src=<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.5.2.0.min.js"); ?>></script>
<script src=<?php echo base_url("assets/vendor/glightbox/js/glightbox.min.js"); ?>></script>
<script src=<?php echo base_url("assets/vendor/swiper/swiper-bundle.min.js"); ?>></script>
<script src=<?php echo base_url("assets/vendor/php-email-form/validate.js"); ?>></script>


<!-- Template Main JS File -->
<script src=<?php echo base_url("assets/js/main.js"); ?>></script>

<?php if(isset($datatables) && $datatables){
    echo "<script src='".base_url("assets/vendor/datatables/jquery.dataTables.min.js")."'></script>
    <script src='".base_url("assets/vendor/datatables/dataTables.bootstrap4.min.js")."'></script>";
}?>

<script type="text/javascript">
$(document).ready(function() {
    $('.loader').hide();
});
</script>