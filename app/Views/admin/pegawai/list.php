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
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="No.: activate to sort column descending">No.</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Nama: activate to sort column descending">Nama</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="NIP/NRP: activate to sort column ascending">
                                                NIP/NRP</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Jabatan: activate to sort column ascending">
                                                Jabatan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Pangkat: activate to sort column ascending">
                                                Pangkat
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Status: activate to sort column ascending">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data as $i => $d){
                                            echo '<tr class="'.(($i%2==1)?'odd':'even').'">
                                                <td class="sorting_1">'.($i+1).'</td>
                                                <td class="sorting_1">'.$d->nama.'</td>
                                                <td>'.$d->nip.'/'.$d->nrp.'</td>
                                                <td>'.$d->jabatan.'</td>
                                                <td>'.$d->pangkat.'-'.$d->golongan.'</td>
                                                <td>'.$d->status.'</td>
                                            </tr>';
                                        }?>
                                        <!-- id_pegawai":
                                        ,"nama":"AHMAD MUCHLIS, S.H., M.H.",
                                        "nip":"197808022005011010",
                                        "nrp":"60578232",
                                        "tmt_pns":"2005-01-01",
                                        "karpeg":"NO.M.099146",
                                        "pangkat":"Jaksa Madya",
                                        "golongan":"IV\/a",
                                        "eselon":"III.a",
                                        "tmt_pangkat":"2018-10-01",
                                        "tmt_satker":"2021-03-02",
                                        "nama_gelar":"Magister",
                                        "jurusan":"Hukum",
                                        "asal_sekolah":"UNIVERSITAS LAMPUNG",
                                        "status":"JAKSA" -->
                                    </tbody>
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
    // Call the dataTables jQuery plugin
    $(function() {
        $('#dataTable').DataTable();
    });
    </script>
    <?php echo view('admin/layout/footer');?>
</body>

</html>