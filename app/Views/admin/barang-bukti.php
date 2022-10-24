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
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
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
                                                aria-label="Tgl / No Putusan: activate to sort column descending">Tgl /
                                                No
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
                                            <th rowspan="1" colspan="1">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($daftar as $i => $d){
                                            echo "<tr class='".(($i%2==1)?'odd':'even')."'>
                                                <td class='sorting_1'>$d->register_barang</td>
                                                <td class='sorting_1'>$d->jenis</td>
                                                <td class='sorting_1'>$d->register_perkara</td>
                                                <td class='sorting_1'>$d->tgl_putusan - $d->no_putusan</td>
                                                <td class='sorting_1'>$d->terdakwa</td>
                                                <td class='sorting_1'>$d->amar_putusan</td>
                                                <td class='sorting_1'>$d->keterangan</td>
                                                <td class='sorting_1'>
                                                    <a href=".base_url('cms/set-barang-bukti/'.$d->id_barang)." class='btn btn-".($d->is_release? 'secondary':'primary')." btn-circle btn-sm'><i class='fas fa-eye'></i></a>
                                                    <a href=".base_url('cms/delete-barang-bukti/'.$d->id_barang)." class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></a>
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
    // $("#inputTag").tagsinput('items');
    </script>
    <script src=<?php echo base_url("assets/js/bootstrap-tagsinput.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/bootstrap-tagsinput.min.js"); ?>></script>

</body>

</html>