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
                            <table class="table table-bordered dataTable tabel_duk" id="dataTable" width="100%"
                                cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">No</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Nama: activate to sort column descending">Nama</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Jabatan: activate to sort column descending">Jabatan
                                        </th>
                                        <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                            aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Pangkat-Gol: activate to sort column descending">
                                            Pangkat-Gol
                                        </th>
                                        <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                            aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="TMT Satker: activate to sort column descending">TMT
                                            Satker</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Pendidikan: activate to sort column descending">
                                            Pendidikan</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Status: activate to sort column descending">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $i => $d){
                                        echo "<a href='#'>".'<tr class="'.(($i%2==1)?'odd':'even').'">'."
                                            <td class='sorting_1'>".($i+1)."</td>
                                            <td class='sorting_1'>$d->nama</td>
                                            <td class='sorting_1'>$d->jabatan</td>
                                            <td class='sorting_1'>$d->pangkat-$d->golongan</td>
                                            <td class='sorting_1'>$d->tmt_satker</td>
                                            <td class='sorting_1'>$d->nama_gelar $d->jurusan</td>
                                            <td class='sorting_1'>$d->status</td>
                                        </tr></a>";
                                        } ?>
                                </tbody>
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
    <style type="text/css">
    /* table {
        font-size 1vw;
    }

    table td {
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
    } */
    </style>
    <script type="text/javascript">
    // Call the dataTables jQuery plugin
    $(function() {
        $(' #dataTable').DataTable();
    });
    </script>
    <?php echo view('public/layout/footer');?>
</body>

</html>