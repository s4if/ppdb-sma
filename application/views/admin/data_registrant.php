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
    <small><?php if(!is_null($sex)): 
        if($sex == 'L'): echo 'Ikhwan';endif; 
        if($sex == 'P'): echo 'Akhwat';endif;
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
            <div class="btn-group">
                <div class="btn-group"role="group">
                    <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        <span class="glyphicon glyphicon-import"></span>
                        Kategori
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation">
                            <a role="menuitem" href="<?=  base_url()?>admin/lihat">
                                Semua
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" href="<?=  base_url()?>admin/lihat/L">
                                Ikhwan
                            </a>
                        </li>
                        <li role="presentation">
                            <a role="menuitem" href="<?=  base_url()?>admin/lihat/P">
                                Akhwat
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-responsive" id="tabel_utama">
                    <thead>
                        <tr>
                            <td>No. Pendaftaran</td>
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
                        <?php foreach ($data_registrant as $registrant) : ?>
                        <tr>
                            <td> <?= $registrant['id'];?></td>
                            <td> <?=$registrant['name'];?> </td>
                            <td> <?=($registrant['sex'] == 'L') ? 'Ikhwan' : 'Akhwat';?> </td>
                            <td> <?=$registrant['previousSchool'];?> </td>
                            <td> <?=  ucfirst($registrant['program']);?> </td>
                            <td> <?=$registrant['cp'];?> </td>
                            <td> <?=$registrant['status'];?> </td>
                            <td>
                                <a class="btn btn-sm btn-success" href="<?=base_url();?>admin/registrant/<?=$registrant['id'];?>">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                            <a id="btnDelRegistrant<?=$registrant['id'];?>" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                            <script type="text/javascript">
                                $("#btnDelRegistrant<?=$registrant['id'];?>").click(function (){
                                    $("#btnDelOk").attr("href", "<?=base_url().'admin/hapus_registrant/'.$registrant['id'];?>");
                                    $("#deleteRegistrant").modal("toggle");
                                });
                            </script>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
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
$(function() {
    $('#tabel_utama').DataTable();
});
</script>