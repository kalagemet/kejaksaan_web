  <section id="hero" class="d-flex align-items-center">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1"
                  data-aos="fade-up">
                  <div>
                      <h1><?php echo $data[0]->post_title; ?></h1>
                  </div>
              </div>
              <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                  data-aos="fade-up">
                  <img src="<?php echo $data[0]->post_header; ?>"
                      onerror="this.src=`<?php echo base_url('assets/img/page.svg');?>`" class="img-fluid header-img"
                      alt="">
              </div>
          </div>
      </div>
  </section>