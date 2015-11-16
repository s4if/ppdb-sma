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
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li class="active">
        Profil
    </li>
</ol>
<div class="container-fluid">
    <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>/pendaftar/do_edit_profil/<?=$id?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="name" id="name" tabindex="1" class="form-control" placeholder="Nama" value="<?=$registrant->getName();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Sekolah Asal :</label>
            <div class="col-sm-6">
                <input type="text" required="true" name="prev_school" id="prev_school" tabindex="1" class="form-control" placeholder="Sekolah Asal" value="<?=$registrant->getPreviousSchool();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">NISN :</label>
            <div class="col-sm-6">
                <input type="text" name="nisn" id="nisn" tabindex="1" class="form-control" placeholder="NISN" value="<?=$registrant->getNisn();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin :</label>
            <div class="col-sm-6">
                <div class="radio">
                    <label>
                        <input type="radio" checked="true" name="sex" value="L" 
                            <?php if(!empty($registrant->getSex())):?>
                                <?php if($registrant->getSex() ==='L'):?>
                                checked="true"
                                <?php endif;?>
                            <?php endif;?>>
                        Laki - Laki
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="sex" value="P"
                            <?php if(!empty($registrant->getSex())):?>
                                <?php if($registrant->getSex() ==='P'):?>
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
            <div class="col-sm-6">
                <select class="form-control" name="program" >
                    <option value="reguler"  
                        <?php if(!empty($registrant->getProgram())):?>
                            <?php if($registrant->getProgram()=='reguler'): ?>
                                    selected="true"
                            <?php endif;?>
                        <?php endif;?>>
                        Reguler
                    </option>
                    <option value="tahfidz"  
                        <?php if(!empty($registrant->getProgram())):?>
                            <?php if($registrant->getProgram()=='tahfidz'): ?>
                                    selected="true"
                            <?php endif;?>
                        <?php endif;?>>
                        Tahfidz
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-sm btn-primary">OK</button>
                <a class="btn btn-sm btn-warning" href="<?=base_url();?>home/">Cancel</a>
            </div>
        </div>
    </form>
</div>