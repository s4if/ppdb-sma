<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    strong.red {
        color: red;
        font-weight: bolder;
    }
    .foto-profil {
        resize: both;
        height: 100%;
        width: 100%;
        max-height: 200px;
        max-width: 150px;
    }
    .foto-kwitansi {
        resize: both;
        height: 100%;
        width: 100%;
        max-height: 800px;
        max-width: 600px;
    }
</style>
<h1 class="page-header">
    Pendaftar
    <small>Isi Nilai Rapor</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'/'.$id;?>/beranda/">Beranda</a>
    </li>
    <li class="active">
        Rapor
    </li>
</ol>
<div class="container-fluid">
    <h2>Silahkan Isi Data Rapor Pada Formulir Dibawah</h2>
    <div class="row">
    <form class="form-horizontal wrapper form-data" role="form" method="post" action="<?=base_url();?>/pendaftar/edit_rapor/<?=$id?>">
        <hr/>
        <?php for($i = 1; $i <=4; $i++): ?>
        <div class="form-group">
            <label class="control-label col-sm-4"><b>Semester <?php echo $i;?> </b></label>
        </div>
        <?php foreach ($nameset as $kode => $mapel_name) :?>
        <div class="form-group">
            <label class="col-sm-3 control-label"> <?=$mapel_name;?> (KKM) :</label>
            <div class="col-sm-3">
                <input type="number" required name="kkm_<?=$kode;?>_<?=$i;?>" class="form-control" placeholder="kkm" value="<?php echo $rapor->get($kode, 'kkm', $i);?>">
            </div>
            <div class="col-sm-2 control-label"><b>Nilai :</b></div>
            <div class="col-sm-3">
                <input type="number" required name="nilai_<?=$kode;?>_<?=$i;?>" class="form-control" placeholder="nilai" value="<?php echo $rapor->get($kode, 'nilai', $i);?>">
            </div>
        </div>
        <?php endforeach;?>
        <hr/>
        <?php endfor;?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-sm btn-primary">OK</button>
                <a class="btn btn-sm btn-warning" href="<?=base_url();?>home/">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</div>
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                 <h4 class="modal-title" id="memberModalLabel">Pendaftaran Hampir Selesai!</h4>

            </div>
            <div class="modal-body">
                <h3>Keterangan yang ditambahkan di pengisian raport</h3>
                <ul>
                    <li>Skala yang digunakan adalah skala <strong>1-100</strong></li>
                    <li>Yang diisi kedalam form ini adalah nilai Pengetahuan</li>
                    <li>Untuk nilai berskala 4 langsung di konversi ke skala 100 dengan cara dikalikan 25</li>
                    <li>Jika dalam raport tidak dituliskan KKM maka KKM diisikan 67 (Sesuai Standar Dinas)</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    $('#memberModal').modal('show');
});
</script>
