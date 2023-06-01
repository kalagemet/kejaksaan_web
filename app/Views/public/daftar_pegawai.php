<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>

<body>
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
                            <h1>Daftar Urut Kepangkatan</h1>
                            <h2>Pegawai Kejaksaan Negeri Boalemo</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src="assets/img/duk_header.svg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

        </section>
        <!-- End Hero -->
        <div class="container">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered tabel_duk" id="dataTable" cellspacing="0"
                                role="grid">
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
            <br />
            <br />
            <!-- <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <form method="post" action=<?php echo base_url('/daftar-urut-kepangkatan');?>
                            class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" name="_token" placeholder="Password"><br />
                                <input type="text" class="form-control" name="username" placeholder="Password"><br />
                                <input type="password" class="form-control" name="password"
                                    placeholder="Password"><br />
                                <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <br />
            <br />
        </div>
        <!-- End of Content -->
    </main>
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
                "data": "no",
                "sortable": false
            }, {
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
    <?php echo view('public/layout/footer');?>
</body>

</html>