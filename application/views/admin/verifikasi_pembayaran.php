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
<style>
    .foto-profil {
        resize: both;
        height: 100%;
        width: 100%;
    }
    .foto-kwitansi {
        resize: both;
        height: 100%;
        width: 100%;
        max-height: 800px;
        max-width: 600px;
    }
</style>

<h1 class="page-header">
    Konfirmasi Resi
    <small>
        Pembayaran
    </small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'admin/beranda';?>">Beranda</a>
    </li>
    <li>
        <a href="<?=base_url().'admin/pembayaran';?>">Pembayaran</a>
    </li>
    <li class="active">
        Konfirmasi
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
        <h3>Data Pendaftar</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table>
                <tr>
                    <td> Nomor Pendaftaran </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getRegistrant()->getId();?> </td>
                </tr>
                <tr>
                    <td> Nama </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getRegistrant()->getName();?> </td>
                </tr>
                <tr>
                    <td> Sekolah Asal </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getRegistrant()->getPreviousSchool()?> </td>
                </tr>
                <tr>
                    <td> Jenis Kelamin </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=($resi->getRegistrant()->getSex() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
                </tr>
                <tr>
                    <td> NISN </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getRegistrant()->getNisn()?> </td>
                </tr>
                <tr>
                    <td> Program </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getRegistrant()->getProgram()?> </td>
                </tr>
                <tr>
                    <td> Jumlah Pembayaran </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getAmount();?> </td>
                </tr>
                <tr>
                    <td> Tanggal Pembayaran </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getPaymentDate()->format('d F Y')?> </td>
                </tr>
                <tr>
                    <td> Rekening Tujuan </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$resi->getTransferDestination()?> </td>
                </tr>
                <tr>
                    <td> Status Verifikasi </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?php
                            if(is_null($resi->getVerified())){
                                echo 'Menunggu Verifikasi <span class="glyphicon glyphicon-refresh"></span>';
                            } elseif ($resi->getVerified() == 'valid'){
                                echo 'Sudah Diverifikasi <span class="glyphicon glyphicon-ok-sign"></span>';
                            } else {
                                echo 'File yang diupload salah <span class="glyphicon glyphicon-alert"></span>';
                            }
                            ?> 
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalVerifikasi" >
                            <span class="glyphicon glyphicon-edit"></span>
                            Verifikasi
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php if(!empty($img_receipt)):?>
    <div class="row">
        <h3>Kwitansi Pembayaran</h3>
    </div>
    <div class="row">
        <img class="foto-kwitansi img-rounded" src="<?=$img_receipt;?>" alt="foto-profil">
    </div>
    <?php endif;?>
</div>

<div class="modal fade" id="ModalVerifikasi" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Kwitansi yang diupload oleh pendaftar dengan ID : <?php echo $resi->getRegistrant()->getId();?> Valid?
            </div>
            <div class="modal-footer">
                <a id="btnDelOk" class="btn btn-success" href="<?=  base_url();?>admin/verifikasi/<?=$resi->getId();?>/valid">Ya</a>
                <a id="btnDelOk" class="btn btn-danger" href="<?=  base_url();?>admin/verifikasi/<?=$resi->getId();?>/tidak">Tidak</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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