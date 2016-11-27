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
    Rekap
    <small>Data</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'/'.$id;?>/beranda/">Beranda</a>
    </li>
    <li class="active">
        Rekap Data
    </li>
</ol>
<div class="container-fluid">
    <style>
        img.foto-profil {
            resize: both;
            height: 100%;
            width: 100%;
            max-height: 200px;
            max-width: 150px;
        }
        table.data{
            border-collapse: collapse;
            padding-bottom: 0.5em;
            padding-top: 0.5em;
            font-size: 1.3em;
            font-size-adjust: 0.2em;
        }
    </style>
    <div class="print-body">
    <div class="row">
        <h3>Rekap Data Pendaftaran</h3>
    </div>
    <div class="row">
<!--        <div class="col-md-12">
            <embed style=" width: 100%; height: 600px;" src="<?=  base_url().'pendaftar/print_data_pendaftaran/'.$id.'/lihat';?>" type="application/pdf"></embed>
        </div>-->
        <div class="page-content">
            <h2 class="header-section">Foto Pendaftar</h2>
            <img class="foto-profil" src="<?=$img_link;?>" alt="Foto 3x4">
            <hr />
        </div>
        <div class="page-content">
        <h2 class="header-section">Data Pendaftaran</h2>
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
                <td> <?=($registrant->getGender() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
            </tr>
            <tr>
                <td> NISN </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$registrant->getNisn()?> </td>
            </tr>
            <tr>
                <td> Email / No. HP </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$registrant->getCp()?> </td>
            </tr>
            <tr>
                <td> Program </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$registrant->getProgram()?> </td>
            </tr>
        </table>
        <hr />
    </div>
    <?php if (!is_null($registrant->getRegistrantData())) :
        $data = $registrant->getRegistrantData();?>
    <div class="page-content">
        <h2 class="header-section">Detail Pendaftar</h2>
        <table class="data">
            <tr>
                <td> TTL </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucfirst($data->getBirthPlace()).', '.tgl_indo($data->getBirthDate()->format('Y m d'));?> </td>
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
                <?php
                $hp_count = $data->getHospitalSheetsCount();
                $hb_count = $data->getHobbiesCount();
                $pa_count = $data->getPhysicalAbnormalitiesCount();
                $ac_count = $data->getAchievementsCount();
                ?>
            <tr>
                <td rowspan="<?=($hp_count < 1)?'1':$hp_count+1;?>"> Riwayat Penyakit </td>
                <td rowspan="<?=($hp_count < 1)?'1':$hp_count+1;?>"> &nbsp;:&nbsp; </td>
                <?php ($hp_count < 1)?'<td>-</td>':'';?>
            </tr>    
                <?php foreach ($data->getHospitalSheets() as $hp):?>
                <tr><td> <?php echo ucfirst($hp);?> </td>
                <?php endforeach;?>
            <tr>
                <td rowspan="<?=($pa_count < 1)?'1':$pa_count+1;?>"> Kelainan Jasmani </td>
                <td rowspan="<?=($pa_count < 1)?'1':$pa_count+1;?>"> &nbsp;:&nbsp; </td>
                <?php ($pa_count < 1)?'<td>-</td>':'';?>
            </tr>
                <?php foreach ($data->getPhysicalAbnormalities() as $pa):?>
                <tr><td> <?php echo ucfirst($pa);?> </td></tr>
                <?php endforeach;?>
            <tr>
                <td> Tinggal Bersama </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo ucwords($data->getStayWith());?> </td>
            </tr>
            <tr>
                <td rowspan="<?=($hb_count < 1)?'1':$hb_count+1;?>"> Hobi </td>
                <td rowspan="<?=($hb_count < 1)?'1':$hb_count+1;?>"> &nbsp;:&nbsp; </td>
                <?php ($hb_count < 1)?'<td>-</td>':'';?>
            </tr>
                <?php foreach ($data->getHobbies() as $hb):?>
                <tr><td> <?php echo ucfirst($hb);?> </td></tr>
                <?php endforeach;?>
            <tr>
                <td rowspan="<?=($ac_count < 1)?'1':$ac_count+1;?>"> Prestasi </td>
                <td rowspan="<?=($ac_count < 1)?'1':$ac_count+1;?>"> &nbsp;:&nbsp; </td>
                <?php ($hp_count < 1)?'<td>-</td>':'';?>
            </tr>
                <?php foreach ($data->getAchievements() as $ac):?>
                <tr><td> <?php echo ucfirst($ac);?> </td></tr>
                <?php endforeach;?>
        </table>
        <hr />
    </div>
    <?php endif;?>
    <?php 
    $arr_parent = [['father', 'ayah'],['mother', 'ibu'],['guardian', 'wali']];
    foreach ($arr_parent as $str_parent) :
    $sfunct = 'get'.ucfirst($str_parent[0]);
    if (!is_null($registrant->$sfunct())) : 
        $parent = $registrant->$sfunct();?>
    <div class="page-content">
        <h2 class="header-section">Data <?=ucfirst($str_parent[1])?></h2>
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
                <td> <?php echo ucfirst($parent->getBirthPlace()).', '.tgl_indo($parent->getBirthDate()->format('Y m d'));?> </td>
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
                <td> Rp. <?php echo number_format($parent->getIncome(), 0, ',', '.');?>,- </td>
            </tr>
            <tr>
                <td> Jumlah Tanggunan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?php echo $parent->getBurdenCount();?> </td>
            </tr>
        </table>
        <hr />
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <a class="btn btn-lg btn-warning <?php echo ($registrant->getCompleted())?'':'disabled';?>" data-toggle="modal" data-target="#ModalFinalized">
        <span class="glyphicon glyphicon-registration-mark"></span>
        Finalisasi
    </a>
    </div>
</div>

<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                 <h4 class="modal-title" id="memberModalLabel">Pendaftaran Hampir Selesai!</h4>

            </div>
            <div class="modal-body">
                <p>Terimakasih karena telah mendaftar di SMAIT Ihsanul Fikri Mungkid</p>
                <p>Pengisian data telah selesai, silahkan cek kembali data yang dimasukkan. 
                    Jika telah benar, silahkan klik finalisasi untuk menyelesaikan pendaftaran.</p>
                <p><strong class="red">Ingat, data yang sudah di-finalisasi tidak bisa diubah kembali!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalFinalized" tabindex="-1" role="dialog" aria-labelledby="ModalFinalized" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalFinalizedLabel>">Finalisasi Data</h4>
            </div>
            <div class="modal-body">
                <h3 style="align-content: center"><span class=" glyphicon glyphicon-warning-sign"></span></h3>
                <p>
                    Finalisasi data akan menyebabkan Anda tidak bisa lagi <strong>mengubah</strong> data yang anda masukkan! <br/>
                    Apakah anda yakin Untuk melakukan Finalisasi data?
                </p>
                <a href="<?=  base_url().'pendaftar/finalisasi/'.$id.'/true'?>" class="btn btn-primary">OK</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('#memberModal').modal('show');

    });
</script>