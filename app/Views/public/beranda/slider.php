    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Galeri</h2>
                <p>Galeri kegiatan dan citra digital Kejaksaan Negeri Boalemo</p>
            </div>
        </div>

        <div class="container" data-aos="fade-up">
            <div class="gallery-slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach($galeri as $d){
                    echo '<div class="swiper-slide"><a href="'.base_url('assets/img/gallery/'.$d->path).'" class="gallery-lightbox"
                            data-gall="gallery-carousel"><img onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" src="'.base_url('assets/img/gallery/thumbnail/'.$d->path).'" class="img-fluid"
                                alt=""></a></div>';
                    }?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <!-- End Gallery Section -->