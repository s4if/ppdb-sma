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
    <small>Data Diri</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'/'.$id;?>/beranda/">Beranda</a>
    </li>
    <li class="active">
        Data Diri
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
    <form class="form-horizontal wrapper" role="form" method="post" action="<?=base_url();?>/pendaftar/do_edit_detail/<?=$id?>">
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save">&nbsp;Simpan</button>
                <a class="btn btn-success" href="<?=base_url().$id;?>/data/father/"><span class="glyphicon glyphicon-chevron-right">&nbsp;Lanjut</a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tempat Lahir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="birth_place" class="form-control" placeholder="Tempat Lahir" value="<?=$reg_data->getBirthPlace();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tanggal Lahir<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input class="form-control datepicker" type="text" required="true"
                       data-date-format="dd-mm-yyyy" name="birth_date" value="<?php echo (is_null($reg_data->getBirthDate()))?'':$reg_data->getBirthDate()->format('d-m-Y');?>">
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Dusun / Jalan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="street" class="form-control" placeholder="Masukkan Dusun/Jalan" value="<?=$reg_data->getStreet();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">RT - RW<strong class="red">*</strong> :</label>
            <div class="col-sm-2">
                <input type="text" required="true" name="RT" class="form-control" placeholder="RT" value="<?=$reg_data->getRT();?>">
            </div>
            <div class="col-sm-1 text-center">
                -
            </div>
            <div class="col-sm-2">
                <input type="text" required="true" name="RW" class="form-control" placeholder="RW" value="<?=$reg_data->getRW();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Desa / Kelurahan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="village" class="form-control" placeholder="Masukkan Desa/Kelurahan" value="<?=$reg_data->getVillage();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kecamatan<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="district" class="form-control" placeholder="Masukkan Kecamatan" value="<?=$reg_data->getDistrict();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kota / Kabupaten<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="city" class="form-control" placeholder="Masukkan kota/kabupaten" value="<?=$reg_data->getCity();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Provinsi<strong class="red">*</strong> :</label>
            <div class="col-sm-5">
                <input type="text" required="true" name="province" class="form-control" placeholder="Masukkan Provinsi" value="<?=$reg_data->getProvince();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kode Pos<strong class="red">*</strong> :</label>
            <div class="col-sm-4">
                <input type="text" required="true" name="postal_code" class="form-control" placeholder="Masukkan Kode Pos" value="<?=$reg_data->getPostalCode();?>">
            </div>
        </div>
        <div class="form-group">
            <hr/>
        </div>
        <!-- TODO: Family Condition pake radio -->
        <div class="form-group">
            <label class="col-sm-4 control-label">Keluarga Pendaftar<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="lengkap" 
                            <?php if(!empty($reg_data->getFamilyCondition())):?>
                                <?php if($reg_data->getFamilyCondition() ==='lengkap'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Lengkap
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="yatim" 
                            <?php if(!empty($reg_data->getFamilyCondition())):?>
                                <?php if($reg_data->getFamilyCondition() ==='yatim'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Yatim
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="piatu" 
                            <?php if(!empty($reg_data->getFamilyCondition())):?>
                                <?php if($reg_data->getFamilyCondition() ==='piatu'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Piatu
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="family_condition" value="yatim piatu" 
                            <?php if(!empty($reg_data->getFamilyCondition())):?>
                                <?php if($reg_data->getFamilyCondition() ==='yatim piatu'):?>
                                checked="true"
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
                            <?php if(!empty($reg_data->getStayWith())):?>
                                <?php if($reg_data->getStayWith() ==='orang tua'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Orang Tua
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="stay_with" value="kakek nenek" 
                            <?php if(!empty($reg_data->getStayWith())):?>
                                <?php if($reg_data->getStayWith() ==='kakek nenek'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Kakek Nenek
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="stay_with" value="kerabat" 
                            <?php if(!empty($reg_data->getStayWith())):?>
                                <?php if($reg_data->getStayWith() ==='kerabat'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Kerabat
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="stay_with" value="lainnya" 
                            <?php if(!empty($reg_data->getStayWith())):?>
                                <?php if($reg_data->getStayWith() ==='yatim piatu'):?>
                                checked="true"
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
                        <?php if(!empty($reg_data->getNationality())):?>
                            <?php if($reg_data->getNationality()=='WNI'): ?>
                                    selected="true"
                            <?php endif;?>
                        <?php endif;?>>
                        WNI
                    </option>
                    <option value="WNA"  
                        <?php if(!empty($reg_data->getNationality())):?>
                            <?php if($reg_data->getNationality()=='WNA'): ?>
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
                <input type="text" required="true" name="religion" id="religion" tabindex="1" class="form-control" placeholder="Agama" value="<?=$reg_data->getReligion();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Tinggi<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="number" required="true" name="height" id="birth_date" tabindex="1" class="form-control" placeholder="Tinggi Badan" value="<?=$reg_data->getHeight();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Berat<strong class="red">*</strong> :</label>
            <div class="col-sm-6">
                <input type="number" required="true" name="weight" id="birth_date" tabindex="1" class="form-control" placeholder="Berat Badan" value="<?=$reg_data->getWeight();?>">
            </div>
        </div>
        <!-- TODO: Riwayat Penyakit -->
        <?php if($reg_data->getHospitalSheets()->isEmpty()):?>
        <div class="form-group">
            <label class="col-sm-4 control-label">Riwayat Penyakit :</label>
            <div class="col-sm-4">
                <input type="text" name="hospital_sheets[]" class="form-control" placeholder="Riwayat Penyakit" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_hs btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php else :
            $count = 0;
            foreach ($reg_data->getHospitalSheets() as $h_s):
                ?>
        <div class="form-group">
            <?php if($count == 0): $count++;?>
            <label class="col-sm-4 control-label">Riwayat Penyakit :</label>
            <div class="col-sm-4">
                <input type="text" name="hospital_sheets[]" class="form-control" placeholder="Riwayat Penyakit" value="<?php echo $h_s->getHospitalSheet();?>">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_hs btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
            <?php else : ?>
            <div class="col-sm-offset-4 col-sm-4">
                <input type="text" required="true" name="hospital_sheets[]" class="form-control" placeholder="Riwayat Penyakit" value="<?php echo $h_s->getHospitalSheet();?>">
            </div>
            <div class="col-sm-4">
                <a class="remove_btn_hs btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        <!-- TODO: Kelainan Jasmani -->
        <?php if($reg_data->getPhysicalAbnormalities()->isEmpty()):?>
        <div class="form-group insert_hs">
            <label class="col-sm-4 control-label">Kelainan Jasmani :</label>
            <div class="col-sm-4">
                <input type="text" name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_pa btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php else :
            $count = 0;
            foreach ($reg_data->getPhysicalAbnormalities() as $p_a):
                ?>
        <div class="form-group insert_hs">
            <?php if($count == 0): $count++;?>
            <label class="col-sm-4 control-label">Kelainan Jasmani :</label>
            <div class="col-sm-4">
                <input type="text" name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="<?php echo $p_a->getPhysicalAbnormality();?>">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_pa btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
            <?php else : ?>
            <div class="col-sm-offset-4 col-sm-4">
                <input type="text" required="true" name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="<?php echo $p_a->getPhysicalAbnormality();?>">
            </div>
            <div class="col-sm-4">
                <a class="remove_btn_pa btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        <!-- TODO: Prestasi -->
        <?php if($reg_data->getAchievements()->isEmpty()):?>
        <div class="form-group insert_pa">
            <label class="col-sm-4 control-label"> Prestasi yang Diraih :</label>
            <div class="col-sm-4">
                <input type="text" name="achievements[]" class="form-control" placeholder="Prestasi" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_acv btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php else :
            $count = 0;
            foreach ($reg_data->getAchievements() as $acv):
                ?>
        <div class="form-group insert_pa">
            <?php if($count == 0): $count++;?>
            <label class="col-sm-4 control-label">Prestasi yang Diraih :</label>
            <div class="col-sm-4">
                <input type="text" name="achievements[]" class="form-control" placeholder="Prestasi" value="<?php echo $acv->getAchievement();?>">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_acv btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
            <?php else : ?>
            <div class="col-sm-offset-4 col-sm-4">
                <input type="text" required="true" name="achievements[]" class="form-control" placeholder="Prestasi" value="<?php echo $acv->getAchievement();?>">
            </div>
            <div class="col-sm-4">
                <a class="remove_btn_acv btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        <!-- TODO: Hobi -->
        <?php if($reg_data->getHobbies()->isEmpty()): //Keep If & Else div sinkron!!!?>
        <div class="form-group insert_acv">
            <label class="col-sm-4 control-label">Hobi :</label>
            <div class="col-sm-4">
                <input type="text" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_hby btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php else : // ini else-nya 
            $count = 0;
            foreach ($reg_data->getHobbies() as $hobby):
                ?>
        <div class="form-group insert_acv">
            <?php if($count == 0): $count++;?>
            <label class="col-sm-4 control-label">Hobi :</label>
            <div class="col-sm-4">
                <input type="text" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="<?php echo $hobby->getHobby();?>">
            </div>
            <div class="col-sm-4">
                <a class="add_btn_hby btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
            <?php else : ?>
            <div class="col-sm-offset-4 col-sm-4">
                <input type="text" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="<?php echo $hobby->getHobby();?>">
            </div>
            <div class="col-sm-4">
                <a class="remove_btn_hby btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
        <div class="form-group insert_hby">
            <div class="col-sm-offset-4 col-sm-6">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save">&nbsp;Simpan</button>
                <a class="btn btn-success" href="<?=base_url().$id;?>/data/father/"><span class="glyphicon glyphicon-chevron-right">&nbsp;Lanjut</a>
            </div>
        </div>
    </form>
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
                    '<input type="text" required="true" name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="">'+
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
                    '<input type="text" required="true" name="hospital_sheets[]" class="form-control" placeholder="Masukkan Riwayat Penyakit" value="">'+
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
                    '<input type="text" required="true" name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="">'+
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
</script>