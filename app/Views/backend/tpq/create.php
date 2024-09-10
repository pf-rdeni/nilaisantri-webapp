<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>

<div class="col-12">
    <?php echo session()->getFlashdata('pesan'); 
    //echo $validation->listErrors();
    ?>
    <div class="card">
        <!-- /.card-header -->
            <div class="modal-body">
                <form action="<?= base_url('tpq/save') ?>" method="POST">
                    <div class="form-group">
                        <label for="FormProfilTpq">NIS TPQ</label>
                        <input 
                            type="number" name="IdTpq" required placeholder="Ketik Nis TPQ"
                            class="form-control  <?= ($validation->hasError('IdTpq')) ? 'is-invalid' : ''; ?>" 
                            autofocus value="<?= old('IdTpq');?>" id="FormProfilTpq" maxlength="20" min="1" 
                        >
                        <div class="invalid-feedback">
                            <?= $validation->getError('IdTpq'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FormProfilTpq">Nama TPQ</label>
                        <input 
                            type="text" name="NamaTpq" id="FormProfilTpq" placeholder="Ketik Nama TPQ"
                            class="form-control  <?= ($validation->hasError('NamaTpq')) ? 'is-invalid' : ''; ?>"  
                        >
                        <div class="invalid-feedback">
                            <?= $validation->getError('NamaTpq'); ?>
                        </div>
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
        
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection(); ?>