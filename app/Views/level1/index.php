<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<?php
$tahun_ini = date('Y');

if (isset($_GET['tahun'])) {
    $tahun = $_GET['tahun'];
} else {
    $tahun = $tahun_ini;
}

$rowspan_distrik = [];
foreach ($allkebun as $keb) {
    @$rowspan_distrik[$keb['DISTRIK']]++;
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
                                    <li><a href="<?= base_url(); ?>/monitor/perbulan">Monitoring Perbulan</a>
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
                                    <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href='?tahun='+this.value">
                                                <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                                    <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </a>
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
                    <li class="active"><a href="/"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li><a data-toggle="tab" href="#monitor"><i class="fas fa-chart-bar"></i> Monitoring</a>
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
                    <div id="monitor" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="<?= base_url(); ?>/monitor/perbulan">Monitoring Perbulan</a>
                            </li>
                            <li><a href="<?= base_url(); ?>/monitor/perkebun">Monitoring Perkebun</a>
                            </li>
                        </ul>
                    </div>
                    <div id="waktu" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href='?tahun='+this.value">
                                        <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                            <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </a>
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
                        <h2 style="margin-top: 20px;">
                            Tahun :<span> <?= $tahun; ?></span>
                        </h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Status area-->
<!-- Start Sale Statistic area-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.get("level1/nilai?tahun=<?= $tahun; ?>", function(array_nilai, status) {
            $('.nilai').text(" 0.00").attr('title', 'data kosong');
            $.each(array_nilai, function(index, k) { //k = array penilaian per kebun; nilai nya ada di k[TOTALNYA]
                if (k['nilai']) {
                    $('#nilai_' + k['kode_kebun'] + '_' + k['tahun'] + '_' + k['bulan'])
                        .text(k['nilai'])
                        .attr('title', 'Nil.Pokok: ' + k['nilai_pokok'] + '; Nil.Block: ' + k['nilai_block'])
                        .addClass(function() {
                            if (k['nilai'] > 85) {
                                return 'nilai_baik';
                            } else if (k['nilai'] >= 71) {
                                return 'nilai_cukup';
                            } else {
                                return 'nilai_kurang';
                            }
                        });
                    $('#nilai1_' + k['kode_kebun'] + '_' + k['tahun'] + '_' + k['bulan'])
                        .text(k['nilai'])
                        .attr('title', 'Nil.Pokok: ' + k['nilai_pokok'] + '; Nil.Block: ' + k['nilai_block'])
                        .addClass(function() {
                            if (k['nilai'] > 85) {
                                return 'nilai_baik';
                            } else if (k['nilai'] >= 71) {
                                return 'nilai_cukup';
                            } else {
                                return 'nilai_kurang';
                            }
                        });
                    // console.log('#nilai_' + k['kode_kebun'] + '_' + k['tahun'] + '_' + k['bulan']);
                }

            })

        }, 'json');
    });
