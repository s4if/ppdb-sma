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
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-responsive" id="tabel_utama">
                    <thead>
                        <tr>
                            <td>No. Pendaftaran</td>
                            <td>Nama</td>
                            <td>I/A</td>
                            <td>Sekolah Asal</td>
                            <td>NISN</td>
                            <td>Program</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_registrant as $registrant) : ?>
                        <tr>
                            <td> <?=$registrant->getId();?></td>
                            <td> <?=$registrant->getName();?> </td>
                            <td> <?=($registrant->getSex() == 'L') ? 'Ikhwan' : 'Akhwat';?> </td>
                            <td> <?=$registrant->getPreviousSchool();?> </td>
                            <td> <?=$registrant->getNisn();?> </td>
                            <td> <?=  ucfirst($registrant->getProgram());?> </td>
                            <td>
                                <a class="btn btn-sm btn-success" href="<?=base_url();?>admin/registrant/<?=$registrant->getId();?>">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                            <?php $now = new DateTime('now');
                            $nowTime = $now->format('d-m-Y');
                            $regTime = $registrant->getRegistrationTime()->format('d-m-Y');
                                if (! ($nowTime == $regTime) ):?>
                            <a id="btnDelRegistrant<?=$registrant->getId();?>" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                            <script type="text/javascript">
                                $("#btnDelRegistrant<?=$registrant->getId();?>").click(function (){
                                    $("#btnDelOk").attr("href", "<?=base_url().'admin/hapus_pendaftar/'.$registrant->getId();?>");
                                    $("#deleteRegistrant").modal("toggle");
                                });
                            </script>
                            <?php endif;?>
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
    $('#tabel_utama').DataTable({
        "order": [[ 0, "desc" ]]
    });
});
</script>