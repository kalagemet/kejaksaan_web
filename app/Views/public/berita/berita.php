<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>
<link href=<?php echo base_url("assets/css/datepicker.min.css"); ?> rel="stylesheet">

<body>
    <?php echo view('public/layout/navigation');?>
    <main id="main">
        <!-- Content -->
        <?php echo view('public/berita/header');?>
        <section id="berita" class="berita">
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
                                placeholder="cari artikel..." aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                        </form>
                    </div>
                </nav>
                <section id="details" class="details">
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
                        foreach( $data as $i => $row){
                        echo '<div class="row content">
                            <div class="col-md-4 img-wrap" data-aos="fade-right">
                                <a href="'.base_url('/berita')."/".$row['post_name'].'" >
                                    <img  style="height: 200px; width: 100%; object-fit: cover;" src="'.$row['thumbnail'].'" onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" class="img-fluid" alt="" />
                                </a>
                            </div>
                            <div class="col-md-8 pt-4" data-aos="fade-up">
                                <a href="'.base_url('/berita')."/".$row['post_name'].'" ><h3 style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                ">'.$row['post_title'].'</h3></a>
                                <p class="fst-italic">
                                    '.$row['tanggal'].'
                                </p>
                                <p style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 5;
                                    -webkit-box-orient: vertical;
                                ">
                                    '.$row['post_title'].'
                                </p>
                            </div>
                        </div>';
                        }?> </div>
                </section>
                <!-- Pagination -->
                <?= $pager->links('berita','bootstrap_pagination') ?>
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