<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <?php echo session()->getFlashdata('pesan'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Nilai Santri Detail</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id Materi</th>
                        <th>Nama Materi</th>
                        <th>Kategori</th>
                        <th>Nilai</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $MainDataNilai=$nilai->getResult();
                    $MainDataColumn=$nilai->getFieldNames();

                    foreach ($MainDataNilai as $DataNilai) : ?>
                        <tr>
                            <td><?php echo $DataNilai->IdMateri; ?></td>
                            <td><?php echo $DataNilai->NamaMateri; ?></td>
                            <td><?php echo $DataNilai->Kategori; ?></td>
                            <td><?php echo $DataNilai->Nilai; ?></td>
                            <td><?php echo $DataNilai->IdTahunAjaran; ?></td>
                            <td><?php echo $DataNilai->Semester; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#EditNilai<?= $DataNilai->Id  ?>"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Materi</th>
                        <th>Nama Materi</th>
                        <th>Kategori</th>
                        <th>Nilai</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal Edit Data-->
<?php 
$MainDataNilai=$nilai->getResult();
$MainDataColumn=$nilai->getFieldNames();
foreach ($MainDataNilai as $DataNilai) : ?>
    <div class="modal fade" id="EditNilai<?= $DataNilai->Id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nilai </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('nilai/update/'. $DataNilai->Id) ?>" method="POST">
                        <input type="hidden" name="Id" value= <?= $DataNilai->Id ?>>
                        <input type="hidden" name="NamaMateri" value="<?= htmlspecialchars($DataNilai->NamaMateri, ENT_QUOTES, 'UTF-8') ?>">
                        <div class="form-group">
                            <label for="FormProfilTpq">Kategori</label>
                            <span class="form-control" id="FormProfilTpq"><?= $DataNilai->Kategori ?></span>
                        </div>
                        <div class="form-group">
                            <label for="FormProfilTpq">Nama Materi</label>
                            <span class="form-control" id="FormProfilTpq"><?= $DataNilai->NamaMateri ?></span>
                        </div>
                        <div class="form-group">
                            <label for="FormProfilTpq">Nilai</label>
                            <input type="number" name="Nilai" class="form-control" id="FormProfilTpq" required 
                                placeholder="Ketik Nilai" value="<?= $DataNilai->Nilai ?>" 
                                min="50" max="95" 
                                oninvalid="this.setCustomValidity('Nilai harus antara 50 dan 95')" 
                                oninput="this.setCustomValidity('')">
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
<?= $this->endSection(); ?>