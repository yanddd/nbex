<?= $this->extend('layout/template'); ?>
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
$tahunkode = explode("/", current_url())[5];
?>
<?= $this->section('content'); ?>
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
                                    <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href=this.value+'-<?php echo $kode; ?>'">
                                                <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                                    <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun1 ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
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


<div class="mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li class="active"><a data-toggle="tab" href="#level2"><i class="fas fa-home"></i> Home</a>
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
                    <div id="level2" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="/">Level 1</a>
                            </li>
                            <li><b>Level 2</b></li>
                        </ul>
                    </div>
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
                            <li><a href="#"><select class="form-control" name="tahun" onchange="window.location.href=this.value+'-<?php echo $kode; ?>'">
                                        <?php for ($thn = 2020; $thn <= $tahun_ini; $thn++) : ?>
                                            <option value="<?php echo $thn; ?>" <?php echo $thn == $tahun1 ? "selected" : ""; ?>>Tahun <?php echo $thn; ?></option>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqk0o7gAPnf-hWOKtlFPjYtvWBKgDo33o" async defer></script>


<?php

$rowspan_afdeling = [];
foreach ($afdeling as $bl) {
    @$rowspan_afdeling[$bl['KODE_AFDELING']]++;
}

// $nilai1 = sprintf($afdeling);

