<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('public/layout/head');?>

<body>
    <div class="container-fluid">
        <button
            style="position: fixed; display: block; width: 100%; height:100%; background:transparent; border: none;z-index: 1;"
            onClick="requestFullScreen()"></button>

        <!-- Galeri slider -->
        <div id="tab_1" class="body">
            <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $awal = count($slider_display);
                    foreach($slider_display as $i => $row){
                        echo '<div class="item'.($i == 0 ? ' active"':'"').'>';
                        echo '<div class="item-img" style="background: url(\''.$row.'\'), url(\''.base_url("assets/img/no-image.svg").'\');"></div></div>';
                    } foreach($post_ig as $i => $row){
                        echo '<div class="item">';
                        echo '<div class="item-img" style="background: url(\''.$row->media_url.'\'), url(\''.base_url("assets/img/no-image.svg").'\');"></div></div>';
                    }?>
                </div>
            </div>
        </div>
        <!-- end of galleri slider -->
        <!-- Content here -->
        <div class="top-header">
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

        <!-- DUK Table -->
        <div id="tab_2" class="body">
            <div style="height: 10px;"></div>
            <h1 class="h1">DAFTAR URUTAN KEPANGKATAN</h1>
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
            <div style="height: 10px;"></div>
            <h1>DAFTAR KEHADIRAN PEGAWAI</h1>
            <h2>KEJAKSAAN NEGERI BOALEMO</h2>
            <div class="daftarPegawai">
                <?php foreach($data as $i => $d){
                echo '<div class="card">
                <div class="row">
                    <div class="col-sm-2 foto">
                        <img class="foto_pegawai" src="'.base_url('assets/img/pegawai/'.$d->nip).'.jpeg" alt="foto_pegawai" />
                    </div>
                    <div class="col-sm-6 identitas">
                        <h3>'.$d->nama.'</h3>
                        <h2>'.$d->jabatan.'</h2>
                    </div>
                    <div class="col-sm-4 kehadiran">
                        Keterangan
                        <h2 class="red">
                            -
                        </h2>
                        <h3>-</h3>
                    </div>
                </div>
                </div>';
                }?>
            </div>
        </div>
        <!-- end of Kehadiran -->

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

    $(document).ready(function() {
        activeTab(0, true);
        // activeTab(1, false);
    });

    function activeTab(index, loop) {
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
                setTimeout(() => activeTab(index + 1, true), timeout + 5000);
            } else {
                // setTimeout(() => activeTab(0), timeout);
                setTimeout(() => location.reload(), timeout + 5000);
            }
        }
        if (index == 1) anim_table(timeout);
        else if (index == 2) anim(timeout);
    }

    var $e = $(".tableDuk");
    var $el = $(".daftarPegawai");

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
        }, timeout / 2, () => anim(timeout));
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