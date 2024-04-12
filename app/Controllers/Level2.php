<?php

namespace App\Controllers;

use App\Models\KebunModel;

class Level2 extends BaseController
{
    protected $kebunModel;
    public function __construct()
    {
        $this->kebunModel = new KebunModel();
    }

    public function index($params)
    {
        $tahun = explode("-", $params)[0];
        $kode = explode("-", $params)[1];

        $data = [
            'title' => 'NBEx | Level 2',
            'afdeling' => $this->kebunModel->aflbarat($kode),
            'nilai' => $this->kebunModel->nilai($tahun, $kode),
            'tahun' => $tahun,
            'kode' => $kode,
        ];

        return view('level2/index', $data);
    }

    public function detail_data($params)
    {
        $arr = explode("_", $params);
        $kebun = $arr[1];
        $block = $arr[2];
        $tahun = $arr[3];
        $bulan = $arr[4];
        $data = [
            'title' => 'NBEx | Detail Data',
            'kebun' => $kebun,
            'block' => $block,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'head_pokok' => $this->kebunModel->head_pokok($tahun, $bulan, $kebun, $block),
            'detail_pokok' => $this->kebunModel->detail_pokok($tahun, $bulan, $kebun, $block),
            'block_detail' => $this->kebunModel->block($tahun, $bulan, $kebun, $block),
        ];
        return view('level2/detail_data', $data);
    }

    public function getDetailData()
    {
        $db = db_connect();
        $db->query("SET SQL_BIG_SELECTS=1");
        $db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $tahun = $_REQUEST['tahun'];
        $bulan = $_REQUEST['bulan'];
        $block = $_REQUEST['block'];
        $kebun = $_REQUEST['kebun'];
        $lat = "";
        $lon = "";
        $avgBlok = 0;
        $avgPokok = 0;

        $nPokok = 0; //jumlah pokok
        $nBlok = 0;

        $idSoalPokok = array();
        $responsePokok = array();

        $sqlTabelPokok = "SELECT DISTINCT id_soal, detail_soal_pokok.soal FROM `detail_soal_pokok`, head_soal_pokok WHERE detail_soal_pokok.id_head=head_soal_pokok.id_head and head_soal_pokok.kode_kebun='$kebun' and head_soal_pokok.block='$block' and MONTH(head_soal_pokok.tanggal)='$bulan' AND YEAR(head_soal_pokok.tanggal)='$tahun' GROUP BY id_soal ASC";
        if ($resultTabelPokok = $db->query($sqlTabelPokok)) {
            foreach ($rTabelPokok = $resultTabelPokok->getResultArray() as $rrTabelPokok) {
                $idSoalPokok[] = $rrTabelPokok['id_soal'];
            }
        }
        // return $rTabelPokok;

        for ($i = 0; $i < count($idSoalPokok); $i++) {

            $sqlNilaiPokok = "SELECT detail_soal_pokok.soal, detail_soal_pokok.latitude, detail_soal_pokok.longitude, AVG(detail_soal_pokok.nilai) AS avg, head_soal_pokok.block, MONTH(head_soal_pokok.tanggal) as bulan, YEAR(head_soal_pokok.tanggal) as tahun, head_soal_pokok.kode_kebun FROM detail_soal_pokok, head_soal_pokok where detail_soal_pokok.id_head=head_soal_pokok.id_head and head_soal_pokok.kode_kebun='$kebun' and MONTH(head_soal_pokok.tanggal)='$bulan' AND YEAR(head_soal_pokok.tanggal)='$tahun' AND head_soal_pokok.block='$block' and detail_soal_pokok.id_soal='$idSoalPokok[$i]'";

            if ($resultPokok = $db->query($sqlNilaiPokok)) {
                foreach ($rowPokok = $resultPokok->getResultArray() as $rrowPokok) {
                    $lat = $rrowPokok['latitude'];
                    $lon = $rrowPokok['longitude'];
                    $nPokok = $nPokok + $rrowPokok['avg'];
                    array_push($responsePokok, array(
                        $rrowPokok['soal'] => round($rrowPokok['avg'], 2)
                    ));
                }
            }
            // return $rowPokok;
        }

        if (count($idSoalPokok) != 0) {
            $avgPokok = $nPokok / count($idSoalPokok);
        }
        array_push($responsePokok, array(
            'pokok' => round($avgPokok, 2)
        ));

        $idSoalBlok = array();
        $responseBlok = array();

        //data blok
        $sqlTabelBlok = "SELECT DISTINCT id_soal, tbl_jwb_block.soal FROM `tbl_jwb_block` left join head_soal_pokok 
        		on tbl_jwb_block.id_head=head_soal_pokok.id_head where tbl_jwb_block.kode_kebun='$kebun' 
        		and tbl_jwb_block.kode_block='$block' and MONTH(head_soal_pokok.tanggal)='$bulan' 
        		AND YEAR(head_soal_pokok.tanggal)='$tahun' GROUP BY id_soal ASC";

        if ($resultTabelBlok = $db->query($sqlTabelBlok)) {
            foreach ($rTabelBlok = $resultTabelBlok->getResultArray() as $rrTabelBlok) {
                $idSoalBlok[] = $rrTabelBlok['id_soal'];
            }
        }

        for ($i = 0; $i < count($idSoalBlok); $i++) {
            // echo 'Id soal '.$idSoalBlok[$i].'<br>';

            $sqlNilaiBlok = "SELECT soal, AVG(nilai) AS avg, kode_block, MONTH(tanggal) as bulan, YEAR(tanggal) as tahun, kode_kebun, remarks FROM tbl_jwb_block 
        					where kode_kebun='$kebun' and MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND kode_block='$block' and id_soal='$idSoalBlok[$i]'";
            //die($sqlNilaiBlok);
            // var_dump($sqlNilaiBlok);
            // echo "<br>";

            if ($resultBlok = $db->query($sqlNilaiBlok)) {
                foreach ($rowBlok = $resultBlok->getResultArray() as $rrowBlok) {
                    $nBlok = $nBlok + $rrowBlok['avg'];
                    $remarks = $rrowBlok['remarks'];
                    array_push($responseBlok, array(
                        $rrowBlok['soal'] => round($rrowBlok['avg'], 2)
                    ));
                }
            }

            // return $rowBlok;
        }

        if (count($idSoalBlok) != 0) {
            $avgBlok = $nBlok / count($idSoalBlok);
        }


        array_push($responseBlok, array(
            'blok' => round($avgBlok, 2)
        ), array(
            'lat' => $lat
        ), array(
            'lon' => $lon
        ),);
        echo json_encode(array_merge($responsePokok, $responseBlok));
    }

