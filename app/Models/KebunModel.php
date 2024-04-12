<?php

namespace App\Models;

use CodeIgniter\Model;

class KebunModel extends Model
{
    protected $primaryKey = 'KODE_KEBUN';

    public function bulan_id($id = false)
    {
        $bulans = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        if ($id) {
            return $bulans[$id];
        } else {
            return $bulans;
        }
    }

    public function kebunbarat()
    {
        return $this->db->table('tbl_kebun')->where('DISTRIK', 'BARAT')->get()->getResultArray();
    }

    public function kebuntimur()
    {
        return $this->db->table('tbl_kebun')->where('DISTRIK', 'TIMUR')->get()->getResultArray();
    }

    public function kebunAll()
    {
        $query_kebun = "SELECT
        tbl_kebun.KODE_KEBUN,
        tbl_kebun.DISTRIK,
        tbl_kebun.JUMLAH_BLOK
        FROM
        tbl_kebun
        ORDER BY
        tbl_kebun.DISTRIK ASC,
        tbl_kebun.KODE_KEBUN ASC
         ";
        return $this->db->query($query_kebun)->getResultArray();
    }

    public function nilailevel1($tahun)
    {
        $query_nilai = "SELECT
	kode_kebun,
	tahun,
	bulan,
	sum( sum_nilai_pokok ) as sum_nilai_pokok,
	sum(count_nilai_pokok) as count_nilai_pokok,
	FORMAT(sum( sum_nilai_pokok ) / sum( count_nilai_pokok ),2) AS nilai_pokok,
	sum(sum_nilai_block) as sum_nilai_block,
	sum(count_nilai_block) as count_nilai_block ,
	FORMAT(sum( sum_nilai_block ) / sum( count_nilai_block ),2) AS nilai_block,
	FORMAT(( IFNULL(sum( sum_nilai_pokok ) / sum( count_nilai_pokok ),0) + IFNULL(sum( sum_nilai_block ) / sum( count_nilai_block ),0) ) / 2,2) AS nilai 
FROM
	`summary_nilai` 
WHERE
	tahun = $tahun
	GROUP BY kode_kebun,tahun,bulan";
        $nilai = [];
        if ($result = $this->db->query($query_nilai)) {
            /* fetch associative array */
            foreach ($row = $result->getResultArray() as $r) {
                $nilai[] = $r;
            }
            $result->freeResult();
        }
        // echo json_encode($nilai);
        return $row;
    }

