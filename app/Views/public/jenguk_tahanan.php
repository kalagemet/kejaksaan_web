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
                            <h1>Izin Besuk Tahanan</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src="<?php echo base_url("assets/img/jenguk_tahanan.svg");?>" class="img-fluid"
                            alt="">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div data-aos='fade-right' class="col-lg-12 d-lg-flex flex-lg-column">
                        <?php
                            echo (!isset($not_found) or !$not_found) ? $page[0]->post_content : '';
                            if(isset($page[0]->post_date)){
                                echo "<div style='
                                    margin-top:40px;
                                    margin-bottom:40px;
                                    font-style: italic;
                                    color: darkgray;
                                '>Dibuat dan atau diperbarui pada : ".$page[0]->post_date."</div>";
                                echo view('public/berita/sharingbuttons');
                            }?>
                    </div>
                </div>
                <br />
                <br />
            </div>

        </section>
        <!-- End Hero -->
        <div class="container">
            
        </div>
        <!-- End of Content -->
    </main>
    <?php echo view('public/layout/footer');?>
</body>

</html>