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
            <h1 class="h3 mb-0 text-gray-800">Edit Postingan</h1>
        </div>
        <div class="card mb-4">
            <form id="form_post" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input require type="hidden" value="<?php echo $data[0]->id_post; ?>" id="id_post" name="id_post" />
                <input require type="hidden" value="<?php echo $data[0]->post_header; ?>" id="old_photo"
                    name="old_photo" />
                <div class="card-header py-3">
                    <input require type="text"
                        value="<?php echo (old('judul') ? old('judul') : $data[0]->post_title); ?>" name="judul"
                        class="form-control small" placeholder="Judul Postingan" aria-label="Search"
                        aria-describedby="basic-addon2">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <input value="<?php echo (old('tanggal') ? old('tanggal') : $data[0]->post_date); ?>"
                                require name="tanggal" type="date" placeholder="Tanggal Postingan" class="form-control"
                                name="datepicker" id="datepicker" />
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <input require accept="image/*" id="header" name="header" type="file" placeholder="Header"
                                class="form-control" />
                            <img src="<?php echo $data[0]->post_header;?>"
                                style="max-height:200px;border-radius: 20px;margin: 20px;width: 80%;object-fit: cover;"
                                onerror="<?php echo 'this.src=`'.base_url("assets/img/no-image.svg");?>`"
                                class="img-fluid" alt="" />
                        </div>
                    </div>
                    <textarea name="content"
                        id="editor"><?php echo (old('content') ? old('content') : $data[0]->post_content); ?></textarea>
                    <br />
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <a href="javascript:{}"
                                onclick="document.getElementById('form_post').action='update-post/publish';document.getElementById('form_post').submit();"
                                type="submit" class="btn btn-success btn-icon-split btn-lg">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Update</span>
                            </a>
                            <a href="javascript:{}"
                                onclick="document.getElementById('form_post').action='update-post/draf';document.getElementById('form_post').submit();"
                                type="submit" class="btn btn-warning btn-icon-split btn-lg">
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Simpan Draf</span>
                            </a>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <input type="text" value="<?php echo (old('tags') ? old('tags') : $data[0]->tags); ?>"
                                id="#inputTag" name="tags" placeholder="Tag Postingan (enter)" data-role="tagsinput"
                                class="form-control  bootstrap-tagsinput">
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