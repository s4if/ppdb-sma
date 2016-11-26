<?php

/* 
 * The MIT License
 *
 * Copyright 2014 s4if.
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
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><b>PPDB SMAIT Ihsanul Fikri Mungkid</b></a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> &nbsp; <b id="uname"><?=$username;?></b> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <?php if(!empty($registrant)) :?>
                    <a href="<?=  base_url().$id.'/password/'?>"><span class="glyphicon glyphicon-edit"></span> &nbsp; Kata Sandi</a>
                    <?php endif;?>
                    <?php if(!empty($admin)) :?>
                    <a href="<?=  base_url().'admin/password/'?>"><span class="glyphicon glyphicon-edit"></span> &nbsp; Kata Sandi</a>
                    <?php endif;?>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?=base_url()?>login/do_logout"><span class="glyphicon glyphicon-log-out"></span> &nbsp; Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <?php if(!empty($registrant)) :?>
            <li id="navHome">
                <a href="<?=  base_url().$id.'/beranda/'?>">Beranda</a>
            </li>
            <?php if((!$registrant->getFinalized())&&(!is_null($registrant->getPaymentData()))):?>
            <li id="navFormulir">
                <a href="<?=  base_url().$id.'/formulir'?>">Isi Data</a>
            </li>
            <li id="navLetter">
                <a href="<?=  base_url().$id.'/surat'?>">Surat Pernyataan</a>
            </li>
            <?php endif;?>
            <li id="navRecap">
                <a href="<?=  base_url().$id.'/rekap'?>">Rekap</a>
            </li>
            <?php endif;?>
            <?php if(!empty($admin)) :?>
            <li id="navHomeAdmin">
                <a href="<?=  base_url().'admin/beranda/'?>">Beranda</a>
            </li>
            <li id="navRegistrantAdmin">
                <a href="<?=  base_url().'admin/lihat/'?>">Lihat Pendaftar</a>
            </li>
            <li id="navPaymentAdmin">
                <a href="<?=  base_url().'admin/pembayaran/'?>">Lihat Pembayaran</a>
            </li>
            <?php endif;?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

<script type="text/javascript">
    $("#nav<?=  ucfirst($nav_pos);?>").attr('class','active');
</script>