    public function aflbarat($Kkebun)
    {
        $query_block = sprintf("SELECT
        tbl_blok.KODE_KEBUN,
        tbl_blok.KODE_AFDELING,
        tbl_blok.NAMA_BLOCK
        FROM
        tbl_blok
        WHERE
        tbl_blok.KODE_KEBUN = '%s'
        ORDER BY
        tbl_blok.KODE_AFDELING ASC,
        tbl_blok.NAMA_BLOCK ASC
        ", $Kkebun);

        return $this->db->query($query_block)->getResultArray();
    }

    public function blokpbln($kodekebun)
    {
        $query_block = sprintf("SELECT DISTINCT
        tbl_blok.KODE_KEBUN,
        tbl_blok.KODE_AFDELING,
        tbl_blok.NAMA_BLOCK
        FROM
        tbl_blok
        WHERE
        tbl_blok.KODE_KEBUN = '%s'
        ORDER BY
        tbl_blok.KODE_AFDELING ASC,
        tbl_blok.NAMA_BLOCK ASC
        ", $kodekebun);
        return $this->db->query($query_block)->getResultArray();
    }

    public function nilai($tahun, $Kkebun)
    {
        $query_nilai = "
SELECT
	*,
	FORMAT( sum_nilai_pokok / count_nilai_pokok, 2 ) AS nilai_pokok,
	FORMAT( sum_nilai_block / count_nilai_block, 2 ) AS nilai_block,
	FORMAT(
		( IFNULL( ( sum_nilai_pokok / count_nilai_pokok ), 0 ) + IFNULL( ( sum_nilai_block / count_nilai_block ), 0 ) ) / 2,
		2 
	) AS nilai 
FROM
	`summary_nilai`
	where tahun=$tahun
	and kode_kebun=\"$Kkebun\"
";

        $nilai = [];
        if ($result = $this->db->query($query_nilai)) {
            /* fetch associative array */
            foreach ($row = $result->getResultArray() as $r) {
                $nilai[] = $r;
            }
            $result->freeResult();
        }

        return $row;
        // return $this->db->query($query_nilai)->getResultArray();
    }

    public function nilaipbln($tahun, $bulan, $kode_kebun)
    {
        $query_nilai = "SELECT
	*,
	FORMAT( sum_nilai_pokok / count_nilai_pokok, 2 ) AS nilai_pokok,
	FORMAT( sum_nilai_block / count_nilai_block, 2 ) AS nilai_block,
	FORMAT(
		( IFNULL( ( sum_nilai_pokok / count_nilai_pokok ), 0 ) + IFNULL( ( sum_nilai_block / count_nilai_block ), 0 ) ) / 2,
		2 
	) AS nilai 
FROM
	`summary_nilai`
	where tahun=$tahun
	and bulan=$bulan
	and kode_kebun='$kode_kebun'";

        $nilai = [];
        if ($result = $this->db->query($query_nilai)) {
            /* fetch associative array */
            foreach ($row = $result->getResultArray() as $r) {
                $nilai[] = $r;
            }
            $result->freeResult();
        }

        return $row;
    }

    public function head_pokok($tahun, $bulan, $kebun, $block)
    {
        $sqlHeadSoalPokok = sprintf("SELECT
*
FROM
head_soal_pokok
WHERE
head_soal_pokok.tanggal like '%d-%02d%%' AND
head_soal_pokok.kode_kebun = '%s' AND
head_soal_pokok.block = '%s';", $tahun, $bulan, $kebun, $block);
        //die($sqlHeadSoalPokok);

        if ($resultHeadSoalPokok = $this->db->query($sqlHeadSoalPokok)) {
            $arrHeadSoalPokok = $resultHeadSoalPokok->getRowArray();
        }
        return $arrHeadSoalPokok;
    }

    public function detail_pokok($tahun, $bulan, $kebun, $block)
    {
        $headpokok = $this->head_pokok($tahun, $bulan, $kebun, $block);
        $sqlDetailSoalPokok = sprintf(
            "
    SELECT
    *, CASE
        WHEN nilai <= 35 THEN 'row-buruk'
        WHEN nilai <= 80 THEN 'row-sedang'
        ELSE 'row-baik' END AS kualitas
    FROM
    detail_soal_pokok
    WHERE
    id_head = '%s'
    AND tanggal LIKE '%d-%02d%%'",
            $headpokok['id_head'],
            $tahun,
            $bulan
        );
        return $sqlDetailSoalPokok;
    }

    public function block($tahun, $bulan, $kebun, $block)
    {
        $headpokok = $this->head_pokok($tahun, $bulan, $kebun, $block);
        $sqlJawabBlock = sprintf(
            "
SELECT
*, CASE
    WHEN nilai <= 35 THEN 'row-buruk'
    WHEN nilai <= 80 THEN 'row-sedang'
    ELSE 'row-baik' END AS kualitas
FROM
tbl_jwb_block
WHERE
id_head = '%s'
AND tanggal LIKE '%d-%02d%%'",
            $headpokok['id_head'],
            $tahun,
            $bulan
        );
        return $sqlJawabBlock;
    }

    public function kbnperbulan($tahun, $bulan)
    {

        $query_kebun = "
SELECT
	keb.*,
	$tahun AS tahun,
	$bulan AS bulan,
	IFNULL( jumlah_block_terinput, 0 ) jumlah_block_terinput,
	format( IFNULL( jumlah_block_terinput, 0 ) / JUMLAH_BLOK * 100, 2 ) AS persen_input,
	IF
	(
		IFNULL( jumlah_block_terinput, 0 ) / JUMLAH_BLOK > 0.85,
		\"baik\",
	IF
		( IFNULL( jumlah_block_terinput, 0 ) / JUMLAH_BLOK >= 0.71, \"cukup\", \"kurang\" ) 
	) AS nilai 
FROM
	tbl_kebun AS keb
	LEFT JOIN (
	SELECT
		KODE_KEBUN,
		kode_afdeling,
		count( block ) AS jumlah_block_terinput 
	FROM
		`summary_nilai` 
	WHERE
		tahun = $tahun 
		AND bulan = $bulan 
		AND sum_nilai_pokok IS NOT NULL 
		AND sum_nilai_block IS NOT NULL 
	GROUP BY
	kode_kebun 
	) summary ON summary.KODE_KEBUN = keb.KODE_KEBUN
";
        return $query_kebun;
    }
}
