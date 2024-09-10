<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('/template/backend/dist') ?>/img/syifa.png" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">SYIFAUL HUSNA</h3>
                    <p class="text-muted text-center">Orang Tua: Deni rusandi</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>TINGKAT</b> <a class="float-right">KELAS 1 SD</a>
                        </li>
                        <li class="list-group-item">
                            <b>RUANGAN</b> <a class="float-right">RUANG 1 LANTAI 1</a>
                        </li>
                        <li class="list-group-item">
                            <b>WALI KELAS</b> <a class="float-right">AGUNG TJATUR ARTINI</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block"><b>DETAIL</b></a>
                </div>

            </div>


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>

                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                    <p class="text-muted">Malibu, California</p>
                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                    <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                    </p>
                    <hr>
                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>

            </div>

        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#KelasTk" data-toggle="tab">Kelas TK</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Kelas1" data-toggle="tab">Kelas SD1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Kelas2" data-toggle="tab">Kelas SD2</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Kelas2" data-toggle="tab">Kelas SD3</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Kelas2" data-toggle="tab">Kelas SD4</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Kelas2" data-toggle="tab">Kelas SD5</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Kelas2" data-toggle="tab">Kelas SD6</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Kelas2" data-toggle="tab">Kelas SMP</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="KelasTk">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link" href="#Ganji_K1" data-toggle="tab">Ganjil</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#Genap_K1" data-toggle="tab">Genap</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-pane" id="Ganji_K1">
                                <div class="card"> 
                                <div class="card-header">
                                    <h3 class="card-title">Data Nilai Santri Detail</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id Materi </th>
                                                <th>Nama Materi</th>
                                                <th>Kategori</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $MainDataNilai=$nilai->getResult();
                                            foreach ($MainDataNilai as $DataNilai) : ?>
                                                <tr>
                                                    <td><?php echo $DataNilai->IdMateri; ?></td>
                                                    <td><?php echo $DataNilai->NamaMateri; ?></td>
                                                    <td><?php echo $DataNilai->Kategori; ?></td>
                                                    <td><?php echo $DataNilai->Nilai; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id Materi</th>
                                                <th>Nama Materi</th>
                                                <th>Kategori</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                                </div>
                                <div class="tab-pane" id="Ganji_K1">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="Kelas1">
                        <div class="col-12">
                            <div class="card"> 
                                <div class="card-header">
                                    <h3 class="card-title">Data Nilai Santri Detail</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id Materi </th>
                                                <th>Nama Materi</th>
                                                <th>Kategori</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $MainDataNilai=$nilai->getResult();
                                            foreach ($MainDataNilai as $DataNilai) : ?>
                                                <tr>
                                                    <td><?php echo $DataNilai->IdMateri; ?></td>
                                                    <td><?php echo $DataNilai->NamaMateri; ?></td>
                                                    <td><?php echo $DataNilai->Kategori; ?></td>
                                                    <td><?php echo $DataNilai->Nilai; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id Materi</th>
                                                <th>Nama Materi</th>
                                                <th>Kategori</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        </div>


                        <div class="tab-pane" id="Kelas2">
                            
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection(); ?>