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
                            <h1>JADWAL SIDANG</h1>
                            <h2>Agenda Sidang Hari ini</h2>
                            <?php foreach($now as $i => $d){
                                echo "<h3>$d->agenda</h3>
                                <h4 style='color:green;'>$d->lokasi_sidang - $d->tanggal</h4>
                                terdakwa <h5>$d->terdakwa</h5>
                                <p style='color: yellowgreen'>$d->keterangan - $d->pasal</p>
                                Jaksa Penuntut Umum:<h5> $d->jaksa</h5>
                                <div class=\"divider\" ></div>";
                            } ?>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src="<?php echo base_url("assets/img/jadwal_sidang_header.svg");?>" class="img-fluid"
                            alt="">
                    </div>
                </div>
            </div>

        </section>
        <!-- End Hero -->
        <div class="container">
            <h2>Agenda Sidang pada Bulan ini</h2><br />
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered tabel_duk" id="dataTable" cellspacing="0"
                                role="grid">
                                <thead>
                                    <tr>
                                        <th>Tanggal Sidang</th>
                                        <th>Nama Terdakwa</th>
                                        <th>Agenda Sidang</th>
                                        <th>Pasal</th>
                                        <th>Penuntut Umum</th>
                                        <th>Lokasi</th>
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
                "url": "<?php echo base_url('jadwal-sidang-pidum'); ?>",
                "type": "POST",
            },
            "columns": [{
                "data": "tanggal",
                "sortable": true
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