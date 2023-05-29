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
                            <h1>Pengelola Barang Bukti</h1>
                            <h2>Daftar Barang Bukti pada Kejaksaan Negeri Boalemo</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src="<?php echo base_url("assets/img/barang-bukti-header.svg");?>" class="img-fluid"
                            alt="">
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
            <div class="row">
                <div data-aos='fade-right' class="col-lg-12 d-lg-flex flex-lg-column">
                    <?php
                        echo (!isset($not_found) or !$not_found) ? $page[0]->post_content : '';
                        if(isset($page[0]->post_date)){
                            echo "<div style='
                                margin-top:40px;
                                margin-bottom:40px;
                                font-style: italic;
                                color: darkgray;
                            '>Dibuat dan atau diperbarui pada : ".$page[0]->post_date."</div>";
                            echo view('public/berita/sharingbuttons');
                        }?>
                </div>
            </div>
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
            }],
            "searching": false,
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