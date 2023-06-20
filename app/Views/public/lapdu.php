<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>

<body>
    <div id="overlay" onclick="off()"></div>
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
                                <input oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="id_laporan"
                                    type="text" class="search-input" placeholder="Nomor Tiket">
                                <button id="button-cekTiket" onClick="cekTiket()" class="search-button">Cari</button>
                            </div>
                            <div data-aos="fade-up" class="my-3">
                                <?php if (!empty(session()->getFlashdata('error_tiket')))
                                echo '<div style="
                                    font-weight: bolder;
                                    color: red;
                                ">'.session()->getFlashdata('error_tiket').'</div>';?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src="<?php echo base_url("assets/img/lapdu_v1.svg");?>" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

        </section>
        <!-- End Hero -->
        <div class="container">
            <div class="row">
                <div data-aos='fade-right' class="col-lg-7 d-lg-flex flex-lg-column">
                    <h2>Buat Laporan Pengaduan</h2>
                    <div data-aos="fade-up" class="my-3">
                        <?php if (!empty(session()->getFlashdata('error')))
                        echo '<div style="
                            font-weight: bolder;
                            color: red;
                        ">'.session()->getFlashdata('error').'</div>';?>
                    </div>
                    <form action="lapdu_v1_create" method="post" enctype="multipart/form-data" role="form"
                        id="form_lapor" class="php-email-form" data-aos="fade-up">
                        <?= csrf_field() ?>
                        <input value="" type="hidden" name="captca" id="captca" required>
                        <div class="form-group mt-3">
                            <label for="kategori">Kategori Laporan</label>
                            <select name="kategori" id="kategori" class="lapdu_kategori_dropdown form-control">
                                <option value='' title=''>-- Pilih Kategori --</option>
                                <?php foreach ($kategori_lapdu as $i) {
                                    echo "<option ".(old('kategori')==$i->id?"selected":"")." value='".$i->id."' title='".$i->keterangan."'>".$i->kategori."</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="nama">Nama Pelapor</label>
                            <input placeholder="Nama Lengkap Pelapor" value="<?php echo old('nama'); ?>" type="text"
                                name="nama" class="form-control" id="nama">
                        </div>
                        <div class="form-group mt-3">
                            <label for="nik">Nomor Induk Kepedudukan</label>
                            <input placeholder="Nomor KTP Pelapor" value="<?php echo old('nik'); ?>" type="text"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="nik" class="form-control"
                                id="nik">
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input
                                placeholder="Email yang bisa dihubungi/Boleh dikosongkan apabila tidak bersedia mencantumkan email"
                                value="<?php echo old('email'); ?>" type="email" class="form-control" name="email"
                                id="email">
                        </div>
                        <div class="form-group mt-3">
                            <label for="telepon">Nomor Telepon/WhatsApp</label>
                            <input
                                placeholder="Nomor yang bisa dihubungi/Boleh dikosongkan apabila tidak bersedia mencantumkan nomor"
                                value="<?php echo old('telepon'); ?>" t type="text" class="form-control" name="telepon"
                                id="subject">
                        </div>
                        <div class="form-group mt-3">
                            <label for="isi">Uraian Singkat</label>
                            <textarea placeholder="Uraikan secara singkat isi dari laporan anda" id="isi"
                                class="form-control" name="isi" rows="5" required><?php echo old('isi'); ?></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="data_dukung">Laporan/Bukti dukung Mak. 4 Mb</label>
                            <input name="data_dukung" id="data_dukung" accept=".pdf" type="file" class="form-control"
                                name="isi" rows="5" required>
                        </div><br />
                        <div class="text-center">
                            <button class="lapdu_kirim_button" id="lapdu_kirim_button" onClick="konfirmasi()"
                                type="button">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 d-lg-flex flex-lg-column">
                    <div class="lapdu-process-container">
                        <div class="process-step">
                            <div class="process-step-number">1</div>
                            <div class="process-step-text">Pilih Jenis Laporan</div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">2</div>
                            <div class="process-step-text">Isi nama NIK email dan nomor telepon, kami akan menjaga
                                kerahasiaan data anda</div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">3</div>
                            <div class="process-step-text">Uraikan secara singkat tentang laporan anda pada form
                                <b>Uraian Singkat</b> gunakan bahasa yang baik dan bisa dimengerti
                            </div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">4</div>
                            <div class="process-step-text">Lampirkan laporan secara resmi beserta bukti dukung, Laporan
                                yang
                                akan diproses wajib
                                memiliki data berikut:
                                <ul>
                                    <li>Surat yang ditujukan kepada Kepala Kejaksaan Negeri perihal laporan pengaduan
                                        yang di buat</li>
                                    <li>Dokumen KTP Pelapor</li>
                                    <li>Bukti pendukung laporan</li>
                                    <li>Dalam bentuk PDF dengan ukuran tidak melebihi 4MB</li>
                                    <li>Apabila terdapat Video yang ingin disampaikan silahkan
                                        kirimkan link vidio tersebut melalui berkas laporan atau silahkan kirimkan
                                        melalui email
                                        kejari.boalemo@kejaksaan.go.id kemudian lampirkan bukti pengirimannya pada
                                        berkas
                                        laporan</li>
                                </ul>
                            </div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">5</div>
                            <div class="process-step-text">
                                Silahkan Tekan Kirim dan centang "im not a robot"
                                Laporan anda akan segera kami tindak lanjuti
                            </div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">6</div>
                            <div class="process-step-text">Silahkan Catat Nomor Pelaporan yang anda terima atau cetak
                                bukti laporan untuk
                                digunakan memantau proses tindak lanjut dari Laporan anda
                            </div>
                        </div>
                        <div class="process-step">
                            <div class="process-step-number">7</div>
                            <div class="process-step-text">Terimakasih sudah membantu kami dalam melakukan penegakan
                                hukum di wilayah Kejaksaan Negeri Boalemo
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modall -->
                <div class="modal fade" id="konfirmasi_cek_lapdu" tabindex="-1" role="dialog"
                    aria-labelledby="konfirmasi_cek_lapdulabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="lapdu_v1_cek" method="post" enctype="multipart/form-data" role="form"
                                id="form_cek_lapor" class="php-email-form">
                                <?= csrf_field() ?>
                                <input value="" type="hidden" name="captca" id="captca_tiket" required>
                                <input value="" type="hidden" name="tiket" id="no_tiket" required>
                            </form>
                            <div style="display:block" class="modal-header">
                                <h5 class="modal-title" style="text-align:center;" id="konfirmasi_cek_lapdulabel">
                                    Konfirmasi anda bukan robot</h5>
                            </div>
                            <div style="text-align:center" class="modal-body">
                                <div style="display:inline-block" class="g-recaptcha" data-callback="recaptchaCekTiket"
                                    data-sitekey="6LcIhhsiAAAAAH1nl41l5c3wNIDUlWUzhYXJaeRX"></div>
                                <br />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    onClick="grecaptcha.reset();$('#konfirmasi_cek_lapdu').modal('hide');">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <!-- Modall -->
                <div class="modal fade" id="konfirmasi_kirim_lapdu" tabindex="-1" role="dialog"
                    aria-labelledby="konfirmasi_kirim_lapdulabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="konfirmasi_kirim_lapdulabel">Konfirmasi Laporan?</h5>
                            </div>
                            <div style="text-align:center" class="modal-body">
                                Laporan yang anda kirim tidak dapat dibatalkan
                                <br />
                                <br />
                                <div style="display:inline-block" class="g-recaptcha" data-callback="recaptchaCallback"
                                    data-sitekey="6LcIhhsiAAAAAH1nl41l5c3wNIDUlWUzhYXJaeRX"></div>
                                <br />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onClick="grecaptcha.reset();$('#konfirmasi_kirim_lapdu').modal('hide');">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <?php if (!empty(session()->getFlashdata('success_tiket'))){
                $data = session()->getFlashdata('success_tiket');
                echo '<div class="modal fade show" id="modal_cek" tabindex="-1" role="dialog"
                    aria-labelledby="modal_cekLabel" aria-hidden="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_cekLabel">Laporan #'.$data['no_tiket'].'</h5>
                            </div>
                            <div class="modal-body">
                                <span style="text-align:right">Uraian Singkat :</span>
                                <span style="text-align:left;overflow: hidden;display:-webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i><b><i>'.$data['uraian'].'</i></b>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </span>
                                <br />
                                <div style="justify-content:space-between;display:flex">
                                    <span style="text-align:right">Status Laporan :</span><span style="color:'.($data['status']=="Aktif"?"green":"orange").'; text-align:left"><b>'.$data['status'].'</b></span>
                                </div>
                                <br />
                                <div style="justify-content:space-between;display:flex">
                                    <span style="text-align:right">Jenis Laporan :</span><span  style="color:'.($data['prioritas']=="Normal"?"Green":"Red").'; text-align:left">'.$data['prioritas'].'</span>
                                </div>
                                <br />
                                <span>Riwayat Laporan :</span><br/><br/>';
                                foreach ($data['riwayat'] as $i => $row) {
                                    echo '<div class="track_tiket_progress-steps">
                                        <div class="step '.(($i==count(array($data['riwayat']))-1)?"active":"").' row">
                                            <div class="col-xl-1 col-md-1 col-sm-1 col-1" style="position: relative;top:5px;">
                                                <div class="step-number"></div>
                                            </div>
                                            <div class="col-xl-11 col-md-11 col-sm-8 col-8">
                                                <div class="step-content">
                                                    <div class="step-title">'.$row->tindakan.'</div>
                                                    <div class="step-date">'.$row->created_at.' oleh '.$row->oleh.'</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                                echo '<br /><br />
                                <span>Untuk informasi lebih lanjut anda dapat menghubuni kami melalui <b>kejari.boalemo@kejaksaan.go.id</b> atau mengunjungi langsung bidang Intelijen Kejaksaan Negeri Boalemo melalui PTSP Kantor Kejaksaan Negeri Boalemo pada hari dan jam pelayanan</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onCLick="grecaptcha.reset();$(`#modal_cek`).modal(`hide`);" class="btn btn-secondary">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>';}?>
                <!-- Modall -->
                <!-- Modal -->
                <?php if (!empty(session()->getFlashdata('success'))){
                echo '<div class="modal fade show" id="modal_berhasil" tabindex="-1" role="dialog"
                    aria-labelledby="modal_berhasilLabel" aria-hidden="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_berhasilLabel">Laporan berhasil dibuat</h5>
                            </div>
                            <div class="modal-body">
                                Terimakasih telah menjadi mitra kami dalam melakukan penegakan hukum
                                <br />
                                <br />
                                <span>Nomor Tiket Laporan:</span><br />
                                <h1 style="color: green;">#'.session()->getFlashdata('success').'</h1>
                                <br />
                                <span>Silahkan catat nomor tiket atau unduh melalui tombol dibawah ini</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="cetak_tiket(`'.base_url('lapdu_v1/tiket?tiket=').session()->getFlashdata('success').'`)" class="btn btn-primary">Unduh Tiket</button>
                                <button type="button" onCLick="location.reload()" class="btn btn-secondary">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>';}?>
                <!-- Modall -->
            </div>
        </div>
        <!-- End of Content -->
    </main>
    <?php echo view('public/layout/footer');?>
</body>
<script type="text/javascript">
$(document).ready(function() {
    var data = "<?php echo isset($_GET['tiket'])?$_GET['tiket']:""; ?>";
    if (data != "") {
        history.pushState(null, "", location.href.split("?")[0]);
        $("#id_laporan").val(data.replace(/[^0-9]/g, ''));
        $("#button-cekTiket").click();
    }
});

function cetak_tiket(url) {
    window.open(url, "_blank")
}

function cekTiket() {
    if (document.getElementById('id_laporan').value > 0) {
        $('#konfirmasi_cek_lapdu').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#konfirmasi_cek_lapdu').modal("show");
    } else {
        document.getElementById('id_laporan').focus();
    }
}

function konfirmasi() {
    if (document.getElementById('isi').value != '') {
        $('#konfirmasi_kirim_lapdu').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#konfirmasi_kirim_lapdu').modal("show");
    } else {
        document.getElementById('isi').focus();
    }
}

function recaptchaCekTiket(response) {
    document.getElementById("captca_tiket").value = response;
    document.getElementById("no_tiket").value = document.getElementById('id_laporan').value;
    if (response) {
        document.getElementById("form_cek_lapor").submit();
    }
}

function recaptchaCallback(response) {
    document.getElementById("captca").value = response;
    if (response) {
        document.getElementById("form_lapor").submit();
    }
}
</script>
<?php if (!empty(session()->getFlashdata('success'))){
    echo "
    <script type='text/javascript'>
    $(window).on('load', function() {
        $('#modal_berhasil').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#modal_berhasil').modal('show');
    })
    </script>";
} 
if (!empty(session()->getFlashdata('success_tiket'))){
    echo "
    <script type='text/javascript'>
    $(window).on('load', function() {
        $('#modal_cek').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#modal_cek').modal('show');
    })
    </script>";
} ?>

</html>