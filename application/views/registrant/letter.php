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
            Pada langkah ini, anda akan membuat surat pernyataan mengenai Jumlah Uang Infaq pembangunan, SPP, dll. <br />
            Pastikan yang mengisi ini adalah <strong>Orang Tua</strong> atau anda <strong>Telah berdiskusi</strong> dengan orang tua anda. <br/>
            Berikut isi pernyataannya:
        </p>
    </div>
    <div class="row">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h5>Isi Pernyataan</h5>
            </div>
            <div class="panel-body">
                <p>Dengan ini menyatakan bahwa:</p>
                <ol>
                    <li class="pernyataan">
                        Jika anak saya diterima sebagai siswa SMAIT Ihsanul Fikri Mungkid, saya 
                        menyerahkan sepenuhnya anak saya dalam hal pembinaan diri selama berstatus siswa SMAIT 
                        Ihsanul FIkri Mungkid dan menerima segala konsekuensi akibat peraturan yang berlaku didalamnya.
                    </li>
                    <li class="pernyataan">
                        Jika anak saya diterima sebagai siswa SMAIT Ihsanul Fikri Mungkid, saya akan melunasi Infaq Pendidikan
                        sesuai dengan kesanggupan saya sebesar <strong>(Jumlah Uang Infaq Pendidikan)</strong>.
                    </li>
                    <li class="pernyataan">
                        Saya sanggup untuk memenuhi SPP bulanan kepada pihak sekolah sebesar <strong>(Jumlah Uang SPP)</strong>.
                    </li>
                    <li class="pernyataan">
                        Saya sanggup untuk membayar Uang Seragam dan Uang Kesiswaan kepada pihak sekolah dengan total sebesar 
                        <strong>Rp. 2.200.000,-</strong>.
                    </li>
                    <li class="pernyataan">
                        Apabila setelah pendaftaran ulang ternyata anak saya mengundurkan diri, maka saya 
                        tidak akan menuntu segala yang telah saya bayarkan sebelumnya.
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
            Jika anda telah membaca dan setuju, silahkan isi form dibawah ini.
        </p>
    </div>
    <div class="row">
        <form class="form-horizontal" role="form" method="post" action="<?=base_url().'pendaftar/isi_pernyataan/'.$id;?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Infaq Pendidikan :</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="8500000" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if($registrant->getInitialCost() == '8500000'):?>
                                    checked="true"
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 8.500.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="10000000" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if($registrant->getInitialCost() == '10000000'):?>
                                    checked="true"
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 10.000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="11000000" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if($registrant->getInitialCost() == '11000000'):?>
                                    checked="true"
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 11.000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="-999" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if(!($registrant->getInitialCost() == '11000000'||
                                            $registrant->getInitialCost() == '8500000'||
                                            $registrant->getInitialCost() == '10000000')):?>
                                    checked="true"
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari 11 Juta Rupiah
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" name="other_icost" class="form-control" placeholder="Masukkan Jumlah Melebih 10Juta Tanpa Titik" value="<?=$registrant->getInitialCost();?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">SPP :</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="900000" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if($registrant->getSubscriptionCost() == '900000'):?>
                                    checked="true"
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 900.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="1000000" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if($registrant->getSubscriptionCost() == '1000000'):?>
                                    checked="true"
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 1000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="-999" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if(!($registrant->getSubscriptionCost() == '900000'||
                                            $registrant->getSubscriptionCost() == '1000000')):?>
                                    checked="true"
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari 1 Juta Rupiah
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" name="other_scost" class="form-control" placeholder="Masukkan Jumlah Melebih 1Juta Tanpa Titik" value="<?=$registrant->getSubscriptionCost();?>">
                </div>
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
                <div class="col-sm-offset-3 col-sm-4">
                    <button type="submit" class="btn btn-sm btn-primary">OK</button>
                    <a class="btn btn-sm btn-warning" href="<?=base_url().$id;?>/beranda">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>