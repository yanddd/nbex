<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
if (isset($tahun)) {
    $tahun1 = $tahun;
} else {
    $tahun1 = date('Y');
}

$tahun_ini = date('Y');

if (isset($tahun)) {
    $tahun1 = $tahun;
} else {
    $tahun1 = $tahun_ini;
}
?>

<?php
if (uri_string() == 'monitor/perbulan') {
    $url = "'perbulan/'";
} else {
    $url = '';
}

?>
<style type="text/css">
    .nilai_kosong {
        background-color: #ffffff;
    }

    .nilai_baik {
        background-color: #00B150;
    }

    .nilai_cukup {
        background-color: #FFFE06;
    }

    .nilai_kurang {
        background-color: #FC0100;
        color: white;
    }

    .glow {
        background: white;
    }

    .subtotal {
        background-color: #75a5ce;
        /* font-width: bolder; */
    }

    .total {
        background-color: orange;
        /* font-width: bolder; */
    }
</style>
</head>

<?php
$db = db_connect();

$db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

$tahun_bulan = sprintf("%04d%02d", $tahun, $bulan);
$bulan_sekarang = date("Ym");
$jumlah_hari_dalam_bulan = cal_days_in_month(CAL_GREGORIAN,  $bulan,  $tahun);
$tanggal_sekarang = date("j");

if ($tahun_bulan == $bulan_sekarang) {
    $tanggal_sd = $tanggal_sekarang; // Tanggal "Sampai Dengan"
} else {
    $tanggal_sd = $jumlah_hari_dalam_bulan; // Tanggal "Sampai Dengan"
}

function get_nilai($persentase)
{
    if ($persentase > 85) {
        return "baik";
    } elseif ($persentase >= 71) {
        return "cukup";
    } else {
        return "kurang";
    }
}

$kebun_arr = [];
if ($result = $db->query($kbnperbulan)) {
    foreach ($row = $result->getResultArray() as $rw) {
        $kebun_arr[] = $rw;
    }
    $result->freeResult();
}

$distrik = [];
$jumlah_block_n5 = 0;
$jumlah_block_terinput_n5 = 0;
$target_sd_n5 = 0;
foreach ($kebun_arr as $keb) {
    $keb['target_sd'] = ceil($tanggal_sd / $jumlah_hari_dalam_bulan * $keb['JUMLAH_BLOK']);
    $keb['persen_sd'] = sprintf("%0.2f", $keb['jumlah_block_terinput'] / ceil($tanggal_sd / $jumlah_hari_dalam_bulan * $keb['JUMLAH_BLOK']) * 100);
    $keb['nilai_sd'] = get_nilai($keb['persen_sd']);
    @$distrik[$keb['DISTRIK']]['jumlah_kebun']++;
    @$distrik[$keb['DISTRIK']]['jumlah_block'] += $keb['JUMLAH_BLOK'];
    @$distrik[$keb['DISTRIK']]['jumlah_block_terinput'] += $keb['jumlah_block_terinput'];
    @$distrik[$keb['DISTRIK']]['target_sd'] += $keb['target_sd'];
    $distrik[$keb['DISTRIK']]['kebun'][] = $keb;

    $jumlah_block_n5 += $keb['JUMLAH_BLOK'];
    $jumlah_block_terinput_n5 += $keb['jumlah_block_terinput'];
    $target_sd_n5 += $keb['target_sd'];
}

$nilai_n5 = get_nilai($jumlah_block_terinput_n5 / $jumlah_block_n5 * 100);

foreach ($distrik as $id => $dis) {
    $distrik[$id]['persen_input'] = sprintf("%0.2f", $dis['jumlah_block_terinput'] / $dis['jumlah_block'] * 100);

    $distrik[$id]['nilai'] = get_nilai($distrik[$id]['persen_input']);
    //$distrik[$id]['color_class'] = 'nilai_baik';

}

?>

