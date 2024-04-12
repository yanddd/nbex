<?php

$db = db_connect();

$count_pokok = 0;

$arrDetailSoalPokok = [];
if ($resultDetailSoalPokok = $db->query($detail_pokok)) {
    /* fetch associative array */
    foreach ($row = $resultDetailSoalPokok->getResultArray() as $r) {
        @$arrDetailSoalPokok[$r['soal']]['sum'] += $r['nilai'];
        @$arrDetailSoalPokok[$r['soal']]['count']++;
        $arrDetailSoalPokok[$r['soal']]['nilai'] = $arrDetailSoalPokok[$r['soal']]['sum'] / $arrDetailSoalPokok[$r['soal']]['count'];
        @$arrDetailSoalPokok[$r['soal']]['items'][] = $r;
    }
    $resultDetailSoalPokok->freeResult();
}

// Menghitung rataan nilai pokok berdasarkan rataan per soal

$sum_pokok = 0;

foreach ($arrDetailSoalPokok as $soal => $item2) {
    $sum_pokok += $item2['nilai'];
}

$countPokok = count($arrDetailSoalPokok);

if ($countPokok == 0) {
} else {
    # code...
    $nilai_pokok = $sum_pokok / $countPokok;
}


// -------------------- END Menghitung rataan nilai pokok berdasarkan rataan per soal

// START hitung penilaian block

$arrJawabBlock = [];

if ($resultJawabBlock = $db->query($block_detail)) {
    /* fetch associative array */
    foreach ($row = $resultJawabBlock->getResultArray() as $r) {
        $arrJawabBlock[] = $r;
    }
    $resultJawabBlock->freeResult();
}

$sum_block = 0;
foreach ($arrJawabBlock as $soal => $item3) {
    $sum_block += $item3['nilai'];
}

$countblock =  count($arrJawabBlock);

if ($countblock == 0) {
} else {
    $nilai_block = $sum_block / $countblock;
}

?>

<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>

<style type="text/css">
    .row-buruk {
        background: salmon;
    }

    .row-sedang {
        background: gold;
    }

    .row-baik {
        background: lightgreen;
    }
</style>

<?php


