<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Data Pegawai</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header text-center">
                <h4>Profile Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-12 text-center">
                        <img style="width:200px;height:300px" id="profile-img"
                            src=<?php echo base_url("media/pegawai/".$data[0]->nip.".jpeg") ?>
                            class="rounded mx-auto d-block">
                        <br />
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputFile01">Ubah</label>
                            <input type="file" class="form-control" id="inputFile01">
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8 mb-12">
                        <div class="form-floating mb-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" value="<?php echo (old('nama') ? old('nama') : $data[0]->nama); ?>"
                                class="form-control" id="nama" placeholder="">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">NIP</span>
                            <input type="text" class="form-control"
                                value="<?php echo (old('nip') ? old('nip') : $data[0]->nip); ?>"
                                placeholder="Nomor Infuk Pegawai" aria-label="Nomor Infuk Pegawai">
                            <span class="input-group-text">NRP</span>
                            <input type="text" class="form-control"
                                value="<?php echo (old('nrp') ? old('nrp') : $data[0]->nrp); ?>" placeholder="NRP"
                                aria-label="NRP">
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">TMT PNS</label>
                            <input type="date" class="form-control"
                                value="<?php echo (old('tmt_pns') ? old('tmt_pns') : $data[0]->tmt_pns); ?>" id=""
                                placeholder="TMT PNS">
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">Nomor Kartu Pegawai</label>
                            <input type="text" value="<?php echo (old('karpeg') ? old('karpeg') : $data[0]->karpeg); ?>"
                                class="form-control" id="" placeholder="Kartu Pegawai">
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">Jabatan</label>
                            <select class="form-control">
                                <?php foreach($jabatan as $d){
                                    echo '<option '.((old('jabatan') ? old('jabatan') : $data[0]->jabatan) == $d->id_jabatan ? 'selected':'').' value="'.$d->id_jabatan.'">'.$d->nama_jabatan.'</option>';
                                }?>
                            </select>
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">Pangkat</label>
                            <select class="form-control">
                                <?php foreach($pangkat as $d){
                                    echo '<option '.((old('pangkat') ? old('pangkat') : $data[0]->pangkat) == $d->id_pangkat ? 'selected':'').' value="'.$d->id_pangkat.'">'.($data[0]->status == 'e23e1828-20d0-11ed-a84b-acde48001122' ? $d->pangkat_jaksa : $d->nama_pangkat).'</option>';
                                }?>
                            </select>
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">TMT Pangkat</label>
                            <input type="date"
                                value="<?php echo (old('tmt_pangkat') ? old('tmt_pangkat') : $data[0]->tmt_pangkat); ?>"
                                class="form-control" id="" placeholder="TMT Pangkat Saat Ini">
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">Pendidikan</label>
                            <input type="text"
                                value="<?php echo (old('pendidikan') ? old('pendidikan') : $data[0]->pendidikan); ?>"
                                class="form-control" id="" placeholder="Pendidikan">
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">TMT Satker</label>
                            <input type="date"
                                value="<?php echo (old('tmt_satker') ? old('tmt_satker') : $data[0]->tmt_satker); ?>"
                                class="form-control" id="" placeholder="TMT Pindah Satker">
                        </div>
                        <div class="form-floating">
                            <label for="floatingPassword">Status</label>
                            <select class="form-control">
                                <?php foreach($status as $d){
                                    echo '<option '.((old('status') ? old('status') : $data[0]->status) == $d->id_status ? 'selected':'').' value="'.$d->id_status.'">'.$d->nama_status.'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($data[0]->deleted_at)) echo '<div class="card-footer text-center"><div class="alert alert-danger" role="alert">Data dihapus pada '.$data[0]->deleted_at.'</div></div>';
            else echo '<div class="card-footer text-right">
                <a class="btn btn-primary">Simpan</a>
                <button data-toggle="modal" data-target="#hapusModal" class="btn btn-danger">Hapus</button>
            </div>';?>
        </div>
        <!-- Logout Modal-->
        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    </div>
                    <div class="modal-body">Anda yakin menghapus data <?php echo $data[0]->nama;?></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary"
                            href=<?php echo base_url('cms/hapus_pegawai/'.$data[0]->id_pegawai);?>>Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo view('admin/layout/footer');?>
    <script type="text/javascript">
    $("#inputFile01").change(
        function(e) {
            if ($("#inputFile01").prop('files')[0]) {
                $("#profile-img").attr('src', URL.createObjectURL($("#inputFile01").prop('files')[0]));
            }
        })
    </script>
    <?php if(isset($data[0]->deleted_at)) echo '
    <script>$(":input").prop("disabled", true);</script>';?>
</body>

</html>