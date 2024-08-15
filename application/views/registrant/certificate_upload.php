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
        <a href="<?=base_url().$id.'/beranda';?>">Beranda</a>
    </li>
    <li class="active">
        Upload Sertifikat
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
        <h2>Ketentuan Upload Dokumen Jalur Prestasi dan Hafalan Qur'an<br />
        <small>(Halaman ini dipertuntukan bagi yang mendaftar seleksi jalur prestasi atau hafalan Qur'an. 
            Untuk Jalur Seleksi Rapor, Pengisian Data ada di bagian Isi Rapor)</small></h2>
        <ol>
            <li>Bagi calon Peserta Jalur Seleksi Hafalan Qur'an, dokumen yang diupload merupakan <strong>Sertifikat Hafalan</strong> 
                yang diterbitkan oleh instansi yang berwenang (sekolah/lembaga pendidikan Al Qur'an).
            </li>
            <li>
                Bagi calon Peserta Jalur Seleksi Prestasi, dokumen yang diupload merupakan bukti keikutsertaan/prestasi calon 
                peserta didik dalam lomba/kompetisi baik akademis maupun non-akademis, <strong>minimal Tingkat Provinsi</strong>.
            </li>
            <li>
                Calon peserta didik diwajibkan mengupload dokumen dengan jujur sesuai dengan 
                prestasi atau jumlah hafalan yang dimiliki.
            </li>
            <li>
                Upload dokumen ini ditutup pada <strong>17 September 2024</strong> kemudian 
                akan diperpanjang jika kuota beasiswa masih ada. <br>
                Dokumen yang masuk seksama oleh tim seleksi yang hasilnya akan diumumkan pada tanggal 
                <strong>24 September 2024</strong> sesuai panduan Seleksi Jalur Prestasi 
                dan Hafalan Qur'an di halaman web <a href="https://smait.ihsanulfikri.sch.id">smait.ihsanulfikri.sch.id</a>
            </li>
            <li>
                Jika calon peserta didik menemukan kesalahan saat upload dokumen, calon peserta didik 
                dapat <strong>menghapus dan mengupload kembali</strong> dokumen yang dimaksud.
            </li>
        </ol>
        <p>Hormat kami, Tim PPDB SMAIT Ihsanul Fikri Mungkid Tahun Ajaran 2024-2025</p>
        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalImport">
            <span class="glyphicon glyphicon-upload"></span>&nbsp;
            Tambah Dokumen
        </a>
        <hr />
    </div>
        <?php if($registrant->getCertificatesCount() == 0):?>
    <div class="row">
        <p>Belum ada sertifikat/surat yang terunggah</p>
    </div>
        <?php else : 
        $count= 1;
        $certificates = $registrant->getCertificates();
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
            <tr>
                <td> </td>
                <td> </td>
                <td> <a class="btn btn-danger" href="<?= base_url()?>pendaftar/hapus_sertifikat/<?=$cert->getId();?>">
                        <span class="glyphicon glyphicon-erase"></span>&nbsp;Hapus
                    </a> </td>
            </tr>
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
                <h4 class="modal-title" id="ModalImportLabel>">Upload Sertifikat Tahfidz/Hafalan/Prestasi Lomba</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal wrapper form-data" role="form" method="post" action="<?=base_url();?>pendaftar/upload_cert/<?=$id?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Jenis Dokumen :</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="document_type">
                            <option value="Sertifikat Kejuaraan">Sertifikat Prestasi/Kejuaraan/Lomba</option>
                            <option value="Surat Keterangan Keikutsertaan">Surat Undangan/Pengumuman</option>
                            <option value="Sertifikat Hafalan">Sertifikat Hafalan</option>
                            <option value="Dokumen Lain">Dokumen Lain</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tanggal Sertifikat :</label>
                    <div class="col-sm-8">
                        <input type="date" name="date" required="true" class="form-control" placeholder="Waktu Mulai OSN">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Penerbit Sertifikat :</label>
                    <div class="col-sm-8">
                        <input type="text" name="issuer" required="true" class="form-control" placeholder="contoh: Dinas Pendidikan Jawa Tengah">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Keterangan :</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="note" rows="3"></textarea>
                        <span  class="help-block">Masukkan keterangan yang diperlukan 
                        (Mata Pelajaran, Ranking Juara, Tingkat Kejuaraan, Penyelenggara, 
                        untuk jalur seleksi prestasi, atau nomor/jumlah Juz, penerbit sertifikat, 
                        pada sertifikat Hafalan untuk Jalur seleksi tahfidz)</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Dokumen yang Diupload :</label>
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
<script type="text/javascript">
    
</script>