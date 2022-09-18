<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body id="page-top">
    <!-- Content -->
    <?php echo view('admin/layout/topbar');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">General Setting</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header">
                Home Carousel
            </div>
            <div class="card-body">
                <?php foreach($header as $i => $r){
                echo '<div class="row">
                        <div class="col-xl-6 col-md-4 mb-1">
                        <img src="'.base_url("assets/img/header/thumbnail/".$r->path).'"
                                style="max-height:100px;border-radius: 20px;margin: 20px;width: 80%;object-fit: cover;"
                                onerror="this.src=`'.base_url("assets/img/no-image.svg").'`"
                                class="img-fluid" alt="" />
                        </div>
                        <div class="col-xl-6 col-md-4 mb-1">
                            <p>Created : '.$r->created_at.'</p>
                            <p>Status : <b style="color:'.($r->is_show==='1' ? "green":"red").'">'.($r->is_show==='1' ? "Tampil":"Tidak Tampil").'</b></p>
                            '.($r->is_show==='1' ? '<a href="'.base_url('cms/set-carousel-show/'.$r->id_image).'" class="btn btn-secondary btn-icon-split">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Sembunyikan</span>
                            </a>' : '
                            <a href="'.base_url('cms/set-carousel-show/'.$r->id_image).'" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Tampilkan</span>
                            </a>').'
                            <a href="'.base_url('cms/delete-carousel/'.$r->id_image).'" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Hapus</span>
                            </a>
                        </div>
                    </div>';
                }?>
            </div>
            <div class="card-footer">
                <form id="form_post" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-xl-9 col-md-6 mb-4">
                            <input require accept="image/*" id="image" name="image" type="file"
                                placeholder="Upload Gambar Carousel" class="form-control" />
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="javascript:{}"
                                onclick="document.getElementById('form_post').action='save-carousel/publish';document.getElementById('form_post').submit();"
                                type="submit" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah</span>
                            </a>
                            <a href="javascript:{}"
                                onclick="document.getElementById('form_post').action='save-carousel/draf';document.getElementById('form_post').submit();"
                                type="submit" class="btn btn-warning btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php echo view('admin/layout/footer');?>
    <!-- End of Content -->
</body>

</html>