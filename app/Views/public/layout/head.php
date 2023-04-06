<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php if(isset($page_title)) echo $page_title; ?></title>
    <!-- Rich Link -->
    <meta property="og:title" content=<?php if(isset($page_title)) echo $page_title; ?>/>
    <meta property="og:description" content="Kejaksaan Negeri Boalemo"/>
    <meta property="og:image" content=<?php if(isset($thumbnail)) echo $thumbnail; ?>/>
    <!-- Favicons -->
    <link href=<?php echo base_url("favicon.ico"); ?> rel="icon">
    <link href=<?php echo base_url("favicon.ico"); ?> rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <script src=<?php echo base_url("assets/js/jquery-3.4.1.js"); ?>></script>
    <!-- <script src=<?php echo base_url("assets/js/main.js"); ?>></script> -->

    <!-- Vendor CSS Files -->
    <link href=<?php echo base_url("assets/vendor/aos/aos.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/vendor/bootstrap-icons/bootstrap-icons.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/vendor/boxicons/css/boxicons.min.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/vendor/glightbox/css/glightbox.min.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/vendor/swiper/swiper-bundle.min.css"); ?> rel="stylesheet">

    <!-- Main CSS File -->
    <link href=<?php echo base_url("assets/css/style.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/css/sharingbuttons.css"); ?> rel="stylesheet">
    <?php if(isset($datatables) && $datatables)
        echo "<link href='".base_url("assets/vendor/datatables/dataTables.bootstrap4.min.css")."' rel='stylesheet'>";
    ?>
    <?php if($_SERVER['REQUEST_URI']=='/'){
        echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    }?>
</head>