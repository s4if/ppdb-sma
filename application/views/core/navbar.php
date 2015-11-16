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
        <a class="navbar-brand" href="#">PPDB SMAIT Ihsanul Fikri Mungkid</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> &nbsp; <?=$username;?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href=""><span class="glyphicon glyphicon-user"></span> &nbsp; Profil</a>
                </li>
                <li>
                    <a href=""><span class="glyphicon glyphicon-edit"></span> &nbsp; Kata Sandi</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?=base_url()?>pendaftar/do_logout"><span class="glyphicon glyphicon-log-out"></span> &nbsp; Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li id="navHome">
                <a href="<?=  base_url().$id.'/beranda/'?>">Beranda</a>
            </li>
            <li id="navProfile">
                <a href="<?=  base_url().$id.'/profil/'?>">Profil</a>
            </li>
            <li id="navIdentity">
                <a href="<?=  base_url().$id.'/detail/'?>">Data Diri</a>
            </li>
            <li id="navFather">
                <a href="<?=  base_url().$id.'/data/father/'?>">Data Ayah</a>
            </li>
            <li id="navMother">
                <a href="<?=  base_url().$id.'/data/mother/'?>">Data Ibu</a>
            </li>
            <li id="navGuardian">
                <a href="<?=  base_url().$id.'/data/guardian/'?>">Data Wali</a>
            </li>
            <li id="navRecap">
                <a href="<?=  base_url().$id.'/recap'?>">Rekap</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

<script type="text/javascript">
    $("#nav<?=  ucfirst($nav_pos);?>").attr('class','active');
</script>