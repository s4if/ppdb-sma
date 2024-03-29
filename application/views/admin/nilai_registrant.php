<?php

/* 
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

?>

<h1 class="page-header">
    Data Nilai Pendaftar
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'admin/beranda';?>">Beranda</a>
    </li>
    <li class="active">
        Pendaftar
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="btn-group"role="group">
                <a id="btn_semua" onclick="semua()" class="btn btn-default active" href="#">
                    Semua
                </a>
                <a id="btn_ikhwan" onclick="ikhwan()" class="btn btn-default" href="#">
                    Ikhwan
                </a>
                <a id="btn_akhwat" onclick="akhwat()" class="btn btn-default" href="#">
                    Akhwat
                </a>
            </div>
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Download Data Ikhwan <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>admin/export_rapor/L/Reguler">Ikhwan Reguler</a></li>
                  <li><a href="<?=base_url()?>admin/export_rapor/L/Tahfidz">Ikhwan Tahfidz</a></li>
                </ul>
            </div>
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Download Data Akhwat <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>admin/export_rapor/P/Reguler">Akhwat Reguler</a></li>
                  <li><a href="<?=base_url()?>admin/export_rapor/P/Tahfidz">Akhwat Tahfidz</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-lg-12">
                <table class="table table-striped table-bordered table-condensed" id="tabel_utama">
                    <thead>
                        <tr>
                            <td rowspan="2">No.</td>
                            <td rowspan="2">Kode Unik</td>
                            <td rowspan="2">Nama</td>
                            <td rowspan="2">I/A</td>
                            <td rowspan="2">Sekolah Asal</td>
                            <td rowspan="2">Jurusan</td>
                            <td rowspan="2">Aksi</td>
                            <?php for($i = 1; $i <= 4; $i++) :?>
                            <td colspan="2">B. Indo S<?=$i;?></td>
                            <td colspan="2">B. Inggris S<?=$i;?></td>
                            <td colspan="2">Matematika S<?=$i;?></td>
                            <td colspan="2">IPA S<?=$i;?></td>
                            <td colspan="2">IPS S<?=$i;?></td>
                            <?php endfor; ?>
                        </tr>
                        <tr>
                            <?php for($i = 1; $i <= 20; $i++) :?>
                            <td>KKM</td>
                            <td>NILAI</td>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
    </div>
</div>
<script type="text/javascript">
var table;

$(document).ready(function() {

    //datatables
    table = $('#tabel_utama').DataTable({ 

        "order": [[ 0, "desc" ]], //Initial no order.
        "scrollX": true,

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/nilai_ajax/'.$gender)?>",
            "type": "POST"
        }

    });

});

function ikhwan(){
    $('#btn_semua').removeClass('active');
    $('#btn_akhwat').removeClass('active');
    $('#btn_ikhwan').addClass('active');
    tabel_refresh('L');
}

function akhwat(){
    $('#btn_semua').removeClass('active');
    $('#btn_ikhwan').removeClass('active');
    $('#btn_akhwat').addClass('active');
    tabel_refresh('P');
}

function semua(){
    $('#btn_akhwat').removeClass('active');
    $('#btn_ikhwan').removeClass('active');
    $('#btn_semua').addClass('active');
    url = "<?php echo site_url('admin/nilai_ajax/')?>/";
    table.ajax.url(url).load();
}

function tabel_refresh (gender){
    url = "<?php echo site_url('admin/nilai_ajax/')?>/" + gender;
    table.ajax.url(url).load();
}


</script>
