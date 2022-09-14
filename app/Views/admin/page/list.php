<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>
<link href=<?php echo base_url("assets/css/datepicker.min.css"); ?> rel="stylesheet">

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Halaman</h1>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <form action="" method="GET" class="input-append form-inline">
                    <?php if(isset($filter_string)) echo '<input type="hidden" name="filter_string" value="'.$filter_string.'"/>'; ?>
                    <input name="filter_" <?php if(isset($filter_)) echo "value='$filter_'"; ?> type="search"
                        placeholder="filter tanggal..." class="form-control" name="datepicker" id="datepicker" />
                    <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i
                            class="bx bxs-calendar"></i></button>
                </form>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <form action="" method="GET" class="form-inline">
                    <?php if(isset($filter_)) echo '<input type="hidden" name="filter_" value="'.$filter_.'"/>'; ?>
                    <input class="form-control mr-sm-2" type="search" name="filter_string"
                        <?php if(isset($filter_string)) echo "value='$filter_string'"; ?> placeholder="cari halaman..."
                        aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                </form>
            </div>
        </div>
        <?php if(isset($filter_title)) echo '<p style="
            font-size: larger;
            text-align: end;
            font-weight: 600;
            font-style: italic;
        ">'.$filter_title.'</p>';
        if(count($data)<1) echo '<p style="
            font-size: larger;
            text-align: center;
            font-weight: 600;
        ">Tidak Ada Data untuk Ditampilkan</p>';
        foreach($data as $i => $r){
            echo '<div class="card shadow mb-4">
                <div class="card-header">
                    Judul Halaman : '.$r['post_title'].'
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-4 mb-1">
                            <p>Page Created : '.$r['tanggal'].'</p>
                            <p>Page Status : <b style="color:'.($r['post_status']==='publish' ? "green":"red").'">'.$r['post_status'].'</b></p>
                            '.($r['post_status']==='publish' ? '<a href="'.base_url('cms/set-post-status/'.$r['id_post']).'" class="btn btn-secondary btn-icon-split">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Hide Page</span>
                            </a>' : '
                            <a href="'.base_url('cms/set-post-status/'.$r['id_post']).'" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Show Page</span>
                            </a>').'
                        </div>
                        <div class="col-xl-6 col-md-4 mb-1">
                            <p>Page Modified : '.$r['post_edit'].'</p>
                            <p>Page URL : <a href="'.base_url('page/'.$r['post_name']).'">'.base_url('page/'.$r['post_name']).'</a></p>
                            <a href="'.base_url('cms/update_page?id='.$r['id_post']).'&page='.$r['post_title'].'" class="btn btn-warning btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>';
        }
        ?>
        <?= $pager->links('halaman','bootstrap_pagination') ?>
    </div>
    <?php echo view('admin/layout/footer');?>
    <script src=<?php echo base_url("assets/js/bootstrap-datepicker.min.js"); ?>></script>
    <script type="text/javascript">
    $(function() {
        $("#datepicker").datepicker({
            format: "mm-yyyy",
            startView: "months",
            minViewMode: "months"
        });
    });
    </script>
</body>

</html>