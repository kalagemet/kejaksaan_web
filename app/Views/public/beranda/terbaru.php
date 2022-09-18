<!-- ======= Post Section ======= -->
<section id="post" class="">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Terbaru</h2>
        </div>

        <div class="card-container col-xl-7">
            <?php foreach($berita_terbaru as $row){
            echo '<div class="card-card">
                <div class="card-head-card">
                    <img src="'.$row->thumbnail.'" onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" class="img-fluid" alt="" />
                </div>
                <div class="card-body-card">
                    <h4 style="
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                    ">'.$row->post_title.'</h4>
                    <i>
                        '.$row->tanggal.'
                    </i>
                    <p style="
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                    ">
                        '.$row->post_title.'
                    </p>
                    <a href="'.base_url('/berita')."/".$row->post_name.'" class="download-btn"></i>Lihat Berita</a>
                </div>
            </div>';
            }?>
        </div>

    </div>
</section>
<!-- End Gallery Section -->