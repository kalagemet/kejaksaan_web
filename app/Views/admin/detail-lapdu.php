<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div style="text-align:center;" class="card-header">
                <br />
                <h4 class="h4 mb-2 text-gray-800">Laporan #23343535346534636</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 col-md-12 mb-4">
                        <div style="width: 100%; height: 712px;">
                            <object data=<?php echo base_url("media/lapdu/202305180953201001.pdf"); ?>
                                type="application/pdf" style="width: 100%; height: 100%;"></object>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div>
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Tanggal Laporan :</span><span
                                    style="color:green;text-align:left"><b>Aktif</b></span>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Kategori Laporan :</span><span
                                    style="color:Green;text-align:left">Normal</span>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Pelapor :</span><span
                                    style="color:Green;text-align:left">Normal</span>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Status Laporan :</span><span
                                    style="color:Green;text-align:left">Aktif</span>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Jenis Laporan :</span><span
                                    style="color:Green;text-align:left">Normal</span>
                            </div>
                            <br />
                            <span>Riwayat Laporan :</span><br /><br />
                            <div class="track_tiket_progress-steps">
                                <div class="step active">
                                    <div class="step-number"></div>
                                    <div class="step-content">
                                        <div class="step-title">Tindakan</div>
                                        <div class="step-date">12-2323-2323-2323</div>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-number"></div>
                                    <div class="step-content">
                                        <div class="step-title">Tindakan</div>
                                        <div class="step-date">12-2323-2323-2323</div>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-number"></div>
                                    <div class="step-content">
                                        <div class="step-title">Tindakan</div>
                                        <div class="step-date">12-2323-2323-2323</div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <br />
                            <span style="text-align:right">Uraian Singkat :</span><br /><br />
                            <span style="text-align:left;">
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                <i>
                                    Untuk informasi lebih lanjut anda dapat menghubuni kami melalui
                                    <b>kejari.boalemo@kejaksaan.go.id</b> atau mengunjungi langsung bidang Intelijen
                                    Kejaksaan Negeri Boalemo melalui PTSP Kantor Kejaksaan Negeri Boalemo pada hari
                                    dan jam
                                    pelayanan
                                </i>
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form method="post" action="add--">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-xl-10 col-md-9 mb-12">
                            <label for="tanggal">Masukan Tindakan:</label>
                            <input require value="<?php echo old('tgl_putusan'); ?>" name="tgl_putusan" type="text"
                                placeholder="tanggal putusan" class="form-control" id="tgl_putusan" />
                        </div>
                        <div class="col-xl-2 col-md-3 mb-12">
                            <button style="margin-top:31px;" type="submit"
                                class="btn btn-success btn-block btn-icon-split btn-md">
                                <span class="text"><i class="fas fa-forward"></i></span>
                            </button>
                        </div>
                    </div><br /><br />
                    <button type="button" class="btn btn-success">Selesaikan Laporan</button>
                    <button type="button" class="btn btn-danger">Prioritaskan</button>
                    <button type="button" class="btn btn-warning">Tunda</button>
                    <!-- <a href="javascript:{}" onclick="document.getElementById('form_post').submit();"
                                type="submit" class="btn btn-success btn-icon-split btn-lg">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </a> -->
                </form>
                <br />
                <br />
            </div>
        </div>

    </div>
    <?php echo view('admin/layout/footer');?>
</body>

</html>