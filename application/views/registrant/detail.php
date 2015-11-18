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
    <small>Data Diri</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li class="active">
        Data Diri
    </li>
</ol>
<div class="container-fluid">
    <div class="row">
    <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>/pendaftar/do_edit_detail/<?=$id?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Tanggal Lahir :</label>
            <div class="col-sm-6">
                <input class="form-control datepicker" type="text" required="true"
                       data-date-format="dd-mm-yyyy" name="birth_date" value="<?=$reg_data->getBirthDate()->format('d-m-Y');?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tempat Lahir :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="birth_place" class="form-control" placeholder="Tempat Lahir" value="<?=$reg_data->getBirthPlace();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Alamat :</label>
            <div class="col-sm-6">
                <textarea class="form-control col-sm-10" required="true" rows="3" name="address"><?=$reg_data->getAddress();?></textarea>
            </div>
        </div>
        <!-- TODO: Family Condition pake radio -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Keadaan Pendaftar :</label>
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
        <!-- TODO: Nationality pake radio -->
        <div class="form-group">
            <label class="col-sm-2 control-label ">Kewarganegaraan :</label>
            <div class="col-sm-6">
                <select class="form-control" name="nationality" >
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
            <label class="col-sm-2 control-label">Agama :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="religion" id="religion" tabindex="1" class="form-control" placeholder="Agama" value="<?=$reg_data->getReligion();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tinggi :</label>
            <div class="col-sm-6">
                <input type="number" required="true" name="height" id="birth_date" tabindex="1" class="form-control" placeholder="Tinggi Badan" value="<?=$reg_data->getHeight();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Berat :</label>
            <div class="col-sm-6">
                <input type="number" required="true" name="weight" id="birth_date" tabindex="1" class="form-control" placeholder="Berat Badan" value="<?=$reg_data->getWeight();?>">
            </div>
        </div>
        <!-- TODO: Riwayat Penyakit -->
        <?php if(empty($h_s)):?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Riwayat Penyakit :</label>
            <div class="col-sm-4">
                <input type="text" required="true" name="weight" id="birth_date" class="form-control" placeholder="Riwayat Penyakit" value="">
            </div>
            <div class="col-sm-2">
                <a class="add_field_button btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </div>
        <?php endif;?>
        <!-- TODO: Kelainan Jasmani -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Tinggal Bersama :</label>
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
        <!-- TODO: Prestasi -->
        <!-- TODO: Hobi -->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-sm btn-primary">OK</button>
                <a class="btn btn-sm btn-warning" href="<?=base_url();?>home/">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</div>