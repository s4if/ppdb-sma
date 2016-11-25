        <div class="form-group">
            <label class="col-sm-6 control-label"><strong class="red">Data <?=  ucfirst($key);?></strong></label>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nama<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="<?= $type.'_';?>name" class="form-control" placeholder="Masukkan Nama" value="<?=$parent_data->getName();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Status<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>status" value="masih hidup" 
                            <?php if(!empty($parent_data->getStatus())):?>
                                <?php if($parent_data->getStatus() ==='masih hidup'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Masih Hidup
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>status" value="almarhum" 
                            <?php if(!empty($parent_data->getStatus())):?>
                                <?php if($parent_data->getStatus() ==='almarhum'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Almarhum
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>status" value="cerai" 
                            <?php if(!empty($parent_data->getStatus())):?>
                                <?php if($parent_data->getStatus() ==='cerai'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Cerai
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tempat Lahir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="<?= $type.'_';?>birth_place" class="form-control" placeholder="Tempat Lahir" value="<?=$parent_data->getBirthPlace();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tanggal Lahir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input class="form-control datepicker" type="text" required="true"
                       data-date-format="dd-mm-yyyy" name="<?= $type.'_';?>birth_date" value="<?php echo (is_null($parent_data->getBirthDate()))?'':$parent_data->getBirthDate()->format('d-m-Y');?>">
            </div>
        </div>
        <!-- Hubungan Darah -->
        <div class="form-group">
            <label class="col-sm-4 control-label">Hubungan dengan Pendaftar<strong class="red">*</strong> :</label>
            <?php if($key == 'ayah' || $key == 'ibu') :?>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>relation" value="anak kandung" 
                            <?php if(!empty($parent_data->getRelation())):?>
                                <?php if($parent_data->getRelation() ==='anak kandung'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Anak Kandung
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>relation" value="anak tiri" 
                            <?php if(!empty($parent_data->getRelation())):?>
                                <?php if($parent_data->getRelation() ==='anak tiri'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Anak Tiri
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>relation" value="anak angkat" 
                            <?php if(!empty($parent_data->getRelation())):?>
                                <?php if($parent_data->getRelation() ==='anak angkat'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Anak Angkat
                    </label>
                </div>
            </div>
            <?php else :?>
            <div class="col-sm-6">
                <input type="text" name="<?= $type.'_';?>relation" class="form-control" placeholder="Masukkan Hubungan dengan pendaftar" value="<?=$parent_data->getRelation();?>">
            </div>
            <?php endif;?>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label ">Kewarganegaraan<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <select class="form-control" name="<?= $type.'_';?>nationality">
                    <option value="WNI"  
                        <?php if(!empty($parent_data->getNationality())):?>
                            <?php if($parent_data->getNationality()=='WNI'): ?>
                                    selected="true"
                            <?php endif;?>
                        <?php endif;?>>
                        WNI
                    </option>
                    <option value="WNA"  
                        <?php if(!empty($parent_data->getNationality())):?>
                            <?php if($parent_data->getNationality()=='WNA'): ?>
                                    selected="true"
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
                <input type="text" required="true" name="<?= $type.'_';?>religion" id="religion" tabindex="1" class="form-control" placeholder="Agama" value="<?=$parent_data->getReligion();?>">
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Dusun / Jalan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="<?= $type.'_';?>street" class="form-control" placeholder="Masukkan Dusun/Jalan" value="<?=$parent_data->getStreet();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">RT - RW<strong class="red">*</strong> :</label>
            <div class="col-sm-2">
                <input type="text" required="true" name="<?= $type.'_';?>RT" class="form-control" placeholder="RT" value="<?=$parent_data->getRT();?>">
            </div>
            <div class="col-sm-1 text-center">
                -
            </div>
            <div class="col-sm-2">
                <input type="text" required="true" name="<?= $type.'_';?>RW" class="form-control" placeholder="RW" value="<?=$parent_data->getRW();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Desa / Kelurahan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="<?= $type.'_';?>village" class="form-control" placeholder="Masukkan Desa/Kelurahan" value="<?=$parent_data->getVillage();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kecamatan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="<?= $type.'_';?>district" class="form-control" placeholder="Masukkan Kecamatan" value="<?=$parent_data->getDistrict();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kota / Kabupaten<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="<?= $type.'_';?>city" class="form-control" placeholder="Masukkan kota/kabupaten" value="<?=$parent_data->getCity();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Provinsi<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="<?= $type.'_';?>province" class="form-control" placeholder="Masukkan Provinsi" value="<?=$parent_data->getProvince();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kode Pos<strong class="red">*</strong> :</label>
            <div class="col-sm-4">
                <input type="number" required="true" name="<?= $type.'_';?>postal_code" class="form-control" placeholder="Masukkan Kode Pos" value="<?=$parent_data->getPostalCode();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">No. Telp<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="<?= $type.'_';?>contact" class="form-control" placeholder="Masukkan Nomor Telepon" value="<?=$parent_data->getContact();?>">
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <!-- Tingkat Pendidikan -->
        <div class="form-group">
            <label class="col-sm-4 control-label">Pendidikan Terakhir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="Tidak Lulus SD" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='Tidak Lulus SD'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Tidak Lulus SD
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="SD" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='SD'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        SD
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="SMP" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='SMP'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        SMP
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="SMA" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='SMA'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        SMA/SMK
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="Diploma" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='Diploma'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Diploma
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="S1" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='S1'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        S1
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="S2" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='S2'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        S2
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="S3" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='S3'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        S3
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-4 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="<?= $type.'_';?>education_level" value="Lainnya" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='Lainnya'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Lainnya
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Pekerjaan<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" name="<?= $type.'_';?>job" class="form-control" placeholder="Masukkan Pekerjaan" value="<?=$parent_data->getJob();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Jabatan :</label>
            <div class="col-sm-6">
                <input type="text" name="<?= $type.'_';?>position" class="form-control" placeholder="Masukkan Jabatan" value="<?=$parent_data->getPosition();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nama Instansi :</label>
            <div class="col-sm-6">
                <input type="text" name="<?= $type.'_';?>company" class="form-control" placeholder="Masukkan Tempat Kerja" value="<?=$parent_data->getCompany();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Penghasilan (Rp.)<?=($key == 'ayah')?'<strong class="red">*</strong>':'';?> :</label>
            <div class="col-sm-6">
                <input type="number" name="<?= $type.'_';?>income" <?=($key == 'ayah')?'required="true"':'';?>
                       class="form-control" placeholder="Masukkan Penghasilan Tanpa Titik" value="<?=$parent_data->getIncome();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Jumlah Tanggungan<?php echo ($key == 'father')?'<strong class="red">*</strong>':'';?> :</label>
            <div class="col-sm-6">
                <input type="number" name="<?= $type.'_';?>burden_count" <?php echo ($key == 'father')?'required="true"':'';?> class="form-control" placeholder="Masukkan Jumlah Tanggungan" value="<?=$parent_data->getBurdenCount();?>">
            </div>
        </div>
        <hr/>