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
    Pendaftar
    <small>Upload Sertifikat</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'admin/beranda';?>">Beranda</a>
    </li>
    <li class="active">
        Lihat Sertifikat
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
<!--        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalImport">
            <span class="glyphicon glyphicon-upload"></span>
            Tambah Dokumen Sertifikat/Surat
        </a>-->
        <a class="btn btn-sm btn-warning" href="<?= base_url()?>admin/print_sertifikat/<?=$reg->getId();?>">
            <span class="glyphicon glyphicon-download"></span>
            Cetak Dokumen Siswa
        </a>
        <hr />
    </div>
    <?php if($reg->getCertificatesCount() == 0):?>
    <div class="row">
        <p>Belum ada sertifikat/surat yang terunggah</p>
    </div>
        <?php else : 
        $count= 1;
        $certificates = $reg->getCertificates();
        foreach ($certificates as $cert):
            //$cert = new CertificateEntity();
        ?>
    <div class="row">
        <h4>Dokumen <?=$count;?></h4>
        <img src="<?= base_url().'pendaftar/img_sertifikat/'.$id.'/'.$cert->getFileName();?>" alt="Gambar Tidak Ditemukan"
             style="max-width: 500px" />
        <table>
            <tr>
                <td> Tipe Dokumen </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getDocumentType();?> </td>
            </tr>
            <tr>
                <td> Tanggal Sertifikat </td>
                <td> &nbsp;:&nbsp; </td>
                <td> 
                <?= tgl_indo($cert->getDate()->format('Y m d'));?>
                </td>
            </tr>
            <tr>
                <td> Penerbit Sertifikat </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getIssuer();?> </td>
            </tr>
            <tr>
                <td> Keterangan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getNote();?> </td>
            </tr>
<!--            <tr>
                <td> </td>
                <td> </td>
                <td> <a class="btn btn-danger" href="<?= base_url()?>admin/hapus_sertifikat/<?=$reg->getId()?>/<?=$cert->getId();?>">
                        <span class="glyphicon-erase"></span>Hapus
                    </a> </td>
            </tr>-->
        </table>
        <hr />
    </div>
        <?php 
        $count++;
        endforeach;
        endif; ?>
</div>

<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Upload Sertifikat/Surat Undangan/Surat Keterangan Seleksi OSN</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal wrapper form-data" role="form" method="post" action="<?=base_url();?>admin/upload_cert/<?=$id?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Pemilihan Jalur :</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="scheme">
                            <option value="Beasiswa">Beasiswa Unggulan</option>
                            <option value="Prestasi">Jalur Prestasi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Mata Pelajaran OSN :</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="subject">
                            <option value="Matematika">Matematika</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Peringkat :</label>
                    <div class="col-sm-8">
                        <input type="number" name="rank" class="form-control" placeholder="Kosongkan jika tidak tahu">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Pelaksana Seleksi OSN :</label>
                    <div class="col-sm-8">
                        <input type="text" name="organizer" required="true" class="form-control" placeholder="contoh: Dinas Pendidikan Jawa Tengah">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Waktu Pelaksanaan OSN :</label>
                    <div class="col-sm-2">
                        <input type="date" name="start_date" required="true" class="form-control" placeholder="Waktu Mulai OSN">
                    </div>
                    <label class="col-sm-1 control-label">Sampai</label>
                    <div class="col-sm-2">
                        <input type="date" name="end_date" required="true" class="form-control" placeholder="Waktu Mulai OSN">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tingkat OSN :</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="level">
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tempat Pelaksanaan OSN :</label>
                    <div class="col-sm-8">
                        <input type="text" name="place" required="true" class="form-control" placeholder="Contoh: Semarang">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Jenis File :</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="file_type">
                            <option value="Sertifikat">Sertifikat</option>
                            <option value="Surat Keterangan">Surat Keterangan</option>
                            <option value="Surat Undangan">Surat Undangan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Lampiran (Sertifikat/Surat Undangan/Surat Keterangan) :</label>
                    <div class="col-sm-8">
                        <input type="file" name="file" required="true" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <input type="submit" value="Upload Data">
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>