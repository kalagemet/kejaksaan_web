<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Display</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <script src=<?php echo base_url("assets/js/jquery-3.1.0.min.js")?>></script>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/bootstrap.min.css"); ?>>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <script src=<?php echo base_url("assets/js/bootstrap-3.3.7.min.js");?>></script>

    <!-- Favicons -->
    <link href=<?php echo base_url("favicon.ico"); ?> rel="icon">
    <link href=<?php echo base_url("favicon.ico"); ?> rel="apple-touch-icon">

    <link href=<?php echo base_url("assets/css/display.css"); ?> rel="stylesheet">
</head>

<body>
    <!-- requestFullScreen -->
    <!-- <button style="position: fixed; display: block; width: 100%; height:100%; background:transparent; border: none;z-index: 1;" onClick="requestFullScreen()"></button> -->
    <div class="app">
        <!-- Galeri slider -->
        <div id="tab_1" class="body">
            <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <!-- <?php $awal = count($slider_display);
                    foreach($slider_display as $i => $row){
                        echo '<li data-target="#dynamic_slide_show" data-slide-to="'.$i.'" '.($i == 0 ? 'class="active"':'').'></li>';
                    }
                    foreach($slider_display as $i => $row){
                        echo '<li data-target="#dynamic_slide_show" data-slide-to="'.($awal+$i-1).'" '.($awal==0 && $i == 0 ? 'class="active"':'').'></li>';
                    }
                    ?> -->
                </ol>
                <div class="carousel-inner">
                    <?php $awal = count($slider_display);
                    foreach($slider_display as $i => $row){
                        echo '<div class="item'.($i == 0 ? ' active"':'"').'>';
                        echo '<img src="'.$row.'" alt="'.$row.'"  onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" /></div>';
                    } foreach($post_ig as $i => $row){
                        echo '<div class="item'.($awal==0 && $i == 0 ? ' active"':'"').'>';
                        echo '<img src="'.$row->media_url.'" alt=""  onerror="this.src=`'.base_url("assets/img/no-image.svg").'`" /></div>';
                        // <div class="carousel-caption">
                        //     <h3></h3>
                        // </div></div>';
                    }?>
                </div>
                <!-- <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a> -->
            </div>
        </div>
        <!-- end of galleri slider -->

        <!-- DUK Table -->
        <div id="tab_2" class="body">
            <img class="logo logo_left" alt="logo_kejaksaan"
                src=<?php echo base_url('/assets/img/kejaksaan_logo.svg');?> />
            <img class="logo logo_right" alt="logo_kejaksaan" src=<?php echo base_url('/assets/img/logo_g20.png');?> />
            <h1>DAFTAR URUTAN KEPANGKATAN</h1>
            <h2>KEJAKSAAN NEGERI BOALEMO</h2>
            <div class="tableDuk">
                <table id="tabel_duk">
                    <thead>
                        <tr>
                            <th class="">No.</th>
                            <th class="">Nama</th>
                            <th class="">NIP</th>
                            <th class="">NRP</th>
                            <th class="">TMT</th>
                            <th class="">Jabatan</th>
                            <th class="">No. Karpeg</th>
                            <th class="">Pangkat</th>
                            <th class="">Gol</th>
                            <th class="">Eselon</th>
                            <th class="">TMT</th>
                            <th class="">Pendidikan</th>
                            <th class="">Tempat</th>
                            <th class="">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $i => $d){
                            echo '<tr key='.$i.'>
                                <td class="">'.($i+1).'</td>
                                <td class="left elipsis">'.$d->nama.'</td>
                                <td class="elipsis">'.$d->nip.'</td>
                                <td class="elipsis">'.$d->nrp.'</td>
                                <td class="elipsis">'.$d->tmt_pns.'</td>
                                <td class="left elipsis">'.$d->jabatan.'</td>
                                <td class="elipsis">'.$d->karpeg.'</td>
                                <td class="elipsis">'.$d->pangkat.'</td>
                                <td class="elipsis">'.$d->golongan.'</td>
                                <td class="elipsis">'.$d->eselon.'</td>
                                <td class="elipsis">'.$d->tmt_pangkat.'</td>
                                <td class="elipsis">'.$d->nama_gelar.' '.$d->jurusan.'</td>
                                <td class="elipsis">'.$d->asal_sekolah.'</td>
                                <td class="elipsis">'.$d->status.'</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end of DUK -->

        <!-- Kehadiran -->
        <div id="tab_3" class="body">
            <img class="logo logo_left" alt="logo_kejaksaan"
                src=<?php echo base_url('/assets/img/kejaksaan_logo.svg');?> />
            <img class="logo logo_right" alt="logo_kejaksaan" src=<?php echo base_url('/assets/img/logo_g20.png');?> />
            <h1>DAFTAR KEHADIRAN PEGAWAI</h1>
            <h2>KEJAKSAAN NEGERI BOALEMO</h2>
            <div class="daftarPegawai">
                <?php foreach($data as $i => $d){
                echo '<div class="card">
                    <div class="foto">
                        <img class="foto_pegawai" src="'.base_url('assets/img/pegawai/'.$d->nip).'.jpeg" alt="foto_pegawai" />
                    </div>
                    <div class="identitas">
                        <h2>'.$d->nama.'</h2>
                        <h1>'.$d->jabatan.'</h1>
                        <h3>NIP / NRP '.$d->nip.'/'.$d->nrp.'</h3>
                    </div>
                    <div class="kehadiran">
                        Keterangan
                        <h2 class="red">
                            -
                        </h2>
                        <h3>-</h3>
                    </div>
                </div>';
                }?>
            </div>
        </div>
        <!-- end of Kehadiran -->

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
    </div>
    <script type="text/javascript">
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

    <script>
    $(document).ready(function() {
        activeTab(0, true);
        // activeTab(1, false);
    });

    function activeTab(index, loop) {
        if (index == 1) anim_table();
        else if (index == 2) anim();
        var tabs = ['tab_1', 'tab_2', 'tab_3'];
        var timeout = <?php echo $timeout[0]->value; ?>;
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("body");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(tabs[index]).style.display = "block";
        if (loop) {
            if (index < 2) {
                setTimeout(() => activeTab(index + 1), timeout);
            } else {
                // setTimeout(() => activeTab(0), timeout);
                setTimeout(() => location.reload(), timeout);
            }
        }
    }

    var $e = $(".tableDuk");

    function anim_table() {
        $el.stop();
        var st = $e.scrollTop();
        var sb = $e.prop("scrollHeight") - $e.innerHeight();
        $e.animate({
            scrollTop: st < sb / 2 ? sb : 0
        }, 50000, anim_table);
    };

    var $el = $(".daftarPegawai");

    function anim() {
        $e.stop();
        var st = $el.scrollTop();
        var sb = $el.prop("scrollHeight") - $el.innerHeight();
        $el.animate({
            scrollTop: st < sb / 2 ? sb : 0
        }, 50000, anim);
    }
    </script>
</body>

</html>