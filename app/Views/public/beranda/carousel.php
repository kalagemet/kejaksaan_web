<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php foreach($header as $i => $d){
            echo '<li data-target="#myCarousel" data-slide-to="0" '.($i==0 ? 'class="active"' :'').'></li>';
        }?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php foreach($header as $i => $d){
            echo '<div class="item '.($i==0?'active':'').'">
                <img src="'.base_url('assets/img/'.$d->path).'" alt="Los Angeles">
            </div>';
        }?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only"></span>
    </a>
</div>