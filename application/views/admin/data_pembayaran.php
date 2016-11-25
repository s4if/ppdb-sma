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
    Data Resi
    <small>
        Pembayaran
    </small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'admin/beranda';?>">Beranda</a>
    </li>
    <li class="active">
        Pembayaran
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-responsive" id="tabel_utama">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Nama</td>
                            <td>I/A</td>
                            <td>Program</td>
                            <td>Tanggal Upload</td>
                            <td>Status</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($data_pembayaran as $resi) :?>
                        <tr>
                            <td> <?=$no;?></td>
                            <td> <?=$resi->getRegistrant()->getName();?> </td>
                            <td> <?=($resi->getRegistrant()->getGender() == 'L') ? 'Ikhwan' : 'Akhwat';?> </td>
                            <td> <?=ucfirst($resi->getRegistrant()->getProgram());?> </td>
                            <td> <?=$resi->getPaymentDate()->format('d F Y')?></td>
                            <td> <?php
                            if(is_null($resi->getVerified())){
                                echo 'Menunggu Verifikasi <span class="glyphicon glyphicon-refresh"></span>';
                            } elseif ($resi->getVerified() == 'valid'){
                                echo 'Sudah Diverifikasi <span class="glyphicon glyphicon-ok-sign"></span>';
                            } else {
                                echo 'File yang diupload salah <span class="glyphicon glyphicon-alert"></span>';
                            }
                            $no++;
                            ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="<?=base_url();?>admin/pembayaran/<?=$resi->getId();?>">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
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