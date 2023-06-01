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
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered tabel_duk" id="dataTable"
                                    cellspacing="0" role="grid">
                                    <thead>
                                        <tr>
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
    <script src=<?php echo base_url("assets/js/jquery-1.9.1.min.js"); ?>></script>
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
            },
            "columns": [{
                "data": "nama",
                "sortable": false
            }, {
                "data": "jabatan",
                "sortable": false
            }, {
                "data": "pangkat",
                "sortable": false
            }, {
                "data": "tmt",
                "sortable": false
            }, {
                "data": "pendidikan",
                "sortable": false
            }, {
                "data": "status",
                "sortable": false
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
    <?php echo view('admin/layout/footer');?>
</body>

</html>