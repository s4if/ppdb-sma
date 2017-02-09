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
    Data Pendaftar
    <small><?php if(!is_null($gender)): 
        if($gender == 'L'): echo 'Ikhwan';endif; 
        if($gender == 'P'): echo 'Akhwat';endif;
        endif;?>
    </small>
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
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Download Data <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>admin/export_data/L/Reguler">Ikhwan Reguler</a></li>
                  <li><a href="<?=base_url()?>admin/export_data/L/Tahfidz">Ikhwan Tahfidz</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?=base_url()?>admin/export_data/P/Reguler">Akhwat Reguler</a></li>
                  <li><a href="<?=base_url()?>admin/export_data/P/Tahfidz">Akhwat Tahfidz</a></li>
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
                            <td>No.</td>
                            <td>Username</td>
                            <td>Kode Unik</td>
                            <td>Nama</td>
                            <td>I/A</td>
                            <td>Sekolah Asal</td>
                            <td>Program</td>
                            <td>CP</td>
                            <td>Status Data</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
    </div>
</div>
<div class="modal fade" id='deleteRegistrant' tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data Pendaftar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="btnDelOk" class="btn btn-danger" href="">OK</a>
            </div>
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
            "url": "<?php echo site_url('admin/lihat_ajax/'.$gender)?>",
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
    url = "<?php echo site_url('admin/lihat_ajax/')?>/";
    table.ajax.url(url).load();
}

function tabel_refresh (gender){
    url = "<?php echo site_url('admin/lihat_ajax/')?>/" + gender;
    table.ajax.url(url).load();
}


</script>