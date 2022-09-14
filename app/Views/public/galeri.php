<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>
<link href=<?php echo base_url("assets/css/datepicker.min.css"); ?> rel="stylesheet">

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
                            <h1>Galeri</h1>
                            <h2>Galeri foto Kejaksaan Negeri Boalemo</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src="<?php echo base_url("assets/img/gallery_header.svg");?>" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

        </section>
        <!-- End Hero -->
        <section id="galeri" class="galeri">
            <div class="container-fluid">
                <nav class="navbar navbar-light bg-light justify-content-between">
                    <div class="container">
                        <form action="" method="GET" class="input-append form-inline">
                            <?php if(isset($filter_string)) echo '<input type="hidden" name="filter_string" value="'.$filter_string.'"/>'; ?>
                            <input name="filter_" <?php if(isset($filter_)) echo "value='$filter_'"; ?> type="search"
                                placeholder="filter tanggal..." class="form-control" name="datepicker"
                                id="datepicker" />
                            <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i
                                    class="bx bxs-calendar"></i></button>
                        </form>
                        <form action="" method="GET" class="form-inline">
                            <?php if(isset($filter_)) echo '<input type="hidden" name="filter_" value="'.$filter_.'"/>'; ?>
                            <input class="form-control mr-sm-2" type="search" name="filter_string"
                                <?php if(isset($filter_string)) echo "value='$filter_string'"; ?>
                                placeholder="cari gambar..." aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                        </form>
                    </div>
                </nav>
                <br />
                <br />
                <div class="container">
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
                    echo '<div class="card-container col-xl-7">';
                        foreach($data as $row){
                        echo '<div class="card-card">
                            <div class="card-head-card">
                                <img onerror="this.src=`'.base_url("assets/img/no-image.svg").'`"
                                    src="'.base_url("assets/img/gallery/".$row['path']).'" alt="">
                            </div>
                            <div class="card-body-card">
                                <h4>'.$row['judul'].'</h4>
                                <p><i>'.$row['tgl'].' - '.$row['keterangan'].'</i></p>
                                <p><a href="'.base_url("assets/img/gallery/".$row['path']).'" class="btn btn-primary gallery-lightbox"
                                        data-gall="gallery-carousel" role="button">Perbesar</a></p>
                            </div>
                        </div>';
                        }?>
                </div>
            </div>
            </div>
            <!-- Pagination -->
            <?= $pager->links('galeri','bootstrap_pagination') ?>
            </div>
        </section>
        <!-- End of Content -->
    </main>
    <?php echo view('public/layout/footer');?>
    <script src=<?php echo base_url("assets/js/bootstrap-datepicker.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/bootstrap.min.js"); ?>></script>
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