</script>
<!-- Main Menu area start-->
<div class="mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li class="active"><a data-toggle="tab" href="#barat"><i class="fas fa-angle-left"></i> Barat</a>
                    </li>
                    <li><a data-toggle="tab" href="#timur">Timur <i class="fas fa-angle-right"></i></a>
                    </li>
                    <li><a data-toggle="tab" href="#all">All <i class="fas fa-layer-group"></i></a>
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
                                                <thead style="background-color: rgb(0,51,25);">
                                                    <tr style="font-weight: bold;">
                                                        <td style="color:white;">KEBUN</td>
                                                        <td style="color:white;" class="center">Januari</td>
                                                        <td style="color:white;" class="center">Februari</td>
                                                        <td style="color:white;" class="center">Maret</td>
                                                        <td style="color:white;" class="center">April</td>
                                                        <td style="color:white;" class="center">Mei</td>
                                                        <td style="color:white;" class="center">Juni</td>
                                                        <td style="color:white;" class="center">Juli</td>
                                                        <td style="color:white;" class="center">Agustus</td>
                                                        <td style="color:white;" class="center">September</td>
                                                        <td style="color:white;" class="center">Oktober</td>
                                                        <td style="color:white;" class="center">November</td>
                                                        <td style="color:white;" class="center">Desember</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach ($kebunB as $k) : ?>
                                                        <tr>
                                                            <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;">
                                                                <a style="color: white;" href="/level2/<?= $tahun; ?>-<?= $k['KODE_KEBUN']; ?>"><?= $k['KODE_KEBUN']; ?></a>
                                                            </td>
                                                            <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                                                <td class="nilai right " id="<?php printf("nilai_%s_%d_%d", $k['KODE_KEBUN'], $tahun, $bulan); ?>"><i class="fa fa-spinner fa-spin"></i></td>
                                                            <?php endfor; ?>
                                                        </tr>
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
                                                <thead style="background-color:rgb(0,51,25);">
                                                    <tr style="font-weight: bold;">
                                                        <td style="color:white;">KEBUN</td>
                                                        <td style="color:white;" class="center">Januari</td>
                                                        <td style="color:white;" class="center">Februari</td>
                                                        <td style="color:white;" class="center">Maret</td>
                                                        <td style="color:white;" class="center">April</td>
                                                        <td style="color:white;" class="center">Mei</td>
                                                        <td style="color:white;" class="center">Juni</td>
                                                        <td style="color:white;" class="center">Juli</td>
                                                        <td style="color:white;" class="center">Agustus</td>
                                                        <td style="color:white;" class="center">September</td>
                                                        <td style="color:white;" class="center">Oktober</td>
                                                        <td style="color:white;" class="center">November</td>
                                                        <td style="color:white;" class="center">Desember</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($kebunT as $k) : ?>
                                                        <tr>
                                                            <td style="background-color:rgb(0,51,25); font-weight: bold; color:white;">
                                                                <a style="color: white;" href="/level2/<?= $tahun; ?>-<?= $k['KODE_KEBUN']; ?>"><?= $k['KODE_KEBUN']; ?></a>
                                                            </td>
                                                            <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                                                <td class="nilai right " id="<?php printf("nilai_%s_%d_%d", $k['KODE_KEBUN'], $tahun, $bulan); ?>"><i class="fa fa-spinner fa-spin"></i></td>
                                                            <?php endfor; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div id="all" class="tab-pane notika-tab-menu-bg animated fadeIn">
                        <ul class="notika-main-menu-dropdown">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="normal-table-list">
                                        <div class="basic-tb-hd">
                                            <h2>Distrik Barat & Timur</h2>
                                        </div>
                                        <div class="bsc-tbl-cds">
                                            <table class="table table-condensed">
                                                <thead style="background-color:rgb(0,51,25);">
                                                    <tr style="font-weight: bold;">
                                                        <td style="color:white;">DISTRIK</td>
                                                        <td style="color:white;">KEBUN</td>
                                                        <td style="color:white;" class="center">Januari</td>
                                                        <td style="color:white;" class="center">Februari</td>
                                                        <td style="color:white;" class="center">Maret</td>
                                                        <td style="color:white;" class="center">April</td>
                                                        <td style="color:white;" class="center">Mei</td>
                                                        <td style="color:white;" class="center">Juni</td>
                                                        <td style="color:white;" class="center">Juli</td>
                                                        <td style="color:white;" class="center">Agustus</td>
                                                        <td style="color:white;" class="center">September</td>
                                                        <td style="color:white;" class="center">Oktober</td>
                                                        <td style="color:white;" class="center">November</td>
                                                        <td style="color:white;" class="center">Desember</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $distrik_sebelumnya = false; ?>
                                                    <?php foreach ($allkebun as $k) : ?>
                                                        <tr>
                                                            <?php if ($distrik_sebelumnya != $k['DISTRIK']) : ?>
                                                                <td style="background-color: #c7c7c7; color: rgb(0,51,25); font-weight: bold;" rowspan="<?php echo $rowspan_distrik[$k['DISTRIK']]; ?>"><?php echo $k['DISTRIK']; ?></td>
                                                                <?php $distrik_sebelumnya =  $k['DISTRIK']; ?>
                                                            <?php endif; ?>
                                                            <td style="background-color:rgb(0,51,25); font-weight: bold; color:white;">
                                                                <a style="color: white;" href="/level2/<?= $tahun; ?>-<?= $k['KODE_KEBUN']; ?>"><?= $k['KODE_KEBUN']; ?></a>
                                                            </td>
                                                            <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                                                <td class="nilai right " id="<?php printf("nilai1_%s_%d_%d", $k['KODE_KEBUN'], $tahun, $bulan); ?>"><i class="fa fa-spinner fa-spin"></i></td>
                                                            <?php endfor; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
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
<!-- End Sale Statistic area-->


<?= $this->endSection(); ?>