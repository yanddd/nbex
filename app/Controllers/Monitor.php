<?php

namespace App\Controllers;

use App\Models\KebunModel;

class Monitor extends BaseController
{
    protected $kebunModel;
    public function __construct()
    {
        $this->kebunModel = new KebunModel();
    }

    public function perbulan($params = false)
    {
        if ($params == false) {
            $tahun = date('Y');
            $bulan = date('n');
        } else {
            $tahun = explode("-", $params)[0];
            $bulan = explode("-", $params)[1];
        }

        $data = [
            'title' => 'NBEx | Monitoring Perbulan',
            'kebunB' => $this->kebunModel->kebunbarat(),
            'kebunT' => $this->kebunModel->kebuntimur(),
            'kbnperbulan' => $this->kebunModel->kbnperbulan($tahun, $bulan),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulan_id' => $this->kebunModel->bulan_id(),
        ];

        return view('monitor/perbulan', $data);
    }
    public function perkebun($params = false)
    {
        if ($params == false) {
            $tahun = date('Y');
            $bulan = date('n');
            $kode = 'SBE';
        } else {
            $tahun = explode("-", $params)[0];
            $bulan = explode("-", $params)[1];
            $kode = explode("-", $params)[2];
        }

        $data = [
            'title' => 'NBEx | Monitoring Perkebun',
            'kebunAll' => $this->kebunModel->kebunAll(),
            'kode' => $kode,
            'kodekebun' => $kode,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulan_id' => $this->kebunModel->bulan_id(),
            'blockbln' => $this->kebunModel->blokpbln($kode),
            'nilaipbln' => $this->kebunModel->nilaipbln($tahun, $bulan, $kode),
        ];

        return view('monitor/perkebun', $data);
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
        ), array(
            'remarks' => $remarks
        ));
        echo json_encode(array_merge($responsePokok, $responseBlok));
    }
}
