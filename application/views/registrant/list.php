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

<!-- Bootstrap DataTables CSS -->
<link href="<?=  base_url() ?>assets/css/datatables.min.css" 
      rel="stylesheet">
    
<!-- Custom CSS -->
<style>
body {
    padding-top: 90px;
    background-image: url("<?php echo base_url().'assets/images/bg-login.jpg';?>")
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
    <div class="navbar navbar-fixed-top navbar-transparent" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand brand-shifted" href="http://ppdb.smait-ihsanulfikri.sch.id">PPDB SMAIT Ihsanul Fikri</a>
                </div>
                <!-- Navbar collapse -->
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right shifted">
                        <li class=""><a href="<?=  base_url().'login/admin'?>">Admin</a></li>
                        <li class="active"><a href="<?=  base_url().'lihat'?>">Lihat</a></li>
                        <li class=""><a href="<?=  base_url().'login'?>">Daftar</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div><!-- /.Fixed navbar -->
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
<?php if(empty($this->session->flashdata('notices')) === false): ?>
<div class="alert alert-success alert-dismissible">
<?php
    echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
            '<span aria-hidden="true">&times;</span><span class="sr-only">'.
            'Close</span></button>'.
            implode('</p><p>', $this->session->flashdata('notices')) . '</p>';	
    ?>
</div>
<?php endif; ?>
<?php if(empty($this->session->flashdata('errors')) === false): ?>
<div class="alert alert-danger alert-dismissible">
<?php
    echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
            '<span aria-hidden="true">&times;</span><span class="sr-only">'.
            'Close</span></button>'.
            implode('</p><p>', $this->session->flashdata('errors')) . '</p></span></button>';	
    ?>
</div>
<?php endif; ?>
<?php if(empty($this->session->flashdata('warnings')) === false): ?>
<div class="alert alert-warning alert-dismissible">
<?php
    echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
            '<span aria-hidden="true">&times;</span><span class="sr-only">'.
            'Close</span></button>'.
            implode('</p><p>', $this->session->flashdata('warnings')) . '</p></span></button>';	
    ?>
</div>
<?php endif; ?>
<!--            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p class=" text-center"><strong>Pengumuman:</strong> Mulai 2 Desember 2015, data yang ditampilkan disini adalah pendaftar yang minimal telah melengkapi data
                pribadi dan data orang tua. <br/>
                Segera lengkapi data pendaftaran anda untuk bisa bergabung dengan keluarga besar SMAIT Ihsanul Fikri Mungkid.<br/>
                <i>Hormat kami, Tim PPDB SMAIT Ihsanul Fikri Mungkid.</i></p>
            </div>-->
</div>
        </div>
    	<div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-login">
                    <div class="panel-heading ">
                        <div class="row">
                            <div class="col-xs-6">
                                <a id="btn_ikhwan" onclick="ikhwan()" class="active" href="#" >Data Pendaftar Ikhwan</a>
                            </div>
                            <div class="col-xs-6">
                                <a id="btn_akhwat" onclick="akhwat()" href="#" >Data Pendaftar Akhwat</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped table-bordered table-condensed table-responsive" id="tabel_utama">
                                    <thead>
                                        <tr>
                                            <td>No. Pendaftaran</td>
                                            <td>Nama</td>
                                            <td>I/A</td>
                                            <td>Sekolah Asal</td>
                                            <td>Program</td>
                                            <td>Status Data</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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
</div>
<!-- Bootstrap Core JS -->
<script src="<?=  base_url() ?>assets/js/bootstrap.min.js"></script>

<!-- Bootstrap DataTables JS -->
<script src="<?=  base_url() ?>assets/js/datatables.min.js"></script>

<script type="text/javascript">
var table;

$(document).ready(function() {

    //datatables
    table = $('#tabel_utama').DataTable({ 

        "order": [[ 0, "desc" ]], //Initial no order.
        "scrollX": true,

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pendaftar/lihat_ajax/'.$gender.'/true')?>",
            "type": "POST"
        }

    });

});

function ikhwan(){
    $('#btn_akhwat').removeClass('active');
    $('#btn_ikhwan').addClass('active');
    tabel_refresh('L');
}

function akhwat(){
    $('#btn_ikhwan').removeClass('active');
    $('#btn_akhwat').addClass('active');
    tabel_refresh('P');
}

function tabel_refresh (gender){
    url = "<?php echo site_url('pendaftar/lihat_ajax/')?>/" + gender + "/true";
    table.ajax.url(url).load();
}


</script>
    
</body>
</html>