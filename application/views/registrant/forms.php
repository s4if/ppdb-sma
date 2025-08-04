<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    strong.red {
        color: red;
        font-weight: bolder;
    }
    .foto-profil {
        resize: both;
        height: 100%;
        width: 100%;
        max-height: 200px;
        max-width: 150px;
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
    Pendaftar
    <small>Isi Formulir</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url() . '/' . $id;?>/beranda/">Beranda</a>
    </li>
    <li class="active">
        Formulir
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-2">
        <img class="foto-profil img-rounded" src="<?=$img_link;?>" alt="foto-profil">
    </div>
    <div class="col-md-8">
        <table>
        <tr>
            <td> Nomor Pendaftaran </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-id"> <?=$registrant->getRegId();?> </td>
        </tr>
        <tr>
            <td> Nama </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-name"> <?=$registrant->getName();?> </td>
        </tr>
        <tr>
            <td> Sekolah Asal </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-prevschool"> <?=$registrant->getPreviousSchool()?> </td>
        </tr>
        <tr>
            <td> Jenis Kelamin </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-gender"> <?=($registrant->getGender() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
        </tr>
        <tr>
            <td> NISN </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-nisn"> <?=$registrant->getNisn()?> </td>
        </tr>
        <tr>
            <td> Email / No. HP (Whatsapp)</td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-cp"> <?=$registrant->getCp()?> </td>
        </tr>
        <tr>
            <td> Program </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-program"> <?=$registrant->getProgram()?> </td>
        </tr>
        <tr>
            <td colspan="3">
                <a class="btn btn-sm btn-primary <?php echo ($registrant->getFinalized()) ? 'disabled' : ''; ?>" data-toggle="modal" data-target="#ModalImport">
                    <span class="glyphicon glyphicon-upload"></span>
                    Upload Foto
                </a>
                <a class="btn btn-sm btn-info <?php echo ($registrant->getFinalized()) ? 'disabled' : ''; ?>" data-toggle="modal" data-target="#editProfil" >
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit Profil
                </a>
                <a class="btn btn-sm btn-success" href="<?= base_url().$id.'/sertifikat'?>">
                    <span class="glyphicon glyphicon-upload"></span>
                    Upload Persyaratan Jalur Prestasi dan Jalur Hafalan Qur'an
                </a>
            </td>
        </tr>
    </table>
    </div>
    &nbsp;
    </div>
    <h2 class="text-center">Silakan Isi Data Pada Formulir Dibawah</h2>
    <h3 class="text-center">Semua Pengisian Data Diharapkan Mengacu Pada <strong>Akta Kelahiran</strong> dan <strong>Kartu Keluarga</strong></h3>
    <form class="form-horizontal wrapper form-data" role="form" method="post" action="<?=base_url();?>/pendaftar/do_edit_all/<?=$id?>">
        <hr/>
        <div class="form-group">
            <label class="col-sm-6 control-label"><strong class="red">Data Detail</strong></label>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tempat Lahir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required name="birth_place" class="form-control" placeholder="Tempat Lahir" value="<?=$reg_data->getBirthPlace();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tanggal Lahir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input class="form-control datepicker" type="text" required
                       data-date-format="dd-mm-yyyy" name="birth_date" value="<?php echo (is_null($reg_data->getBirthDate())) ? '' : $reg_data->getBirthDate()->format('d-m-Y'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nomor Induk Kependudukan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="number" required name="nik" class="form-control" placeholder="Masukkan NIK" value="<?=$reg_data->getNik();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nomor Kartu Keluarga<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="number" required name="nkk" class="form-control" placeholder="Masukkan Nomor KK" value="<?=$reg_data->getNkk();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nomor Akta Kelahiran<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required name="nak" class="form-control" placeholder="Masukkan Nomor Akta Kelahiran" value="<?=$reg_data->getNak();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label ">Golongan Darah<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <select class="form-control" name="blood_type">
                    <option value="A"
                            <?php if (property_exists($reg_data, 'bloodType')): ?>
                                <?php if ($reg_data->getBloodType() == 'A'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        A
                    </option>
                    <option value="B"
                            <?php if (property_exists($reg_data, 'bloodType')): ?>
                                <?php if ($reg_data->getBloodType() == 'B'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        B
                    </option>
                    <option value="O"
                            <?php if (property_exists($reg_data, 'bloodType')): ?>
                                <?php if ($reg_data->getBloodType() == 'O'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        O
                    </option>
                    <option value="AB"
                            <?php if (property_exists($reg_data, 'bloodType')): ?>
                                <?php if ($reg_data->getBloodType() == 'AB'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        AB
                    </option>
                    <option value="-"
                            <?php if (property_exists($reg_data, 'bloodType')): ?>
                                <?php if ($reg_data->getBloodType() == '-'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        - (Tidak Tahu)
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <div class="form-group">
            <h3 class="text-center">Alamat sesuai dengan yang tercantum dalam Kartu Keluarga (kecuali jika pindah domisili)</h3>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Dusun / Jalan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required name="street" class="form-control" placeholder="Masukkan Dusun/Jalan" value="<?=$reg_data->getStreet();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">RT - RW<strong class="red">*</strong> :</label>
            <div class="col-sm-2">
                <input type="number" required name="RT" class="form-control" placeholder="RT" value="<?=$reg_data->getRT();?>">
            </div>
            <div class="col-sm-1 text-center">
                -
            </div>
            <div class="col-sm-2">
                <input type="number" required name="RW" class="form-control" placeholder="RW" value="<?=$reg_data->getRW();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Desa / Kelurahan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required name="village" class="form-control" placeholder="Masukkan Desa/Kelurahan" value="<?=$reg_data->getVillage();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kecamatan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required name="district" class="form-control" placeholder="Masukkan Kecamatan" value="<?=$reg_data->getDistrict();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kota / Kabupaten<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required name="city" class="form-control" placeholder="Masukkan kota/kabupaten" value="<?=$reg_data->getCity();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Provinsi<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required name="province" class="form-control" placeholder="Masukkan Provinsi" value="<?=$reg_data->getProvince();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kode Pos<strong class="red">*</strong> :</label>
            <div class="col-sm-4">
                <input type="number" required name="postal_code" class="form-control" placeholder="Masukkan Kode Pos" value="<?=$reg_data->getPostalCode();?>">
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Anak ke</label>
            <div class="col-sm-3">
                <input type="number" required name="child_order" class="form-control" value="<?=$reg_data->getChildOrder();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">dari </label>
            <div class="col-sm-3">
                <input type="number" required name="siblings_count" class="form-control" value="<?=$reg_data->getSiblingsCount();?>">
            </div>
            <label class="col-sm-2 control-label">bersaudara.<strong class="red">*</strong></label>
        </div>
        <!-- TODO: Family Condition pake radio -->
        <div class="form-group">
            <label class="col-sm-4 control-label">Keluarga Pendaftar<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="lengkap"
                            <?php if (!empty($reg_data->getFamilyCondition())): ?>
                                <?php if ($reg_data->getFamilyCondition() === 'lengkap'): ?>
                                checked
                                <?php endif;?>
                            <?php else: ?>
                                checked
                            <?php endif;?>>
                        Lengkap
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="yatim"
                            <?php if (!empty($reg_data->getFamilyCondition())): ?>
                                <?php if ($reg_data->getFamilyCondition() === 'yatim'): ?>
                                checked
                                <?php endif;?>
                            <?php endif;?>>
                        Yatim
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="piatu"
                            <?php if (!empty($reg_data->getFamilyCondition())): ?>
                                <?php if ($reg_data->getFamilyCondition() === 'piatu'): ?>
                                checked
                                <?php endif;?>
                            <?php endif;?>>
                        Piatu
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="yatim piatu"
                            <?php if (!empty($reg_data->getFamilyCondition())): ?>
                                <?php if ($reg_data->getFamilyCondition() === 'yatim piatu'): ?>
                                checked
                                <?php endif;?>
                            <?php endif;?>>
                        Yatim Piatu
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tinggal Bersama<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="stay_with" value="orang tua"
                            <?php if (!empty($reg_data->getStayWith())): ?>
                                <?php if ($reg_data->getStayWith() === 'orang tua'): ?>
                                checked
                                <?php endif;?>
                            <?php else: ?>
                                checked
                            <?php endif;?>>
                        Orang Tua
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="stay_with" value="kakek nenek"
                            <?php if (!empty($reg_data->getStayWith())): ?>
                                <?php if ($reg_data->getStayWith() === 'kakek nenek'): ?>
                                checked
                                <?php endif;?>
                            <?php endif;?>>
                        Kakek Nenek
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="stay_with" value="kerabat"
                            <?php if (!empty($reg_data->getStayWith())): ?>
                                <?php if ($reg_data->getStayWith() === 'kerabat'): ?>
                                checked
                                <?php endif;?>
                            <?php endif;?>>
                        Kerabat
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="stay_with" value="lainnya"
                            <?php if (!empty($reg_data->getStayWith())): ?>
                                <?php if ($reg_data->getStayWith() === 'yatim piatu'): ?>
                                checked
                                <?php endif;?>
                            <?php endif;?>>
                        Lainnya
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <!-- TODO: Nationality pake radio -->
        <div class="form-group">
            <label class="col-sm-4 control-label ">Kewarganegaraan<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <select class="form-control" name="nationality">
                    <option value="WNI"
                        <?php if (!empty($reg_data->getNationality())): ?>
                            <?php if ($reg_data->getNationality() == 'WNI'): ?>
                                    selected
                            <?php endif;?>
                        <?php endif;?>>
                        WNI
                    </option>
                    <option value="WNA"
                        <?php if (!empty($reg_data->getNationality())): ?>
                            <?php if ($reg_data->getNationality() == 'WNA'): ?>
                                    selected
                            <?php endif;?>
                        <?php endif;?>>
                        WNA
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Agama<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required name="religion" id="religion" tabindex="1" class="form-control" placeholder="Agama" value="<?=$reg_data->getReligion();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tinggi<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="number" required name="height" id="birth_date" tabindex="1" class="form-control" placeholder="Tinggi Badan" value="<?=$reg_data->getHeight();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Berat<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="number" required name="weight" id="birth_date" tabindex="1" class="form-control" placeholder="Berat Badan" value="<?=$reg_data->getWeight();?>">
            </div>
        </div>
        <!-- TODO: Riwayat Penyakit -->
        <?php if ($reg_data->getHospitalSheetsCount() == 0): ?>
        <div class="form-group">
            <label class="col-sm-4 control-label">Riwayat Penyakit :</label>
            <div class="col-sm-4">
                <input type="text" name="hospital_sheets[]" class="form-control" placeholder="Riwayat Penyakit" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_hs btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php else:
	$count = 0;
	foreach ($reg_data->getHospitalSheets() as $h_s):
	?>
    <div class="form-group">
        <?php if ($count == 0): $count++;?>
        <label class="col-sm-4 control-label">Riwayat Penyakit :</label>
        <div class="col-sm-4">
            <input type="text" name="hospital_sheets[]" class="form-control" placeholder="Riwayat Penyakit" value="<?php echo $h_s; ?>">
        </div>
        <div class="col-sm-4">
            <a class="add_btn_hs btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <?php else: ?>
        <div class="col-sm-offset-4 col-sm-4">
            <input type="text" required name="hospital_sheets[]" class="form-control" placeholder="Riwayat Penyakit" value="<?php echo $h_s; ?>">
        </div>
        <div class="col-sm-4">
            <a class="remove_btn_hs btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
        <?php endif;?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        <!-- TODO: Kelainan Jasmani -->
        <?php if ($reg_data->getPhysicalAbnormalitiesCount() == 0): ?>
        <div class="form-group insert_hs">
            <label class="col-sm-4 control-label">Kelainan Jasmani :</label>
            <div class="col-sm-4">
                <input type="text" name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_pa btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php else:
	$count = 0;
	foreach ($reg_data->getPhysicalAbnormalities() as $p_a):
	?>
    <div class="form-group <?php if ($count == 0) {echo 'insert_hs';}?>">
        <?php if ($count == 0): $count++;?>
        <label class="col-sm-4 control-label">Kelainan Jasmani :</label>
        <div class="col-sm-4">
            <input type="text" name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="<?php echo $p_a; ?>">
        </div>
        <div class="col-sm-4">
            <a class="add_btn_pa btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <?php else: ?>
        <div class="col-sm-offset-4 col-sm-4">
            <input type="text" required name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="<?php echo $p_a; ?>">
        </div>
        <div class="col-sm-4">
            <a class="remove_btn_pa btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
        <?php endif;?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        <div class="form-group insert_pa"></div> <!-- pengganti yang nonaktif -->
        <!-- <?php if ($reg_data->getAchievementsCount() == 0): ?>
        <div class="form-group insert_pa">
            <label class="col-sm-4 control-label"> Prestasi yang Diraih :</label>
            <div class="col-sm-4">
                <input type="text" name="achievements[]" class="form-control" placeholder="Prestasi" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_acv btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <div class="form-group">
            <p class="help-block col-sm-offset-4 col-sm-4">* Prestasi yang dihitung adalah prestasi yang bertemakan OSN, Bahasa, dan MTQ dengan
                tingkat minimal kabupaten/kota</p>
        </div>
        <?php else:
	$count = 0;
	foreach ($reg_data->getAchievements() as $acv):
	?>
        <div class="form-group <?php if ($count == 0) {echo 'insert_pa';}?>">
            <?php if ($count == 0): $count++;?>
            <label class="col-sm-4 control-label">Prestasi yang Diraih :</label>
            <div class="col-sm-4">
                <input type="text" name="achievements[]" class="form-control" placeholder="Prestasi" value="<?php echo $acv; ?>">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_acv btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
            <?php else: ?>
            <div class="col-sm-offset-4 col-sm-4">
                <input type="text" required name="achievements[]" class="form-control" placeholder="Prestasi" value="<?php echo $acv; ?>">
            </div>
            <div class="col-sm-4">
                <a class="remove_btn_acv btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <?php endif;?>
        </div>
        <?php endforeach;?>
        <div class="form-group">
            <p class="help-block col-sm-offset-4 col-sm-4">* Prestasi yang dihitung adalah prestasi yang bertemakan OSN, Bahasa, dan MTQ dengan
                tingkat minimal kabupaten/kota</p>
        </div>
        <?php endif;?> -->
        <!-- TODO: Hobi -->
        <?php if ($reg_data->getHobbiesCount() == 0): //Keep If & Else div sinkron!!!?>
        <div class="form-group insert_acv">
            <label class="col-sm-4 control-label">Hobi :</label>
            <div class="col-sm-4">
                <input type="text" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_hby btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php else: // ini else-nya
	$count = 0;
	foreach ($reg_data->getHobbies() as $hobby):
	?>
    <div class="form-group <?php if ($count == 0) {echo 'insert_acv';}?>">
        <?php if ($count == 0): $count++;?>
        <label class="col-sm-4 control-label">Hobi :</label>
        <div class="col-sm-4">
            <input type="text" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="<?php echo $hobby; ?>">
        </div>
        <div class="col-sm-4">
            <a class="add_btn_hby btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <?php else: ?>
        <div class="col-sm-offset-4 col-sm-4">
            <input type="text" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="<?php echo $hobby; ?>">
        </div>
        <div class="col-sm-4">
            <a class="remove_btn_hby btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
        <?php endif;?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        <hr class="insert_hby"/>
        <?=$parent_form;?>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
                <button type="button" class="btn btn-primary btn-save" onclick="save()"><span class="glyphicon glyphicon-floppy-save">&nbsp;Simpan</button>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="editProfil" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Pendaftar</h4>
            </div>
            <div class="modal-body">
    <form class="form-horizontal form-profil" role="form" method="post" action="#">
        <div class="form-group">
            <label class="col-sm-3 control-label">Nama :</label>
            <div class="col-sm-8">
                <input type="text" required name="name" id="name" tabindex="1" class="form-control" placeholder="Nama" value="<?=$registrant->getName();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sekolah Asal :</label>
            <div class="col-sm-8">
                <input type="text" required name="prev_school" id="prev_school" tabindex="1" class="form-control" placeholder="Sekolah Asal" value="<?=$registrant->getPreviousSchool();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">NISN :</label>
            <div class="col-sm-8">
                <input type="text" name="nisn" id="nisn" tabindex="1" class="form-control" placeholder="NISN" value="<?=$registrant->getNisn();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Email/No.HP (Whatsapp) :</label>
            <div class="col-sm-8">
                <input type="text" name="cp" id="cp" tabindex="1" class="form-control" placeholder="Email" value="<?=$registrant->getCp();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label ">Program :</label>
            <div class="col-sm-8">
                <select class="form-control" name="program">
                    <option value="Reguler"
                            <?php if (property_exists($registrant, 'program')): ?>
                                <?php if ($registrant->getProgram() == 'Reguler'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        Reguler
                    </option>
                    <option value="Tahfidz"
                            <?php if (property_exists($registrant, 'program')): ?>
                                <?php if ($registrant->getProgram() == 'Tahfidz'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        Tahfidz
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label ">Jalur Pendaftaran :</label>
            <div class="col-sm-8">
                <select class="form-control" name="selection_path">
                    <option value="Jalur Reguler"
                            <?php if (property_exists($registrant, 'selectionPath')): ?>
                                <?php if ($registrant->getSelectionPath() == 'Jalur Tes Tulis'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        Jalur Tes Tulis
                    </option>
                    <option value="Jalur Tahfidz"
                            <?php if (property_exists($registrant, 'selectionPath')): ?>
                                <?php if ($registrant->getSelectionPath() == "Jalur Hafalan Qur'an"): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        Jalur Hafalan Qur'an
                    </option>
                    <option value="Jalur Rapor"
                            <?php if (property_exists($registrant, 'selectionPath')): ?>
                                <?php if ($registrant->getSelectionPath() == 'Jalur Rapor'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        Jalur Rapor
                    </option>
                    <option value="Jalur Prestasi"
                            <?php if (property_exists($registrant, 'selectionPath')): ?>
                                <?php if ($registrant->getSelectionPath() == 'Jalur Prestasi'): ?>
                                        selected
                                <?php endif;?>
                            <?php endif;?>>
                        Jalur Prestasi 
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
                <button type="button" id="btn-ok" onclick="aksiOk()" class="btn btn-primary">OK</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-alert-failed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifikasi</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-center">
                    <span class="glyphicon glyphicon-remove-sign"></span>
                    Maaf, data gagal disimpan, mohon cek kembali data yang anda masukkan!
                </h4>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <div class="col-md-2 col-md-offset-5">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-alert-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifikasi</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-center">
                    <span class="glyphicon glyphicon-ok-sign"></span>
                    Data telah berhasil disimpan. <br/>
                    Silahkan melanjutkan untuk mengisi data nilai dengan menekan tombol <b>lanjut</b>.<br />
                    Atau mengisi data wali (jika perlu) dengan menekan tombol <b>Isi Wali</b>.
                </h4>
            </div>
            <div class="modal-footer" >
                <div class="center-block">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" href="<?=base_url() . $id . '/surat'?>">
                                Lanjut
                            </a>
                            <a class="btn btn-warning" href="<?=base_url() . $id . '/wali'?>">
                                Isi Wali
                            </a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
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
                <form role="form" method="post" action="<?=base_url();?>pendaftar/upload_foto/<?=$registrant->getId()?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Silahkan upload fil foto resmi dengan proporsi 4x3</label>
                        <input type="file" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Nanti</button>
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
                    '<input type="text" required name="achievements[]" class="form-control" placeholder="Prestasi" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
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
                    '<input type="text" required name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
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
                    '<input type="text" required name="hospital_sheets[]" class="form-control" placeholder="Masukkan Riwayat Penyakit" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
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
                    '<input type="text" required name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
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
function save()
{
    $('.form-group').removeClass('has-error'); // clear error class
    $('.btn-save').text('Menyimpan...'); //change button text
    $('.btn-save').attr('disabled',true); //set button disable
    var url;

    url = '<?php echo base_url() . 'pendaftar/ajax_edit_all/' . $id; ?>';

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('.form-data').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#alert-div').empty();
                $('#alert-div').append('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Data Berhasil Disimpan</p>'+
                    '</div>'
                );
                $('.btn-next').removeClass('hidden');
                btnNext = $('.btn-next');
                $('.insert-lanjut').after(btnNext[0]);
                $('#modal-alert-success').modal('toggle');
            }
            else
            {
                $('#alert-div').empty();
                $('#alert-div').append('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Maaf Penyimpanan Data Gagal</p>'+
                    '</div>');
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
//                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
                $('#modal-alert-failed').modal('toggle');
            }
            $('.btn-save').text('Simpan'); //change button text
            $('.btn-save').prepend('<span class="glyphicon glyphicon-floppy-save">&nbsp;');
            $('.btn-save').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Maaf, Terjadi kesalahan! Silahkan cek kembali isian anda!');
            $('.btn-save').text('Simpan'); //change button text
            $('.btn-save').prepend('<span class="glyphicon glyphicon-floppy-save">&nbsp;');
            $('.btn-save').attr('disabled',false); //set button enable

        }
    });
}
function aksiOk()
{
    $('#btn-ok').text('saving...'); //change button text
    $('#btn-ok').attr('disabled',true); //set button disable
    var url;

    url = '<?php echo base_url() . 'pendaftar/ajax_edit_profil/' . $id; ?>';

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('.form-profil').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#alert-div').append('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Edit Data Profil Berhasil</p>'+
                    '</div>'
                );
                $('#reg-id').text(data.profile.id);
                $('#reg-name').text(data.profile.name);
                $('#uname').text(data.profile.name);
                $('#reg-gender').text(data.profile.gender);
                $('#reg-prevschool').text(data.profile.prev_school);
                $('#reg-nisn').text(data.profile.nisn);
                $('#reg-cp').text(data.profile.cp);
                $('#reg-program').text(data.profile.program);
                $("#editProfil").modal('hide');

            }
            else
            {
                $('#alert-div').append('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Maaf Penyimpanan Data Gagal</p>'+
                    '</div>');
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
                $("#editProfil").modal('hide');
            }
            $('#btn-ok').text('save'); //change button text
            $('#btn-ok').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btn-ok').text('save'); //change button text
            $('#btn-ok').attr('disabled',false); //set button enable

        }
    });
}

function isi_alamat(tipe){
    $('input[name='+tipe+'_street]').val($('input[name=street]').val());
    $('input[name='+tipe+'_RT]').val($('input[name=RT]').val());
    $('input[name='+tipe+'_RW]').val($('input[name=RW]').val());
    $('input[name='+tipe+'_village]').val($('input[name=village]').val());
    $('input[name='+tipe+'_district]').val($('input[name=district]').val());
    $('input[name='+tipe+'_city]').val($('input[name=city]').val());
    $('input[name='+tipe+'_province]').val($('input[name=province]').val());
    $('input[name='+tipe+'_postal_code]').val($('input[name=postal_code]').val());
}

$(document).ready(function () {
<?php
$default = base_url() . 'assets/images/default.png';
if ($default == $img_link) {?>
    $('#ModalImport').modal('show');
<?php }?>
});

$("input[name=father_status]").on('change', function () {
    if ($("input[name=father_status]:checked").val()=='masih hidup') {
        $('#father_job_mark').html('Pekerjaan<strong class="red">*</strong> :');
        $('input[name=father_job]').attr('required', 'true');
        $('#father_income_mark').html('Penghasilan<strong class="red">*</strong> :');
        $('input[name=father_income]').attr('required', 'true');
        $('#father_burden_mark').html('Jumlah Tanggungan<strong class="red">*</strong> :');
        $('input[name=father_burden_count]').attr('required', 'true');
    } else {
        $('#father_job_mark').html('Pekerjaan :');
        $('input[name=father_job]').removeAttr('required');
        $('#father_income_mark').html('Penghasilan :');
        $('input[name=father_income]').removeAttr('required');
        $('#father_burden_mark').html('Jumlah Tanggungan :');
        $('input[name=father_burden_count]').removeAttr('required');
    }
});

function rupiah(key) {
    var angka = $('input[name='+key+'_income]').val();
    if (isNaN(angka)) {
        $('#'+key+'_income_help').html('error');
    } else {
        str_angka = 'Tersimpan sebagai: '+format_rupiah(angka);
        $('#'+key+'_income_help').html(str_angka);
    }
}
</script>