if ($countPokok == 0) { ?>

    <script>
        window.close();
    </script>

<?php } else { ?>



    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="active"><a data-toggle="tab" href="#piringan">Piringan Pokok</a>
                        </li>
                        <li><a data-toggle="tab" href="#btt">Buah Tidak Terpanen</a>
                        </li>
                        <li><a data-toggle="tab" href="#mp">Mutu Pupuk</a>
                        </li>
                        <li><a data-toggle="tab" href="#pp">Pasar Pikul</a>
                        </li>
                        <li><a data-toggle="tab" href="#mt">Mutu Tunasan</a>
                        </li>
                        <li><a data-toggle="tab" href="#gawangan">Gawangan</a>
                        </li>
                        <li><a data-toggle="tab" href="#pb">Penilaian Block</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="piringan" class="tab-pane in active notika-tab-menu-bg animated fadeIn">
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="basic-tb-hd">
                                                <h2>Piringan Pokok</h2>
                                            </div>
                                            <div class="bsc-tbl-cds">
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead style="background-color: rgb(0,51,25);">
                                                        <tr style="font-weight: bold; height: 35px;">
                                                            <td style="color:white; width: 20%; text-align: center;">Tanggal</td>
                                                            <td style="color:white; text-align: center;">Baris Ke</td>
                                                            <td style="color:white; text-align: center;">Pokok Ke</td>
                                                            <td style="color:white; text-align: center;">Nilai</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($arrDetailSoalPokok as $soal => $arr_soal) : ?>
                                                            <?php if ($soal == 'Piringan Pokok') : ?>
                                                                <?php foreach ($arr_soal['items'] as $detail) : ?>
                                                                    <tr class="<?php echo $detail['kualitas'] ?>" style="height: 25px; text-align: center;">
                                                                        <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;"><?php echo $detail['tanggal']; ?></td>
                                                                        <td><?php echo $detail['baris']; ?></td>
                                                                        <td><?php echo $detail['pokok']; ?></td>
                                                                        <td><?php echo $detail['nilai']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                <tr style="height: 25px; background:rgb(0,51,25);">
                                                                    <td style="height: 25px; color:white;  text-align:right;" colspan="3">Rataan <?php echo $soal; ?> = <?php echo $arr_soal['sum']; ?> / <?php echo $arr_soal['count']; ?>&nbsp;= &nbsp;</td>
                                                                    <td style="height: 25px; color:white; text-align:center;"><?php printf("%0.2f", $arr_soal['nilai']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div id="btt" class="tab-pane notika-tab-menu-bg animated fadeIn">
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="basic-tb-hd">
                                                <h2>Buah Tidak Terpanen</h2>
                                            </div>
                                            <div class="bsc-tbl-cds">
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead style="background-color: rgb(0,51,25);">
                                                        <tr style="font-weight: bold; height: 35px;">
                                                            <td style="color:white; width: 20%; text-align: center;">Tanggal</td>
                                                            <td style="color:white; text-align: center;">Baris Ke</td>
                                                            <td style="color:white; text-align: center;">Pokok Ke</td>
                                                            <td style="color:white; text-align: center;">Nilai</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($arrDetailSoalPokok as $soal => $arr_soal) : ?>
                                                            <?php if ($soal == 'Buah tidak terpanen') : ?>
                                                                <?php foreach ($arr_soal['items'] as $detail) : ?>
                                                                    <tr class="<?php echo $detail['kualitas'] ?>" style="height: 25px; text-align: center;">
                                                                        <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;"><?php echo $detail['tanggal']; ?></td>
                                                                        <td><?php echo $detail['baris']; ?></td>
                                                                        <td><?php echo $detail['pokok']; ?></td>
                                                                        <td><?php echo $detail['nilai']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                <tr style="height: 25px;  background:rgb(0,51,25);">
                                                                    <td style="height: 25px; color:white; text-align:right;" colspan="3">Rataan <?php echo $soal; ?> = <?php echo $arr_soal['sum']; ?> / <?php echo $arr_soal['count']; ?>&nbsp;= &nbsp;</td>
                                                                    <td style="height: 25px;  color:white;  text-align:center;"><?php printf("%0.2f", $arr_soal['nilai']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div id="mp" class="tab-pane notika-tab-menu-bg animated fadeIn">
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="basic-tb-hd">
                                                <h2>Mutu Pupuk</h2>
                                            </div>
                                            <div class="bsc-tbl-cds">
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead style="background-color: rgb(0,51,25);">
                                                        <tr style="font-weight: bold; height: 35px;">
                                                            <td style="color:white; width: 20%; text-align: center;">Tanggal</td>
                                                            <td style="color:white; text-align: center;">Baris Ke</td>
                                                            <td style="color:white; text-align: center;">Pokok Ke</td>
                                                            <td style="color:white; text-align: center;">Nilai</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($arrDetailSoalPokok as $soal => $arr_soal) : ?>
                                                            <?php if ($soal == 'Mutu Pupuk') : ?>
                                                                <?php foreach ($arr_soal['items'] as $detail) : ?>
                                                                    <tr class="<?php echo $detail['kualitas'] ?>" style="height: 25px; text-align: center;">
                                                                        <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;"><?php echo $detail['tanggal']; ?></td>
                                                                        <td><?php echo $detail['baris']; ?></td>
                                                                        <td><?php echo $detail['pokok']; ?></td>
                                                                        <td><?php echo $detail['nilai']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                <tr style="height: 25px; background:rgb(0,51,25);">
                                                                    <td style="height: 25px; color:white;text-align:right;" colspan="3">Rataan <?php echo $soal; ?> = <?php echo $arr_soal['sum']; ?> / <?php echo $arr_soal['count']; ?>&nbsp;= &nbsp;</td>
                                                                    <td style="height: 25px;  color:white;  text-align:center;"><?php printf("%0.2f", $arr_soal['nilai']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div id="pp" class="tab-pane notika-tab-menu-bg animated fadeIn">
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="basic-tb-hd">
                                                <h2>Pasar Pikul</h2>
                                            </div>
                                            <div class="bsc-tbl-cds">
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead style="background-color:rgb(0,51,25);">
                                                        <tr style="font-weight: bold; height: 35px;">
                                                            <td style="color:white; width: 20%; text-align: center;">Tanggal</td>
                                                            <td style="color:white; text-align: center;">Baris Ke</td>
                                                            <td style="color:white; text-align: center;">Pokok Ke</td>
                                                            <td style="color:white; text-align: center;">Nilai</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($arrDetailSoalPokok as $soal => $arr_soal) : ?>
                                                            <?php if ($soal == 'Pasar Pikul') : ?>
                                                                <?php foreach ($arr_soal['items'] as $detail) : ?>
                                                                    <tr class="<?php echo $detail['kualitas'] ?>" style="height: 25px; text-align: center;">
                                                                        <td style="background-color:rgb(0,51,25); font-weight: bold; color:white;"><?php echo $detail['tanggal']; ?></td>
                                                                        <td><?php echo $detail['baris']; ?></td>
                                                                        <td><?php echo $detail['pokok']; ?></td>
                                                                        <td><?php echo $detail['nilai']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                <tr style="height: 25px; background:rgb(0,51,25);">
                                                                    <td style="height: 25px; color:white;text-align:right;" colspan="3">Rataan <?php echo $soal; ?> = <?php echo $arr_soal['sum']; ?> / <?php echo $arr_soal['count']; ?>&nbsp;= &nbsp;</td>
                                                                    <td style="height: 25px; color:white;  text-align:center;"><?php printf("%0.2f", $arr_soal['nilai']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div id="mt" class="tab-pane notika-tab-menu-bg animated fadeIn">
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="basic-tb-hd">
                                                <h2>Mutu Tunasan</h2>
                                            </div>
                                            <div class="bsc-tbl-cds">
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead style="background-color: rgb(0,51,25);">
                                                        <tr style="font-weight: bold; height: 35px;">
                                                            <td style="color:white; width: 20%; text-align: center;">Tanggal</td>
                                                            <td style="color:white; text-align: center;">Baris Ke</td>
                                                            <td style="color:white; text-align: center;">Pokok Ke</td>
                                                            <td style="color:white; text-align: center;">Nilai</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($arrDetailSoalPokok as $soal => $arr_soal) : ?>
                                                            <?php if ($soal == 'Mutu Tunasan') : ?>
                                                                <?php foreach ($arr_soal['items'] as $detail) : ?>
                                                                    <tr class="<?php echo $detail['kualitas'] ?>" style="height: 25px; text-align: center;">
                                                                        <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;"><?php echo $detail['tanggal']; ?></td>
                                                                        <td><?php echo $detail['baris']; ?></td>
                                                                        <td><?php echo $detail['pokok']; ?></td>
                                                                        <td><?php echo $detail['nilai']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                <tr style="height: 25px; background:rgb(0,51,25);">
                                                                    <td style="height: 25px ;color:white;text-align:right;" colspan="3">Rataan <?php echo $soal; ?> = <?php echo $arr_soal['sum']; ?> / <?php echo $arr_soal['count']; ?>&nbsp;= &nbsp;</td>
                                                                    <td style="height: 25px; color:white;  text-align:center;"><?php printf("%0.2f", $arr_soal['nilai']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div id="gawangan" class="tab-pane notika-tab-menu-bg animated fadeIn">
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="basic-tb-hd">
                                                <h2>Gawangan</h2>
                                            </div>
                                            <div class="bsc-tbl-cds">
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead style="background-color: rgb(0,51,25);">
                                                        <tr style="font-weight: bold; height: 35px;">
                                                            <td style="color:white; width: 20%; text-align: center;">Tanggal</td>
                                                            <td style="color:white; text-align: center;">Baris Ke</td>
                                                            <td style="color:white; text-align: center;">Pokok Ke</td>
                                                            <td style="color:white; text-align: center;">Nilai</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($arrDetailSoalPokok as $soal => $arr_soal) : ?>
                                                            <?php if ($soal == 'Gawangan') : ?>
                                                                <?php foreach ($arr_soal['items'] as $detail) : ?>
                                                                    <tr class="<?php echo $detail['kualitas'] ?>" style="height: 25px; text-align: center;">
                                                                        <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;"><?php echo $detail['tanggal']; ?></td>
                                                                        <td><?php echo $detail['baris']; ?></td>
                                                                        <td><?php echo $detail['pokok']; ?></td>
                                                                        <td><?php echo $detail['nilai']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                <tr style="height: 25px; background:rgb(0,51,25);">
                                                                    <td style="height: 25px; color:white;text-align:right;" colspan="3">Rataan <?php echo $soal; ?> = <?php echo $arr_soal['sum']; ?> / <?php echo $arr_soal['count']; ?>&nbsp;= &nbsp;</td>
                                                                    <td style="height: 25px;  color:white; text-align:center;"><?php printf("%0.2f", $arr_soal['nilai']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div id="pb" class="tab-pane notika-tab-menu-bg animated fadeIn">
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="basic-tb-hd">
                                                <h2>Penilaian Block</h2>
                                            </div>
                                            <div class="bsc-tbl-cds">
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead style="background-color: rgb(0,51,25);">
                                                        <tr style="font-weight: bold; height: 35px;">
                                                            <td style="color:white; width: 5%; text-align: center;">No</td>
                                                            <td style="color:white; width: 20%; text-align: center;">Parameter</td>
                                                            <td style="color:white; text-align: center;">Nilai</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($arrJawabBlock as $index => $jb) : ?>
                                                            <tr style="height: 25px;" class="<?php echo $jb['kualitas'] ?>">
                                                                <td style="text-align: center; color:white; height: 25px; background-color: rgb(0,51,25);"><?php echo $index + 1; ?></td>
                                                                <td style="height: 25px;"><span style="margin-left: 5px;"><?php echo $jb['soal']; ?></span></td>
                                                                <td style="height: 25px; text-align: center;"><?php echo $jb['nilai']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr style="height: 25px;background:#DAA520;font-weight:bold;">
                                                            <td style="height: 25px;">&nbsp;</td>
                                                            <td style="height: 25px; text-align: center;">Rataan penilaian Block</td>
                                                            <td style="height: 25px; text-align: center;"><?php printf("%0.2f", $nilai_block); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </ul>
                            <ul class="notika-main-menu-dropdown">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p style="margin-left: 20px;"><strong>Rataan Penilaian Block &amp; Pokok: <?php printf("%0.2f", ($nilai_pokok + $nilai_block) / 2); ?></strong></p>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?= $this->endSection(); ?>