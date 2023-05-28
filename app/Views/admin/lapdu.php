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
                <h4 class="h4 mb-2 text-gray-800">Daftar Pengaduan Masyarakat Online</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="lapduTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th>Nama Pelapor</th>
                                            <th>Tiket</th>
                                            <th>Status</th>
                                            <th>Prioritas</th>
                                            <th>Tindakan Terakhir</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
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
        var dataTable = $('#lapduTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('cms/lapdu_v1'); ?>",
                "type": "POST",
            },
            "order": [
                [0, "DESC"]
            ],
            "columns": [{
                "data": "created_at",
                "render": function(data, type, row, meta) {
                    return '<a style="font-size:medium" href="/cms/lapdu_v1/' + row
                        .id_lapdu +
                        '">' + data + '</a>';
                }
            }, {
                "data": "kategori",
                "render": function(data, type, row, meta) {
                    return '<a style="font-size:medium" href="/cms/lapdu_v1/' + row
                        .id_lapdu +
                        '"><span class="badge badge-primary">' + data + '</span></a>';
                }
            }, {
                "data": "nama_pelapor",
                "render": function(data, type, row, meta) {
                    return '<a style="font-size:medium" href="/cms/lapdu_v1/' + row
                        .id_lapdu +
                        '">' + data + '</a>';
                }
            }, {
                "data": "tiket",
                "render": function(data, type, row, meta) {
                    return '<a style="font-size:medium" href="/cms/lapdu_v1/' + row
                        .id_lapdu +
                        '">#' + data + '</a>';
                }
            }, {
                "data": "status",
                "render": function(data, type, row, meta) {
                    return '<a style="font-size:medium" href="/cms/lapdu_v1/' + row
                        .id_lapdu +
                        '">' + data + '</a>';
                }
            }, {
                "data": "jenis",
                "render": function(data, type, row, meta) {
                    return '<a style="font-size:medium" href="/cms/lapdu_v1/' + row
                        .id_lapdu +
                        '">' + data + '</a>';
                }
            }, {
                "data": "tindakan",
                "render": function(data, type, row, meta) {
                    return '<a style="font-size:medium" href="/cms/lapdu_v1/' + row
                        .id_lapdu +
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
    $('#lapduTable').on('xhr.dt', function(e, settings, json) {
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