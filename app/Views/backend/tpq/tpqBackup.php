<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>

<div class="col-12">
    <?php echo session()->getFlashdata('pesan'); 
    //$validation->listError();
    ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-2 col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProfilTpqModalInput">
                        Tambah Data TPQ
                    </button>
                </div>

                <div class="col-lg-6 col-6">
                    <h3 class="card-title">Lembaga Pendidikan TPQ yang ada di Kecamatan Seri Kuala Lobam</h3>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nama Kepala</th>
                        <th>Tempat Belajar</th>
                        <th>Tahun Berdiri</th>
                        <th>No Telpon/Hp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tpq as $dataTpq) : ?>
                        <tr>
                            <td><?= $dataTpq['IdTpq'] ?></td>
                            <td><?= $dataTpq['NamaTpq']  ?></td>
                            <td><?= $dataTpq['Alamat']  ?></td>
                            <td><?= $dataTpq['KepalaSekolah']  ?></td>
                            <td><?= $dataTpq['TempatBelajar']  ?></td>
                            <td><?= $dataTpq['TahunBerdiri']  ?></td>
                            <td><?= $dataTpq['NoHp']  ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ProfilTpqModalEdit<?= $dataTpq['IdTpq']  ?>"><i class="fas fa-edit"></i></button>
                                <a href="<?= base_url('tpq/delete/' . $dataTpq['IdTpq']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Akan Delet Data Ini')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nama Kepala</th>
                        <th>Tempat Belajar</th>
                        <th>Tahun Berdiri</th>
                        <th>No Telpon/Hp</th>
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
<?php foreach ($tpq as $dataTpq) : ?>
    <div class="modal fade" id="ProfilTpqModalEdit<?= $dataTpq['IdTpq'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data TPQ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tpq/update') ?>" method="POST">
                        <div class="form-group">
                            <label for="FormProfilTpq">NIS TPQ</label>
                            <input type="number" name="id" class="form-control" id="FormProfilTpq" maxlength="20" min="1" required placeholder="Ketik Nis TPQ" value=<?= $dataTpq['IdTpq'] ?>>
                        </div>
                        <div class="form-group">
                            <label for="FormProfilTpq">Nama TPQ</label>
                            <input type="text" name="NamaTpq" class="form-control" id="FormProfilTpq" placeholder="Ketik Nama TPQ" value="<?= $dataTpq['NamaTpq'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="FormProfilTpq">Alamat</label>
                            <input type="text" name="AlamatTpq" class="form-control" id="FormProfilTpq" placeholder="Ketik Alamat TPQ" value="<?= $dataTpq['Alamat'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="FormProfilTpq">Nama Kep. TPQ</label>
                            <input type="text" name="NamaKepTpq" class="form-control" id="FormProfilTpq" placeholder="Ketik Nama Kepala TPQ" value="<?= $dataTpq['KepalaSekolah'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="FormProfilTpq">No Hp</label>
                            <input type="text" name="NoHp" class="form-control" id="FormProfilTpq" placeholder="Ketik No Handphone" value="<?= $dataTpq['NoHp'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="FormProfilTpq">Tempat Belajar</label>
                            <input type="text" name="TempatBelajar" class="form-control" id="FormProfilTpq" placeholder="Ketik Tempat Belajar" value="<?= $dataTpq['TempatBelajar'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Beridiri:</label>
                            <div class="input-group date" id="DateForEdit" data-target-input="nearest">
                                <input type="text" name="TanggalBerdiri" class="form-control datetimepicker-input" data-target="#DateForEdit" placeholder="Tekan Icon Tanggal" value="<?= $dataTpq['TahunBerdiri'] ?>" />
                                <div class="input-group-append" data-target="#DateForEdit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
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

<!-- Modal Input Data-->
<div class="modal fade" id="ProfilTpqModalInput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data TPQ Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tpq/save') ?>" method="POST">
                    <div class="form-group">
                        <label for="FormProfilTpq">NIS TPQ</label>
                        <input type="number" name="id" class="form-control" id="FormProfilTpq" maxlength="20" min="1" required placeholder="Ketik Nis TPQ">
                    </div>
                    <div class="form-group">
                        <label for="FormProfilTpq">Nama TPQ</label>
                        <input type="text" name="NamaTpq" class="form-control" id="FormProfilTpq" placeholder="Ketik Nama TPQ">
                    </div>
                    <div class="form-group">
                        <label>Kelurahan/Desa</label>
                        <select class="form-control select2" style="width: 100%;" name="AlamatTpq">
                            <option value="">--Pilih--</option>
                            <option value="Tanjung Permai">Tanjung Permai</option>
                            <option value="Kuala Sempang">Kuala Sempang</option>
                            <option value="Busung">Busung</option>
                            <option value="Teluk Sasah">Teluk Sasah</option>
                            <option value="Teluk Lobam">Teluk Lobam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="FormProfilTpq">Nama Kep. TPQ</label>
                        <input type="text" name="NamaKepTpq" class="form-control" id="FormProfilTpq" placeholder="Ketik Nama Kepala TPQ">
                    </div>
                    <div class="form-group">
                        <label for="FormProfilTpq">No Hp</label>
                        <input type="text" name="NoHp" class="form-control" id="FormProfilTpq" placeholder="Ketik No Handphone">
                    </div>
                    <div class="form-group">
                        <label for="FormProfilTpq">Tempat Belajar</label>
                        <input type="text" name="TempatBelajar" class="form-control" id="FormProfilTpq" placeholder="Ketik Tempat Belajar">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Beridiri:</label>
                        <div class="input-group date" id="DateForInput" data-target-input="nearest">
                            <input type="text" name="TanggalBerdiri" class="form-control datetimepicker-input" data-target="#DateForInput" placeholder="Tekan Icon Tanggal" />
                            <div class="input-group-append" data-target="#DateForInput" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                        <button type="reset" class="btn btn-warning"><i class="fas fa-trash"></i>Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>