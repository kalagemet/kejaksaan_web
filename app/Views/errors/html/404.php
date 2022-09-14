<div class="container-fluid">
    <br />
    <br />
    <!-- 404 Error Text -->
    <div class="text-center">
        <img style="width:10vw" data-aos='fade-up' src=<?php echo base_url("assets/img/kejaksaan_logo.svg"); ?> alt=""
            class="img-fluid">
        <!-- <h3>TERJADI KESALAHAN !!!</h3> -->
        <br />
        <?php if(isset($error_name)) echo "<br/><h1  data-aos='fade-right'>$error_name</h1>";
            if(isset($error_code)) echo "<h2 data-aos='fade-right'>$error_code</h2>";
            if(isset($error_desc)) echo "<p class='text-gray-500 mb-0'>$error_desc</p>";
            echo "<a data-aos='fade-right' href='".base_url("/")."'>← Kembali ke beranda</a>"; ?>
    </div>
</div>