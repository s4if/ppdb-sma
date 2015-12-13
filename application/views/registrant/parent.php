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
<style>
    strong.red {
        color: red;
        font-weight: bolder;
    }
</style>
<h1 class="page-header">
    Pendaftar
    <small>Data <?=$trans;?></small>
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
    <form class="form-horizontal wrapper form-data" role="form" method="post" action="#">
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
                <a class="btn btn-warning" href="<?=base_url().$id.'/'.$prev;?>"><span class="glyphicon glyphicon-chevron-left">&nbsp;Kembali</a>
                <button type="button" class="btn btn-primary btn-save" onclick="save()"><span class="glyphicon glyphicon-floppy-save">&nbsp;Simpan</button>
                <?php if($nav_pos == 'mother') :?>
                    <a class="btn btn-info <?php echo (is_null($parent_data->getBirthDate()))?'hidden':'';?>" href="<?=base_url().$id.'/data/guardian';?>"><span class="glyphicon glyphicon-user">&nbsp;Wali</a>
                <?php endif;?>
                <a class="btn btn-success <?php echo (is_null($parent_data->getBirthDate()))?'hidden':'';?>" href="<?=base_url().$id.'/'.$next;?>">Lanjut&nbsp;<span class="glyphicon glyphicon-chevron-right"></a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nama<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="name" class="form-control" placeholder="Masukkan Nama" value="<?=$parent_data->getName();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Status<strong class="red">*</strong> :</label>
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
                        <input type="radio" name="status" value="cerai" 
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
                <input type="text" required="true" name="birth_place" class="form-control" placeholder="Tempat Lahir" value="<?=$parent_data->getBirthPlace();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tanggal Lahir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input class="form-control datepicker" type="text" required="true"
                       data-date-format="dd-mm-yyyy" name="birth_date" value="<?php echo (is_null($parent_data->getBirthDate()))?'':$parent_data->getBirthDate()->format('d-m-Y');?>">
            </div>
        </div>
        <!-- Hubungan Darah -->
        <div class="form-group">
            <label class="col-sm-4 control-label">Hubungan dengan Pendaftar<strong class="red">*</strong> :</label>
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
            <label class="col-sm-4 control-label ">Kewarganegaraan<strong class="red">*</strong> :</label>
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
            <label class="col-sm-4 control-label">Agama<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="religion" id="religion" tabindex="1" class="form-control" placeholder="Agama" value="<?=$parent_data->getReligion();?>">
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Dusun / Jalan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="street" class="form-control" placeholder="Masukkan Dusun/Jalan" value="<?=$parent_data->getStreet();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">RT - RW<strong class="red">*</strong> :</label>
            <div class="col-sm-2">
                <input type="text" required="true" name="RT" class="form-control" placeholder="RT" value="<?=$parent_data->getRT();?>">
            </div>
            <div class="col-sm-1 text-center">
                -
            </div>
            <div class="col-sm-2">
                <input type="text" required="true" name="RW" class="form-control" placeholder="RW" value="<?=$parent_data->getRW();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Desa / Kelurahan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="village" class="form-control" placeholder="Masukkan Desa/Kelurahan" value="<?=$parent_data->getVillage();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kecamatan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="district" class="form-control" placeholder="Masukkan Kecamatan" value="<?=$parent_data->getDistrict();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kota / Kabupaten<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="city" class="form-control" placeholder="Masukkan kota/kabupaten" value="<?=$parent_data->getCity();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Provinsi<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="province" class="form-control" placeholder="Masukkan Provinsi" value="<?=$parent_data->getProvince();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kode Pos<strong class="red">*</strong> :</label>
            <div class="col-sm-4">
                <input type="text" required="true" name="postal_code" class="form-control" placeholder="Masukkan Kode Pos" value="<?=$parent_data->getPostalCode();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">No. Telp<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="contact" class="form-control" placeholder="Masukkan Nomor Telepon" value="<?=$parent_data->getContact();?>">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <div class="col-sm-offset-4 col-sm-6">
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
            <label class="col-sm-4 control-label">Pekerjaan<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" name="job" class="form-control" placeholder="Masukkan Pekerjaan" value="<?=$parent_data->getJob();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Jabatan :</label>
            <div class="col-sm-6">
                <input type="text" name="position" class="form-control" placeholder="Masukkan Jabatan" value="<?=$parent_data->getPosition();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nama Instansi :</label>
            <div class="col-sm-6">
                <input type="text" name="company" class="form-control" placeholder="Masukkan Tempat Kerja" value="<?=$parent_data->getCompany();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Penghasilan (Rp.)<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="number" name="income" required="true" class="form-control" placeholder="Masukkan Penghasilan Tanpa Titik" value="<?=$parent_data->getIncome();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Jumlah Tanggungan<?php echo ($nav_pos == 'father')?'<strong class="red">*</strong>':'';?> :</label>
            <div class="col-sm-6">
                <input type="number" name="burden_count" <?php echo ($nav_pos == 'father')?'required="true"':'';?> class="form-control" placeholder="Masukkan Jumlah Tanggungan" value="<?=$parent_data->getBurdenCount();?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
                <a class="btn btn-warning" href="<?=base_url().$id.'/'.$prev;?>"><span class="glyphicon glyphicon-chevron-left">&nbsp;Kembali</a>
                <button type="button" class="btn btn-primary btn-save" onclick="save()"><span class="glyphicon glyphicon-floppy-save">&nbsp;Simpan</button>
                <?php if($nav_pos == 'mother') :?>
                    <a class="btn btn-info <?php echo (is_null($parent_data->getBirthDate()))?'hidden':'';?>" href="<?=base_url().$id.'/data/guardian';?>"><span class="glyphicon glyphicon-user">&nbsp;Wali</a>
                <?php endif;?>
                <a class="btn btn-success <?php echo (is_null($parent_data->getBirthDate()))?'hidden':'';?>" href="<?=base_url().$id.'/'.$next;?>">Lanjut&nbsp;<span class="glyphicon glyphicon-chevron-right"></a>
            </div>
        </div>
    </form>
    </div>
</div>
<script type="text/javascript">
function save()
{
    $('.form-group').removeClass('has-error'); // clear error class
    $('.btn-save').text('Menyimpan...'); //change button text
    $('.btn-save').attr('disabled',true); //set button disable 
    var url;

    url = '<?php echo base_url().'pendaftar/ajax_edit_parent/'.$id.'/'.$nav_pos;?>';

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
                $('#alert-div').append('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Data Berhasil Disimpan</p>'+
                    '</div>'
                );
                $('#btn-next').removeClass('hidden');
                
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
                }
            }
            $('.btn-save').text('Simpan'); //change button text
            $('.btn-save').prepend('<span class="glyphicon glyphicon-floppy-save">&nbsp;');
            $('.btn-save').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('.btn-save').text('Simpan'); //change button text
            $('.btn-save').prepend('<span class="glyphicon glyphicon-floppy-save">&nbsp;');
            $('.btn-save').attr('disabled',false); //set button enable 

        }
    });
}
</script>