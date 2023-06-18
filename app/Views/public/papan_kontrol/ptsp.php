<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>

<body>
    <div class="container-fluid">
        <!-- <button
            style="position: fixed; display: block; width: 100%; height:100%; background:transparent; border: none;z-index: 1111;"
            onClick="requestFullScreen()"></button> -->

        <!-- Galeri slider -->
        <div id="tab_1" class="body">
            <!-- Carousel wrapper -->
            <?php $awal = count($slider_display);?>
            <div id="dynamic_slide_show" class="carousel slide carousel-fade"
                data-interval="<?php echo ($awal>0 ? $timeout[0]->value/$awal: $timeout[0]->value/2);?>">
                <!-- Inner -->
                <div class="carousel-inner">
                    <?php foreach($slider_display as $i => $row){
                        echo '<div class="carousel-item item'.($i == 0 ? ' active"':'"').'>';
                        if($row->type == "video")
                        echo '<video id="video_show" class="img-fluid item-img" onplay="beforeVideo()" onended="afterVideo()" autoplay="autoplay" muted="true">
                            <source src="'.base_url("media/upload/".$row->value).'" type="video/mp4" />
                        </video>';
                        else echo '<div class="item-img" style="background: url(\''.base_url("media/upload/".$row->value).'\'), url(\''.base_url("assets/img/no-image.svg").'\');"></div></div>';
                    } 
                    foreach($post_ig as $i => $row){
                        echo '<div class="carousel-item item">';
                        if($row->media_type == "VIDEO")
                        echo '<video id="video_show" class="img-fluid item-img" onplay="beforeVideo()" onended="afterVideo()" autoplay muted>
                            <source src="'.$row->media_url.'" type="video/mp4" />
                        </video>';
                        else echo '<div class="item-img" style="background: url(\''.$row->media_url.'\'), url(\''.base_url("assets/img/no-image.svg").'\');"></div></div>';
                    }?>
                </div>
                <!-- Inner -->
            </div>
            <!-- Carousel wrapper -->
        </div>
    </div>
    <!-- end of galleri slider -->
    <!-- Content here -->
    <div class=" top-header">
        <p id="date"> </p>
        <p style="text-align:end;" id="time"> </p>
    </div>
    <div class="running">
        <img class="logo_footer left" alt="" src=<?php echo base_url('/assets/img/Logo_BerAKHLAK.png');?> />
        <img class="logo_footer right" alt="" src=<?php echo base_url('/assets/img/Logo_EVP.png');?> />
        <div class="main-runtext">
            <marquee direction="">
                <div class="holder">
                    <div class="text-container">
                        <p>
                            <?php if(isset($running_text)) echo $running_text[0]->value; ?>
                        </p>
                    </div>
                </div>
            </marquee>
        </div>
    </div>

    <!-- sidang Table -->
    <div id="tab_2" class="body">
        <div style="height: 10px;"></div>
        <h1 class="h1">KEJAKSAAN NEGERI BOALEMO</h1>
        <h2>JADWAL SIDANG BULAN INI</h2>
        <div class="tableDuk">
            <table id="tabel_duk">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Sidang</th>
                        <th>Nama Terdakwa</th>
                        <th>Agenda Sidang</th>
                        <th>Pasal</th>
                        <th>Penuntut Umum</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d){
                            echo '<tr key='.$i.'>
                                <td class="">'.($i+1).'</td>
                                <td class="left elipsis">'.$d->tanggal.'</td>
                                <td class="elipsis">'.$d->terdakwa.'</td>
                                <td class="elipsis">'.$d->agenda.'</td>
                                <td class="elipsis">'.$d->pasal.'</td>
                                <td class="left elipsis">'.$d->jaksa.'</td>
                                <td class="elipsis">'.$d->lokasi_sidang.'</td>
                                <td class="elipsis">'.$d->keterangan.'</td>
                            </tr>';
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end of -->

    <!-- sidang hari ini -->
    <div id="tab_3" class="body sidangHariini" style="background-color:white;height:100%">
        <div style="height: 100px;"></div>
        <div class="container">
            <div class="row">
                <div
                    class="col-lg-8 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1">
                    <div>
                        <br />
                        <?php foreach($now as $i => $d){
                                echo "<h3>$d->agenda</h3>
                                <h4 style='color:green;'>$d->lokasi_sidang - $d->tanggal</h4>
                                terdakwa <h5>$d->terdakwa</h5>
                                <p style='color: yellowgreen'>$d->keterangan - $d->pasal</p>
                                Jaksa Penuntut Umum:<h5> $d->jaksa</h5>
                                <div class=\"divider\" ></div>";
                            } ?>
                    </div>
                </div>
                <div class="col-lg-4 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img">
                    <h1>JADWAL SIDANG</h1>
                    <h2>Agenda Sidang Hari ini</h2>
                    <img src="<?php echo base_url("assets/img/jadwal_sidang_header.svg");?>" class="img-fluid" alt="">
                </div>
            </div>
        </div>
        <div style="height: 100px;"></div>
    </div>
    <!-- end of -->

    </div>

    <script type="text/javascript">
    function displayDateTime() {
        var now = new Date();
        var options = {
            timeZone: 'Asia/Singapore',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: false
        };
        var timeString = now.toLocaleString('id-ID', options);
        var gmtOffset = now.getTimezoneOffset() / -60;
        var gmtText = "GMT" + (gmtOffset >= 0 ? "+" : "") + gmtOffset;
        options = {
            timeZone: 'Asia/Singapore',
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour12: false
        };
        var dateString = now.toLocaleString('id-ID', options);
        document.getElementById('time').textContent = gmtText + " : " + timeString;
        document.getElementById('date').textContent = dateString;
    }
    // Memperbarui tanggal dan waktu setiap detik
    setInterval(displayDateTime, 1000);

    var timeoutId;
    var remainingTime = 0; // Variabel untuk menyimpan waktu sisa timeout
    var index = 0;
    var timeout = <?php echo $timeout[0]->value; ?>;

    function activeTab(loop) {
        var tabs = ['tab_1', 'tab_3', 'tab_2'];
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("body");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(tabs[index]).style.display = "block";

        if (loop) {
            if (index < 2) {
                index = index + 1;
            } else {
                timeoutId = setTimeout(() => location.reload(), timeout + 5000 - remainingTime);
            }
            resumeTimeout();
        }

        if (index == 1) anim(timeout);
        else if (index == 2) anim_table(timeout);
    }

    function pauseTimeout() {
        clearTimeout(timeoutId);
        remainingTime = Date.now() - (new Date().getTime() - timeoutId);
    }

    function resumeTimeout() {
        timeoutId = setTimeout(() => activeTab(true), timeout + 5000 - remainingTime);
    }

    $(document).ready(function() {
        activeTab(true);
        $('.carousel').carousel('cycle');
    });
    var timeoutId;

    function beforeVideo() {
        $('.carousel').carousel('pause');
        pauseTimeout();
    }

    function afterVideo() {
        $('.carousel').carousel('next');
        $('.carousel').carousel('cycle');
        var video = document.getElementById("video_show");
        video.currentTime = 0;
        resumeTimeout();
    }

    var $e = $(".tableDuk");
    var $el = $(".sidangHariini");

    function anim_table(timeout) {
        $el.stop();
        var st = $e.scrollTop();
        var sb = $e.prop("scrollHeight") - $e.innerHeight();
        $e.animate({
            scrollTop: st < sb / 2 ? sb : 0
        }, timeout / 2, () => anim_table(timeout));
    };

    function anim(timeout) {
        $e.stop();
        var st = $el.scrollTop();
        var sb = $el.prop("scrollHeight") - $el.innerHeight();
        $el.animate({
            scrollTop: st < sb / 2 ? sb : 0
        }, timeout, () => anim(timeout));
    }

    function requestFullScreen() {
        var element = document.body; // Make the body go full screen.
        // Supports most browsers and their versions.
        var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element
            .mozRequestFullScreen || element.msRequestFullScreen;
        if (requestMethod) { // Native full screen.
            requestMethod.call(element);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
            // } else {
            //     if (document.exitFullscreen) {
            //         document.exitFullscreen();
            //     } else if (document.webkitExitFullscreen) { /* Safari */
            //         document.webkitExitFullscreen();
            //     } else if (document.msExitFullscreen) { /* IE11 */
            //         document.msExitFullscreen();
            //     }
        }
    }
    </script>
</body>

</html>