    public function update_summary_per_block($params)
    {
        $db = db_connect();
        $db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $tahun = explode("-", $params)[0];
        $bulan = explode("-", $params)[1];
        $kode_kebun = explode("-", $params)[2];
        $block = explode("-", $params)[3];


        // A. BACA DATA LAMA, lihat tanggalnya
        // A.1. baca tanggal terakhir data nilai pokok dan block ------------------------
        // langkah A tidak dipakai

        // B. BACA DATA BARU UNTUK PERSIAPAN INPUT --------------------------------------
        // B.1. baca id_head yang perlu diupdate ke summary; max ambil 1000

        $query_baca_id_head = "SELECT id_head,tanggal FROM `head_soal_pokok` where kode_kebun='$kode_kebun' AND block='$block' AND tanggal like '$tahun-$bulan%'  ";
        //die($query_baca_id_head);
        $id_head = [];
        $max_updated_at = "2020-01-01 00:00:00";

        if ($result = $db->query($query_baca_id_head)) {
            /* fetch associative array */
            foreach ($row = $result->getResultArray() as $eee) {
                $id_head[] = $eee['id_head'];
                $max_updated_at = max($max_updated_at, $eee['tanggal']);
            }

            /* freeResult result set */
            $result->freeResult();
        }
        $id_head = array_unique($id_head);
        //print_r($id_head);die();
        $id_head_string = '"' . implode('","', $id_head) . '"';
        //die($id_head_string);

        // // B.2. baca data baru
        $query_baca_data = "
        SELECT 
        	concat(h.kode_kebun,'-',h.KODE_AFDELING,'-',h.block,'-',YEAR	( h.tanggal ),'-',LPAD(MONTH ( h.tanggal ),2,'0')) as id, -- kodekebun-afd-block-tahun-bulan
        	h.kode_kebun, h.KODE_AFDELING, h.block,
        	YEAR	( h.tanggal ) AS tahun,
        	MONTH ( h.tanggal ) AS bulan,
        	max(h.tanggal) as updated_at,
        	sum( sum_nilai_pokok ) as sum_nilai_pokok,
        	sum( count_nilai_pokok ) as count_nilai_pokok,
        	-- FORMAT(sum( sum_nilai_pokok ) / sum( count_nilai_pokok ),2) AS nilai_pokok,
        	sum( sum_nilai_block ) as sum_nilai_block,
        	sum( count_nilai_block ) as count_nilai_block -- ,
        	-- FORMAT(sum( sum_nilai_block ) / sum( count_nilai_block ),2) AS nilai_block,
        	-- FORMAT(( IFNULL(sum( sum_nilai_pokok ) / sum( count_nilai_pokok ),0) + IFNULL(sum( sum_nilai_block ) / sum( count_nilai_block ),0) ) / 2,2) AS nilai 
        FROM
        	(
        		SELECT * FROM `head_soal_pokok` where id_head in ($id_head_string)
        		) AS h
        	LEFT JOIN (
        	SELECT
        		detail_soal_pokok.id_head,
        		Sum( detail_soal_pokok.nilai ) AS sum_nilai_pokok,
        		Count( detail_soal_pokok.nilai ) AS count_nilai_pokok
        	FROM
        		detail_soal_pokok 
        	WHERE
        		id_head in ($id_head_string)
        	GROUP BY
        		detail_soal_pokok.id_head 
        	) AS pokok ON h.id_head = pokok.id_head
        	LEFT JOIN (
        	SELECT
        		tbl_jwb_block.id_head,
        		Sum( tbl_jwb_block.nilai ) AS sum_nilai_block,
        		Count( tbl_jwb_block.nilai ) AS count_nilai_block
        	FROM
        		tbl_jwb_block 
        	WHERE
        		id_head in ($id_head_string)
        	GROUP BY
        		tbl_jwb_block.id_head 
        	) AS block ON h.id_head = block.id_head 
        	LEFT JOIN tbl_kebun keb ON keb.KODE_KEBUN=h.kode_kebun
        WHERE
        	h.id_head in ($id_head_string)
        GROUP BY
        	YEAR ( h.tanggal ),
        	MONTH ( h.tanggal ),
        	h.kode_kebun ,
        	h.KODE_AFDELING,
        	h.block
        ORDER BY
        	h.kode_kebun ASC,
        	tahun ASC,
        	bulan ASC
        ";
        //die($query_baca_nilai_block);
        $data_baru = [];
        if ($result = $db->query($query_baca_data)) {
            /* fetch associative array */
            foreach ($row = $result->getResultArray() as $aa) {
                $data_baru[] = $aa;
            }

            /* freeResult result set */
            $result->freeResult();
        }
        // //print_r($data_baru);die();
        $data_baru_array = [];
        foreach ($data_baru as $d) {
            $data_baru_array[] = sprintf(
                "('%s','%s','%s','%s',%d,%02d,'%s',%d,%d,%d,%d)",
                $d['id'],
                $d['kode_kebun'],
                $d['kode_afdeling'],
                $d['block'],
                $d['tahun'],
                $d['bulan'],
                min($d['updated_at'], $max_updated_at),
                $d['sum_nilai_pokok'],
                $d['count_nilai_pokok'],
                $d['sum_nilai_block'],
                $d['count_nilai_block']
            );
        }
        //print_r($data_baru_array);die();
        $data_baru_to_string = implode(',', $data_baru_array);

        // // B.3. siapkan query insert / update
        $insert_query = "INSERT INTO summary_nilai (id,kode_kebun,kode_afdeling,block,tahun,bulan,updated_at,sum_nilai_pokok,count_nilai_pokok,sum_nilai_block,count_nilai_block)
            VALUES
            $data_baru_to_string
        ON DUPLICATE KEY UPDATE
            id = values(id),
            kode_kebun = values(kode_kebun),
            kode_afdeling = values(kode_afdeling),
            block = values(block),
            tahun = values(tahun),
            bulan = values(bulan),
            updated_at = values(updated_at),
            sum_nilai_pokok = values(sum_nilai_pokok),
            count_nilai_pokok = values(count_nilai_pokok),
            sum_nilai_block = values(sum_nilai_block),
            count_nilai_block = values(count_nilai_block)";

        $db->query($insert_query);

        // //echo (count($data_baru_array));

        // if ($_REQUEST['response'] == 'json') {
        $output = $data_baru[0];
        $output['rataan'] = round((
            ($output['sum_nilai_block'] / $output['count_nilai_block'])
            + ($output['sum_nilai_pokok'] / $output['count_nilai_pokok'])
        ) / 2, 2);
        echo json_encode($output);
    }
}