<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a href="/"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li><a data-toggle="collapse" data-target="#monitor1" href="#"><i class="fas fa-chart-bar"></i> Monitoring</a>
                                <ul id="monitor1" class="collapse dropdown-header-top">
                                    <li><a href="<?= base_url(); ?>/monitor/perbulan"><b>Monitoring Perbulan</b></a>
                                    </li>
                                    <li><a href="<?= base_url(); ?>/monitor/perkebun">Monitoring Perkebun</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" onclick="window.location.href='<?= base_url(); ?>/apk/NBEx-1.5-BETA.apk';" href="<?= base_url(); ?>/apk/NBEx-1.5-BETA.apk'#Charts"><i class="fa fa-android"></i> Download APK</a>
                            </li>
                            <li><a data-toggle="collapse" onclick="window.location.href='<?= base_url(); ?>/source/Panduan_NBEx.pdf';" href="<?= base_url(); ?>/source/Panduan_NBEx.pdf"><i class="fa fa-file-pdf-o"></i> Panduan</a>
                            </li>
                            <li><a data-toggle="collapse" onclick="window.location.href='https://youtu.be/4sPwnTyD5pk';" href="https://youtu.be/4sPwnTyD5pk"><i class="fa fa-youtube-play"></i> Tutorial</a>
                            </li>
                            <li><a data-toggle="collapse" onclick="window.location.href='https://drive.google.com/drive/folders/1N88JHqk8HZWAhmEkJ_fnbn4mruD0peuj';" href="https://drive.google.com/drive/folders/1N88JHqk8HZWAhmEkJ_fnbn4mruD0peuj"><i class="fa fa-pie-chart"></i> Peta Protas</a>
                            </li>
                            <li><a data-toggle="collapse" data-target="#periode" href="#"><i class="far fa-calendar-alt"></i> Periode</a>
                                <ul id="periode" class="collapse dropdown-header-top">
                                    <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href=<?= $url; ?>+this.value+'-<?php echo $bulan; ?>'">
                                                <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                                    <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun1 ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </a>
                                    </li>
                                    <li><a href="#"><select class="form-control" name="bulan" onchange="window.location.href=<?= $url; ?>+<?php echo $tahun; ?>+'-'+this.value">
                                                <?php foreach ($bulan_id as $id_bulan => $nama) : ?>
                                                    <option value="<?php echo $id_bulan; ?>" <?php echo $id_bulan == $bulan ? "selected" : ""; ?>><?php echo $nama; ?></option>
                                                <?php endforeach; ?>
                                            </select></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li><a href="/"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="active"><a data-toggle="tab" href="#monitor"><i class="fas fa-chart-bar"></i> Monitoring</a>
                    </li>
                    <li><a data-toggle="tab" onclick="window.location.href='<?= base_url(); ?>/apk/NBEx-1.5-BETA.apk';" href="<?= base_url(); ?>/apk/NBEx-1.5-BETA.apk'#Charts"><i class="fa fa-android"></i> Download APK</a>
                    </li>
                    <li><a data-toggle="tab" onclick="window.location.href='<?= base_url(); ?>/source/Panduan_NBEx.pdf';" href="<?= base_url(); ?>/source/Panduan_NBEx.pdf"><i class="fa fa-file-pdf-o"></i> Panduan</a>
                    </li>
                    <li><a data-toggle="tab" onclick="window.location.href='https://youtu.be/4sPwnTyD5pk';" href="https://youtu.be/4sPwnTyD5pk"><i class="fa fa-youtube-play"></i> Tutorial</a>
                    </li>
                    <li><a data-toggle="tab" onclick="window.location.href='https://drive.google.com/drive/folders/1N88JHqk8HZWAhmEkJ_fnbn4mruD0peuj';" href="https://drive.google.com/drive/folders/1N88JHqk8HZWAhmEkJ_fnbn4mruD0peuj"><i class="fa fa-pie-chart"></i> Peta Protas</a>
                    </li>
                    <li><a data-toggle="tab" href="#waktu"><i class="far fa-calendar-alt"></i> Periode</a>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="monitor" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="<?= base_url(); ?>/monitor/perbulan"><b>Monitoring Perbulan</b></a>
                            </li>
                            <li><a href="<?= base_url(); ?>/monitor/perkebun">Monitoring Perkebun</a>
                            </li>
                        </ul>
                    </div>
                    <div id="waktu" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href=<?= $url; ?>+this.value+'-<?php echo $bulan; ?>'">
                                        <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                            <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun1 ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </a>
                            </li>
                            <li><a href="#"><select class="form-control" name="bulan" onchange="window.location.href=<?= $url; ?>+<?php echo $tahun; ?>+'-'+this.value">
                                        <?php foreach ($bulan_id as $id_bulan => $nama) : ?>
                                            <option value="<?php echo $id_bulan; ?>" <?php echo $id_bulan == $bulan ? "selected" : ""; ?>><?php echo $nama; ?></option>
                                        <?php endforeach; ?>
                                    </select></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2>><span> 85</span></h2>
                        <p>Baik</p>
                    </div>
                    <div style="width: 40px; height: 40px; background-color:#00B150; border-radius: 50%;" class="sparkline-bar-stats2"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span>71-85</span></h2>
                        <p>Cukup</p>
                    </div>
                    <div style="width: 40px; height: 40px; background-color:#f7d600; border-radius: 50%;" class="sparkline-bar-stats2"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2>
                            <<span> 71</span>
                        </h2>
                        <p>Kurang</p>
                    </div>
                    <div style="width: 40px; height: 40px; background-color:red; border-radius: 50%;" class="sparkline-bar-stats2"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2>
                            Tahun :<span> <?= $tahun; ?></span>
                        </h2>
                        <p>
                            Bulan :<span> <?= $bulan; ?></span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li class="active"><a data-toggle="tab" href="#barat"><i class="fas fa-angle-left"></i> Barat</a>
                    </li>
                    <li><a data-toggle="tab" href="#timur">Timur <i class="fas fa-angle-right"></i></i></a>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="barat" class="tab-pane in active notika-tab-menu-bg animated fadeIn">
                        <ul class="notika-main-menu-dropdown">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="normal-table-list">
                                        <div class="basic-tb-hd">
                                            <h2>Distrik Barat</h2>
                                        </div>
                                        <div class="bsc-tbl-cds">
                                            <table class="table table-condensed">
                                                <thead style="background-color: #003319;">
                                                    <tr style="font-weight: bold;">
                                                        <td rowspan="2" style="color:white;">KEBUN</td>
                                                        <td rowspan="2" style="color:white;">Jumlah Blok</td>
                                                        <td rowspan="2" style="color:white;">
                                                            <p>Target Inputan<br>s.d. Tgl <?php echo $tanggal_sd; ?></p>
                                                        </td>
                                                        <td rowspan="2" style="color:white;">
                                                            <p>Realisasi<br>Inputan</p>
                                                        </td>
                                                        <td colspan="2" style="color:white;">Persen (%) Capaian</td>
                                                    </tr>
                                                    <tr style="font-weight: bold;" class='center'>
                                                        <td style="color:white;">s.d. tgl <?php echo $tanggal_sd; ?></td>
                                                        <td style="color:white;">Akhir Bulan</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($distrik as $nama_distrik => $dis) : ?>
                                                        <?php if ($nama_distrik == 'BARAT') : ?>
                                                            <?php foreach ($dis['kebun'] as $id => $keb) : ?>
                                                                <tr>
                                                                    <td style="background-color: #003319; font-weight: bold; color:white;" class="center"><a style="color: white;" href="/level2/<?= $tahun; ?>-<?= $keb['KODE_KEBUN']; ?>"><?php echo $keb['KODE_KEBUN']; ?> </a></td>
                                                                    <td class="right"><?php echo $keb['JUMLAH_BLOK']; ?></td>
                                                                    <td class="right"><?php echo $keb['target_sd']; ?></td>
                                                                    <td class="right"><?php echo $keb['jumlah_block_terinput']; ?></td>
                                                                    <td class='right nilai_<?php echo $keb['nilai_sd']; ?>'><?php echo $keb['persen_sd']; ?></td>
                                                                    <td class='right nilai_<?php echo $keb['nilai']; ?>'><?php echo $keb['persen_input']; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            <tr>
                                                                <td style="font-weight: bold; color:white;" class="center subtotal">SUBTOTAL</td>
                                                                <td class="right subtotal"><?php echo $dis['jumlah_block']; ?></td>
                                                                <td class="right subtotal"><?php echo $dis['target_sd']; ?></td>
                                                                <td class="right subtotal"><?php echo $dis['jumlah_block_terinput']; ?></td>
                                                                <?php $persen_distrik_sd = $dis['jumlah_block_terinput'] / $dis['target_sd'] * 100; ?>
                                                                <td class='right nilai_<?php echo get_nilai($persen_distrik_sd); ?> '><?php printf("%0.2f", $persen_distrik_sd); ?></td>
                                                                <td class='right nilai_<?php echo $dis['nilai']; ?>'><?php printf("%0.02f", $dis['persen_input']); ?></td>
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
                    <div id="timur" class="tab-pane notika-tab-menu-bg animated fadeIn">
                        <ul class="notika-main-menu-dropdown">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="normal-table-list">
                                        <div class="basic-tb-hd">
                                            <h2>Distrik Timur</h2>
                                        </div>
                                        <div class="bsc-tbl-cds">
                                            <table class="table table-condensed">
                                                <thead style="background-color: #003319;">
                                                    <tr style="font-weight: bold;">
                                                        <td rowspan="2" style="color:white;">KEBUN</td>
                                                        <td rowspan="2" style="color:white;">Jumlah Blok</td>
                                                        <td rowspan="2" style="color:white;">
                                                            <p>Target Inputan<br>s.d. Tgl <?php echo $tanggal_sd; ?></p>
                                                        </td>
                                                        <td rowspan="2" style="color:white;">
                                                            <p>Realisasi<br>Inputan</p>
                                                        </td>
                                                        <td colspan="2" style="color:white;">Persen (%) Capaian</td>
                                                    </tr>
                                                    <tr style="font-weight: bold;" class='center'>
                                                        <td style="color:white;">s.d. tgl <?php echo $tanggal_sd; ?></td>
                                                        <td style="color:white;">Akhir Bulan</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($distrik as $nama_distrik => $dis) : ?>
                                                        <?php if ($nama_distrik == 'TIMUR') : ?>
                                                            <?php foreach ($dis['kebun'] as $id => $keb) : ?>
                                                                <tr>
                                                                    <td style="background-color: #003319; font-weight: bold; color:white;" class="center"><a style="color: white;" href="/level2/<?= $tahun; ?>-<?= $keb['KODE_KEBUN']; ?>"><?php echo $keb['KODE_KEBUN']; ?> </a></td>
                                                                    <td class="right"><?php echo $keb['JUMLAH_BLOK']; ?></td>
                                                                    <td class="right"><?php echo $keb['target_sd']; ?></td>
                                                                    <td class="right"><?php echo $keb['jumlah_block_terinput']; ?></td>
                                                                    <td class='right nilai_<?php echo $keb['nilai_sd']; ?>'><?php echo $keb['persen_sd']; ?></td>
                                                                    <td class='right nilai_<?php echo $keb['nilai']; ?>'><?php echo $keb['persen_input']; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            <tr>
                                                                <td style="font-weight: bold; color:white;" class="center subtotal">SUBTOTAL</td>
                                                                <td class="right subtotal"><?php echo $dis['jumlah_block']; ?></td>
                                                                <td class="right subtotal"><?php echo $dis['target_sd']; ?></td>
                                                                <td class="right subtotal"><?php echo $dis['jumlah_block_terinput']; ?></td>
                                                                <?php $persen_distrik_sd = $dis['jumlah_block_terinput'] / $dis['target_sd'] * 100; ?>
                                                                <td class='right nilai_<?php echo get_nilai($persen_distrik_sd); ?> '><?php printf("%0.2f", $persen_distrik_sd); ?></td>
                                                                <td class='right nilai_<?php echo $dis['nilai']; ?>'><?php printf("%0.02f", $dis['persen_input']); ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <tr style="font-weight: bold;">
                                                        <td class=" center total">TOTAL</td>
                                                        <td class="right total"><?php echo $jumlah_block_n5; ?></td>
                                                        <td class="right total"><?php echo $target_sd_n5; ?></td>
                                                        <td class="right total"><?php echo $jumlah_block_terinput_n5; ?></td>
                                                        <?php $persen_n5_sd = $jumlah_block_terinput_n5 / $target_sd_n5 * 100; ?>
                                                        <td class="right nilai_<?php echo get_nilai($persen_n5_sd); ?>"><?php printf("%0.2f", $jumlah_block_terinput_n5 / $target_sd_n5 * 100); ?></td>
                                                        <td class='right nilai_<?php echo $nilai_n5; ?>'><?php printf("%0.2f", $jumlah_block_terinput_n5 / $jumlah_block_n5 * 100); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>