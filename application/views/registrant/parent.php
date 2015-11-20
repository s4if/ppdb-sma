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
    <small>Data Orang Tua/Wali</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'/'.$id;?>/beranda/">Beranda</a>
    </li>
    <li class="active">
        Data <?=$trans;?>
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
    <form class="form-horizontal wrapper" role="form" method="post" action="<?=base_url();?>pendaftar/do_edit_parent/<?=$id?>/<?=$nav_pos?>">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save">&nbsp;Simpan</button>
                <a class="btn btn-success" href="<?=base_url().$id.'/'.$next;?>"><span class="glyphicon glyphicon-chevron-right">&nbsp;Lanjut</a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Status :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="masih hidup" 
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
                        <input type="radio" name="status" value="almarhum" 
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
                        <input type="radio" name="relation" value="ceraj" 
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
            <label class="col-sm-2 control-label">Nama :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="name" class="form-control" placeholder="Masukkan Nama" value="<?=$parent_data->getName();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tanggal Lahir :</label>
            <div class="col-sm-6">
                <input class="form-control datepicker" type="text" required="true"
                       data-date-format="dd-mm-yyyy" name="birth_date" value="<?php echo (is_null($parent_data->getBirthDate()))?'':$parent_data->getBirthDate()->format('d-m-Y');?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tempat Lahir :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="birth_place" class="form-control" placeholder="Tempat Lahir" value="<?=$parent_data->getBirthPlace();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Alamat :</label>
            <div class="col-sm-6">
                <textarea class="form-control col-sm-10" required="true" rows="3" name="address"><?=$parent_data->getAddress();?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">No. Telp :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="contact" class="form-control" placeholder="Masukkan Nomor Telepon" value="<?=$parent_data->getContact();?>">
            </div>
        </div>
        <!-- Hubungan Darah -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Hubungan :</label>
            <?php if($nav_pos == 'father' || $nav_pos == 'mother') :?>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="relation" value="anak kandung" 
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
                        <input type="radio" name="relation" value="anak tiri" 
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
                        <input type="radio" name="relation" value="anak angkat" 
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
                <input type="text" name="relation" class="form-control" placeholder="Masukkan Hubungan dengan pendaftar" value="<?=$parent_data->getRelation();?>">
            </div>
            <?php endif;?>
        </div>
        <!-- TODO: Nationality pake radio -->
        <div class="form-group">
            <label class="col-sm-2 control-label ">Kewarganegaraan :</label>
            <div class="col-sm-6">
                <select class="form-control" name="nationality">
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
            <label class="col-sm-2 control-label">Agama :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="religion" id="religion" tabindex="1" class="form-control" placeholder="Agama" value="<?=$parent_data->getReligion();?>">
            </div>
        </div>
        <!-- Tingkat Pendidikan -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Pendidikan Terakhir :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="Tidak Lulus SD" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='Tidak Lulus SD'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Tidak Lulus SD
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="SD" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='SD'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        SD
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="SMP" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='SMP'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        SMP
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="SMA" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='SMA'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        SMA/SMK
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="Diploma" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='Diploma'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Diploma
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="S1" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='S1'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        S1
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="S2" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='S2'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        S2
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="S3" 
                            <?php if(!empty($parent_data->getEducationLevel())):?>
                                <?php if($parent_data->getEducationLevel() ==='S3'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        S3
                    </label>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="education_level" value="Lainnya" 
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
            <label class="col-sm-2 control-label">Pekerjaan :</label>
            <div class="col-sm-6">
                <input type="text" name="job" class="form-control" placeholder="Masukkan Pekerjaan" value="<?=$parent_data->getJob();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Jabatan :</label>
            <div class="col-sm-6">
                <input type="text" name="position" class="form-control" placeholder="Masukkan Jabatan" value="<?=$parent_data->getPosition();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama Instansi :</label>
            <div class="col-sm-6">
                <input type="text" name="company" class="form-control" placeholder="Masukkan Tempat Kerja" value="<?=$parent_data->getCompany();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Penghasilan (Rp.) :</label>
            <div class="col-sm-6">
                <input type="number" name="income" required="true" class="form-control" placeholder="Masukkan Penghasilan" value="<?=$parent_data->getIncome();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Jumlah Tanggungan :</label>
            <div class="col-sm-6">
                <input type="text" name="burden_count" <?php echo ($nav_pos == 'father')?'required="true"':'';?> class="form-control" placeholder="Masukkan Jumlah Tanggungan" value="<?=$parent_data->getBurdenCount();?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save">&nbsp;Simpan</button>
                <a class="btn btn-success" href="<?=base_url().$id.'/'.$next;?>"><span class="glyphicon glyphicon-chevron-right">&nbsp;Lanjut</a>
            </div>
        </div>
    </form>
    </div>
</div>