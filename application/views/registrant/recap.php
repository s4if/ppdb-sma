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
    Profil
    <small>Ganti Password</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().$id.'/home';?>">Beranda</a>
    </li>
    <li class="active">
        Ganti Password
    </li>
</ol>
<div class="container-fluid">
    <?php //var_dump($registrant);?>
    <style>
        img.foto-profil {
            resize: both;
            height: 100%;
            width: 100%;
        }
        table.data{
            border-collapse: collapse;
            padding-bottom: 0.5em;
            padding-top: 0.5em;
            font-size: 1.3em;
            font-size-adjust: 0.2em;
        }
    </style>
    <div class="row">
        <h3>Data Pendaftaran</h3>
    </div>
    <div class="row">
        <div class="col-md-2">
            <img class="foto-profil img-rounded" src="<?=$img_link;?>" alt="foto-profil">
        </div>
        <div class="col-md-8">
            <table class="data">
                <tr>
                    <td> Nomor Pendaftaran </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$registrant->getId();?> </td>
                </tr>
                <tr>
                    <td> Nama </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$registrant->getName();?> </td>
                </tr>
                <tr>
                    <td> Sekolah Asal </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$registrant->getPreviousSchool()?> </td>
                </tr>
                <tr>
                    <td> Jenis Kelamin </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=($registrant->getSex() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
                </tr>
                <tr>
                    <td> NISN </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$registrant->getNisn()?> </td>
                </tr>
                <tr>
                    <td> Program </td>
                    <td> &nbsp;:&nbsp; </td>
                    <td> <?=$registrant->getProgram()?> </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <hr />
    </div>
    <?php if (!is_null($registrant->getRegistrantData())) :?>
    <div class="row">
        <h3>Detail Pendaftar</h3>
    </div>
    <div class="row">
        <?php 
        $data = $registrant->getRegistrantData();
        //$data = new RegistrantDataEntity();
        ?>
        <table class="data">
            <tr>
                <td> TTL </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucfirst($data->getBirthPlace()).', '.$data->getBirthDate()->format('d F Y');?> </td>
            </tr>
            <tr>
                <td> Alamat </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $data->getAddress();?> </td>
            </tr>
            <tr>
                <td> Keadaan Keluarga Pendaftar </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucwords($data->getFamilyCondition());?> </td>
            </tr>
            <tr>
                <td> Kewarganegaraan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo strtoupper($data->getNationality());?> </td>
            </tr>
            <tr>
                <td> Agama </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucfirst($data->getReligion());?> </td>
            </tr>
            <tr>
                <td> Tinggi / Berat </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $data->getHeight().'/'.$data->getWeight();?> </td>
            </tr>
            <tr>
                <td> Tinggal Bersama </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucwords($data->getStayWith());?> </td>
            </tr>
        </table>
    </div>
    <?php endif;?>
    <div class="row">
        <hr />
    </div>
    <?php 
    $arr_parent = [['father', 'ayah'],['mother', 'ibu'],['guardian', 'wali']];
    foreach ($arr_parent as $str_parent) :
        $sfunct = 'get'.ucfirst($str_parent[0]);
        if (!is_null($registrant->$sfunct())) : ?>
    <div class="row">
        <h3>Detail <?=ucfirst($str_parent[1])?></h3>
    </div>
    <div class="row">
        <?php 
        $parent = $registrant->$sfunct();
        ?>
        <table class="data">
            <tr>
                <td> Nama </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getName();?> </td>
            </tr>
            <tr>
                <td> Status </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucwords($parent->getStatus());?> </td>
            </tr>
            <tr>
                <td> TTL </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucfirst($parent->getBirthPlace()).', '.$parent->getBirthDate()->format('d F Y');?> </td>
            </tr>
            <tr>
                <td> Alamat </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getAddress();?> </td>
            </tr>
            <tr>
                <td> No. Telp </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getContact();?> </td>
            </tr>
            <tr>
                <td> Hubungan dengan Pendaftar </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucwords($parent->getRelation());?> </td>
            </tr>
            <tr>
                <td> Kewarganegaraan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo strtoupper($parent->getNationality());?> </td>
            </tr>
            <tr>
                <td> Agama </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucwords($parent->getReligion());?> </td>
            </tr>
            <tr>
                <td> Tingkat Pendidikan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getEducationLevel();?> </td>
            </tr>
            <tr>
                <td> Pekerjaan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getJob();?> </td>
            </tr>
            <tr>
                <td> Jabatan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getPosition();?> </td>
            </tr>
            <tr>
                <td> Instansi </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getCompany();?> </td>
            </tr>
            <tr>
                <td> Penghasilan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> Rp. <?php echo $parent->getIncome();?>,- </td>
            </tr>
            <tr>
                <td> Jumlah Tanggunan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getBurdenCount();?> </td>
            </tr>
        </table>
    </div>
    <div class="row">
        <hr />
    </div>
    <?php endif;?>
    <?php endforeach;?>
</div>