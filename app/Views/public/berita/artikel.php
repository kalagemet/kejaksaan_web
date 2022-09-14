<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>

<body>
    <?php echo view('public/layout/navigation');?>
    <main id="main">
        <!-- Content -->
        <section id="artikel">
            <?php echo (!isset($not_found) or !$not_found) ? view('public/berita/header_artikel'): "<br/><br/>";?>
            <div class="container">
                <div class="row">
                    <div data-aos='fade-right' class="col-lg-8 d-lg-flex flex-lg-column">
                        <?php echo (!isset($not_found) or !$not_found) ? $data[0]->post_content : view('errors/html/404.php',$data); 
                        if(isset($data[0]->post_date)){
                            echo "<div style='
                                margin-top:40px;
                                margin-bottom:40px;
                                font-style: italic;
                                color: darkgray;
                            '>Dibuat dan atau diperbarui pada : ".$data[0]->post_date."</div>";
                            echo view('public/berita/sharingbuttons');
                        }?>
                    </div>
                    <div class="col-lg-4 d-lg-flex flex-lg-column">
                        <div class="side-pane">
                            <?php echo view('public/berita/side');?>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End of Content -->
    </main>
    <?php echo view('public/layout/footer');?>
</body>

</html>