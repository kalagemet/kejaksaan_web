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
                <h4 class="h4 mb-2 text-gray-800">Papan Kontrol</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div style="padding:5px" class="text-right">
                            <button type="button" data-toggle="modal" data-target="#modal_tambah"
                                class="btn btn-primary btn-md">
                                <span class="text">Tambah</span>
                            </button>
                        </div>
                        <div class="modal fade show" data-backdrop="static" data-keyboard="false" id="modal_tambah"
                            tabindex="-1" role="dialog" aria-labelledby="modal_tambahLabel" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="tambah/ptsp" enctype="multipart/form-data" method="post"
                                        id="formTambahSLider">
                                        <?= csrf_field(); ?>
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title" id="modal_tambahLabel">Tambah Slider</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid text-center">
                                                <img id="thumbnail"
                                                    src="<?php echo base_url('/assets/img/no-image.svg');?>"
                                                    class="img-fluid rounded img-thumbnail" />
                                                <div class="mb-3">
                                                    <br />
                                                    <label for="inputFile" class="form-label">Pilih File</label>
                                                    <input name="upload"
                                                        accept="image/jpeg,image/jpg,image/png,video/mp4" type="file"
                                                        class="form-control" max-size="20971520" id="inputFile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="simpanTambah"
                                                class="btn btn-primary">Simpan</button>
                                            <button type="button" data-dismiss="modal" onclick="resetInput()"
                                                class="btn btn-secondary">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="lapduTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Slider</th>
                                            <th>Tanggal Upload</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($slider as $i => $row){
                                            echo '<tr>
                                                <td>'.($i+1).'</td>
                                                <td><a href="'.base_url("media/upload/".$row->value).'" target="_blank">
                                                    <img src="'.base_url("media/upload/thumbnail/".$row->value).'"
                                                        style="max-height:100px;border-radius: 20px;margin: 20px;width: 80%;object-fit: cover;"
                                                        onerror="this.src=`'.base_url("assets/img/no-image.svg").'`"
                                                        class="img-fluid" alt="" />
                                                </a>
                                                </td>
                                                <td>'.$row->created_at.'</td>
                                                <td><span class="badge badge-info">'.$row->type.'</span></td>
                                                <td><span class="badge '.($row->is_active? 'badge-success">Tampil':'badge-warning">Tidak Tampil').'</span></td>
                                                <td>
                                                    <a class="col-xl-4 col-md-12 col-12 btn btn-primary btn-sm" target="_blank" href="'.base_url("media/upload/".$row->value).'"/>Lihat</a>
                                                    <a href="'.base_url("cms/papan-kontrol/set/".$row->id).'" class="col-xl-4 col-md-12 col-12 btn btn-sm btn-'.(!$row->is_active? 'success"> Show':'warning">Hide').'</a>
                                                    <button class="col-xl-4 col-md-12 col-12 btn btn-danger btn-sm" onClick="$(\'#confirmHapus\').attr(\'href\',\''.base_url("cms/papan-kontrol/hapus/".$row->id).'\');$(\'#hapusModal\').modal(\'show\')" >Hapus</button>
                                                </td>
                                            </tr>';
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <!-- Logout Modal-->
                <div class=" modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                </h5>
                            </div>
                            <div class="modal-body">Anda yakin ?</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                    onClick="$('#hapusModal').modal('hide')">Batal</button>
                                <a class="btn btn-primary" id="confirmHapus">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <form id="formSimpan" method="post" action="simpan/ptsp">
                    <?php echo csrf_field(); ?>
                    <input value="<?php (isset($running[0]->id)?$running[0]->id:'') ?>" name="id_running"
                        type="hidden" />
                    <input value="<?php (isset($timeout[0]->id)?$timeout[0]->id:'') ?>" name="id_timeout"
                        type="hidden" />
                    <div class="row">
                        <div class="col-xl-10 col-md-10 col-12">
                            <label for="tanggal">Runnig Text:</label>
                            <textarea id="running" name="running" placeholder="Teks berjalan pada bawah layar"
                                class="form-control"><?php echo (old('running') ? old('running') : (isset($running[0]->value)?$running[0]->value:"")); ?></textarea>
                        </div>
                        <div class="col-xl-2 col-md-2 col-12">
                            <label for="tanggal">Interval (milidetik):</label>
                            <input require
                                value="<?php echo (old('timeout') ? old('timeout') : (isset($timeout[0]->value)?$timeout[0]->value:"")); ?>"
                                id="timeout" name="timeout" type="text" placeholder="Waktu" class="form-control" />
                        </div>
                    </div>
            </div>
            <div class="card-footer text-right">
                <a onClick="$('#formSimpan').submit();" class="btn btn-success btn-icon-split btn-md">
                    <span class="text">Simpan</span>
                </a>
            </div>
        </div>

    </div>
    <?php echo view('admin/layout/footer');?>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#simpanTambah").prop("disabled", true);
    });

    function resetInput() {
        $('#inputFile').val('');
        $('#thumbnail').replaceWith(
            $('<img>', {
                id: "thumbnail",
                src: "<?php echo base_url('/assets/img/no-image.svg');?>",
                class: "img-fluid rounded img-thumbnail"
            })
        );
        $("#simpanTambah").prop("disabled", true);
    }

    $("#inputFile").change(
        function(e) {
            var file = $("#inputFile").prop('files')[0];
            var imgElement = $('#thumbnail');
            var tmpElement;
            if (file) {
                if ($.inArray(file["type"], ["image/jpg", "image/jpeg", "image/png"]) > 0) {
                    imgElement.attr('src', URL.createObjectURL(file));
                    tmpElement = $('<img>', {
                        id: imgElement.attr('id'),
                        src: imgElement.attr('src'),
                        class: imgElement.attr('class')
                    });
                    $("#simpanTambah").prop("disabled", false);
                } else if ($.inArray(file["type"], ["video/*"])) {
                    imgElement.attr('src', URL.createObjectURL(file));
                    tmpElement = $('<video>', {
                        id: imgElement.attr('id'),
                        src: imgElement.attr('src'),
                        class: imgElement.attr('class'),
                        autoplay: true,
                        muted: true
                    });
                    $("#simpanTambah").prop("disabled", false);
                }
                imgElement.replaceWith(tmpElement);
            }
        })
    </script>
</body>

</html>