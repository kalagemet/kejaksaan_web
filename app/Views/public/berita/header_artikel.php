  <!-- ======= Hero Section ======= -->
  <section style="padding-top:50px;" id="hero" class="d-flex align-items-center">
      <div class="container">
          <div data-aos='fade-up' class="alert alert-warning" role="alert">
              <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                  <ol style="margin:0" class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                      <li class="breadcrumb-item"><a href="/berita">Berita</a></li>
                      <li style="width:80%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                          class="breadcrumb-item active" aria-current="page">
                          <?php echo $data[0]->post_title;?></li>
                  </ol>
              </nav>
          </div>
          <div class="row">
              <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1"
                  data-aos="fade-up">
                  <div>
                      <h1><?php echo $data[0]->post_title; ?></h1>
                      <h2>Berita Pada <?php echo $data[0]->post_date; ?></h2>
                  </div>
              </div>
              <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img text-center"
                  data-aos="fade-up">
                  <img src="<?php echo $data[0]->post_header; ?>"
                      onerror="this.src=`<?php echo base_url('assets/img/no-image.svg');?>`"
                      class="img-fluid header-img" alt="">
              </div>
          </div>
      </div>

  </section>
  <!-- End Hero -->