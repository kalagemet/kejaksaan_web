<!-- ======= Contact Section ======= -->
<section id="aduan" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Hubungi Kami</h2>
            <p>Laporkan atau sampaikan kritikan membangun anda demi menunjang kualitas pelayanan kami</p>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 info">
                        <i class="bx bx-map"></i>
                        <h4>Alamat</h4>
                        <p>Jl. Sis Al Jufri, Modelomo, Tilamuta<br>Kabupaten Boalemo</p>
                    </div>
                    <div class="col-lg-6 info">
                        <i class="bx bx-phone"></i>
                        <h4>Telpon</h4>
                        <!-- <p>+62 5589 55488 55<br>+62 5589 22548 64</p> -->
                    </div>
                    <div class="col-lg-6 info">
                        <i class="bx bx-envelope"></i>
                        <h4>Email</h4>
                        <p>kn.boalemo@kejaksaan.go.id</p>
                    </div>
                    <div class="col-lg-6 info">
                        <i class="bx bx-time-five"></i>
                        <h4>Jam Kerja</h4>
                        <p>Senin - Jum'at: 09.00/16.00 WITA</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <form action="lapor" method="post" role="form" id="form_lapor" class="php-email-form"
                    data-aos="fade-up">
                    <?= csrf_field() ?>
                    <input value="" type="hidden" name="captca" id="captca" required>
                    <div class="form-group">
                        <input placeholder="Nama Lengkap" value="<?php echo old('nama'); ?>" type="text" name="nama"
                            class="form-control" id="name" required>
                    </div>
                    <div class="form-group mt-3">
                        <input placeholder="Email yang bisa dihubungi" value="<?php echo old('email'); ?>" t
                            type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group mt-3">
                        <input placeholder="Nomor Telepon" value="<?php echo old('telepon'); ?>" t type="text"
                            class="form-control" name="telepon" id="subject" required>
                    </div>
                    <div class="form-group mt-3">
                        <textarea placeholder="Pesan" value="<?php echo old('isi'); ?>" t class="form-control"
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

        </div>

    </div>
</section>
<!-- End Contact Section -->
<script type="text/javascript">
function recaptchaCallback(response) {
    $('#captca').val(response);
    $('#send_laporan_button').removeAttr('disabled');
};
</script>