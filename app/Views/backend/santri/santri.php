<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lembaga Pendidikan TPQ yang ada di Kecamatan Seri Kuala Lobam</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>IdSantri</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>Tingkat</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>No Hp Ayah/Ibu</th>
                        <th>Alamat</th>
                        <th>Rt/Rw</th>
                        <th>Kel/Desa</th>
                        <th>NKK</th>
                        <th>NIK</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($santri as $DataSantri) : ?>
                        <tr>
                            <td><?= $DataSantri['IdSantri']; ?></td>
                            <td><?= $DataSantri['Nama']; ?></td>
                            <td><?= $DataSantri['JenisKelamin']; ?></td>
                            <td><?= $DataSantri['TempatLahir'] . ", " . $DataSantri['TanggalLahir']; ?></td>
                            <td><?= $DataSantri['Tingkat']; ?></td>
                            <td><?= $DataSantri['NamaAyah']; ?></td>
                            <td><?= $DataSantri['NamaIbu']; ?></td>
                            <td><?= $DataSantri['NoHpAyah'] . " / " . $DataSantri['NoHpIbu']; ?></td>
                            <td><?= $DataSantri['Alamat']; ?></td>
                            <td><?= $DataSantri['Rt'] . " / " . $DataSantri['Rw']; ?></td>
                            <td><?= $DataSantri['KelurahanDesa'] ?></td>
                            <td><?= $DataSantri['Kk'] ?></td>
                            <td><?= $DataSantri['Nik']; ?></td>
                            <td><?= $DataSantri['Status']; ?></td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>IdSantri</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>Tingkat</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>No Hp Ayah/Ibu</th>
                        <th>Alamat</th>
                        <th>Rt/Rw</th>
                        <th>Kel/Desa</th>
                        <th>NKK</th>
                        <th>NIK</th>
                        <th>Status</th>
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