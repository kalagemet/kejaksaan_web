<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>

<body>
    <?php echo view('public/layout/navigation');?>
    <main id="main">
        <!-- Content -->
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1"
                        data-aos="fade-up">
                        <div>
                            <h1>LAPDU ONLINE</h1>
                            <h2>Layanan Laporan Pengaduan Masyarakat Online</h2>
                            <div class="lapdu-search-container">
                                <input type="text" class="search-input" placeholder="Nomor Tiket">
                                <button class="search-button">Cari</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src="<?php echo base_url("assets/img/lapdu_v1.svg");?>" class="img-fluid"
                            alt="">
                    </div>
                </div>
            </div>

        </section>
        <!-- End Hero -->
        <div class="container">
            <div class="row">
                <div data-aos='fade-right' class="col-lg-7 d-lg-flex flex-lg-column">
                    <h2>Buat Laporan Pengaduan</h2>
                    <form action="lapdu_v1" method="post" role="form" id="form_lapor" class="php-email-form"
                        data-aos="fade-up">
                        <?= csrf_field() ?>
                        <input value="" type="hidden" name="captca" id="captca" required>
                        <div class="form-group mt-3">
                            <select class="lapdu_kategori_dropdown form-control">
                                <?php foreach ($kategori_lapdu as $i) {
                                    echo "<option value='".$i->id."' title='".$i->keterangan."'>".$i->kategori."</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <input placeholder="Nama Lengkap" value="<?php echo old('nama'); ?>" type="text" name="nama"
                                class="form-control" id="name" required>
                        </div>
                        <div class="form-group mt-3">
                            <input placeholder="Email yang bisa dihubungi" value="<?php echo old('email'); ?>"
                                type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group mt-3">
                            <input placeholder="Nomor Telepon" value="<?php echo old('telepon'); ?>" t type="text"
                                class="form-control" name="telepon" id="subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea placeholder="Pesan" value="<?php echo old('isi'); ?>" class="form-control"
                                name="isi" rows="5" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <input type="file" placeholder="Bukti Dukung" class="form-control"
                                name="isi" rows="5" required></textarea>
                        </div>
                        <div class="my-3">
                            <?php if (!empty(session()->getFlashdata('error')))
                            echo '<div style="
                                font-weight: bolder;
                                color: red;
                            ">'.session()->getFlashdata('error').'</div>';
                            if (!empty(session()->getFlashdata('success')))
                            echo '<div style="
                                font-weight: bolder;
                                color: green;
                            ">'.session()->getFlashdata('success').'</div>';?>
                        </div>
                        <div class="g-recaptcha" data-callback="recaptchaCallback"
                            data-sitekey="6LcIhhsiAAAAAH1nl41l5c3wNIDUlWUzhYXJaeRX"></div>
                        <br />
                        <div class="text-center"><button disabled onClick="document.getElementById('form_lapor').submit()"
                                id="send_laporan_button" type="submit">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 d-lg-flex flex-lg-column">
                    <div class="lapdu-process-container">
                        <div class="process-step">
                            <div class="process-step-number">1</div>
                            <div class="process-step-text">Langkah 1: Pilih Jenis Laporan</div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">2</div>
                            <div class="process-step-text">Langkah 2: Isi Formulir</div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">3</div>
                            <div class="process-step-text">Langkah 3: Proses Pengiriman</div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">4</div>
                            <div class="process-step-text">Langkah 4: Cetak Nomor Laporan</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End of Content -->
    </main>
    <?php echo view('public/layout/footer');?>
</body>
<script type="text/javascript">
function recaptchaCallback(response) {
    $('#captca').val(response);
    $('#send_laporan_button').removeAttr('disabled');
};
</script>
</html>