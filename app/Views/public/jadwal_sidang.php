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
                                Jaksa Penuntut Umum:<h5> $d->jaksa</h5>";
                            } ?>
                            <!-- <td class='sorting_1'>$d->tanggal</td>
                                            <td class='sorting_1'>$d->terdakwa</td>
                                            <td class='sorting_1'>$d->agenda</td>
                                            <td class='sorting_1'>$d->pasal</td>
                                            <td class='sorting_1'>$d->jaksa</td>
                                            <td class='sorting_1'>$d->keterangan</td> -->
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
            <h2>Agenda Sidang pada Bulan <?php echo $nama_bulan; ?></h2><br />
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable tabel_duk" id="dataTable" width="100%"
                                cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Tanggal Sidang: activate to sort column descending">Tanggal
                                            Sidang</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Nama Terdakwa: activate to sort column descending">Nama Terdakwa
                                        </th>
                                        <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                            aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Agenda Sidang: activate to sort column descending">Agenda Sidang
                                        </th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Pasal: activate to sort column descending">Pasal
                                        </th>
                                        <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                            aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Jaksa Penuntut Umum: activate to sort column descending">
                                            Penuntut Umum
                                        </th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Lokasi: activate to sort column descending">
                                            Lokasi</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Keterangan: activate to sort column descending">
                                            Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $i => $d){
                                        echo "<tr class='".(($i%2==1)?'odd':'even')."'>
                                            <td class='sorting_1'>$d->tanggal</td>
                                            <td class='sorting_1'>$d->terdakwa</td>
                                            <td class='sorting_1'>$d->agenda</td>
                                            <td class='sorting_1'>$d->pasal</td>
                                            <td class='sorting_1'>$d->jaksa</td>
                                            <td class='sorting_1'>$d->keterangan</td>
                                        </tr>";
                                    } ?>
                                </tbody>
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
    // Call the dataTables jQuery plugin
    $(function() {
        $(' #dataTable').DataTable();
    });
    </script>
    <?php echo view('public/layout/footer');?>
</body>

</html>