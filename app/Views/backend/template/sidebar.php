<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url("Pages") ?>" class="brand-link">
        <img src="<?php echo base_url('/template/backend/dist') ?>/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('/template/backend/dist') ?>/img/user2-160x160.jpg"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Deni Rusandi</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
                <li class="nav-item">
                    <a href=<?php echo base_url('pages/index') ?> class="nav-link">
                        <i class="nav-icon 	fas fa-tachometer-alt"></i>
                        <p> Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href=<?php echo base_url('tpq/show') ?> class="nav-link">
                        <i class="nav-icon 	fas fa-mosque"></i>
                        <p> Data TPQ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=<?php echo base_url('guru/show') ?> class="nav-link">
                        <i class="nav-icon 	fas fa-user"></i>
                        <p> Data Guru</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=<?php echo base_url('santri/show') ?> class="nav-link">
                        <i class="nav-icon 	fas fa-users"></i>
                        <p> Data Santri</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=<?php echo base_url('login/show') ?> class="nav-link">
                        <i class="nav-icon 	fas fa-user"></i>
                        <p> Login</p>
                    </a>
                </li>
                <li class="nav-item" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                        Setting
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;"> <!-- none; or block -->;
                        <li class="nav-item">
                            <a href=<?php echo base_url('kelas/showSantriKelasBaru') ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelas Baru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=<?php echo base_url('kelas/showListSantriPerKelas') ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kenaikan Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=<?php echo base_url('guru/setWaliSantri') ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Wali Kelas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Kesiswaan
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                        <a href=<?php echo base_url('santri/showSantriPerKelas') ?> class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Santri Per Kelas</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href=<?php echo base_url('nilai/showSumaryPersemester') ?> class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nilai Per Semester</p>
                        </a>
                        <li class="nav-item">
                        <a href=<?php echo base_url('nilai/showNilaiProfilDetail'.'/'.'20150001') ?>  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Profil Detail</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item no-hover" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                        Wali Kelas
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <?php 
                            $IdGuru='2101075810760001';
                            $encrypter = \Config\Services::encrypter();
                            $encryptedIdGuru = bin2hex($encrypter->encrypt($IdGuru));;?>
                        <li class="nav-item">
                            <a href=<?php echo base_url('') ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Absensi Santri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=<?php echo base_url('') ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Prestasi Santri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=<?php echo base_url('') ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabungan Santri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=<?php echo base_url('') ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Iuaran Santri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=<?php 
                            
                            echo base_url('santri/showSantriPerKelas/'.$encryptedIdGuru) ?> class="nav-link no-hover">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nilai Per Semester</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>