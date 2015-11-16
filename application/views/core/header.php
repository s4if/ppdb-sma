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
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$title?></title>
    
    <?php if($cdn):?>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    
    <!-- Bootstrap DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs/jszip-2.5.0,dt-1.10.9,b-1.0.3,b-colvis-1.0.3,b-print-1.0.3,cr-1.2.0,fc-3.1.0,fh-3.0.0,kt-2.0.0,r-1.0.7,rr-1.0.0,sc-1.3.0,se-1.0.1/datatables.min.css"/>
    
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css">
    
    <!-- Datepicker3 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">
    
    <!-- Custom CSS -->
    <link href="<?=  base_url() ?>assets/css/sb-admin.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?=  base_url() ?>assets/css/style.css" rel="stylesheet">
    
    <!-- JQuery JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    
    <?php else :?>
    <!-- Bootstrap Core CSS -->
    <link href="<?=  base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap DataTables CSS -->
    <link href="<?=  base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
    
    <!-- Datepicker CSS -->
    <link href="<?=  base_url() ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
    
    <!-- Datepicker3 CSS -->
    <link href="<?=  base_url() ?>assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?=  base_url() ?>assets/css/sb-admin.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?=  base_url() ?>assets/css/style.css" rel="stylesheet">
    
    <!-- JQuery JS -->
    <script src="<?=  base_url() ?>assets/js/jquery-2.1.4.min.js"></script>
    
    <?php endif;?>
    
</head>

<body>