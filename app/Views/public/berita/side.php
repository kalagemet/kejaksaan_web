<section id="side-panel">
    <?php $tag = array("btn-primary","btn-secondary","btn-success","btn-danger","btn-warning","btn-info","btn-dark");
    $random_key = array_rand($tag,3); ?>
    <div class="container-fluid">
        <div class="row no-gutters">
            <div style="text-align:center" class="col-lg box" data-aos="fade-right">
                <div id="myCarousel" style="height: 350px;border: 0;background-color: transparent; margin-bottom:40px"
                    data-aos="fade-up" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php
                        foreach($post_ig as $i => $d){
                            echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.($i==0 ? 'class="active"' :'').'></li>';
                        }
                        ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php
                        foreach($post_ig as $i => $d){
                            echo '<div class="item '.($i==0?'active':'').'">
                                <img style="border-radius: 19px;height:350px" src="'.$d->media_url.'" onerror="this.src=`'.base_url("assets/img/no-image.svg").'`">
                            </div>';
                        }?>
                    </div>
                    <div style="margin: 10px 0px"><a href="#">Kunjungi Instagram</a></div>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg box" data-aos="fade-right">
                <h4><span>Daftar Berita</span></h4>
                <div class="accordion-list">
                    <ul>
                        <?php foreach($count_year as $i => $r){
                        echo '<li data-aos="fade-up" data-aos-delay="100">
                            <a data-bs-toggle="collapse" data-bs-target="#accordion-list-'.($i+1).'" class="collapsed">'.$r->thn.'
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-'.($i+1).'" class="collapse" data-bs-parent=".accordion-list">';
                                foreach($count_month as $d){
                                    if($d->thn===$r->thn) echo '<a href="'.base_url('/berita?filter_='.$d->bln_num.'-'.$r->thn).'">'.$d->bln.' ('.$d->jml.')</a>';
                                }
                            echo '</div>
                        </li>';}?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg box" data-aos="fade-right">
                <h4><span>Berita Terbaru</span></h4>
                <?php foreach($berita_terbaru as $r){
                    echo '<a style="
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        -webkit-line-clamp: 1;
                        -webkit-box-orient: vertical;
                    " href="'.base_url('berita/'.$r->post_name).'"><i class="bx bx-check" ></i>'.$r->post_title.'<br/></a>';
                }?>
                <a href=<?php echo base_url('berita/'); ?> class="get-started-btn">Berita lainnya...</a>
                <br />
                <br />
                <?php $tag_color = array("btn-primary","btn-secondary","btn-success","btn-danger","btn-warning","btn-info","btn-dark");
                    if(!isset($not_found) or !$not_found){
                        echo "<h4>#<span>TAG</span></h4><h6>";
                        if(isset($tags) && $tags !==''){
                            foreach(explode(';',$tags) as $r){
                                echo '<button type="button" class="btn '.$tag_color[array_rand($tag_color,1)].' btn-sm">'.$r.'</button>';
                                echo '<a href="'.base_url('berita?tag='.$r).'" type="button" class="btn '.$tag_color[array_rand($tag_color,1)].' btn-sm">'.$r.'</a>';
                            }
                        }else{
                            echo '<p style="text-align: center;color:lightgray;"><i>Tidak ada tag pada artikel ini</i></p>';
                        }
                    }?>
                </h6>
            </div>
        </div>
    </div>
</section>