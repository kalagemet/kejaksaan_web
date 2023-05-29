<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Daftar Barang Bukti</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0"
                                    role="grid">
                                    <thead>
                                        <tr>
                                            <th>Register</th>
                                            <th>Jenis</th>
                                            <th>Perkara</th>
                                            <th>Putusan</th>
                                            <th>Terdakwa</th>
                                            <th>Amar Putusan</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
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

        <div class="card shadow mb-4">
            <div class="card-body">
                <h3>Tambah Jadwal Baru</h3>
                <br />
                <form method="post" action="add-barang-bukti">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="tanggal">Tanggal Putusan:</label>
                            <input require value="<?php echo old('tgl_putusan'); ?>" name="tgl_putusan" type="date"
                                placeholder="tanggal putusan" class="form-control" id="tgl_putusan" />
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="tanggal">No Putusan:</label>
                            <input require value="<?php echo old('no_putusan'); ?>" name="no_putusan" type="text"
                                placeholder="Nomor putusan" class="form-control" id="no_putusan" />
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="register_barang">Register Barang:</label>
                            <input require type="text" value="<?php echo old('register_barang'); ?>"
                                name="register_barang" id="register_barang" class="form-control small"
                                placeholder="Nomor..." aria-label="Search" aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="jenis">Jenis:</label>
                            <input require type="text" value="<?php echo old('jenis'); ?>" name="jenis" id="jenis"
                                class="form-control small" placeholder="Sepeda Motor..." aria-label="Search"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="pasal">Reg Perkara:</label>
                            <input require type="text" value="<?php echo old('register_perkara'); ?>"
                                name="register_perkara" id="register_perkara" class="form-control small"
                                placeholder="Nomor..." aria-label="Search" aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="pasal">Terdakwa:</label>
                            <input require type="text" value="<?php echo old('terdakwa'); ?>" name="terdakwa"
                                id="terdakwa" class="form-control small" placeholder="Nama..." aria-label="Search"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="pasal">Amar Pu:</label>
                            <input require type="text" value="<?php echo old('amar_putusan'); ?>" name="amar_putusan"
                                id="amar_putusan" class="form-control small" placeholder="Amar..." aria-label="Search"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="keterangan">Keterangan:</label>
                            <input require type="text" value="<?php echo old('keterangan'); ?>" name="keterangan"
                                id="keterangan" class="form-control small" placeholder="-" aria-label="Search"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-12 col-md-6 mb-4 d-sm-flex"
                            style="text-align: right;display: inline-block !important;">
                            <input type='submit' class='btn btn-success' value='Tambah' />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Penjelasan Halaman</h1>
        </div>
        <div class="card mb-4">
            <form id="form_post" action="update-page" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input require type="hidden" value="<?php echo $data[0]->id_post; ?>" id="id_post" name="id_post" />
                <input require type="hidden" value="<?php echo $data[0]->post_name; ?>" name="url">
                <div class="card-header py-3">
                    <input require value="<?php echo $data[0]->post_title; ?>" name="judul" class="form-control small"
                        type="hidden">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <input require accept="image/*" id="header" name="header" type="file" style="display: none;"
                                placeholder="Header" class="form-control" />
                        </div>
                    </div>
                    <textarea name="content"
                        id="editor"><?php echo (old('content') ? old('content') : $data[0]->post_content); ?></textarea>
                    <br />
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <a href="javascript:{}" onclick="document.getElementById('form_post').submit();"
                                type="submit" class="btn btn-success btn-icon-split btn-lg">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
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
        var baseurl = "<?php echo base_url('cms'); ?>";
        var dataTable = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('barang-bukti'); ?>",
                "type": "POST",
            },
            "columns": [{
                "data": "register_barang",
                "sortable": true
            }, {
                "data": "jenis",
                "sortable": false
            }, {
                "data": "register_perkara",
                "sortable": false
            }, {
                "data": "putusan",
                "sortable": false
            }, {
                "data": "terdakwa",
                "sortable": false
            }, {
                "data": "amar_putusan",
                "sortable": false
            }, {
                "data": "keterangan",
                "sortable": false
            }, {
                "data": "id_barang",
                "sortable": false,
                "render": function(data, type, row, meta) {
                    return '<td class="sorting_1"><a href="' + baseurl +
                        '/set-barang-bukti/' + row.id_barang +
                        '" class="btn btn-' + (row.is_release == 1 ? "secondary" :
                            "primary") +
                        ' btn-circle btn-sm"><i class="fas fa-eye"></i> </a><a href ="' +
                        baseurl + '/delete-barang-bukti/' + row.id_barang +
                        '" class ="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>';
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
    <script src=<?php echo base_url("assets/js/bootstrap-tagsinput.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/bootstrap-tagsinput.min.js"); ?>></script>

</body>

</html>