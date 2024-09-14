<?= $this->extend('backend/template/template'); ?>
<?= $this->section('containt'); ?>
<div class="col-12">
    <?php echo session()->getFlashdata('pesan'); ?>
    <div class="card">
        <?php
        // Extracting the first result from $dataNilai (assuming it has at least one result)
        $dataNilai = $nilai->getResult();
        if (!empty($dataNilai)) {
            $firstResult = $dataNilai[0];
            $IdSantri = htmlspecialchars($firstResult->IdSantri, ENT_QUOTES, 'UTF-8');
            $NamaSantri = htmlspecialchars($firstResult->Nama, ENT_QUOTES, 'UTF-8');
            $Semester = htmlspecialchars($firstResult->Semester, ENT_QUOTES, 'UTF-8');
            $NamaKelas = htmlspecialchars($firstResult->IdKelas, ENT_QUOTES, 'UTF-8');
            // Format the Tahun with "/"
            $Tahun = $firstResult->IdTahunAjaran;
            if (strlen($Tahun) == 8) {
                $Tahun = substr($Tahun, 0, 4) . '/' . substr($Tahun, 4, 4);
            } else {
                $Tahun = 'Invalid Year Format'; 
            }
        } else {
            // Default values or handle the case when $dataNilai is empty
            $NamaSantri = "";
            $Tahun = "";
            $Semester = "";
            $IdSantri ="";
        }
        ?>

        <div class="card-header">
            <h3 class="card-title">
                Data Nilai Santri <strong><?= $IdSantri .' - ' .$NamaSantri?></strong> Kelas <?= $NamaKelas?> Tahun <?= $Tahun?> Semester <?= $Semester?>
            </h3>
        </div>       <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                   <?php
                        $tableHeadersFooter = '
                            <tr>
                                <th>Kategori</th>
                                <th>Nama Materi</th>
                                <th>Nilai</th>
                                <th>Catatan</th>';
                        if ($pageEdit) {
                            $tableHeadersFooter .= '<th>Aksi</th>';
                        }
                        $tableHeadersFooter .= '</tr>';
                        echo $tableHeadersFooter
                    ?>

                </thead>
                <tbody>
                    <?php
                    $MainDataNilai=$nilai->getResult();
                    foreach ($MainDataNilai as $DataNilai) : 
                        if(
                            $pageEdit && (double)$DataNilai->Nilai <= 0.0 &&  $guruPendamping ||
                            !$pageEdit &&  $guruPendamping || !$guruPendamping
                         )
                        {?>

                        <tr>
                            <td><?php echo $DataNilai->Kategori; ?></td>
                            <td><?php echo $DataNilai->NamaMateri; ?></td>
                            <td><?php echo $DataNilai->Nilai; ?></td>
                            <td><?php echo $DataNilai->Catatan; ?></td>
                            <?php if($pageEdit) {?>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#EditNilai<?= $DataNilai->Id  ?>"><i class="fas fa-edit"></i></button>
                                </td>
                            <?php }?>
                        </tr>
                    <?php }
                    endforeach ?>
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

<!-- Modal Edit Data-->
<?php 
$MainDataNilai=$nilai->getResult();
foreach ($MainDataNilai as $DataNilai) : ?>
    <div class="modal fade" id="EditNilai<?= $DataNilai->Id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nilai </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('nilai/update/'.$pageEdit) ?>" method="POST">
                        <input type="hidden" name="Id" value= <?= $DataNilai->Id ?>>
                        <input type="hidden" name="IdSantri" value= <?= $DataNilai->IdSantri ?>>
                        <input type="hidden" name="Semester" value= <?= $DataNilai->Semester ?>>
                        <input type="hidden" name="NamaMateri" value="<?= htmlspecialchars($DataNilai->NamaMateri, ENT_QUOTES, 'UTF-8') ?>">
                        
                        <div class="form-group">
                            <label for="FormProfilTpq">Kategori</label>
                            <span class="form-control" id="FormProfilTpq"><?= $DataNilai->Kategori ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="FormProfilTpq">Nama Materi</label>
                            <span class="form-control" id="FormProfilTpq"><?= $DataNilai->NamaMateri ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="FormProfilTpq">Nilai</label>
                            <input type="number" name="Nilai" class="form-control" id="FormProfilTpq" required 
                                placeholder="Ketik Nilai" value="<?= $DataNilai->Nilai ?>" 
                                min="50" max="95" 
                                oninvalid="this.setCustomValidity('Nilai harus antara 50 dan 95')" 
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="Catatan">Catatan</label>
                            <textarea name="Catatan" class="form-control" id="Catatan" placeholder="Tambahkan catatan jika diperlukan"><?= isset($DataNilai->Catatan) ? htmlspecialchars($DataNilai->Catatan, ENT_QUOTES, 'UTF-8') : '' ?></textarea>
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
<?= $this->endSection(); ?>