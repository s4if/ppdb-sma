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
    Beranda
    <small>Admin</small>
</h1>
<ol class="breadcrumb">
    <li class="active">
        Beranda
    </li>
</ol>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pie-chart"></i> Pendaftar Ikhwan / Akhwat</h3>
            </div>
            <div class="panel-body">
                <div id="chart-jml-pendaftar"></div>
                <div class="text-left">
                    <strong>Total Pendaftar : <?=($male_count+$female_count)?></strong>
                </div>
                <div class="text-right">
                    <a href="<?=  base_url().'admin/lihat/'?>">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Pendaftar Yang belum melengkapi</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-striped table-bordered table-condensed table-responsive" id="tabel_utama">
                        <thead>
                            <tr>
                                <td>
                                    ID
                                </td>
                                <td>
                                    Nama
                                </td>
                                <td>
                                    I/A
                                </td>
                                <td>
                                    CP
                                </td>
                                <td>
                                    Kekurangan
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <a class="btn btn-primary" href="<?=  base_url()?>admin/export_data_uncomplete">
                        Download Data
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-red">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Pendaftar Yang belum melengkapi</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-striped table-bordered table-condensed table-responsive" id="tabel_unpaid">
                        <thead>
                            <tr>
                                <td>
                                    ID
                                </td>
                                <td>
                                    Nama
                                </td>
                                <td>
                                    I/A
                                </td>
                                <td>
                                    CP
                                </td>
                                <td>
                                    Kekurangan
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <a class="btn btn-primary" href="<?=  base_url()?>admin/export_data_unpaid/">
                        Download Data
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- JS -->
<script src="<?=  base_url() ?>assets/js/plugins/morris/raphael.min.js"></script>
<script src="<?=  base_url() ?>assets/js/plugins/morris/morris.js"></script>
<script>
    // Donut Chart
    

var table;

$(document).ready(function() {
    
    Morris.Donut({
        element: 'chart-jml-pendaftar',
        data: [
            {label: "Ikhwan", value: <?php echo $male_count;?>},
            {label: "Akhwat", value: <?php echo $female_count;?>}
        ]
    });
    
    //datatables
    table = $('#tabel_utama').DataTable({ 

        "order": [[ 0, "desc" ]], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/uncomplete_ajax/')?>",
            "type": "POST"
        }

    });
    
    table = $('#tabel_unpaid').DataTable({ 

        "order": [[ 0, "desc" ]], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/uncomplete_ajax/unpaid/')?>",
            "type": "POST"
        }

    });

});

</script>