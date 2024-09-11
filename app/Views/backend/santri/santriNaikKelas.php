<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Santri TPQ Per Kelas</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Wali Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Tingkat Kelas</th>
                        <th>Nama Santri</th>
                        <th>Jenis Kelamin</th>
                        <th>Nilai Semester Ganjil</th>
                        <th>Nilai Semester Genap</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $MainDataNilai = $santri->getResult();
                     $MainDataColumn = $santri->getFieldNames();
                    foreach ($MainDataNilai as $DataSantri) : ?>
                        <tr>
                            <td><?php echo $DataSantri->GuruNama; ?></td>
                            <td><?php echo $DataSantri->IdTahunAjaran; ?></td>
                            <td><?php echo $DataSantri->NamaKelas; ?></td>
                            <td><?php echo $DataSantri->SantriNama; ?></td>
                            <td><?php echo $DataSantri->JenisKelamin; ?></td>
                            <td>
                                <a href="<?php echo base_url('nilai/showDetail') ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo base_url('nilai/showDetail') ?>" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-danger btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Wali Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Tingkat Kelas</th>
                        <th>Nama Santri</th>
                        <th>Jenis Kelamin</th>
                        <th>Nilai Semester Ganjil</th>
                        <th>Nilai Semester Genap</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection(); ?>