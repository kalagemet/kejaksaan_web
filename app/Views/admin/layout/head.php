<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php if(isset($page_title)) echo $page_title; ?></title>

    <?php if(isset($summernote) && $summernote){
        // echo '<link href="'.base_url("assets/css/bootstrap.summernote.min.css").'" rel="stylesheet" type="text/css">
        // <script src="'.base_url("assets/js/jquery-3.5.1.js").'"></script>
        // <script src="'.base_url("assets/js/bootstrap.min.js").'"></script>
        // <link href="'.base_url("assets/css/summernote.min.css").'" rel="stylesheet">
        // <script src="'.base_url("assets/js/summernote.min.js").'"></script>';
        echo "<script src='https://cdn.tiny.cloud/1/0m45nsu0fp9s2gyq12ovukxbinfr6lforzroozcw1nbu1xym/tinymce/6/tinymce.min.js' referrerpolicy='origin'></script>
        <script>
          tinymce.init({
            selector: '#editor',
            plugins: [
              'advlist','autolink',
              'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
              'fullscreen','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
              'alignleft aligncenter alignright alignjustify | ' +
              'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
          });
        </script>";
    }?>
    <?php if(isset($datatables) && $datatables)
      echo "<link href='".base_url("assets/vendor/datatables/dataTables.bootstrap4.min.css")."' rel='stylesheet'>";
    ?>

    <!-- Custom fonts for this template-->
    <link href=<?php echo base_url("assets/vendor/fontawesome-free/css/all.min.css"); ?> rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href=<?php echo base_url("assets/css/sb-admin-2.min.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/vendor/boxicons/css/boxicons.min.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("assets/css/style-admin.css"); ?> rel="stylesheet">
    <?php if(isset($select_bootstrap) && $select_bootstrap)
        echo "<link href=".base_url("assets/css/bootstrap-select.css")." rel='stylesheet'>";
    ?>

</head>