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
<link href="<?=  base_url() ?>assets/css/bootstrap.min.css"
	rel="stylesheet">

<link href="<?=  base_url() ?>assets/css/bootstrap-datepicker.min.css"
	rel="stylesheet">

<link href="<?=  base_url() ?>assets/css/bootstrap-datepicker3.min.css"
	rel="stylesheet">

<!-- Custom CSS -->
<style>
body {
    padding-top: 90px;
    background-image: url("<?php echo base_url().'assets/images/bg-login-1718.jpg';?>")
}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}
img.foto-profil {
            resize: both;
            height: 4cm;
            width: 3cm;
        }
.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}
@media screen and (min-width: 680px) {
.navbar-transparent {
    background: transparent;
    background-image: none;
    border-color: transparent;
}
.navbar-default .navbar-nav>.active>a,
.navbar-default .navbar-nav>.active>a:focus,
.navbar-default .navbar-nav>.active>a:hover {
    background: transparent;
    background-image: none;
    border-color: transparent;
}}
#navbar ul li.active {
    background:transparent;
    background-image: none;
    border-color: transparent;
}

#navbar ul li:hover {       
    background:transparent;
    background-image: none;
    border-color: transparent;
}
</style>

<!-- JQuery JS -->
<script src="<?=  base_url() ?>assets/js/jquery-2.1.4.min.js"></script>

</head>

<body>
    <div class="container">
    	<div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-success">
                    <div class="panel-heading ">
                        <h1 style="text-align: center;">Kartu Ujian</h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p style="text-align: center;">
                                    Registrasi PPDB SMAIT Ihsanul Fikri Mungkid TA:2016/2017 telah berhasil. 
                                    Data yang ter-input adalah sebagai berikut :
                                </p>
                                <table class="table table-responsive table-condensed table-borderless">
                                    <tr>
                                        <td rowspan="4">
                                            <img class="foto-profil" src="<?=FCPATH.'data/foto/'.$registrant->getId().'.png';?>" alt="Foto 3x4">
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
                                        <td><?php echo $registrant->getRegId();?></td>
                                    </tr>
                                    <tr>
                                        <td>Asal Sekolah </td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?php echo $registrant->getPreviousSchool();?></td>
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
    </div>
</div>
<!-- Bootstrap Core JS -->
<script src="<?=  base_url() ?>assets/js/bootstrap.min.js"></script>
</body>
</html>