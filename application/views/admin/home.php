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
                <div style="max-height: 400px">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <td>
                                    ID
                                </td>
                                <td>
                                    Nama
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
                            <?php foreach ($data_registrant as $registrant) : ?>
                            <?php if(!$registrant['completed']) : ?>
                            <tr>
                                <td> <?= $registrant['id'];?></td>
                                <td> <?=$registrant['name'];?> </td>
                                <td> <?=$registrant['cp'];?> </td>
                                <td> <?=$registrant['status'];?> </td>
                            </tr>
                            <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
    jQuery.ready(
    Morris.Donut({
        element: 'chart-jml-pendaftar',
        data: [
            {label: "Ikhwan", value: <?php echo $male_count;?>},
            {label: "Akhwat", value: <?php echo $female_count;?>}
        ]
    })
    );
</script>