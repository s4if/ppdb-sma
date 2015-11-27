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
    <div class="row">
        <h3>Rekap Data Pendaftaran</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <embed style=" width: 100%; height: 600px;" src="<?=  base_url().'pendaftar/print_data_pendaftaran/'.$id.'/lihat';?>" type="application/pdf"></embed>
        </div>
    </div>
</div>