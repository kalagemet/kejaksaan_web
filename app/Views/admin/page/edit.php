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
            <h1 class="h3 mb-0 text-gray-800">Edit Halaman</h1>
        </div>
        <div class="card mb-4">
            <form id="form_post" action="update-page" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input require type="hidden" value="<?php echo $data[0]->id_post; ?>" id="id_post" name="id_post" />
                <input require type="hidden" value="<?php echo $data[0]->post_header; ?>" id="old_photo"
                    name="old_photo" />
                <div class="card-header py-3">
                    <input require type="text"
                        value="<?php echo (old('judul') ? old('judul') : $data[0]->post_title); ?>" name="judul"
                        class="form-control small" placeholder="Judul Halaman" aria-label="Search"
                        aria-describedby="basic-addon2">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <img src="<?php echo $data[0]->post_header;?>"
                                style="max-height:200px;border-radius: 20px;margin: 20px;width: 80%;object-fit: cover;"
                                onerror="<?php echo 'this.src=`'.base_url("assets/img/page.svg");?>`" class="img-fluid"
                                alt="" />
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <input require accept="image/*" id="header" name="header" type="file" placeholder="Header"
                                class="form-control" />
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
                        <div class="col-xl-6 col-md-6 mb-4">
                            <input require type="text"
                                value="<?php echo (old('url') ? old('url') : $data[0]->post_name); ?>" name="url"
                                class="form-control small" placeholder="URL Halaman" aria-label="Search"
                                aria-describedby="basic-addon2">
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