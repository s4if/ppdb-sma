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
                    <table class="table-bordered table-responsive">
                        <tr>
                            <th>Jenis Pembiayaan</th>
                            <th>Nominal Pembiayaan</th>
                            <th>Frekuensi Pembiayaan</th>
                        </tr>
                        <tr>
                            <td>a. Infaq Pendidikan</td>
                            <td><strong>[[Sesuai Pilihan]]</strong></td>
                            <th>Sekali</th>
                        </tr>
                        <tr>
                            <td>b. Iuran Dana Pendidikan (IDP) bulanan</td>
                            <td><strong>[[Sesuai Pilihan]]</strong></td>
                            <th>Per Bulan</th>
                        </tr>
                        <tr>
                            <td>c. Wakaf Tanah</td>
                            <td><strong>[[Sesuai Pilihan]]</strong></td>
                            <th>Sekali</th>
                        </tr>
                        <tr>
                            <td>d. Seragam</td>
                            <td>Rp. 1.900.000,-</td>
                            <th>Sekali</th>
                        </tr>
                        <tr>
                            <td>e. Kesiswaan</td>
                            <td><?php echo ($program == 'IPA Tahfidz' || $program == 'IPS Tahfidz')?'Rp. 1.200.000,-':'Rp. 1.000.000,-';?> <strong class="red">*</strong></td>
                            <th>Per Tahun</th>
                        </tr>
                        <tr>
                            <td>f. Biaya Kesehatan</td>
                            <td>Rp. 250.000,-</td>
                            <th>Per Tahun</th>
                        </tr>
                        <tr>
                            <td>g. Biaya Buku</td>
                            <td>Rp. 1.500.000,-</td>
                            <th>Per Tahun</th>
                        </tr>
                        <tr>
                            <td>h. Perlengkapan Asrama</td>
                            <td>Rp. 1.100.000,-</td>
                            <th>Sekali</th>
                        </tr>
                        <tr>
                            <td>i. Majalah dan Kalender</td>
                            <td>Rp. 120.000,-</td>
                            <th>Per Tahun</th>
                        </tr>
                    </table>
                    <span class="help-block">* = Untuk kelas tahfidz Rp.1200.000,- sedangkan
                        untuk kelas reguler Rp.1.000.000,-.</span>
                    
                    <li class="pernyataan">
                        Bersedia mengikuti program Qurban minimal 1 kali selama menjadi siswa SMAIT Ihsanul 
                        Fikri Mungkid pada Hari Raya Idul Adha tahun 2020/2021/2022 (Tahun bisa dipilih).
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
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="11000000" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if($registrant->getInitialCost() == '11000000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 11.000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="12000000" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if($registrant->getInitialCost() == '12000000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 12.000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="13000000" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if($registrant->getInitialCost() == '13000000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 13.000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_icost" value="-999" 
                                <?php if(!empty($registrant->getInitialCost())):?>
                                    <?php if(!($registrant->getInitialCost() == '12000000'||
                                            $registrant->getInitialCost() == '11000000'||
                                            $registrant->getInitialCost() == '13000000')):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari 13 Juta Rupiah
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" pattern="^([0-9]{1,9}$)" name="other_icost" title="Maksimal 9 digit angka!"
                           class="form-control" placeholder="Masukkan Jumlah Melebih 13Juta Tanpa Titik" value="<?=$registrant->getInitialCost();?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Iuran Dana Pendidikan (IDP) :</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="1350000" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if($registrant->getSubscriptionCost() == '1350000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 1.350.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="1450000" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if($registrant->getSubscriptionCost() == '1450000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 1.450.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="1550000" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if($registrant->getSubscriptionCost() == '1550000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 1.550.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_scost" value="-999" 
                                <?php if(!empty($registrant->getSubscriptionCost())):?>
                                    <?php if(!($registrant->getSubscriptionCost() == '1350000'||
                                            $registrant->getSubscriptionCost() == '1450000' ||
                                            $registrant->getSubscriptionCost() == '1550000')):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari 1,55 Juta Rupiah
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" name="other_scost" pattern="^([0-9]{1,8}$)" title="Maksimal 8 digit angka!"
                           class="form-control" placeholder="Masukkan Jumlah Melebih 1,5 Juta Tanpa Titik" value="<?=$registrant->getSubscriptionCost();?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Wakaf Tanah :</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_lcost" value="500000" 
                                <?php if(!empty($registrant->getLandDonation())):?>
                                    <?php if($registrant->getLandDonation() == '500000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 500.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_lcost" value="1000000" 
                                <?php if(!empty($registrant->getLandDonation())):?>
                                    <?php if($registrant->getLandDonation() == '1000000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 1.000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_lcost" value="1500000" 
                                <?php if(!empty($registrant->getLandDonation())):?>
                                    <?php if($registrant->getLandDonation() == '1500000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 1.500.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_lcost" value="2000000" 
                                <?php if(!empty($registrant->getLandDonation())):?>
                                    <?php if($registrant->getLandDonation() == '2000000'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Rp. 2.000.000,-
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="raw_lcost" value="-999" 
                                <?php if(!empty($registrant->getLandDonation())):?>
                                    <?php if(!($registrant->getLandDonation() == '500000'||
                                            $registrant->getLandDonation() == '1000000' ||
                                            $registrant->getLandDonation() == '2000000' ||
                                            $registrant->getLandDonation() == '1500000')):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Lebih dari 2 Juta Rupiah
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="number" name="other_lcost" pattern="^([0-9]{1,9}$)" title="Maksimal 8 digit angka!"
                           class="form-control" placeholder="Masukkan Jumlah Melebih 2Juta Tanpa Titik" value="<?=$registrant->getLandDonation();?>">
                    <input type="number" name="boarding_kit" hidden="true" value="1">
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
                <div class="col-sm-4 col-sm-offset-3">
                    <label class="text-center">
                        Bersedia/mengikuti program Qurban minimal 1 kali selama menjadi siswa SMAIT 
                        Ihsanul Fikri Mungkid pada Hari Raya Idul Adha tahun 2020/2021/2022.
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="q1" value="2020" <?php
                            if (strpos($registrant->getQurban(), '2020') !== false) {
                                echo "checked";
                            }
                        ?> > 2020
                    </label>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="q2" value="2021" <?php
                            if (strpos($registrant->getQurban(), '2021') !== false) {
                                echo "checked";
                            }
                        ?> > 2021
                    </label>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="q3" value="2022" <?php
                            if (strpos($registrant->getQurban(), '2022') !== false) {
                                echo "checked";
                            }
                        ?> > 2022
                    </label>
                  </div>
                </div>
            </div>
            <hr/>
            <div class="form-group">
                <label class="col-sm-6 control-label"><strong class="text-warning">Pernyataan pemindahan Jurusan</strong></label>
            </div>
            <div class="form-group ">
                <label class="control-label col-sm-6 col-sm-offset-3"><p class="text-center">Apakah anda bersedia ditempatkan di jurusan yang lain jika anda tidak lolos 
                        untuk jurusan pilihan anda namun nilai anda bisa bersaing di jurusan yang lain?</p></label>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="radio">
                        <label>
                            <input type="radio" name="rel_to_ips" value="false" 
                                <?php if(!empty($registrant->getRelToIPS())):?>
                                    <?php if($registrant->getRelToIPS() ==='false'):?>
                                    checked
                                    <?php endif;?>
                                <?php endif;?>>
                            Saya tidak bersedia
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="rel_to_ips" value="true" 
                                <?php if(!empty($registrant->getRelToIPS())):?>
                                    <?php if($registrant->getRelToIPS() ==='true'):?>
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
            <hr/>
            <?php if($program == 'IPA Tahfidz' || $program == 'IPS Tahfidz'): ?>
            <div class="form-group">
                <label class="col-sm-6 control-label"><strong class="text-warning">Pernyataan pemindahan Program</strong></label>
            </div>
            <div class="form-group ">
                <label class="control-label col-sm-6 col-sm-offset-3"><p class="text-center">Apakah anda bersedia ditempatkan di 
                    program reguler jika tidak lolos seleksi program Tahfidz?</p></label>
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
<</div>