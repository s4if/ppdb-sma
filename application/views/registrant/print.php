<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Registrasi PPDB SMAIT Ihsanul Fikri</title>

<!-- Di server, jangan lupa untuk diganti menjadi CDN -->

<!-- Bootstrap Core CSS -->
<link href="<?=  FCPATH ?>assets/css/bootstrap.min.css"
	rel="stylesheet">

<!-- Custom CSS -->
<style>
body {
    padding-top: 90px;
}
.p-header {
    background-image: url("<?php echo FCPATH.'assets/images/headerkartu.jpg';?>");
    background-size:cover;
}
.txt-header {
    color:white;
    font-weight:bolder;
    text-align:center;
}
img.foto-profil {
    resize: both;
    height: 4cm;
    width: 3cm;
}
</style>

<!-- JQuery JS -->
<script src="<?=  FCPATH ?>assets/js/jquery-2.1.4.min.js"></script>

</head>

<body>
    <div class="container">
    	<div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-success">
                    <div class="panel-heading p-header">
                        <h1 class="txt-header">Kartu Ujian</h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p style="text-align: center;">
                                    Registrasi PPDB SMAIT Ihsanul Fikri Mungkid TA:2023/2024 telah berhasil.<br />
                                    Data yang ter-input adalah sebagai berikut :
                                </p>
                                <table class="table table-responsive table-condensed table-borderless">
                                    <tr>
                                        <td rowspan="5">
                                            <img class="foto-profil" src="<?=FCPATH.'data/foto/'.$registrant->getId().'.png';?>" alt="Tempelkan Fto 3x4CM">
                                        </td>
                                        <td>Nama </td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?php echo ucwords($registrant->getName());?></td>
                                    </tr>
                                    <tr>
                                        <td>I/A </td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?php echo ($registrant->getGender()=='L')?'Ikhwan':'Akhwat';?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Pendaftaran </td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?php
                                        echo $registrant->getRegId();?></td>
                                    </tr>
                                    <tr>
                                        <td>Asal Sekolah </td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?php echo $registrant->getPreviousSchool();?></td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan/Program </td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?php echo $registrant->getProgram();?></td>
                                    </tr>
                                </table>
                                <p style="text-align: center;">
                                    Silahkan dibawa saat tes tertulis sebagai kartu peserta tes dan bukti pendaftaran.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-success">
                    <div class="panel-heading p-header">
                        <h1 class="txt-header">Rundown Tes Seleksi</h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive table-bordered">
                                <tr>
                                    <th class="text-center">Materi Test</th>
                                    <th class="text-center">Paraf</th>
                                </tr>
                                <tr>
                                    <td>
                                        Tes Kemampuan Dasar:
                                        <ul>
                                            <li>TPS (Bahasa Indonesia dan Logika dasar)</li>
                                            <li>Matematika</li>
                                            <li>Bahasa Inggris</li>
                                        </ul>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Tes Tahsin Tahfidz (Juz 29 & 30)</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Tes Tahfidz (Khusus Program Tahfidz)</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Ukur Seragam</td>
                                    <td>&nbsp;</td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-footer">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Bootstrap Core JS -->
<script src="<?=  FCPATH ?>assets/js/bootstrap.min.js"></script>
</body>
</html>