<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>
<!-- Latest compiled and minified CSS -->

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <!-- Begin Page Content -->
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Jadwal Sidang</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div style="display: grid; justify-content: end; margin:10px">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#tambahModal">
                                        Tambah Sidang
                                    </button>
                                </div>
                                <br />
                                <table class="table table-striped table-bordered dataTable" id="dataTable"
                                    cellspacing="0" role="grid">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Sidang</th>
                                            <th>Nama Terdakwa</th>
                                            <th>Agenda Sidang</th>
                                            <th>Pasal</th>
                                            <th>Penuntut Umum</th>
                                            <th>Lokasi</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal Sidang</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="formTambahJadwal" action="add-sidang-pidum">
                            <input type="hidden" id="csrf_tambahjadwal" name="csrf_token_name">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="tanggal">Waktu Sidang</label>
                                    <input require value="<?php echo old('tanggal'); ?>" name="tanggal"
                                        type="datetime-local" placeholder="tanggal sidang" class="form-control"
                                        id="tanggal" />
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="terdakwa">Nama Terdakwa:</label>
                                    <input require type="text" value="<?php echo old('terdakwa'); ?>" name="terdakwa"
                                        id="terdakwa" class="form-control small" placeholder="Isron dkk..."
                                        aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="agenda">Agenda Sidang:</label>
                                    <input require type="text" value="<?php echo old('agenda'); ?>" name="agenda"
                                        id="agenda" class="form-control small" placeholder="Pemeriksaan Saksi..."
                                        aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="pasal">Pasal:</label>
                                    <input require type="text" value="<?php echo old('pasal'); ?>" name="pasal"
                                        id="pasal" class="form-control small" placeholder="Pasal 170 KUHP..."
                                        aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col-sm-12" style="display:grid">
                                    <label for="jaksa">Jaksa Penuntut Umum:</label>
                                    <select id="jaksa" name="jaksa[]" class="select fluid" multiple
                                        data-mdb-filter="true">
                                        <?php foreach($jaksa as $i => $d){
                                    echo '<option value="'.$d->id_pegawai.'">'.$d->nama.'</option>';
                                }?>
                                    </select>
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="lokasi">Lokasi:</label>
                                    <input require type="text" value="<?php echo old('lokasi'); ?>" name="lokasi"
                                        id="lokasi" class="form-control small" placeholder="PN - " aria-label="Search"
                                        aria-describedby="basic-addon2">
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="keterangan">Keterangan:</label>
                                    <input require type="text" value="<?php echo old('keterangan'); ?>"
                                        name="keterangan" id="keterangan" class="form-control small" placeholder="-"
                                        aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" onClick="tambahJadwal()" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php echo view('admin/layout/footer');?>
    <script type="text/javascript">
    function tambahJadwal() {
        $.ajax({
            url: "<?php echo base_url('cms/get_csrf_token'); ?>",
            type: "GET",
            success: function(response) {
                $('#csrf_tambahjadwal').val(response);
                $("#formTambahJadwal").submit();
            }
        });
    }
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        var dataTable = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('jadwal-sidang-pidum'); ?>",
                "type": "POST",
            },
            "columns": [{
                "data": "tanggal",
                "sortable": false
            }, {
                "data": "terdakwa",
                "sortable": false
            }, {
                "data": "agenda",
                "sortable": false
            }, {
                "data": "pasal",
                "sortable": false
            }, {
                "data": "jaksa",
                "sortable": false
            }, {
                "data": "lokasi_sidang",
                "sortable": false
            }, {
                "data": "keterangan",
                "sortable": false
            }, {
                "data": "id_jadwal",
                "render": function(data, type, row, meta) {
                    return '<a href="/cms/delete-sidang-pidum/' + data +
                        '" class="btn btn-danger">Hapus</a>';
                }
            }],
            "searching": true,
            "paging": true,
            "lengthMenu": [10, 25, 50, 100],
            "pageLength": 10,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(Filter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
    //regenerate token
    $('#dataTable').on('xhr.dt', function(e, settings, json) {
        $.ajax({
            url: "<?php echo base_url('cms/get_csrf_token'); ?>",
            type: "GET",
            success: function(response) {
                // Mengupdate nilai token CSRF pada setiap permintaan Ajax DataTables
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': response
                    }
                });
            }
        });
    });
    </script>
    <script type="text/javascript">
    $(function() {
        $('select').selectpicker();
    });
    </script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- End of Content -->
</body>

</html>