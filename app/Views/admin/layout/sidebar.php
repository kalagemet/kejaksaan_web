<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href=<?php echo base_url("cpanel");?>>
        <div class="sidebar-brand-icon">
            <i class="fas fa-map-pin"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KN_Boalemo<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href=<?php echo base_url("cpanel");?>>
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Content
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php if(in_array('post',session()->permission))
    echo '<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-newspaper"></i>
            <span>Post</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Post Artikel:</h6>
                <a class="collapse-item" href='.base_url("cms/list_post").'>Daftar Postingan</a>
                <a class="collapse-item" href='.base_url("cms/create_post").'>Tambah Postingan</a>
            </div>
        </div>
    </li>';?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <?php if(in_array('page',session()->permission))
    echo '<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-columns"></i>
            <span>Halaman</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Halaman / Page</h6>
                <a class="collapse-item" href='.base_url("cms/list_page").'>Daftar Halaman</a>
            </div>
        </div>
    </li>';?>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php if(in_array('pegawai',session()->permission))
    echo '
    <!-- Heading -->
    <div class="sidebar-heading">
        Database
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pegawai</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Database Pegawai</h6>
                <a class="collapse-item" href='.base_url("cms/list_pegawai").'>Daftar Pegawai</a>
                <a class="collapse-item" href='.base_url("cms/add_pegawai").'>Tambah Pegawai</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Pejabat</h6>
                <a class="collapse-item" href='.base_url("cms/list_hero").'>Daftar Pejabat</a>
            </div>
        </div>
    </li>';?>

    <!-- Nav Item - Tables -->
    <?php if(in_array('galeri',session()->permission))
    echo '<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGal" aria-expanded="true"
            aria-controls="collapseGal">
            <i class="fas fa-fw fa-table"></i>
            <span>Galeri</span>
        </a>
        <div id="collapseGal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Post Artikel:</h6>
                <a class="collapse-item" href='.base_url("cms/gallery").'>Daftar</a>
                <a class="collapse-item" href='.base_url("cms/add-gallery").'>Tambah Foto</a>
            </div>
        </div>
    </li>';?>

    <?php if(in_array('pidana-umum',session()->permission))
    echo '<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePidum" aria-expanded="true"
        aria-controls="collapseGal">
        <i class="fas fa-fw fa-circle"></i>
        <span>Pidum</span>
    </a>
    <div id="collapsePidum" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href='.base_url("cms/admin-page/pidana-umum").'>Halaman Pidum</a>
            <a class="collapse-item" href='.base_url("cms/jadwal-sidang-pidum").'>Jadwal Sidang</a>
        </div>
    </div>
    </li>';?>

    <?php if(in_array('pengelola-barang-bukti',session()->permission))
    echo '<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBB" aria-expanded="true"
        aria-controls="collapseGal">
        <i class="fas fa-fw fa-circle"></i>
        <span>PB3R</span>
    </a>
    <div id="collapseBB" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href='.base_url("cms/admin-page/pengelola-barang-bukti").'>Halaman PB3R</a>
            <a class="collapse-item" href='.base_url("cms/daftar-barang-bukti").'>Daftar Barang Bukti</a>
        </div>
    </div>
    </li>';?>

    <!-- Nav Item - Charts -->
    <?php if(in_array('aduan',session()->permission))
    echo '<li class="nav-item">
        <a class="nav-link" href='.base_url("cms/aduan").'>
            <i class="fas fa-list"></i>
            <span>Laporan Pengaduan</span></a>
    </li>';?>

    <!-- Nav Item - Charts -->
    <?php if(in_array('admin',session()->permission))
    echo '<li class="nav-item">
        <a class="nav-link" href='.base_url("cms/setting").'>
            <i class="fas fa-cog"></i>
            <span>Setting</span></a>
    </li>';?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
    </div> -->

</ul>
<!-- End of Sidebar -->