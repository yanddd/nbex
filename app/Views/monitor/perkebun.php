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
if (uri_string() == 'monitor/perkebun') {
    $url = "'perkebun/'";
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
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqk0o7gAPnf-hWOKtlFPjYtvWBKgDo33o" async defer></script>

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
                                    <li><a href="<?= base_url(); ?>/monitor/perkebun"><b>Monitoring Perkebun</b></a>
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
                                    <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href=<?= $url; ?>+this.value+'-<?php echo $bulan; ?>'+'-<?php echo $kodekebun; ?>'">
                                                <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                                    <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun1 ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </a>
                                    </li>
                                    <li><a href="#"><select class="form-control" name="bulan" onchange="window.location.href=<?= $url; ?>+<?php echo $tahun; ?>+'-'+this.value+'-<?php echo $kodekebun; ?>'">
                                                <?php foreach ($bulan_id as $id_bulan => $nama) : ?>
                                                    <option value="<?php echo $id_bulan; ?>" <?php echo $id_bulan == $bulan ? "selected" : ""; ?>><?php echo $nama; ?></option>
                                                <?php endforeach; ?>
                                            </select></a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#democrou" href="#">
                                    <select style="width: 95%;" class="form-control" name="kode_kebun" onchange="window.location.href=<?= $url; ?>+<?= $tahun1; ?>+'-'+<?= $bulan; ?>+'-'+this.value">
                                        <?php foreach ($kebunAll as $kbn) : ?>

                                            <option value="<?php echo $kbn['KODE_KEBUN']; ?>" <?php echo $kbn['KODE_KEBUN'] == $kodekebun ? "selected" : ""; ?>><?php echo $kbn['KODE_KEBUN']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </a>
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
                    <li><a data-toggle="tab" onclick="window.location.href='<?= base_url(); ?>/source/NBEx-1.5-BETA.apk';" href="<?= base_url(); ?>/source/NBEx-1.5-BETA.apk"><i class="fa fa-android"></i> Download APK</a>
                    </li>
                    <li><a data-toggle="tab" onclick="window.location.href='<?= base_url(); ?>/source/Panduan_NBEx.pdf';" href="<?= base_url(); ?>/source/Panduan_NBEx.pdf"><i class="fa fa-file-pdf-o"></i> Panduan</a>
                    </li>
                    <li><a data-toggle="tab" onclick="window.location.href='https://youtu.be/4sPwnTyD5pk';" href="https://youtu.be/4sPwnTyD5pk"><i class="fa fa-youtube-play"></i> Tutorial</a>
                    </li>
                    <li><a data-toggle="tab" onclick="window.location.href='https://drive.google.com/drive/folders/1N88JHqk8HZWAhmEkJ_fnbn4mruD0peuj';" href="https://drive.google.com/drive/folders/1N88JHqk8HZWAhmEkJ_fnbn4mruD0peuj"><i class="fa fa-pie-chart"></i> Peta Protas</a>
                    </li>
                    <li><a data-toggle="tab" href="#waktu"><i class="far fa-calendar-alt"></i> Periode</a>
                    </li>

                    <li><a data-toggle="tab" href="#"><select class="form-control" name="kode_kebun" onchange="window.location.href=<?= $url; ?>+<?= $tahun1; ?>+'-'+<?= $bulan; ?>+'-'+this.value">
                                <?php foreach ($kebunAll as $kbn) : ?>

                                    <option value="<?php echo $kbn['KODE_KEBUN']; ?>" <?php echo $kbn['KODE_KEBUN'] == $kodekebun ? "selected" : ""; ?>><?php echo $kbn['KODE_KEBUN']; ?></option>
                                <?php endforeach; ?>
                            </select></a>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="monitor" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="<?= base_url(); ?>/monitor/perbulan">Monitoring Perbulan</a>
                            </li>
                            <li><a href="<?= base_url(); ?>/monitor/perkebun"><b>Monitoring Perkebun</b></a>
                            </li>
                        </ul>
                    </div>
                    <div id="waktu" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href=<?= $url; ?>+this.value+'-<?php echo $bulan; ?>'+'-<?php echo $kodekebun; ?>'">
                                        <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                            <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun1 ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </a>
                            </li>
                            <li><a href="#"><select class="form-control" name="bulan" onchange="window.location.href=<?= $url; ?>+<?php echo $tahun; ?>+'-'+this.value+'-<?php echo $kodekebun; ?>'">
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

<?php

$afdeling_sebelumnya = false;

?>

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
                        <p style="margin-left: 80px; margin-top: -20px;">
                            Kebun :<span> <?= $kodekebun; ?></span>
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
                    <?php foreach ($blockbln as $a) : ?>
                        <?php if ($afdeling_sebelumnya != $a['KODE_AFDELING']) : ?>
                            <?php $afdeling_sebelumnya =  $a['KODE_AFDELING']; ?>
                            <li class="<?= $a['KODE_AFDELING'] === $blockbln[0]['KODE_AFDELING'] ? 'active' : '' ?>"><a data-toggle="tab" href="#<?= $a['KODE_AFDELING']; ?>"><?= $a['KODE_AFDELING']; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content custom-menu-content">
                    <?php foreach ($blockbln as $a) : ?>
                        <?php if ($afdeling_sebelumnya != $a['KODE_AFDELING']) : ?>
                            <?php $afdeling_sebelumnya =  $a['KODE_AFDELING']; ?>
                            <div id="<?= $a['KODE_AFDELING']; ?>" class="tab-pane <?= $a['KODE_AFDELING'] === $blockbln[0]['KODE_AFDELING'] ? 'in active' : '' ?> notika-tab-menu-bg animated fadeIn">
                                <ul class="notika-main-menu-dropdown">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="normal-table-list">
                                                <div class="basic-tb-hd">
                                                    <h2>Afdeling <?= $a['KODE_AFDELING']; ?></h2>
                                                </div>
                                                <div class="bsc-tbl-cds">
                                                    <table class="table table-bordered">
                                                        <thead style="background-color: rgb(0,51,25);">
                                                            <tr style="font-weight: bold;">
                                                                <td style="color:white;">BLOCK</td>
                                                                <td style="color:white;">Nilai Pokok</td>
                                                                <td style="color:white;">Nilai Blok</td>
                                                                <td style="color:white;">Ratan</td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($blockbln as $af) : ?>
                                                                <?php if ($af['KODE_AFDELING'] == $a['KODE_AFDELING']) : ?>
                                                                    <tr>
                                                                        <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;">
                                                                            <?php echo $af['NAMA_BLOCK']; ?>
                                                                        </td>
                                                                        <td class="right " id="<?php printf("nilai_pokok_%s_%s_%d_%d",  $af['KODE_KEBUN'], $af['NAMA_BLOCK'], $tahun, $bulan); ?>">0.00</td>
                                                                        <td class="right " id="<?php printf("nilai_block_%s_%s_%d_%d",  $af['KODE_KEBUN'], $af['NAMA_BLOCK'], $tahun, $bulan); ?>">0.00</td>
                                                                        <td class="right autonilai" id="<?php printf("nilai_%s_%s_%d_%d",  $af['KODE_KEBUN'], $af['NAMA_BLOCK'], $tahun, $bulan); ?>">0.00</td>
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
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding:10px;">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Penilaian</h4>
            </div>

            <div class="modal-body">
                <p style="margin-bottom: -10px;" id="judul"></p>
                <form>
                    <input type="hidden" name="modal_bln" id="modal_bln">
                    <input type="hidden" name="modal_thn" id="modal_thn">
                    <input type="hidden" name="modal_block" id="modal_block">
                    <input type="hidden" name="modal_kebun" id="modal_kebun">
                    <div id="proses" name="proses">Mengambil data.......</div> <br>
                </form>
            </div>

            <div style="width: 100%; display: table; padding-right: 20px; padding-left: 20px;">
                <div style="display: table-row; text-align: center; border-collapse:collapse; ">
                    <div style="display: table-cell; text-align: left;">
                        <div style="display: table-row; text-align: left;">
                            Kategori Pokok
                        </div>
                        <div style="display: table-row; text-align: left; " id="soal_pokok">
                        </div>
                    </div>
                    <div style="display: table-cell; text-align: left;">
                        <div style="display: table-row; text-align: left;"> <br>
                        </div>
                        <div style="display: table-row; text-align: left;" id="pokok_jawab">
                        </div>
                    </div>

                    <div style="display: table-cell; text-align: left;">
                        <div style="display: table-row; text-align: left;">
                            Kategori Block
                        </div>
                        <div style="display: table-row; text-align: left;" id="soal_blok">
                        </div>
                    </div>

                    <div style="display: table-cell; text-align: left;">
                        <div style="display: table-row; text-align: left;"><br>
                        </div>
                        <div style="display: table-row; text-align: left;" id="block_jawab">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="map_canvas" style="height: 354px; width:570px;"></div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    var array_nilai = <?php echo json_encode($nilaipbln); ?>;

    var directionsDisplay,
        directionsService,
        map;

    function initialize(longi, lati) {
        var directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer();
        var posisi = new google.maps.LatLng(lati, longi);
        // var posisi = new google.maps.LatLng( 0.4683751752600074, 101.43390490673482);
        var mapOptions = {
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: posisi
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        directionsDisplay.setMap(map);

        // Membuat Marker Maps
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lati, longi), //titik lokasi maps
            map: map,
            animation: google.maps.Animation.BOUNCE
        });
    }

    function wordwrap(str, width, brk, cut) {

        brk = brk || 'n';
        width = width || 75;
        cut = cut || false;

        if (!str) {
            return str;
        }

        var regex = '.{1,' + width + '}(\s|$)' + (cut ? '|.{' + width + '}|.+$' : '|\S+?(\s|$)');

        return str.match(RegExp(regex, 'g')).join(brk);

    }


    function buka_popup(skor, bln, thn, blk, kbn) {

        $('#myModal').modal('show');
        $('#judul').html(blk + ' = ' + skor);
        $('#modal_thn').val(thn);
        $('#modal_bln').val(bln);
        $('#modal_block').val(blk);
        $('#modal_kebun').val(kbn);
    }



    $(function() {

        $("#proses").hide();

        //tutup modal
        $("#myModal").on('hidden.bs.modal', function() {
            $("#soal_pokok").html("");
            $("#pokok_jawab").html("");

            $("#soal_blok").html("");
            $("#block_jawab").html("");
            $("#map_canvas").html("");
        });

        // cari
        $('.autonilai').click(function() {
            setTimeout(function() {
                $("#proses").show();
                var data = new FormData();

                data.append('tahun', $("#modal_thn").val());
                data.append('bulan', $("#modal_bln").val());
                data.append('block', $("#modal_block").val());
                data.append('kebun', $("#modal_kebun").val());

                $.ajax({
                    url: '<?= base_url(); ?>/monitor/getDetailData',
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                        if (e && e.overrideMimeType) {
                            e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response) {
                        $("#proses").hide();
                        var pokok = "";
                        var mdl_pokok = "";
                        var mdl_blk = "";
                        var blok = "";
                        var cek = "1"; //cek node json
                        var longitude = ""
                        var latitue = ""


                        for (i = 0; i < response.length; i++) {
                            var myobj = response[i];
                            for (var property in myobj) {
                                if (cek == "1") {

                                    if (property == "pokok") {
                                        cek = "0";
                                        pokok += "Rata - rata kategori pokok " + "<br>";
                                        mdl_pokok += "=" + myobj[property] + "<br>";
                                    } else {
                                        pokok += property + "<br>";
                                        mdl_pokok += "=" + myobj[property] + "<br>";
                                    }
                                } else {
                                    if (property == "blok") {
                                        blok += "Rata - rata kategori block " + "<br>";
                                        mdl_blk += "=" + myobj[property] + "<br>";
                                    } else if (property == "lon") {
                                        longitude = myobj[property];
                                    } else if (property == "lat") {
                                        latitue = myobj[property];
                                    } else {
                                        blok += property + "<br>";
                                        mdl_blk += "=" + myobj[property] + "<br>";
                                    }
                                }


                            }

                            $("#soal_pokok").html(pokok);
                            $("#pokok_jawab").html(mdl_pokok);

                            $("#soal_blok").html(blok);
                            $("#block_jawab").html(mdl_blk);

                            // $("#longt").val(longitude);
                            // $("#langt").val(latitue);
                            initialize(longitude, latitue);


                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }
                }, 100);
            });
        });

        $.each(array_nilai, function(index, b) { //b = array penilaian per block; nilai nya ada di b[TOTALNYA]

            if (b['nilai']) {

                $('#nilai_block_' + b['kode_kebun'] + '_' + b['block'] + '_' + b['tahun'] + '_' + b['bulan']).text(b['nilai_block']);
                $('#nilai_pokok_' + b['kode_kebun'] + '_' + b['block'] + '_' + b['tahun'] + '_' + b['bulan']).text(b['nilai_pokok']);

                var aTag = $('<a>', {
                    href: "javascript: buka_popup(" + b['nilai'] + "," + b['bulan'] + "," + b['tahun'] + ",'" + b['block'] + "','" + b['kode_kebun'] + "');"
                }).html(b['nilai']).css('color', 'black');
                $('#nilai_' + b['kode_kebun'] + '_' + b['block'] + '_' + b['tahun'] + '_' + b['bulan'])
                    .text('').append(aTag)
                    .addClass(function() {
                        if (b['nilai'] > 85) {
                            return 'nilai_baik';
                        } else if (b['nilai'] >= 71) {
                            return 'nilai_cukup';
                        } else {
                            return 'nilai_kurang';
                        }
                    });
                //console.log('#nilai_'+k['kode_kebun']+'_'+k['tahun']+'_'+k['bulan']);

            }

        });

        $('.nilai_nbex').hover(function() {
            $(this).addClass('refresh_container').prepend('<a href="detail_data/' + $(this).attr('id') + '" target="_blank" class="detail_button" title="detail"><i class="fa fa-list" ></i></a><a href="javascript:do_refresh(\'' + $(this).attr('id') + '\')" title="refresh" class="refresh_button " ><i class="fa fa-refresh"></i></a>');
        }, function() {
            $(this).removeClass('refresh_container').find('.refresh_button').remove();
            $(this).removeClass('refresh_container').find('.detail_button').remove();
        });
    });

    var do_refresh = function(field_id) {
        var arr = field_id.split('_');
        var url = "update_summary_per_block.php?response=json&kode_kebun=" + arr[1] + "&block=" + arr[2] + "&tahun=" + arr[3] + "&bulan=" + ('0' + arr[4]).slice(-2);
        $.get(url, false, function(data) {
            $('#' + field_id).find('.link_popup').text(data.rataan);
        }, 'json');
    };
</script>
<?= $this->endSection(); ?>