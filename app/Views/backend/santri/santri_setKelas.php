<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Set Santri Baru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <form action="<?= base_url('tpq/update/'. "ID") ?>" method="POST">
            <table id="example1" class="table table-bordered table-striped">
                <?php
                $tableHeaders = '
                    <tr>
                        <th>IdSantri</th>
                        <th>Nama Santri</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas Diajukan</th>
                        <th>Nama Ayah</th>
                        <th>Kelas Baru</th>
                    </tr>
                ';
                ?>
                <thead>
                <?= $tableHeaders ?>
                </thead>
                <tbody>
                    <?php
                    foreach ($santri as $DataSantri) : ?>
                        <tr>
                            <td><?= $DataSantri['IdSantri']; ?></td>
                            <td><?= $DataSantri['Nama']; ?></td>
                            <td><?= $DataSantri['JenisKelamin']; ?></td>
                            <td><?= $DataSantri['Tingkat']; ?></td>
                            <td><?= $DataSantri['NamaAyah']; ?></td>
                            <td>
                                <select name="IdKelas" class="form-control select2" id="FormProfilTpq" required>
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    <option value="TK">TK</option>
                                            <option value="SD1">SD1</option>
                                    <option value="SD2">SD2</option>
                                    <option value="SD3">SD3</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <?= $tableHeaders ?>
                </tfoot>
            </table>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
            </div>
        </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection(); ?>