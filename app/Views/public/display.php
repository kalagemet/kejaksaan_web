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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src=<?php echo base_url("assets/js/bootstrap-3.3.7.min.js");?>></script>

    <!-- Favicons -->
    <link href=<?php echo base_url("favicon.ico"); ?> rel="icon">
    <link href=<?php echo base_url("favicon.ico"); ?> rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href=<?php echo base_url("assets/css/display.css"); ?> rel="stylesheet">
</head>

<body>
    <div class="app">

        <!-- Galeri slider -->
        <div id="tab_1" class="body">
            <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <!-- <?php 
                foreach($slider_display as $i => $row){
                    if($i == 0){
                        echo '<li data-target="#dynamic_slide_show" data-slide-to="'.$i.'" class="active"></li>';
                    }else{
                        echo '<li data-target="#dynamic_slide_show" data-slide-to="'.$i.'"></li>';
                    }
                }
                ?> -->
                </ol>
                <div class="carousel-inner">
                    <?php 
                foreach($slider_display as $i => $row){
                    if($i == 0){
                        echo '<div class="item active">';
                    }else{
                        echo '<div class="item">';
                    }
                    echo '<img src="'.$row.'" alt="'.$row.'" /></div>';
                    // <div class="carousel-caption">
                    //     <h3></h3>
                    // </div></div>';
                } ?>
                </div>
                <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
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
                                <?php if(isset($running_text)) echo $running_text[0]->running_text; ?>
                            </p>
                        </div>
                    </div>
                </marquee>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    // function log_in() {
    //     console.log("dd");
    //     $.ajax({
    //         url: "https://absensi.kejaksaan.go.id/absen/absensi",
    //         method: "GET",
    //         header: {
    //             'Access-Control-Allow-Origin': '*',
    //             'Access-Control-Allow-Headers': 'Content-Type',
    //             'Access-Control-Max-Age': '3600',
    //             'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0'
    //         }
    //     }, {
    //         success: function(response) {
    //             console.log(response);
    //         }
    //     });
    // };
    // log_in();

    // let data = {
    //     _token: "barium"
    // };

    // fetch("/post/data/here", {
    //     method: "POST",
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     body: JSON.stringify(data)
    // }).then(res => {
    //     console.log("Request complete! response:", res);
    // });
    </script>

    <script>
    $(document).ready(function() {
        activeTab(2, true);
        // activeTab(1, false);
    });

    function activeTab(index, loop) {
        anim_stop();
        if (index == 1) anim_table();
        else if (index == 2)() => anim();
        var tabs = ['tab_1', 'tab_2', 'tab_3'];
        var timeout = <?php echo $timeout[0]->display_timeout; ?>;
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
                setTimeout(() => activeTab(0), timeout);
            }
        }
    }

    var $e = $(".tableDuk");

    function anim_table() {
        var st = $e.scrollTop();
        var sb = $e.prop("scrollHeight") - $e.innerHeight();
        $e.animate({
            scrollTop: st < sb / 2 ? sb : 0
        }, 50000, anim_table);
    };

    var $el = $(".daftarPegawai");

    function anim() {
        var st = $el.scrollTop();
        var sb = $el.prop("scrollHeight") - $el.innerHeight();
        $el.animate({
            scrollTop: st < sb / 2 ? sb : 0
        }, 5000, anim);
    }

    function anim_stop() {
        $e.stop();
        $el.stop();
    }
    </script>
</body>

</html>