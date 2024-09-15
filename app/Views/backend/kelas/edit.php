<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<form action="<?= base_url('kelas/update/' . $guruKelas['Id']); ?>" method="post">
    <label for="IdTpq">ID TPQ:</label>
    <input type="text" name="IdTpq" value="<?= $guruKelas['IdTpq']; ?>" required>
    <br>
    <label for="IdKelas">ID Kelas:</label>
    <input type="text" name="IdKelas" value="<?= $guruKelas['IdKelas']; ?>" required>
    <br>
    <label for="IdGuru">ID Guru:</label>
    <input type="text" name="IdGuru" value="<?= $guruKelas['IdGuru']; ?>" required>
    <br>
    <label for="IdTahunAjaran">ID Tahun Ajaran:</label>
    <input type="text" name="IdTahunAjaran" value="<?= $guruKelas['IdTahunAjaran']; ?>" required>
    <br>
    <label for="Posisi">Posisi:</label>
    <input type="text" name="Posisi" value="<?= $guruKelas['Posisi']; ?>" required>
    <br>
    <button type="submit">Update</button>
</form>

<?= $this->endSection(); ?>
