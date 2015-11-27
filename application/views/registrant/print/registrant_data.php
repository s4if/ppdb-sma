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
<!DOCTYPE html>
<html>
    
<head>
    <title>Laporan Hasil Belajar Kelas <?=$id_kelas?></title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 0.8em;
            font-size-adjust: 0.5;
        }
        h1.header-print {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1em;
            font-size-adjust: 0.5;
            text-align: center;
        }
        h2.header-section {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.9em;
            font-size-adjust: 0.5;
            text-align: left;
        }
        p.xprint{
            font-size: 0.7em;
            font-weight: bold;
        }
        td.catatan {
            font-family: inherit;
            font-style: italic;
            font-size: 0.8em;
            font-size-adjust: 0.5;
        }
        table {
            vertical-align: text-top;
        }
        table.utama {
            font-family: inherit;
            font-size: 0.75em;
            color:#333333;
            border-width: 1px;
            border-color: #000000;
            border-collapse: collapse;
        }
        table.utama thead {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #dedede;
            text-align: center;
            font-weight: bolder;
        }
        table.utama th {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #dedede;
        }
        table.utama td {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #ffffff;
        }
        td.surat{
            font:inherit;
            font-style: italic;
            text-align: center;
        }
        td.tengah{
            font:inherit;
            text-align: center;
            font-weight: bold;
        }
        div.end-break {
            page-break-after: always;
        }
        div.page-content{
            page-break-inside: avoid;
        }
        li.pernyataan {
            text-align: justify;
        }
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
            font-size-adjust: 0.5;
            vertical-align: text-top;
        }
    </style>
</head>
<body>
    <div>
        <h1 class="header-print">Data Pendaftar</h1>
        <div class="page-content">
            <h2 class="header-section">Foto Pendaftar</h2>
            <img class="foto-profil img-rounded" src="<?=$img_link;?>" alt="foto-profil">
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
            <hr />
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>

</html>