?>

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
                            Tahun :<span> <?= $tahun1; ?></span>
                        </h2>
                        <p>
                            Kebun :<span> <?= $kode; ?></span>
                        </p>
                    </div>

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
                    <?php foreach ($afdeling as $a) : ?>
                        <?php if ($afdeling_sebelumnya != $a['KODE_AFDELING']) : ?>
                            <?php $afdeling_sebelumnya =  $a['KODE_AFDELING']; ?>
                            <li class="<?= $a['KODE_AFDELING'] === $afdeling[0]['KODE_AFDELING'] ? 'active' : '' ?>"><a data-toggle="tab" href="#<?= $a['KODE_AFDELING']; ?>"><?= $a['KODE_AFDELING']; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content custom-menu-content">
                    <?php foreach ($afdeling as $a) : ?>
                        <?php if ($afdeling_sebelumnya != $a['KODE_AFDELING']) : ?>
                            <?php $afdeling_sebelumnya =  $a['KODE_AFDELING']; ?>
                            <div id="<?= $a['KODE_AFDELING']; ?>" class="tab-pane <?= $a['KODE_AFDELING'] === $afdeling[0]['KODE_AFDELING'] ? 'in active' : '' ?> notika-tab-menu-bg animated fadeIn">
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

                                                            <?php foreach ($afdeling as $af) : ?>
                                                                <?php if ($af['KODE_AFDELING'] == $a['KODE_AFDELING']) : ?>
                                                                    <tr>
                                                                        <td style="background-color: rgb(0,51,25); font-weight: bold; color:white;">
                                                                            <?php echo $af['NAMA_BLOCK']; ?>
                                                                        </td>
                                                                        <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                                                            <td class="right nilai_nbex autonilai" id="<?php printf("nilai_%s_%s_%d_%d",  $af['KODE_KEBUN'], $af['NAMA_BLOCK'], $tahun, $bulan); ?>">0.00</td>

                                                                        <?php endfor; ?>
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


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding:10px;">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Penilaian</h4>
            </div>

            <div class="modal-body">
                <p id="judul"></p>
                <form>
                    <input type="hidden" name="modal_bln" id="modal_bln">
                    <input type="hidden" name="modal_thn" id="modal_thn">
                    <input type="hidden" name="modal_block" id="modal_block">
                    <input type="hidden" name="modal_kebun" id="modal_kebun">
                    <!-- <button type="button" class="btn btn-primary" id="btn-cari">Lihat</button> -->
                    <div id="proses" name="proses">Mengambil data.......</div> <br>
                </form>
            </div>
            <table style="width: 100%; margin-top:-30px; background-color:white; border:none; border-collapse:collapse;  cellspacing:0; cellpadding:0">
                <thead>
                    <th colspan="2" style="border:none">
                        Kategori Pokok
                    </th>
                    <th colspan="2" style="border:none">
                        Kategori Blok
                    </th>
                </thead>
                <tbody>
                    <tr valign="top">
                        <td style="border:none">
                            <div tyle="text-align: left;" id="soal_pokok">
                            </div>
                        </td>
                        <td style="border:none">
                            <div style="text-align: left;" id="pokok_jawab">
                            </div>
                        </td>
                        <td style="border:none">
                            <div style="text-align: left;" id="soal_blok">
                            </div>
                        </td>
                        <td style="border:none">
                            <div style="text-align: left;" id="block_jawab">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border:none">
                            Manajemen Isu
                        </td>
                    </tr>
                    <!-- <tr>
                        <td colspan="4" style="border:none">
                            <div style="text-align: left;" id="remarks">
                            </div>
                        </td>
                    </tr> -->
                </tbody>
            </table>
            <hr>
            <div id="map_canvas" style="height: 354px; width:570px;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var array_nilai = <?php echo json_encode($nilai); ?>;

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
            $("#remarks").html('" "');
            $("#map_canvas").html("");
            $("#soal_blok").html("");
            $("#block_jawab").html("");
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
                    url: '<?= base_url(); ?>/level2/getDetailData',
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

                        // console.log(response);
                        $("#proses").hide();
                        var pokok = "";
                        var mdl_pokok = "";
                        var mdl_blk = "";
                        var blok = "";
                        var cek = "1"; //cek node json
                        var longitude = "";
                        var latitue = "";
                        var stringRemarks = "";


                        for (i = 0; i < response.length; i++) {
                            var myobj = response[i];
                            for (var property in myobj) {
                                if (cek == "1") {

                                    if (property == "pokok") {
                                        cek = "0";
                                        pokok += "<h5 > Rata - rata kategori pokok </h5>";
                                        mdl_pokok += "<h5> =" + myobj[property] + "</h5>";
                                    } else {
                                        pokok += "<h5>" + property + "</h5>";
                                        if (myobj[property] > 85) {
                                            mdl_pokok += "<h5 style='color:green;'> =" + myobj[property] + " </h5>";
                                        } else if (myobj[property] >= 71) {
                                            mdl_pokok += "<h5 style='color:rgb(247,160,0);'> =" + myobj[property] + " </h5>";
                                        } else {
                                            mdl_pokok += "<h5 style='color:red;'> =" + myobj[property] + " </h5>";
                                        }

                                    }
                                } else {
                                    if (property == "blok") {
                                        blok += "<h5> Rata - rata kategori block </h5>";
                                        mdl_blk += "<h5> =" + myobj[property] + "</h5>";
                                    } else if (property == "remarks") {
                                        stringRemarks = myobj[property];
                                    } else if (property == "lon") {
                                        longitude = myobj[property];
                                    } else if (property == "lat") {
                                        latitue = myobj[property];
                                    } else {
                                        blok += "<h5>" + property + "</h5>";
                                        if (myobj[property] > 85) {
                                            mdl_blk += "<h5 style='color:green;'> =" + myobj[property] + " </h5>";
                                        } else if (myobj[property] >= 71) {
                                            mdl_blk += "<h5 style='color:rgb(247,160,0);'> =" + myobj[property] + " </h5>";
                                        } else {
                                            mdl_blk += "<h5 style='color:red;'> =" + myobj[property] + " </h5>";
                                        }
                                    }
                                }


                            }
                            $("#soal_pokok").html(pokok);


                            // if(mdl_pokok > 85){
                            //     $("#pokok_jawab").html(mdl_pokok).css('color', 'green');
                            // }else if(mdl_pokok >= 71){
                            //     $("#pokok_jawab").html(mdl_pokok).css('color', 'yellow');
                            // }else {
                            //     $("#pokok_jawab").html(mdl_pokok).css('color', 'red');
                            // }
                            $("#pokok_jawab").html(mdl_pokok)
                            $("#soal_blok").html(blok);
                            $("#block_jawab").html(mdl_blk);
                            $("#remarks").html('"' + stringRemarks + '"');

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

                var aTag = $('<a>', {
                    class: "link_popup",
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
            $(this).addClass('refresh_container').prepend('<a href="detail_data/' + $(this).attr('id') + '" target="_blank" class="detail_button" style= "color :rgb(0,51,25)" title="detail"><i class="fa fa-list" ></i></a> <a href="javascript:do_refresh(\'' + $(this).attr('id') + '\')" title="refresh"  style= "color :rgb(0,51,25)"  class="refresh_button " ><i class="fa fa-refresh"></i></a>');
        }, function() {
            $(this).removeClass('refresh_container').find('.refresh_button').remove();
            $(this).removeClass('refresh_container').find('.detail_button').remove();
        });
    });


    var do_refresh = function(field_id) {
        var arr = field_id.split('_');
        var url = "update_summary_per_block/" + arr[3] + "-" + ('0' + arr[4]).slice(-2) + "-" + arr[1] + "-" + arr[2];
        $.get(url, false, function(data) {
            $('#' + field_id).find('.link_popup').text(data.rataan);
        }, 'json');
    };
</script>

<?= $this->endSection(); ?>