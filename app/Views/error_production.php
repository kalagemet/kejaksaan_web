<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body id="page-top">
    <!-- Content -->
    <div class="container-fluid">
        <br />
        <br />
        <!-- 404 Error Text -->
        <div class="text-center">
            <img style="width:10vw" src=<?php echo base_url("assets/img/kejaksaan_logo.svg"); ?> alt=""
                class="img-fluid">
            <h3>TERJADI KESALAHAN !!!</h3>
            <br />
            <?php if(isset($error_code)) echo "<div class='error mx-auto' data-text='$error_code'>$error_code</div>";
            if(isset($error_name)) echo "<p class='lead text-gray-800 mb-5'>$error_name</p>";
            if(isset($error_desc)) echo "<p class='text-gray-500 mb-0>$error_desc</p>";
            echo "<a href='".base_url("/")."'>← Kembali ke beranda</a>"; ?>
        </div>
    </div>
    <?php echo view('admin/layout/footer');?>
</body>

</html>