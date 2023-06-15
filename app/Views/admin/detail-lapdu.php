<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <div data-aos='fade-up' class="alert" role="alert">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol style="margin:0" class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Laporan Masuk</a></li>
                <li style="width:80%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                    class="breadcrumb-item active" aria-current="page">
                    <?php echo $data->tiket;?></li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div style="text-align:center;" class="card-header">
                <br />
                <h4 class="h4 mb-2 text-gray-800">Laporan #<?php echo $data->tiket;?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 col-md-12 mb-4">
                        <div style="width: 100%; height: 712px;">
                            <iframe src=<?php echo base_url("media/lapdu_v1/".$data->id_lapdu); ?>
                                type="application/pdf" style="width: 100%; height: 100%;" frameborder=0></iframe>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div>
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Tanggal Laporan :</span><span
                                    style="color:green;text-align:left"><?php echo $data->tanggal; ?></span>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Kategori Laporan :</span>
                                <h5 style="color:Green;text-align:left"><span
                                        class="badge badge-primary"><?php echo $data->kategori; ?></span></h5>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Pelapor :</span><span
                                    style="color:Green;text-align:left">
                                    <?php echo $data->nama_pelapor; ?><br />
                                    <?php echo $data->tlp; ?><br />
                                    <?php echo $data->email; ?><br />
                                </span>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Status Laporan :</span>
                                <h5 style="color:Green;text-align:left"><?php echo $data->status; ?></h5>
                            </div>
                            <br />
                            <div style="justify-content:space-between;display:flex">
                                <span style="text-align:right">Jenis Laporan :</span>
                                <h5 style="color:Green;text-align:left">
                                    <?php echo $data->prioritas." ".$data->pending ?></h5>
                            </div>
                            <br />
                            <span>Riwayat Laporan :</span><br /><br />
                            <?php foreach ($tindakan as $i => $row) {
                                    echo '<div class="track_tiket_progress-steps">
                                        <div class="step '.(($i==count(array($tindakan))-1)?"active":"").' row">
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
                            ?>
                            <br />
                            <br />
                            <span style="text-align:right">Uraian Singkat :</span><br /><br />
                            <span style="text-align:left;">
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                <i>
                                    <?php echo $data->uraian; ?>
                                </i>
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?php if($data->is_active==1 && $data->is_pending==0) echo '
                <form id="formTindakan" method="post" action="add">
                '.csrf_field().'
                <input require value="'.$data->id_lapdu.'" name="id_lapdu" type="hidden" />
                <div class="row">
                    <div class="col-xl-7 col-md-8 mb-12">
                        <label for="tanggal">Tindakan:</label>
                        <input require value="'.old('tindakan').'" id="tindakan" name="tindakan" type="text"
                            placeholder="Tindakan yang sedang dikerjakan" class="form-control" />
                    </div>
                    <div class="col-xl-3 col-md-4 mb-12">
                        <label for="tanggal">Oleh:</label>
                        <input require value="'.old('oleh').'" id="oleh" name="oleh" type="text" placeholder="Pelaksana"
                            class="form-control" />
                    </div>
                    <div class="col-xl-2 col-md-12 mb-12">
                        <a style="margin-top:31px;" onClick="tambahTindakan()"
                            class="btn btn-success btn-block btn-icon-split btn-md">
                            <span class="text"><i class="fas fa-forward"></i></span>
                        </a>
                    </div>
                </div>
                </form>';?>
                <br /><br />
                <a type="button" <?php echo "href=\"".base_url("cms/lapdu_v1/update/is_active/".$data->id_lapdu)."\" class=\"".($data->is_active==1?"btn btn-success\">Selesaikan Laporan</a> ":"btn btn-secondary\">Aktifkan Laporan</a> ");
                    if($data->is_active){
                        echo "<a type=\"button\" href=\"".base_url("cms/lapdu_v1/update/is_priority/".$data->id_lapdu)."\"
                        class=\"".($data->is_priority==0?"btn btn-primary\">Prioritaskan</a> ":"btn btn-info\">Prioritas Normal</a> "); 
                        echo "<a type=\"button\" href=\"".base_url("cms/lapdu_v1/update/is_pending/".$data->id_lapdu)."\"
                        class=\"".($data->is_pending==0?"btn btn-warning\">Tangguhkan Laporan</a> ":"btn btn-success\">Proses Laporan</a> "); 
                        if(count($tindakan)>1) echo "<a href=\"".base_url("cms/lapdu_v1/delete/".$data->id_lapdu)."\" type=\" button\" class=\"btn btn-danger\">Hapus Tindakan Terakhir</a>";
                } ?> <br />
                <br />
            </div>
        </div>
    </div>
    <?php echo view('admin/layout/footer');?>
</body>
<script type="text/javascript">
function tambahTindakan() {
    if ($('#tindakan').val() == "") {
        $('#tindakan').focus();
        return false
    }
    if ($('#oleh').val() == "") {
        $('#oleh').focus();
        return false
    }
    $("#formTindakan").submit();
}
</script>

</html>