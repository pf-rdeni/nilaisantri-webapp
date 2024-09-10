SELECT
        tbl_nilai.IdSantri, tbl_santri.Nama, tbl_santri.JenisKelamin,
        tbl_tahun_ajaran.NamaTahunAjaran, tbl_nilai.Semester, 
        SUM(Nilai) AS TotalNilai, 
        concat(ROUND(AVG(Nilai),2)) AS NilaiRataRata
        FROM
        tbl_nilai, tbl_santri, tbl_tahun_ajaran
        WHERE
        tbl_nilai.IdSantri=tbl_santri.IdSantri
        AND tbl_tahun_ajaran.IdTahunAjaran=tbl_nilai.IdTahunAjaran
        AND tbl_nilai.IdKelas="SD1"  
        GROUP BY
        tbl_nilai.IdSantri,
        tbl_nilai.Semester
        ORDER BY
        tbl_nilai.Semester ASC,
        TotalNilai DESC;

SELECT 
    ks.IdTahunAjaran,
    k.TingkatKelas,
    g.Nama AS GuruNama,
    s.IdSantri,
    s.Nama AS SantriNama,
    s.JenisKelamin,
    t.NamaTpq,
    t.Alamat
FROM 
    tbl_kelas_santri ks
JOIN 
    tbl_kelas k ON ks.IdKelas = k.IdKelas
JOIN 
    tbl_santri s ON ks.IdSantri = s.IdSantri
JOIN 
    tbl_tpq t ON ks.IdTpq = t.IdTpq
JOIN 
    tbl_wali_kelas w ON w.IdKelas = k.IdKelas AND w.IdTpq = t.IdTpq
JOIN 
    tbl_guru g ON w.IdGuru = g.Nik
WHERE 
    ks.IdTahunAjaran = w.IdTahunAjaran;
