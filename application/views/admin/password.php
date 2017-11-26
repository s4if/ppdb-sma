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
        <a href="<?=base_url().'admin/beranda';?>">Beranda</a>
    </li>
    <li class="active">
        Ganti Password
    </li>
</ol>
<div class="container-fluid">
    <form class="form-horizontal" role="form" method="post" action="<?=base_url().'admin/change_password/'.$username;?>">
        <div class="form-group error">
            <label class="col-sm-2 control-label">Password Lama :</label>
            <div class="col-sm-6 error">
                <input type="password" class="form-control" name="stored_password" 
                       placeholder="Masukkan Password Lama" value="" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Password Baru :</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="new_password" 
                       placeholder="Masukkan Password Baru" value="" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Konfirmasi :</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="confirm_password" 
                       placeholder="Konfirmasi" value="" required>
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