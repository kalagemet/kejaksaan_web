  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  header-transparent ">
      <div class="container d-flex align-items-center justify-content-between">

          <div class="logo">
              <a href=<?php echo base_url(); ?>><img src=<?php echo base_url("assets/img/kejaksaan_logo.svg"); ?> alt=""
                      class="img-fluid"><b>KEJAKSAAN NEGERI BOALEMO</b></a>
          </div>

          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto"
                          href=<?php echo base_url(); if(base_url($_SERVER['REQUEST_URI'])===base_url()) echo "#hero"; ?>>Beranda</a>
                  </li>
                  <li class="dropdown"><a href="#"><span>Tentang</span><i class="bi bi-chevron-down"></i></a>
                      <ul>
                          <li><a href=<?php echo base_url("page/visi-misi"); ?>>Visi Misi</a></li>
                          <li><a href=<?php echo base_url("daftar-urut-kepangkatan"); ?>>DUK Instansi</a></li>
                          <li><a href=<?php echo base_url("tentang/struktur-organisasi"); ?>>Struktur Organisasi</a>
                          </li>
                          <li><a href=<?php echo base_url("page/doktrin-kejaksaan"); ?>>Doktrin Kejaksaan</a></li>
                          <li class="dropdown"><a href=""><span>Bidang</span><i class="bi bi-chevron-right"></i></a>
                              <ul>
                                  <li><a href=<?php echo base_url("page/pembinaan"); ?>>Pembinaan</a></li>
                                  <li><a href=<?php echo base_url("page/intelijen"); ?>>Intelijen</a></li>
                                  <li><a href=<?php echo base_url("page/pidana-umum"); ?>>Pidana Umum</a></li>
                                  <li><a href=<?php echo base_url("page/pidana-khusus"); ?>>Pidana Khusus</a></li>
                                  <li><a href=<?php echo base_url("page/perdata-dan-tata-usaha-negara"); ?>>Perdata dan
                                          TUN</a></li>
                                  <li><a href=<?php echo base_url("page/pengelola-barang-bukti"); ?>>Pelacakan Aset dan Pengelola Barang
                                          Bukti</a></li>
                              </ul>
                          </li>
                          <li><a href=<?php echo base_url("page/ikatan-adhyaksa-dharmakarini"); ?>>IAD</a></li>
                      </ul>
                  </li>
                  <li class="dropdown"><a href="#"><span>Layanan</span><i class="bi bi-chevron-down"></i></a>
                      <ul>
                          <li><a href=<?php echo base_url('perpustakaan'); ?>>Perpustakaan</a></li>
                          <li><a href=<?php echo base_url('whistleblowing'); ?>>Whistleblowing</a></li>
                          <li><a href=<?php echo base_url('jadwal-sidang-pidum'); ?>>Jadwal Sidang</a></li>
                          <li><a href=<?php echo base_url('jenguk-tahanan'); ?>>Izin Besuk Tahanan</a></li>
                          <li><a href=<?php echo base_url('barang-bukti'); ?>>Barang Bukti / Rampasan</a></li>
                          <li><a href=<?php echo base_url('lapdu_v1'); ?>>Laporan Pengaduan Masyarakat</a></li>
                          <li><a href=<?php echo base_url('#aduan'); ?>>Layanan Kritik dan Saran</a></li>
                          <li><a href=<?php echo base_url('page/survei-kepuasan-masyarakat'); ?>>Survei Kepuasan
                                  Masyarakat</a></li>
                          <li><a href="https://tilang.kejaksaan.go.id/">e-Tilang</a></li>
                          <!-- <li><a href=<?php echo base_url('validasi-surat'); ?>>Validasi Surat</a></li> -->
                      </ul>
                  </li>
                  <li class="dropdown"><a href="#"><span>Zona Integritas</span><i class="bi bi-chevron-down"></i></a>
                      <ul>
                          <li><a href=<?php echo base_url('page/manajemen-perubahan'); ?>>Manajemen Perubahan</a></li>
                          <li><a href=<?php echo base_url('page/penataan-tatalaksana'); ?>>Penataan Tatalaksana</a></li>
                          <li><a href=<?php echo base_url('page/penataan-sistem-manajemen-sdm'); ?>>Penataan Sistem
                                  Manajemen SDM</a></li>
                          <li><a href=<?php echo base_url('page/penguatan-pengawasan'); ?>>Penguatan Pengawasan</a></li>
                          <li><a href=<?php echo base_url('page/peningkatan-kualitas-pelayanan-publik'); ?>>Peningkatan
                                  Kualitas Pelayanan Publik</a></li>
                      </ul>
                  </li>
                  <li><a class="nav-link scrollto"
                          href=<?php echo base_url("/berita"); if(base_url($_SERVER['REQUEST_URI'])===base_url('/berita')) echo "#hero"; ?>>Berita</a>
                  </li>
                  <li><a class="nav-link scrollto"
                          href=<?php echo base_url("/galeri"); if(base_url($_SERVER['REQUEST_URI'])===base_url('/galeri')) echo "#hero"; ?>>Galeri</a>
                  </li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

      </div>
  </header>
  <!-- End Header -->
  <div class="loader">
      <div class="spinner">
      </div>
      <img src="<?php echo base_url('assets/img/kejaksaan_logo.png'); ?>" alt="loader_logo" />
  </div>