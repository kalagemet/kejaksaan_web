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
                            <table class="table table-bordered dataTable tabel_duk" id="dataTable" width="100%"
                                cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting">No</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Register: activate to sort column descending">Register</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Jenis: activate to sort column descending">Jenis
                                        </th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="No Perkara: activate to sort column descending">No Perkara
                                        </th>
                                        <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                            aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Tgl / No Putusan: activate to sort column descending">Tgl / No
                                            Putusan
                                        </th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Terdakwa: activate to sort column descending">Terdakwa
                                        </th>
                                        <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                            aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Amar Putusan: activate to sort column descending">
                                            Amar Putusan
                                        </th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Keterangan: activate to sort column descending">
                                            Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $i => $d){
                                        echo "<tr class='".(($i%2==1)?'odd':'even')."'>
                                            <td class='sorting_1'>".($i+1)."</td>
                                            <td class='sorting_1'>$d->register_barang</td>
                                            <td class='sorting_1'>$d->jenis</td>
                                            <td class='sorting_1'>$d->register_perkara</td>
                                            <td class='sorting_1'>$d->tgl_putusan - $d->no_putusan</td>
                                            <td class='sorting_1'>$d->terdakwa</td>
                                            <td class='sorting_1'>$d->amar_putusan</td>
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
    // Call the dataTables jQuery plugin
    $(function() {
        $(' #dataTable').DataTable();
    });
    </script>
    <?php echo view('public/layout/footer');?>
</body>

</html>