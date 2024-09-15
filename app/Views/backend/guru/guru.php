<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pengajar di TPQ yang ada di Kecamatan Seri Kuala Lobam</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>Pendidikan</th>
                        <th>Tempat Tugas</th>
                        <th>Mulai Bertugas</th>
                        <th>Alamat</th>
                        <th>Rt/Rw</th>
                        <th>Kel/Desa</th>
                        <th>NIK</th>
                        <th>REK BPR</th>
                        <th>REK RiauKepri</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($guru as $dataGuru) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $dataGuru['Nama'] ?></td>
                        <td><?= $dataGuru['JenisKelamin'] ?></td>
                        <td><?= $dataGuru['TempatLahir'] . ", " . $dataGuru['TanggalLahir'] ?></td>
                        <td><?= $dataGuru['PendidikanTerakhir'] ?></td>
                        <td><?= $dataGuru['TempatTugas'] ?></td>
                        <td><?= $dataGuru['TanggalMulaiTugas'] ?></td>
                        <td><?= $dataGuru['Alamat'] ?></td>
                        <td><?= $dataGuru['Rt'] . " / " . $dataGuru['Rw'] ?></td>
                        <td><?= $dataGuru['KelurahanDesa'] ?></td>
                        <td><?= $dataGuru['IdGuru'] ?></td>
                        <td><?= $dataGuru['NoRekBpr'] ?></td>
                        <td><?= $dataGuru['NoRekRiauKepri'] ?></td>
                        <td><?= $dataGuru['Status'] ?></td>
                        <td>
                            <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>Pendidikan</th>
                        <th>Tempat Tugas</th>
                        <th>Mulai Bertugas</th>
                        <th>Alamat</th>
                        <th>Rt/Rw</th>
                        <th>Kel/Desa</th>
                        <th>NIK</th>
                        <th>REK BPR</th>
                        <th>REK RiauKepri</th>
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