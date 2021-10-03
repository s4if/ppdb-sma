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
        <h2>Ketentuan Upload Dokumen Beasiswa Prestasi, Beasiswa Unggulan dan Beasiswa Unggulan Plus</h2>
        <ol>
            <li>Dokumen yang diupload merupakan bukti keikutsertaan/prestasi calon peserta 
                didik dalam lomba <strong> Olimpiade Sains Nasional (OSN) minimal Tingkat Provinsi 
                (Beasiswa Prestasi), Tingkat Nasional (Beasiswa Unggulan) atau Tingkat 
                Internasional (Beasiswa Unggulan Plus).</strong> 
            </li>
            <li>
                Bukti yang dimaksud dalam poin 1 adalah:
                <ul>
                    <li>Sertifikat Juara/Keikutsertaan OSN atau</li>
                    <li>Surat Keterangan Peserta OSN atau</li>
                    <li>Surat Undangan Mengikuti OSN.</li>
                </ul>
            </li>
            <li>
                Calon peserta didik diwajibkan mengupload dokumen dengan jujur sesuai dengan 
                prestasi yang dimiliki.
            </li>
            <li>
                Dokumen yang diupload oleh calon peserta didik akan diseleksi secara seksama oleh tim seleksi 
                yang hasilnya akan diumumkan bersamaan dengan pengumuman penerimaan jalur reguler.
            </li>
            <li>
                Jika calon peserta didik menemukan kesalahan saat upload dokumen, calon peserta didik 
                dapat <strong>menghapus dan mengupload kembali</strong> dokumen yang dimaksud.
            </li>
        </ol>
        <p>Hormat kami, Tim PPDB SMAIT Ihsanul Fikri Mungkid Tahun Ajaran 2019-2020</p>
        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalImport">
            <span class="glyphicon glyphicon-upload"></span>&nbsp;
            Tambah Dokumen Sertifikat/Surat
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
                <td> Jalur </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getScheme();?> </td>
            </tr>
            <tr>
                <td> Tipe Dokumen </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getFileType();?> </td>
            </tr>
            <tr>
                <td> Mapel OSN </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getSubject();?> </td>
            </tr>
            <tr>
                <td> Ranking </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getRank();?> </td>
            </tr>
            <tr>
                <td> Tingkat Olimpiade </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getLevel();?> </td>
            </tr>
            <tr>
                <td> Penyelenggara </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getOrganizer();?> </td>
            </tr>
            <tr>
                <td> Lokasi Lomba </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getPlace();?> </td>
            </tr>
            <tr>
                <td> Tanggal Pelaksanaan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> 
                <?= tgl_indo($cert->getStartDate()->format('Y m d'));?> s/d 
                <?= tgl_indo($cert->getEndDate()->format('Y m d'));?>
                </td>
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
                <h4 class="modal-title" id="ModalImportLabel>">Upload Sertifikat/Surat Undangan/Surat Keterangan Seleksi OSN</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal wrapper form-data" role="form" method="post" action="<?=base_url();?>pendaftar/upload_cert/<?=$id?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Pemilihan Jalur :</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="scheme">
                            <option value="Beasiswa Prestasi">Beasiswa Prestasi</option>
                            <option value="Beasiswa Unggulan">Beasiswa Unggulan</option>
                            <option value="Beasiswa Unggulan Plus">Beasiswa Unggulan Plus</option>
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
<script type="text/javascript">
    
</script>