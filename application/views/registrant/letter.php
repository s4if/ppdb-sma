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
    <small>Surat Pernyataan</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().$id.'/beranda';?>">Beranda</a>
    </li>
    <li class="active">
        Surat Pernyataan
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
        <p>
            Pada langkah ini, Anda akan membuat surat pernyataan mengenai Jumlah Uang Infaq pendidikan, IDP, dll. <br />
            Pastikan yang mengisi formulir ini adalah <strong>Orang Tua</strong> atau Anda <strong>Telah berdiskusi</strong> dengan orang tua Anda. <br/>
            Berikut isi pernyataannya:
        </p>
    </div>
    <?php $program = $registrant->getProgram();?>
    <div class="row">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h5>Isi Pernyataan</h5>
            </div>
            <div class="panel-body">
                <p>Dengan ini menyatakan bahwa:</p>
                <ol>
                    <li class="pernyataan">
                        Jika anak saya diterima sebagai siswa SMAIT Ihsanul Fikri Mungkid, saya menyerahkan anak saya dan siap bekerja sama 
                        dalam hal pembinaan diri selama berstatus sebagai siswa SMAIT Ihsanul Fikri Mungkid, bersedia menerima segala konsekuensi
                        akibat peraturan yang berlaku di dalamnya, dan tidak menuntut apapun yang menjadi keputusan sekolah.
                    </li>
                    <li class="pernyataan">
                        Jika anak saya diterima sebagai siswa SMAIT Ihsanul Fikri Mungkid, saya akan melunasi  
                        pembiayaan sesuai dengan kesanggupan saya:
                    </li>
                    <style type="text/css">
                        .pembiayaan table,th,tr,td {
                            border-collapse: collapse;
                            border: 1px solid black;
                            padding-left: 5px;
                            padding-right: 5px;
                        }
                    </style>
                    <div class="pembiayaan">
                        <?=$tabel_surat;?>
                    </div>
                    <li class="pernyataan">
                        Bersedia mengikuti program Qurban minimal 1 kali selama menjadi siswa SMAIT Ihsanul 
                        Fikri Mungkid pada Hari Raya Idul Adha tahun 2023/2024/2025 (Tahun dapat dipilih).
                    </li>
                    <li class="pernyataan">
                        Apabila setelah pendaftaran ulang ternyata anak saya mengundurkan diri, maka saya 
                        tidak akan menuntut segala yang telah saya bayarkan sebelumnya. Seluruh pembiayaan 
                        yang saya bayarkan tidak akan saya tarik kembali dan dijadikan sebagai Infaq.
                    </li>
                </ol>
            </div>
            <div class="panel-footer">
                &nbsp;
            </div>
        </div>
    </div>
    <div class="row">
        <p>
            Jika Anda telah membaca pernyataan dan setuju, silakan isi form dibawah ini untuk menentukan jumlah kesediaan membayar.
        </p>
    </div>
    <div class="row">
        <form class="form-horizontal" role="form" method="post" action="<?=base_url().'pendaftar/isi_pernyataan/'.$id;?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Infaq Pendidikan :</label>
                <div class="col-sm-4">
                    <?php
                    $infaq = $biaya_pilihan_minimal['infaq_pendidikan'];
                    for ($i = 0; $i < 3; $i++):?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="raw_icost" value="<?=$infaq;?>" 
                                    <?php if(!empty($registrant->getInitialCost())):?>
                                        <?php if($registrant->getInitialCost() == $infaq):?>
                                        checked
                                        <?php endif;?>
                                    <?php endif;?>>
                                Rp. <?= number_format($infaq, 0, ',', '.');?>,-
                            </label>
                        </div>
                    <?php 
                    $infaq += 1000000;
                    endfor; 
                    $infaq -= 1000000; ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="-999" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if($registrant->getInitialCost() > $infaq):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari Rp. <?= number_format($infaq, 0, ',', '.');?>,-
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" onkeyup="rupiah('icost')" pattern="^([0-9]{1,9}$)" name="other_icost" title="Maksimal 9 digit angka!"
                           class="form-control" placeholder="Masukkan Jumlah Melebih Rp. <?= number_format($infaq, 0, ',', '.');?>,- Tanpa Titik" value="<?=$registrant->getInitialCost();?>">
                </div>
            </div>
            <div class="form-group">
                <p class="help-block col-sm-offset-4 col-sm-4" id="icost_help"></p>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Iuran Dana Pendidikan (IDP) :</label>
                <div class="col-sm-4">
                    <?php
                    $spp = $biaya_pilihan_minimal['spp_bulanan'];
                    for ($i = 0; $i < 3; $i++):?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="raw_scost" value="<?=$spp;?>" 
                                    <?php if(!empty($registrant->getSubscriptionCost())):?>
                                        <?php if($registrant->getSubscriptionCost() == $spp):?>
                                        checked
                                        <?php endif;?>
                                    <?php endif;?>>
                                Rp. <?= number_format($spp, 0, ',', '.');?>,-
                            </label>
                        </div>
                    <?php 
                    $spp += 100000;
                    endfor; 
                    $spp -= 100000; ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="-999" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if($registrant->getSubscriptionCost() > $spp):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari Rp. <?= number_format($spp, 0, ',', '.');?>,-
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" onkeyup="rupiah('scost')" name="other_scost" pattern="^([0-9]{1,8}$)" title="Maksimal 8 digit angka!"
                           class="form-control" placeholder="Masukkan Jumlah Melebih Rp. <?= number_format($spp, 0, ',', '.');?>,- Tanpa Titik" value="<?=$registrant->getSubscriptionCost();?>">
                </div>
            </div>
            <div class="form-group">
                <p class="help-block col-sm-offset-4 col-sm-4" id="scost_help"></p>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Wakaf Tanah :</label>
                <div class="col-sm-4">
                    <?php
                    $wakaf = $biaya_pilihan_minimal['wakaf_tanah'];
                    for ($i = 0; $i < 3; $i++):?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="raw_scost" value="<?=$wakaf;?>" 
                                    <?php if(!empty($registrant->getLandDonation())):?>
                                        <?php if($registrant->getLandDonation() == $spp):?>
                                        checked
                                        <?php endif;?>
                                    <?php endif;?>>
                                Rp. <?= number_format($wakaf, 0, ',', '.');?>,-
                            </label>
                        </div>
                    <?php 
                    $wakaf += 500000;
                    endfor; 
                    $wakaf -= 500000; ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_lcost" value="-999" 
                                <?php if(!empty($registrant->getLandDonation())):?>
                                    <?php if(($registrant->getLandDonation() > $wakaf)):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari Rp. <?= number_format($wakaf, 0, ',', '.');?>,-
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" name="other_lcost" pattern="^([0-9]{1,9}$)" title="Maksimal 8 digit angka!"
                           class="form-control" onkeyup="rupiah('lcost')" placeholder="Masukkan Jumlah Melebih Rp. <?= number_format($wakaf, 0, ',', '.');?>,- Tanpa Titik" value="<?=$registrant->getLandDonation();?>">
                    <input type="number" name="boarding_kit" hidden="true" value="1">
                </div>
            </div>
            <div class="form-group">
                <p class="help-block col-sm-offset-4 col-sm-4" id="lcost_help"></p>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Yang Dicantumkan :</label>
                <div class="col-sm-4">
                    <select class="form-control" name="main_parent">
                        <option value="father" 
                                <?php if(!empty($registrant->getMainParent())):?>
                                    <?php if($registrant->getMainParent() == 'father'):?>
                                    selected="true" 
                                    <?php endif;?>
                                <?php endif;?>>
                            Nama Ayah
                        </option>
                        <option value="mother" 
                                <?php if(!empty($registrant->getMainParent())):?>
                                    <?php if($registrant->getMainParent() == 'mother'):?>
                                    selected="true" 
                                    <?php endif;?>
                                <?php endif;?>>
                            Nama Ibu
                        </option>
                        <option value="guardian" 
                                <?php if(!empty($registrant->getMainParent())):?>
                                    <?php if($registrant->getMainParent() == 'guardian'):?>
                                    selected="true" 
                                    <?php endif;?>
                                <?php endif;?>>
                            Nama Wali
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <label class="text-center">
                        Bersedia mengikuti program Qurban minimal 1 kali selama menjadi siswa SMAIT 
                        Ihsanul Fikri Mungkid pada Hari Raya Idul Adha tahun 
                        <?php 
                        $tampil_tahun = $tahun_masuk;
                        echo $tampil_tahun . '/' . ++$tampil_tahun . '/' . ++$tampil_tahun;?>.
                    </label>
                </div>
            </div>
            <?php
            $ck_tahun = $tahun_masuk; 
            for ($i = 0; $i < 3; $i++):?>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="checkbox">
                        <label>
                            <input type="checkbox" name="q<?=$i?>" value="<?=$ck_tahun;?>" <?php
                                $str_thn = "".$ck_tahun;
                                if (strpos($registrant->getQurban(), $str_thn) !== false) {
                                    echo "checked";
                                }
                            ?> > <?= $ck_tahun;?>
                        </label>
                      </div>
                    </div>
                </div>
            <?php 
            $ck_tahun++;
            endfor; ?>
            <hr/>
            <?php $jalur = $registrant->getSelectionPath();
            if($jalur != 'Jalur Reguler'): ?>
            <div class="form-group">
                <label class="col-sm-6 control-label"><strong class="text-warning">Pernyataan pemindahan Jalur Seleksi</strong></label>
            </div>
            <div class="form-group ">
                <label class="control-label col-sm-6 col-sm-offset-3"><p class="text-center">Apakah anda bersedia 
                    mengikuti <strong>Jalur Seleksi Reguler</strong> jika tidak lolos Seleksi Jalur Prestasi, Tahfidz, dan Rapor?</p></label>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="radio">
                        <label>
                            <input type="radio" name="rel_to_regular_path" value="false" 
                                <?php if(!empty($registrant->getRelToRegular())):?>
                                    <?php if($registrant->getRelToRegular() ==='false'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Saya tidak bersedia
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="rel_to_regular_path" value="true" 
                                <?php if(!empty($registrant->getRelToRegular())):?>
                                    <?php if($registrant->getRelToRegular() ==='true'):?>
                                    checked
                                    <?php endif;?>
                                <?php else :?>
                                    checked
                                <?php endif;?>>
                            Saya bersedia
                        </label>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <hr/>
            <?php if($program != 'Reguler'): ?>
            <div class="form-group">
                <label class="col-sm-6 control-label"><strong class="text-warning">Pernyataan pemindahan Program</strong></label>
            </div>
            <div class="form-group ">
                <label class="control-label col-sm-6 col-sm-offset-3"><p class="text-center">
                    Apakah anda bersedia ditempatkan di Program/Kelas reguler jika tidak lolos seleksi 
                    Program/Kelas Tahfidz?
                </p></label>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="radio">
                        <label>
                            <input type="radio" name="rel_to_regular" value="false" 
                                <?php if(!empty($registrant->getRelToRegular())):?>
                                    <?php if($registrant->getRelToRegular() ==='false'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Saya tidak bersedia
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="rel_to_regular" value="true" 
                                <?php if(!empty($registrant->getRelToRegular())):?>
                                    <?php if($registrant->getRelToRegular() ==='true'):?>
                                    checked
                                    <?php endif;?>
                                <?php else :?>
                                    checked
                                <?php endif;?>>
                            Saya bersedia
                        </label>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-4">
                    <button type="submit" class="btn btn-sm btn-primary">OK</button>
                    <a class="btn btn-sm btn-warning" href="<?=base_url().$id;?>/beranda">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
function rupiah(key) {
    var angka = $('input[name=other_'+key+']').val();
    if (isNaN(angka)) {
        $('#'+key+'_help').html('error');
    } else {
        str_angka = 'Tersimpan sebagai: '+format_rupiah(angka);
        $('#'+key+'_help').html(str_angka);
    }
}
</script>