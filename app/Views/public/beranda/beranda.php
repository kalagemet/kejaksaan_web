<?php echo view('public/beranda/hero');?>
<!-- ======= App Features Section ======= -->
<section id="features" class="features">
    <div class="container">
        <div data-aos="fade-up" class="section-title">
            <h2>Kejaksaan Negeri Boalemo</h2>
            <p>Pembaharuan Kejaksaan dalam aspek organisasi, tata kerja dan sumber daya manusia serta manajemen teknis
                perkara dan pengawasan, merupakan program prioritas yang harus direspon atas Reformasi Birokrasi dalam
                rangka mendukung tekad pemerintah untuk mewujudkan pemerintahan yang bersih dan berwibawa <i>(clean
                    governance and good governance).</i></p>
        </div>
        <div class="row no-gutters">
            <div class="col-xl-7 d-flex align-items-stretch order-2 order-lg-1">
                <div class="content d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col-md-6 icon-box" data-aos="fade-up">
                            <i class="bx bx-id-card"></i>
                            <h4>Bidang Pembinaan</h4>
                            <p><a href=<?php echo base_url("/page/pembinaan");?>>Selengkapnya &raquo; </a></p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-shield"></i>
                            <h4>Intelijen</h4>
                            <p><a href=<?php echo base_url("/page/intelijen");?>>Selengkapnya &raquo; </a></p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bx-images"></i>
                            <h4>Pidana Umum</h4>
                            <p><a href=<?php echo base_url("/page/pidana-umum");?>>Selengkapnya &raquo; </a></p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                            <i class="bx bx-atom"></i>
                            <h4>Pidana Khusus</h4>
                            <p><a href=<?php echo base_url("/page/pidana-khusus");?>>Selengkapnya &raquo; </a></p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                            <i class="bx bx-receipt"></i>
                            <h4>Perdata dan Tata Usaha</h4>
                            <p><a href=<?php echo base_url("/page/perdata-dan-tata-usaha-negara");?>>Selengkapnya
                                    &raquo; </a></p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                            <i class="bx bx-cube-alt"></i>
                            <h4>Pengelola Barang Bukti dan Rampasan</h4>
                            <p><a href=<?php echo base_url("/page/pengelola-barang-bukti");?>>Selengkapnya &raquo; </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="image col-xl-5 d-flex align-items-stretch justify-content-center order-1 order-lg-2"
                data-aos="fade-left" data-aos-delay="100">
                <img src="assets/img/features.svg" class="img-fluid" alt="">
            </div> -->
        </div>

    </div>
</section><!-- End App Features Section -->
<?php echo view('public/beranda/carousel');?>
<?php echo view('public/beranda/pejabat');?>
<?php echo view('public/beranda/slider');?>
<?php echo view('public/beranda/terbaru');?>
<?php echo view('public/beranda/kontak');?>