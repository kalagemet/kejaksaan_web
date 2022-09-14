<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials section-bg">
    <div class="container" data-aos="fade-up">
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                <?php foreach($pejabat as $d){
                    echo '<div class="swiper-slide">
                        <div class="testimonial-item">
                            <img style="height:110px; object-fit:cover;" onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" src="'.base_url("assets/img/pegawai/".$d->nip.'.jpeg').'" class="testimonial-img" alt="" />
                            <h3>'.$d->nama.'</h3>
                            <h4>'.$d->nama_pangkat.'</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                '.$d->nama_jabatan.'
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>';
                }?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<!-- End Testimonials Section -->