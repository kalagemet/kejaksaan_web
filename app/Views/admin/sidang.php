<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>
<!-- Latest compiled and minified CSS -->

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <!-- Begin Page Content -->
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Jadwal Sidang Pidum Bulan <?php echo $nama_bulan; ?></h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Tanggal Sidang: activate to sort column descending">Tanggal
                                                Sidang</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Nama Terdakwa: activate to sort column descending">Nama
                                                Terdakwa
                                            </th>
                                            <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                                aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Agenda Sidang: activate to sort column descending">Agenda
                                                Sidang
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Pasal: activate to sort column descending">Pasal
                                            </th>
                                            <th style='white-space: nowrap;' class="sorting sorting_asc" tabindex="0"
                                                aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Jaksa Penuntut Umum: activate to sort column descending">
                                                Jaksa Penuntut Umum
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Lokasi: activate to sort column descending">
                                                Lokasi</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Keterangan: activate to sort column descending">
                                                Keterangan</th>
                                            <th rowspan="1" colspan="1">
                                                Action</th>
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
                                            <td class='sorting_1'>$d->lokasi_sidang</td>
                                            <td class='sorting_1'>$d->keterangan</td>
                                            <td class='sorting_1'>
                                                <!-- <input type='button' class='btn btn-warning' value='edit' /> -->
                                                <a href=".base_url('cms/delete-sidang-pidum/'.$d->id_jadwal)." class='btn btn-danger'>Hapus</a>
                                            </td>
                                        </tr>";
                                    } ?>
                                    </tbody>
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
                <form method="post" action="add-sidang-pidum">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="tanggal">Waktu Sidang</label>
                            <input require value="<?php echo old('tanggal'); ?>" name="tanggal" type="datetime-local"
                                placeholder="tanggal sidang" class="form-control" id="tanggal" />
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="terdakwa">Nama Terdakwa:</label>
                            <input require type="text" value="<?php echo old('terdakwa'); ?>" name="terdakwa"
                                id="terdakwa" class="form-control small" placeholder="Isron dkk..." aria-label="Search"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="agenda">Agenda Sidang:</label>
                            <input require type="text" value="<?php echo old('agenda'); ?>" name="agenda" id="agenda"
                                class="form-control small" placeholder="Pemeriksaan Saksi..." aria-label="Search"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-1 col-md-6 mb-4">
                            <label for="pasal">Pasal:</label>
                            <input require type="text" value="<?php echo old('pasal'); ?>" name="pasal" id="pasal"
                                class="form-control small" placeholder="Pasal 170 KUHP..." aria-label="Search"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <label for="jaksa">Jaksa Penuntut Umum:</label>
                            <select id="jaksa" name="jaksa[]" class="select" multiple data-mdb-filter="true">
                                <?php foreach($jaksa as $i => $d){
                                    echo '<option value="'.$d->id_pegawai.'">'.$d->nama.'</option>';
                                }?>
                            </select>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <label for="lokasi">Lokasi:</label>
                            <input require type="text" value="<?php echo old('lokasi'); ?>" name="lokasi"
                                id="lokasi" class="form-control small" placeholder="PN - " aria-label="Search"
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
    </div>
    <?php echo view('admin/layout/footer');?>
    <script type="text/javascript">
    // Call the dataTables jQuery plugin
    $(function() {
        $('#dataTable').DataTable();
    });

    $(function() {
        $('select').selectpicker();
    });
    </script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- End of Content -->
</body>

</html>