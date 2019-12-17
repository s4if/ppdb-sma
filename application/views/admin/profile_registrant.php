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
    <small>Profil</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>admin/beranda/">Beranda</a>
    </li>
    <li class="active">
        Profil
    </li>
</ol>
<style>
    .foto-profil {
        resize: both;
        max-height: 200px;
        max-width: 150px;
        height: 100%;
        width: 100%;
    }
</style>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-2">
        <img class="foto-profil img-rounded" src="<?=$img_link;?>" alt="foto-profil">
    </div>
    <div class="col-md-8">
        <table>
        <tr>
            <td> Username </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$registrant_data->getUsername();?> </td>
        </tr>
        <tr>
            <td> Nama </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$registrant_data->getName();?> </td>
        </tr>
        <tr>
            <td> Sekolah Asal </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$registrant_data->getPreviousSchool()?> </td>
        </tr>
        <tr>
            <td> Jenis Kelamin </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=($registrant_data->getGender() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
        </tr>
        <tr>
            <td> NISN </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$registrant_data->getNisn()?> </td>
        </tr>
        <tr>
            <td> Email </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$registrant_data->getCp()?> </td>
        </tr>
        <tr>
            <td> Program </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$registrant_data->getProgram()?> </td>
        </tr>
        <tr>
            <td colspan="3">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProfil" >
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit Profil
                </a>
                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalImport">
                    <span class="glyphicon glyphicon-upload"></span>
                    Upload Foto
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPassword">
                    <span class="glyphicon glyphicon-briefcase"></span>
                    Ganti Password
                </a>
            </td>
        </tr>
    </table>
    </div>
    &nbsp;
</div>
    <div class="row">
        <h3 class="col-md-12">Status</h3>
        <div class="col-md-12">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <td>
                            No.
                        </td>
                        <td>
                            Data
                        </td>
                        <td>
                            Status
                        </td>
                        <td>
                            Aksi
                        </td>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Data Pendaftar
                        </td>
                        <td>
                            <?php echo ($status ['data'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#editDetail"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Data Ayah
                        </td>
                        <td>
                            <?php echo ($status ['father'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editFather"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Data Ibu
                        </td>
                        <td>
                            <?php echo ($status ['mother'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                           <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editMother"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            Data Pembayaran
                        </td>
                        <td>
                            <?php echo ($status ['letter'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                           <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editLetter"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5
                        </td>
                        <td>
                            Data Wali (Hanya yang bersama Wali)
                        </td>
                        <td>
                            <?php echo ($status ['guardian'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                          <a class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#editGuardian"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="editProfil" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Pendaftar</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>/admin/do_edit_profil/<?=$id?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input type="text" required="true" name="name" id="name" tabindex="1" class="form-control" placeholder="Nama" value="<?=$registrant_data->getName();?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sekolah Asal :</label>
                        <div class="col-sm-8">
                            <input type="text" required="true" name="prev_school" id="prev_school" tabindex="1" class="form-control" placeholder="Sekolah Asal" value="<?=$registrant_data->getPreviousSchool();?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NISN :</label>
                        <div class="col-sm-8">
                            <input type="text" name="nisn" id="nisn" tabindex="1" class="form-control" placeholder="NISN" value="<?=$registrant_data->getNisn();?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email / No. HP:</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="NISN" value="<?=$registrant_data->getCp();?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Kelamin :</label>
                        <div class="col-sm-8">
                            <div class="radio">
                                <label>
                                    <input type="radio" checked="true" name="gender" value="L" 
                                        <?php if(!empty($registrant_data->getGender())):?>
                                            <?php if($registrant_data->getGender() ==='L'):?>
                                            checked="true"
                                            <?php endif;?>
                                        <?php endif;?>>
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="P"
                                        <?php if(!empty($registrant_data->getGender())):?>
                                            <?php if($registrant_data->getGender() ==='P'):?>
                                            checked="true"
                                            <?php endif;?>
                                        <?php endif;?>>
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Program :</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="program">
                                <option value="IPA Reguler"
                                        <?php if(array_key_exists('program', $registrant_data)):?>
                                            <?php if($registrant_data['program']=='IPA Reguler'): ?>
                                                    selected
                                            <?php endif;?>
                                        <?php endif;?>>
                                    IPA Reguler
                                </option>
                                <option value="IPS Reguler"
                                        <?php if(array_key_exists('program', $registrant_data)):?>
                                            <?php if($registrant_data['program']=='IPS Reguler'): ?>
                                                    selected
                                            <?php endif;?>
                                        <?php endif;?>>
                                    IPS Reguler
                                </option>
                                <option value="IPA Tahfidz"
                                        <?php if(array_key_exists('program', $registrant_data)):?>
                                            <?php if($registrant_data['program']=='IPA Tahfidz'): ?>
                                                    selected
                                            <?php endif;?>
                                        <?php endif;?>>
                                    IPA Tahfidz
                                </option>
                                <option value="IPS Tahfidz" 
                                        <?php if(array_key_exists('program', $registrant_data)):?>
                                            <?php if($registrant_data['program']=='IPS Tahfidz'): ?>
                                                    selected
                                            <?php endif;?>
                                        <?php endif;?>>
                                    IPS Tahfidz
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-sm btn-primary">OK</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $program = $registrant_data->getProgram();?>
<div class="modal fade" id="editLetter" tabindex="-1" role="dialog" aria-labelledby="editLetter" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Edit Pembayaran</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>/admin/do_edit_letter/<?=$id?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Infaq Pendidikan :</label>
                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_icost" value="11000000" 
                                                <?php if(!empty($registrant_data->getInitialCost())):?>
                                                    <?php if($registrant_data->getInitialCost() == '11000000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 11.000.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_icost" value="12000000" 
                                                <?php if(!empty($registrant_data->getInitialCost())):?>
                                                    <?php if($registrant_data->getInitialCost() == '12000000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 12.000.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_icost" value="13000000" 
                                                <?php if(!empty($registrant_data->getInitialCost())):?>
                                                    <?php if($registrant_data->getInitialCost() == '13000000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 13.000.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_icost" value="-999" 
                                                <?php if(!empty($registrant_data->getInitialCost())):?>
                                                    <?php if(!($registrant_data->getInitialCost() == '12000000'||
                                                            $registrant_data->getInitialCost() == '11000000'||
                                                            $registrant_data->getInitialCost() == '13000000')):?>
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
                                    <input type="number" onkeyup="rupiah('icost')" pattern="^([0-9]{1,9}$)" name="other_icost" title="Maksimal 9 digit angka!"
                                           class="form-control" placeholder="Masukkan Jumlah Melebih 13Juta Tanpa Titik" value="<?=$registrant_data->getInitialCost();?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="help-block col-sm-offset-4 col-sm-4" id="icost_help"></p>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Iuran Dana Pendidikan (IDP) :</label>
                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_scost" value="1350000" 
                                                <?php if(!empty($registrant_data->getSubscriptionCost())):?>
                                                    <?php if($registrant_data->getSubscriptionCost() == '1350000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 1.350.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_scost" value="1450000" 
                                                <?php if(!empty($registrant_data->getSubscriptionCost())):?>
                                                    <?php if($registrant_data->getSubscriptionCost() == '1450000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 1.450.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_scost" value="1550000" 
                                                <?php if(!empty($registrant_data->getSubscriptionCost())):?>
                                                    <?php if($registrant_data->getSubscriptionCost() == '1550000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 1.550.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_scost" value="-999" 
                                                <?php if(!empty($registrant_data->getSubscriptionCost())):?>
                                                    <?php if(!($registrant_data->getSubscriptionCost() == '1350000'||
                                                            $registrant_data->getSubscriptionCost() == '1450000' ||
                                                            $registrant_data->getSubscriptionCost() == '1550000')):?>
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
                                    <input type="number" onkeyup="rupiah('scost')" name="other_scost" pattern="^([0-9]{1,8}$)" title="Maksimal 8 digit angka!"
                                           class="form-control" placeholder="Masukkan Jumlah Melebih 1,5 Juta Tanpa Titik" value="<?=$registrant_data->getSubscriptionCost();?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="help-block col-sm-offset-4 col-sm-4" id="scost_help"></p>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Wakaf Tanah :</label>
                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_lcost" value="500000" 
                                                <?php if(!empty($registrant_data->getLandDonation())):?>
                                                    <?php if($registrant_data->getLandDonation() == '500000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 500.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_lcost" value="1000000" 
                                                <?php if(!empty($registrant_data->getLandDonation())):?>
                                                    <?php if($registrant_data->getLandDonation() == '1000000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 1.000.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_lcost" value="1500000" 
                                                <?php if(!empty($registrant_data->getLandDonation())):?>
                                                    <?php if($registrant_data->getLandDonation() == '1500000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 1.500.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_lcost" value="2000000" 
                                                <?php if(!empty($registrant_data->getLandDonation())):?>
                                                    <?php if($registrant_data->getLandDonation() == '2000000'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Rp. 2.000.000,-
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="raw_lcost" value="-999" 
                                                <?php if(!empty($registrant_data->getLandDonation())):?>
                                                    <?php if(!($registrant_data->getLandDonation() == '500000'||
                                                            $registrant_data->getLandDonation() == '1000000' ||
                                                            $registrant_data->getLandDonation() == '2000000' ||
                                                            $registrant_data->getLandDonation() == '1500000')):?>
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
                                           class="form-control" onkeyup="rupiah('lcost')" placeholder="Masukkan Jumlah Melebih 2Juta Tanpa Titik" value="<?=$registrant_data->getLandDonation();?>">
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
                                                <?php if(!empty($registrant_data->getMainParent())):?>
                                                    <?php if($registrant_data->getMainParent() == 'father'):?>
                                                    selected="true" 
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Nama Ayah
                                        </option>
                                        <option value="mother" 
                                                <?php if(!empty($registrant_data->getMainParent())):?>
                                                    <?php if($registrant_data->getMainParent() == 'mother'):?>
                                                    selected="true" 
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Nama Ibu
                                        </option>
                                        <option value="guardian" 
                                                <?php if(!empty($registrant_data->getMainParent())):?>
                                                    <?php if($registrant_data->getMainParent() == 'guardian'):?>
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
                                        Ihsanul Fikri Mungkid pada Hari Raya Idul Adha tahun 2020/2021/2022.
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="q1" value="2020" <?php
                                            if (strpos($registrant_data->getQurban(), '2020') !== false) {
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
                                            if (strpos($registrant_data->getQurban(), '2021') !== false) {
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
                                            if (strpos($registrant_data->getQurban(), '2022') !== false) {
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
                                                <?php if(!empty($registrant_data->getRelToIPS())):?>
                                                    <?php if($registrant_data->getRelToIPS() ==='false'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Saya tidak bersedia
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rel_to_ips" value="true" 
                                                <?php if(!empty($registrant_data->getRelToIPS())):?>
                                                    <?php if($registrant_data->getRelToIPS() ==='true'):?>
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
                                                <?php if(!empty($registrant_data->getRelToRegular())):?>
                                                    <?php if($registrant_data->getRelToRegular() ==='false'):?>
                                                    checked
                                                    <?php endif;?>
                                                <?php endif;?>>
                                            Saya tidak bersedia
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rel_to_regular" value="true" 
                                                <?php if(!empty($registrant_data->getRelToRegular())):?>
                                                    <?php if($registrant_data->getRelToRegular() ==='true'):?>
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=base_url();?>admin/upload_foto/<?=$registrant_data->getId()?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>File berupa Foto Berwarna degan proporsi 4x3</label>
                        <input type="file" id="file" name="file" required="true">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".wrapper"); //Fields wrapper
        var point_acv       = $(".insert_acv"); //Fields wrapper
        var add_btn_acv  = $(".add_btn_acv"); //Add button ID

        var id_acv = 1;
        var x_acv = 1; //initlal text box count
        $(add_btn_acv).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_acv < max_fields){ //max input box allowed
                x_acv++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required="true" name="achievements[]" class="form-control" placeholder="Prestasi" value="">'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                    '<a class="remove_btn_acv btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_acv).before(inpt);
                id_acv++;
            }
        });

        $(wrapper).on("click",".remove_btn_acv", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_acv--;
        });
        
        //Hobby
        var point_hby       = $(".insert_hby"); //Fields wrapper
        var add_btn_hby  = $(".add_btn_hby"); //Add button ID

        var id_hby = 1;
        var x_hby = 1; //initlal text box count
        $(add_btn_hby).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_hby < max_fields){ //max input box allowed
                x_hby++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required="true" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="">'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                    '<a class="remove_btn_hby btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_hby).before(inpt);
                id_hby++;
            }
        });

        $(wrapper).on("click",".remove_btn_hby", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_hby--;
        });
        
        //Hospital Sheets
        var point_hs       = $(".insert_hs"); //Fields wrapper
        var add_btn_hs  = $(".add_btn_hs"); //Add button ID

        var id_hs = 1;
        var x_hs = 1; //initlal text box count
        $(add_btn_hs).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_hs < max_fields){ //max input box allowed
                x_hs++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required="true" name="hospital_sheets[]" class="form-control" placeholder="Masukkan Riwayat Penyakit" value="">'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                    '<a class="remove_btn_hs btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_hs).before(inpt);
                id_hs++;
            }
        });

        $(wrapper).on("click",".remove_btn_hs", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_hs--;
        });
        
        //Physical Abnormalities
        var point_pa       = $(".insert_pa"); //Fields wrapper
        var add_btn_pa  = $(".add_btn_pa"); //Add button ID

        var id_pa = 1;
        var x_pa = 1; //initlal text box count
        $(add_btn_pa).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_pa < max_fields){ //max input box allowed
                x_pa++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required="true" name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="">'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                    '<a class="remove_btn_pa btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_pa).before(inpt);
                id_pa++;
            }
        });

        $(wrapper).on("click",".remove_btn_pa", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_pa--;
        });
        
    });
</script>