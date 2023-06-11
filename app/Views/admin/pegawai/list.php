<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Pegawai</h1>
        <p class="mb-4">Data yang di input pada sistem adalah data publik yang nantinya akan di olah untuk data
            publikasi pada website</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-1">Filter</div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input value="semua" class="form-check-input" type="radio" name="filter_status"
                                        id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Semua
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="JAKSA" class="form-check-input" type="radio" name="filter_status"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Jaksa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="TU" class="form-check-input" type="radio" name="filter_status"
                                        id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Non Jaksa
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input value="semua" class="form-check-input" type="radio" name="filter_jabatan"
                                        id="flexRadioDefault5" checked>
                                    <label class="form-check-label" for="flexRadioDefault5">
                                        Semua
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="STRUKTURAL" class="form-check-input" type="radio"
                                        name="filter_jabatan" id="flexRadioDefault6">
                                    <label class="form-check-label" for="flexRadioDefault6">
                                        Struktural
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="FUNGSIONAL" class="form-check-input" type="radio"
                                        name="filter_jabatan" id="flexRadioDefault7">
                                    <label class="form-check-label" for="flexRadioDefault7">
                                        Fungsional
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="PELAKSANA" class="form-check-input" type="radio" name="filter_jabatan"
                                        id="flexRadioDefault8">
                                    <label class="form-check-label" for="flexRadioDefault8">
                                        Pelaksana
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input value="0" class="form-check-input" type="radio" name="filter_aktif"
                                        id="flexRadioDefault9" checked>
                                    <label class="form-check-label" for="flexRadioDefault9">
                                        Dinas Aktif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input value="1" class="form-check-input" type="radio" name="filter_aktif"
                                        id="flexRadioDefault10">
                                    <label class="form-check-label" for="flexRadioDefault10">
                                        Pindah
                                    </label>
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column-reverse; direction: rtl;padding:5px"
                                class="col-sm-2">
                                <button style="width: 100px" type="button" id="refreshButton"
                                    class="btn btn-sm btn-primary">Filter</button>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered tabel_duk" id="dataTable"
                                    cellspacing="0" role="grid">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jabatan</th>
                                            <th>Pangakat/Gol</th>
                                            <th>TMT</th>
                                            <th>Pendidikan</th>
                                            <th>Status</th>
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

    </div>
    <?php echo view('admin/layout/footer');?>
    <script type="text/javascript">
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
                "url": "<?php echo base_url('daftar-urut-kepangkatan'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.filter_status = $('input[name="filter_status"]:checked').val();
                    d.filter_jabatan = $('input[name="filter_jabatan"]:checked').val();
                    d.filter_aktif = $('input[name="filter_aktif"]:checked').val();
                }
            },
            "columns": [{
                "data": null,
                "sortable": false,
                "render": function(data, type, row, meta) {
                    // Menghasilkan nomor urut berdasarkan nomor halaman dan panjang halaman
                    var pageNumber = dataTable.page.info().page;
                    var pageLength = dataTable.page.info().length;
                    var index = meta.row + (pageNumber * pageLength) + 1;
                    return index;
                }
            }, {
                "data": "nama",
                "render": function(data, type, row, meta) {
                    return '<a href="/cms/detail_pegawai/' + row
                        .id_pegawai +
                        '">' + data + '</a>';
                }
            }, {
                "data": "jabatan",
                "render": function(data, type, row, meta) {
                    return '<a href="/cms/detail_pegawai/' + row
                        .id_pegawai +
                        '">' + data + '</a>';
                }
            }, {
                "data": "pangkat",
                "render": function(data, type, row, meta) {
                    return '<a href="/cms/detail_pegawai/' + row
                        .id_pegawai +
                        '">' + data + '</a>';
                }
            }, {
                "data": "tmt",
                "render": function(data, type, row, meta) {
                    return '<a href="/cms/detail_pegawai/' + row
                        .id_pegawai +
                        '">' + data + '</a>';
                }
            }, {
                "data": "pendidikan",
                "render": function(data, type, row, meta) {
                    return '<a href="/cms/detail_pegawai/' + row
                        .id_pegawai +
                        '">' + data + '</a>';
                }
            }, {
                "data": "status",
                "render": function(data, type, row, meta) {
                    return '<a href="/cms/detail_pegawai/' + row
                        .id_pegawai +
                        '">' + data + '</a>';
                }
            }],
            "searching": true,
            "paging": true,
            "lengthMenu": [10, 25, 50, 100],
            "pageLength": 10,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(Filter dari _MAX_ total data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
    //refresh
    $('#refreshButton').on('click', function() {
        $('#dataTable').DataTable().ajax.reload();
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
</body>

</html>