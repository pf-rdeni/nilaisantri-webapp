<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">

    <!-- Card for Previous Academic Year -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Santri TPQ Per Kelas Tahun Ajaran Sebelumnya untuk dinaikan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="previousKelas" class="table table-bordered table-striped">
                <?php
                $tableHeadersFooter = '
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Nama Kelas</th>
                        <th>Jumlah Santri</th>
                        <th>Proses Naik Kelas</th>
                    </tr>
                ';
                ?>
                <thead>
                    <?= $tableHeadersFooter ?>
                </thead>
                <tbody>
                    <?php if (!empty($kelas_previous)): ?>
                        <?php foreach ($kelas_previous as $dataKelas) : ?>
                            <tr>
                                <td><?= $dataKelas['IdTahunAjaran']; ?></td>
                                <td><?= $dataKelas['NamaKelas']; ?></td>
                                <td><?= $dataKelas['SumIdKelas']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('kelas/updateNaikKelas/'.$dataKelas['IdTahunAjaran'].'/' . $dataKelas['IdKelas']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No data available for the previous academic year.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <?= $tableHeadersFooter ?>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Card for Current Academic Year -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Santri TPQ Per Kelas Tahun Ajaran <?= $current_tahun_ajaran ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="currentKelas" class="table table-bordered table-striped">
                <?php
                $tableHeadersFooter = '
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Nama Kelas</th>
                        <th>Jumlah Santri</th>
                    </tr>
                ';
                ?>
                <thead>
                    <?= $tableHeadersFooter ?>
                </thead>
                <tbody>
                    <?php if (!empty($kelas_current)): ?>
                        <?php foreach ($kelas_current as $dataKelas) : ?>
                            <tr>
                                <td><?= $dataKelas['IdTahunAjaran']; ?></td>
                                <td><?= $dataKelas['NamaKelas']; ?></td>
                                <td><?= $dataKelas['SumIdKelas']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No data available for the current academic year.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <?= $tableHeadersFooter ?>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<?= $this->endSection(); ?>
