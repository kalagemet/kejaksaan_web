<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>
<link href=<?php echo base_url("assets/css/struktur.css"); ?> rel="stylesheet">

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
                            <h1>Struktur Organisasi</h1>
                            <h2>Kejaksaan Negeri Boalemo</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                        data-aos="fade-up">
                        <img src=<?php echo base_url("assets/img/tentang-struktur.svg");?> class="img-fluid" alt="">
                    </div>
                </div>
            </div>

        </section>
        <!-- End Hero -->
        <section id="struktur_chart" class="d-flex align-items-center">
            <div id="wrapper">
                <div id="container">
                    <ol class="organizational-chart">
                        <li>
                            <?php foreach($data as $r){
                                if($r->struktur==1) echo '<div data-aos="fade-right">
                                    <img style="height:150px;width: 100px;object-fit:cover;border-radius: 10px;margin: -90px 0px 28px 0px;" onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" src="'.base_url("assets/img/pegawai/".$r->nip.'.jpeg').'" class="testimonial-img" alt="" />
                                    <h4>'.$r->nama_jabatan.'</h4>
                                    <p class="center">'.$r->nama.'<br/>'.$r->nama_pangkat.'<br/>NRP : '.$r->nrp.
                                    '<br/>TMT SATKER :'.$r->tmt.'</p>
                                </div>';
                            }
                            echo '<ol>';
                                foreach($data as $r){
                                if($r->struktur>1 && $r->struktur<8){ echo '
                                <li>
                                    <div data-aos="fade-right">
                                        <img style="height:140px;width: 100px;object-fit:cover;border-radius: 10px;margin: 0px 0px 28px 0px;" onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" src="'.base_url("assets/img/pegawai/".$r->nip.'.jpeg').'" class="testimonial-img" alt="" />
                                        <p class="center"><b>'.$r->nama_jabatan.'</b><br/></p><p>'.$r->nama.'<br/>'.$r->nama_pangkat.'<br/>NRP : '.$r->nrp.'</p>
                                    </div>';
                                        $tmp = true;
                                        foreach($data as $d){
                                        if($d->struktur[0] === $r->struktur && $d->struktur > 10){ 
                                        if($tmp) echo '<ol>';
                                        echo '
                                        <li>
                                            <div data-aos="fade-right">
                                                <img style="height:140px;width: 100px;object-fit:cover;border-radius: 10px;margin: 0px 0px 28px 0px;" onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" src="'.base_url("assets/img/pegawai/".$d->nip.'.jpeg').'" class="testimonial-img" alt="" />
                                                <p class="center"><b>'.$d->nama_jabatan.'</b><br/></p><p>'.$d->nama.'<br/>'.$d->nama_pangkat.'<br/>NRP : '.$d->nrp.
                                                '<br/>TMT SATKER :'.$d->tmt.'</p>
                                            </div>
                                        </li>';$tmp=false;}}
                                    echo '</ol>
                                </li>';
                                }}
                            echo '</ol>';?>
                            <br />
                        </li>
                    </ol>
                    <ol class="organizational-chart">
                        <li>
                            <div data-aos="fade-right">
                                <h4>Kelompok Jabatan Fungsional</h4>
                            </div>
                            <ol>
                                <?php foreach($data as $r){
                                if($r->struktur==8){ echo ' 
                                <li style="display:flex;justify-content:center;">
                                    <div style="width:fit-content" data-aos="fade-right">
                                        <img style="height:140px;width: 100px;object-fit:cover;border-radius: 10px;margin: 0px 0px 28px 0px;"
                                            onerror="this.src=`'.base_url(" assets/img/no-image.svg").'`"
                                            src="'.base_url(" assets/img/pegawai/".$r->nip.'.jpeg').'"
                                        class="testimonial-img" alt="" />
                                        <p class="center"><b>'.$r->nama_jabatan.'</b><br /></p>
                                        <p>'.$r->nama.'<br />'.$r->nama_pangkat.'<br />NRP : '.$r->nrp.'</p>
                                    </div>
                                </li>';
                                }} ?>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End of Content -->
    </main>
    <?php echo view('public/layout/footer');?>
</body>

</html>