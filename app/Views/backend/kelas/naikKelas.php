<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Santri TPQ Per Kelas Tahun Ajaran Sebelumnya untuk dinaikan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
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
                <?php
                foreach ($kelas as $dataKelas) : ?>
                    <tr>
                        <td><?= $dataKelas['IdTahunAjaran']; ?></td>
                        <td><?= $dataKelas['NamaKelas']; ?></td>
                        <td><?= $dataKelas['SumIdKelas']; ?></td>
                        <td>
                            <a href="<?php echo base_url('kelas/updateNaikKelas/'.$dataKelas['IdTahunAjaran'].'/' . $dataKelas['IdKelas']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
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