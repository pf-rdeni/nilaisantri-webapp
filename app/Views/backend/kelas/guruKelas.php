<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>

<div class="col-12">
    <div class="card">      
        <div class="card-header">
            <div class="row mb-2">
                
                <div class="col-sm-12 float-sm-left">
                    <button class="btn btn-primary" data-toggle="modal" 
                    data-target="#GuruKelasNew"><i class="fas fa-edit"></i>Tambah Pengaturan Guru</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <?php 
                        $helpModel = new \App\Models\HelpFunctionModel(); 
                    ?>
                    <?= $headerfooter='
                    <tr>
                        <th>ID</th>
                        <th>Nama TPQ</th>
                        <th>Nama Kelas</th>
                        <th>Nama Guru</th>
                        <th>Tahun Ajaran</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>'
                    ?>
                </thead>
                <tbody>
                    <?php foreach ($guruKelas as $row) : ?>
                        <tr>
                            <td><?= $row['Id']; ?></td>
                            <td><?= $row['NamaTpq']; ?></td>
                            <td><?= $row['NamaKelas']; ?></td>
                            <td><?= $row['Nama']; ?></td>
                            <td><?= $helpModel->convertTahunAjaran($row['IdTahunAjaran']); ?></td>
                            <td><?= $row['NamaJabatan']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" 
                                data-target="#GuruKelasEdit<?= $row['Id']  ?>"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('guruKelas/delete/' .  $row['Id']) ?>" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Apakah Anda Yakin Akan Delet Data Ini')"><i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <?= $headerfooter ?>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal Edit Data-->
<?php foreach ($guruKelas as $row) : ?>
    <div class="modal fade" id="GuruKelasEdit<?= $row['Id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('guruKelas/store/') ?>" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="Id" id="FormGuruKelas" value="<?= $row['Id'] ?>">
                            <input type="hidden" name="IdTpq" id="FormGuruKelas" value="<?= $row['IdTpq'] ?>">
                            <input type="hidden" name="IdTahunAjaran" id="FormGuruKelas" value="<?= $row['IdTahunAjaran'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="FormGuruKelas">Nama Kelas</label>
                            <select name="IdKelas" class="form-control" id="FormGuruKelas">
                                <option value="" disabled selected>Pilih Nama Kelas</option>
                                <?php foreach ($helpModel->getDataKelas() as $kelas): ?>
                                    <option value="<?= $kelas['IdKelas']; ?>" <?= $row['IdKelas'] == $kelas['IdKelas'] ? 'selected' : ''; ?>>
                                        <?= $kelas['NamaKelas']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="FormGuruKelas">Nama Guru</label>
                            <select name="IdGuru" class="form-control" id="FormGuruKelas">
                                <option value="" disabled selected>Pilih Nama Guru</option>
                                <?php 
                                    foreach ($helpModel->getDataGuru($row['IdTpq']) as $guru): ?>
                                    <option value="<?= $guru['IdGuru']; ?>" <?= $row['IdGuru'] == $guru['IdGuru'] ? 'selected' : ''; ?>>
                                        <?= $guru['Nama']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="FormGuruKelas">Posisi</label>
                            <select name="IdJabatan" class="form-control" id="FormGuruKelas">
                                <option value="" disabled selected>Pilih Sebagai</option>
                                <?php 
                                    foreach ($helpModel->getDataJabatan() as $Jabatan): ?>
                                    <option value="<?= $Jabatan['IdJabatan']?>" <?= $row['IdJabatan'] == $Jabatan['IdJabatan'] ? 'selected' : '' ?>>
                                    <?= $Jabatan['NamaJabatan']?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<div class="modal fade" id="GuruKelasNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('guruKelas/store/')?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="IdTpq" id="FormGuruKelas" value="<?= $dataTpq?>">
                    </div>
                    <div class="form-group">
                        <label for="FormGuruKelas">Tahun Ajaran</label>
                        <select name="IdTahunAjaran" class="form-control" id="FormGuruKelas">
                            <option value="" disabled selected>Pilih Tahun Ajaran</option>
                            <option value="<?=  $helpModel->getTahunAjaranSaatIni() ?>">Saat ini <?= $helpModel->convertTahunAjaran($helpModel->getTahunAjaranSaatIni()) ?> </option>
                            <option value="<?=  $helpModel->getTahunAjaranSebelumnya($helpModel->getTahunAjaranSaatIni()) ?>">Sebelumnya <?= $helpModel->convertTahunAjaran($helpModel->getTahunAjaranSebelumnya($helpModel->getTahunAjaranSaatIni())) ?> </option>
                            <option value="<?=  $helpModel->getTahuanAjaranBerikutnya($helpModel->getTahunAjaranSaatIni()) ?>">Berikutnya <?= $helpModel->convertTahunAjaran($helpModel->getTahuanAjaranBerikutnya($helpModel->getTahunAjaranSaatIni())) ?> </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="FormGuruKelas">Nama Kelas</label>
                        <select name="IdKelas" class="form-control" id="FormGuruKelas">
                            <option value="" disabled selected>Pilih Nama Kelas</option>
                            <?php foreach ($helpModel->getDataKelas() as $kelas): ?>
                                <option value="<?= $kelas['IdKelas']; ?>"><?= $kelas['NamaKelas']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="FormGuruKelas">Nama Guru</label>
                        <select name="IdGuru" class="form-control" id="FormGuruKelas">
                            <option value="" disabled selected>Pilih Nama Guru</option>
                            <?php 
                                foreach ($helpModel->getDataGuru($row['IdTpq']) as $guru): ?>
                                <option value="<?= $guru['IdGuru']; ?>"><?= $guru['Nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="FormGuruKelas">Posisi</label>
                        <select name="IdJabatan" class="form-control" id="FormGuruKelas">
                            <option value="" disabled selected>Pilih Sebagai</option>
                            <?php 
                                foreach ($helpModel->getDataJabatan() as $Jabatan): ?>
                                <option value="<?= $Jabatan['IdJabatan']?>"><?= $Jabatan['NamaJabatan']?></option>
                            <?php endforeach; ?>
                        </select>                       
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
