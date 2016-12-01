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
    padding-top: 150px;
    background-image: url("<?php echo base_url().'assets/images/bg-login-1718.jpg';?>");
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
    background: rgba(255,255,255,0.6);
    background-image: none;
    border-color: rgba(255,255,255,0.6);
}
.navbar-default .navbar-nav>.active>a,
.navbar-default .navbar-nav>.active>a:focus,
.navbar-default .navbar-nav>.active>a:hover {
    background: rgba(255,255,255,0.6);
    background-image: none;
    border-color: rgba(255,255,255,0.6);
}}
#navbar ul li.active {
    background:rgba(255,255,255,0.6);
    background-image: none;
    border-color: rgba(255,255,255,0.6);
}

#navbar ul li:hover {
    background:rgba(255,255,255,0.6);
    background-image: none;
    border-color: rgba(255,255,255,0.6);
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
                <a class="navbar-brand brand-shifted" href="http://smait.ihsanulfikri.sch.id/">PPDB SMAIT Ihsanul Fikri</a>
            </div>
            <!-- Navbar collapse -->
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right shifted">
                    <li class=""><a href="<?=  base_url().'login/admin'?>">Admin</a></li>
                    <li class=""><a href="<?=  base_url().'lihat'?>">Lihat</a></li>
                    <li class=" active"><a href="<?=  base_url().'login'?>">Daftar</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div><!-- /.Fixed navbar -->
    <div class="container">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
</div>
        </div>
    	<div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Masuk</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Daftar</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="<?php echo base_url().'login/do_login/'?>" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="id_pendaftaran" tabindex="1" class="form-control" placeholder="Username" value="" required="true">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required="true">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Masuk">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="register-form" action="<?php echo base_url().'login/do_register/';?>" method="post" role="form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" required="true" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?=(array_key_exists('username', $registrant))?$registrant['username']:'';?>">
                                </div>
                                <div id="status"class="form-group">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" required="true" name="name" id="name" tabindex="1" class="form-control" placeholder="Nama" value="<?=(array_key_exists('name', $registrant))?$registrant['name']:'';?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" required="true" name="prev_school" id="prev_school" tabindex="1" class="form-control" placeholder="Sekolah Asal" value="<?=(array_key_exists('prev_school', $registrant))?$registrant['prev_school']:'';?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="nisn" id="nisn" tabindex="1" class="form-control" placeholder="NISN (Tidak Wajib)" pattern="^([0-9]{1,20}$)" title="Hanya angka!"
                                           value="<?=(array_key_exists('nisn', $registrant))?$registrant['nisn']:'';?>">
                                </div>
                                <div class="form-group">
                                    <input class="col-xs-2" type="text" name="cp_prefix" required="true" id="cp_prefix" tabindex="1" class="form-control" placeholder="" value="+62">
                                    <input class="col-xs-10" type="text" name="cp_suffix" pattern="^[1-9]([0-9]{1,13}$)" title="Hanya angka tanpa awalan '0'!"
                                           required="true" id="cp_suffix" tabindex="1" class="form-control" placeholder="Telp tanpa awalan cth: 85727411xxx">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Jenis Kelamin :</label>
                                    <div class="">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" checked="true" name="gender" value="L"
                                                       <?php if(array_key_exists('gender', $registrant)):?>
                                                            <?php if($registrant['gender'] ==='L'):?>
                                                            checked="true"
                                                            <?php endif;?>
                                                        <?php endif;?>>
                                                Laki - Laki
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="P"
                                                       <?php if(array_key_exists('gender', $registrant)):?>
                                                            <?php if($registrant['gender'] ==='P'):?>
                                                            checked="true"
                                                            <?php endif;?>
                                                        <?php endif;?>>
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label">Program :</label>
                                    <div class="">
                                        <select class="form-control" name="program">
                                            <option value="reguler"
                                                    <?php if(array_key_exists('program', $registrant)):?>
                                                        <?php if($registrant['program']=='reguler'): ?>
                                                                selected="true"
                                                        <?php endif;?>
                                                    <?php endif;?>>
                                                Reguler
                                            </option>
                                            <option value="tahfidz" 
                                                    <?php if(array_key_exists('program', $registrant)):?>
                                                        <?php if($registrant['program']=='tahfidz'): ?>
                                                                selected="true"
                                                        <?php endif;?>
                                                    <?php endif;?>>
                                                Tahfidz
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" required="true" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" required="true" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                </div>
                                <!-- TODO: Chaptca (Pake gregwar yang di download-an)-->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class=" control-label">Captcha :</label>
                                        <img src="<?php echo $builder->inline(); ?>" class="img-responsive" alt="captcha" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" required="true" name="captcha" id="captcha" tabindex="1" class="form-control" placeholder="Masukkan Teks Dari Gambar Diatas" value="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Daftar Sekarang">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Core JS -->
<script src="<?=  base_url() ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $("#username").keyup(function(){
        // get text username text field value 
        var username = $("#username").val();

        // check username name only if length is greater than or equal to 3
        if(username.length >= 3)
        {
            $("#status").html('Checking availability...');
            // check username 
            $.post("<?=  base_url() ?>login/uname_avaible", {username: username}, function(data, status){
                $("#status").html(data);
            });
        }

    });
});

</script>
    
</body>
</html>