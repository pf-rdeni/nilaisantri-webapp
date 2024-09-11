<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Nilai Santri Summary</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id Santri</th>
                        <th>Nama Santri</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Total Nilai</th>
                        <th>Rata-Rata Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $MainDataNilai = $nilai->getResult();
                    $MainDataColumn = $nilai->getFieldNames();

                    foreach ($MainDataNilai as $DataNilai) : ?>
                        <tr>
                            <td><?php echo $DataNilai->IdSantri; ?></td>
                            <td><?php echo $DataNilai->Nama; ?></td>
                            <td><?php echo $DataNilai->JenisKelamin; ?></td>
                            <td><?php echo $DataNilai->NamaTahunAjaran; ?></td>
                            <td><?php echo $DataNilai->Semester; ?></td>
                            <td><?php echo $DataNilai->TotalNilai; ?></td>
                            <td><?php echo $DataNilai->NilaiRataRata; ?></td>
                            <td>
                                <a href="<?php echo base_url('nilai/showDetail/' . $DataNilai->IdSantri) ?>" class="btn btn-warning btn-sm"><i class="fas fa-list"></i></a>

                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id Santri</th>
                        <th>Nama Santri</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Total Nilai</th>
                        <th>Rata-Rata Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection(); ?>