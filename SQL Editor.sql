-- ====================== 

WITH FilteredNilai AS (
    SELECT *
    FROM tbl_nilai
    WHERE 
        IdKelas = 'SD1' AND 
        IdTahunAjaran = '20222023' AND
        IdTpq = '411221010225'
)

SELECT 
    n.Id AS Id,
    n.IdTahunAjaran,
    n.Semester,
    k.NamaKelas,
    n.IdSantri AS IdSantri,
    -- s.Nama AS NamaSantri,
    -- s.JenisKelamin AS JenisKelamin,
    -- t.NamaTpq AS NamaTpq,
    m.NamaMateri AS NamaMateri,
    n.IdMateri,
    n.IdGuru,
    n.Nilai AS Nilai,
    ROUND(
        (SELECT AVG(n2.Nilai)
         FROM FilteredNilai n2
         WHERE n2.IdMateri = n.IdMateri
         AND n2.IdKelas = n.IdKelas
         AND n2.IdTahunAjaran = n.IdTahunAjaran
         AND n2.Semester = n.Semester
        ), 2
    ) AS NilaiRataRataMateriPelajaranPerKelas,
    r.Rangking
FROM FilteredNilai n
JOIN tbl_santri s ON n.IdSantri = s.IdSantri
JOIN tbl_tpq t ON n.IdTpq = t.IdTpq
JOIN tbl_materi_pelajaran m ON n.IdMateri = m.IdMateri
JOIN tbl_kelas k ON n.IdKelas = k.IdKelas
JOIN (
    SELECT 
        IdSantri,
        SUM(Nilai) AS TotalNilai,
        RANK() OVER (ORDER BY SUM(Nilai) DESC) AS Rangking
    FROM FilteredNilai
    GROUP BY IdSantri
) r ON n.IdSantri = r.IdSantri

UNION ALL

SELECT 
    'TOTAL' AS Id_tbl_nilai,
    NULL AS IdTahunAjaran,
    NULL AS Semester,
    NULL AS NamaKelas,
    NULL AS IdSantri,
   -- NULL AS NamaSantri,
    -- NULL AS JenisKelamin,
    -- NULL AS NamaTpq,
    NULL AS NamaMateri,
    NULL AS IdMateri,
    NULL AS IdGuru,
    SUM(n.Nilai) AS Nilai,
    ROUND(AVG(n.Nilai), 2) AS Rata2Kelas,
    NULL AS Rangking
FROM FilteredNilai n;

-- ================
WITH FilteredNilai AS (
    SELECT *
    FROM tbl_nilai
    WHERE 
        IdKelas = 'SD1' AND 
        IdTahunAjaran = '20222023' AND
        IdTpq = '411221010225'
),
Semester1Data AS (
    SELECT 
        IdSantri,
        IdMateri,
        SUM(Nilai) AS TotalNilai_Semester_1
    FROM FilteredNilai
    WHERE Semester = '1'
    GROUP BY IdSantri, IdMateri
),
Semester2Data AS (
    SELECT 
        IdSantri,
        IdMateri,
        SUM(Nilai) AS TotalNilai_Semester_2
    FROM FilteredNilai
    WHERE Semester = '2'
    GROUP BY IdSantri, IdMateri
),
-- Subquery untuk mendapatkan nilai rata-rata materi per kelas (Semester 1 dan 2)
AvgNilaiPerMateri_Semester1 AS (
    SELECT 
        IdMateri,
        ROUND(AVG(Nilai), 2) AS NilaiRataRataMateri_Semester_1
    FROM FilteredNilai
    WHERE Semester = '1'
    GROUP BY IdMateri
),
AvgNilaiPerMateri_Semester2 AS (
    SELECT 
        IdMateri,
        ROUND(AVG(Nilai), 2) AS NilaiRataRataMateri_Semester_2
    FROM FilteredNilai
    WHERE Semester = '2'
    GROUP BY IdMateri
)

-- Menggunakan UNION untuk gabungan Semester 1 dan 2
SELECT 
    COALESCE(s1.IdSantri, s2.IdSantri) AS IdSantri,
    COALESCE(s1.IdMateri, s2.IdMateri) AS IdMateri,  -- Menggunakan IdMateri yang ada di salah satu semester
    COALESCE(s1.TotalNilai_Semester_1, 0) AS Nilai_Semester_1, -- Jika tidak ada di semester 1, isi dengan 0
    COALESCE(s2.TotalNilai_Semester_2, 0) AS Nilai_Semester_2, -- Jika tidak ada di semester 2, isi dengan 0
    -- Mengambil Nilai Rata-rata per Materi dari subquery yang berbeda untuk Semester 1 dan 2
    COALESCE(a1.NilaiRataRataMateri_Semester_1, 0) AS NilaiRataRataMateriPelajaranPerKelas_S1,
    COALESCE(a2.NilaiRataRataMateri_Semester_2, 0) AS NilaiRataRataMateriPelajaranPerKelas_S2
FROM Semester1Data s1
LEFT JOIN Semester2Data s2 ON s1.IdSantri = s2.IdSantri AND s1.IdMateri = s2.IdMateri
LEFT JOIN AvgNilaiPerMateri_Semester1 a1 ON s1.IdMateri = a1.IdMateri
LEFT JOIN AvgNilaiPerMateri_Semester2 a2 ON s2.IdMateri = a2.IdMateri

-- UNION untuk menangani materi yang hanya ada di Semester 2
UNION ALL

SELECT 
    s2.IdSantri,
    s2.IdMateri,
    COALESCE(s1.TotalNilai_Semester_1, 0) AS Nilai_Semester_1,
    COALESCE(s2.TotalNilai_Semester_2, 0) AS Nilai_Semester_2,
    -- Mengambil Nilai Rata-rata per Materi dari subquery
    COALESCE(a1.NilaiRataRataMateri_Semester_1, 0) AS NilaiRataRataMateriPelajaranPerKelas_S1,
    COALESCE(a2.NilaiRataRataMateri_Semester_2, 0) AS NilaiRataRataMateriPelajaranPerKelas_S2
FROM Semester2Data s2
LEFT JOIN Semester1Data s1 ON s1.IdSantri = s2.IdSantri AND s1.IdMateri = s2.IdMateri
LEFT JOIN AvgNilaiPerMateri_Semester1 a1 ON s2.IdMateri = a1.IdMateri
LEFT JOIN AvgNilaiPerMateri_Semester2 a2 ON s2.IdMateri = a2.IdMateri
WHERE s1.IdMateri IS NULL;


-- ================= Insert
CREATE TABLE tbl_jabatan (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    NamaJabatan VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
