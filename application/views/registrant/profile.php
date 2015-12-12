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
    Pendaftar
    <small>Profil</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url().'/'.$id;?>/beranda/">Beranda</a>
    </li>
    <li class="active">
        Profil
    </li>
</ol>
<style>
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
<div class="container-fluid">
    <div class="row">
    <div class="col-md-2">
        <img class="foto-profil img-rounded" src="<?=$img_link;?>" alt="foto-profil">
    </div>
    <div class="col-md-8">
        <table>
        <tr>
            <td> Nomor Pendaftaran </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-id"> <?=$registrant->getId();?> </td>
        </tr>
        <tr>
            <td> Nama </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-name"> <?=$registrant->getName();?> </td>
        </tr>
        <tr>
            <td> Sekolah Asal </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-prevschool"> <?=$registrant->getPreviousSchool()?> </td>
        </tr>
        <tr>
            <td> Jenis Kelamin </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-gender"> <?=($registrant->getGender() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
        </tr>
        <tr>
            <td> NISN </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-nisn"> <?=$registrant->getNisn()?> </td>
        </tr>
        <tr>
            <td> Email / No. HP </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-cp"> <?=$registrant->getCp()?> </td>
        </tr>
        <tr>
            <td> Program </td>
            <td> &nbsp;:&nbsp; </td>
            <td id="reg-program"> <?=$registrant->getProgram()?> </td>
        </tr>
        <tr>
            <td colspan="3">
                <a class="btn btn-primary btn-sm <?php echo ($registrant->getFinalized())?'disabled':'';?>" data-toggle="modal" data-target="#editProfil" >
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit Profil
                </a>
                <a class="btn btn-sm btn-info <?php echo ($registrant->getFinalized())?'disabled':'';?>" data-toggle="modal" data-target="#ModalImport">
                    <span class="glyphicon glyphicon-upload"></span>
                    Upload Foto
                </a>
            </td>
        </tr>
    </table>
    </div>
    &nbsp;
</div>
    <div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="editProfil" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Pendaftar</h4>
            </div>
            <div class="modal-body">
    <form class="form-horizontal form-profil" role="form" method="post" action="#">
        <div class="form-group">
            <label class="col-sm-3 control-label">Nama :</label>
            <div class="col-sm-8">
                <input type="text" required="true" name="name" id="name" tabindex="1" class="form-control" placeholder="Nama" value="<?=$registrant->getName();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sekolah Asal :</label>
            <div class="col-sm-8">
                <input type="text" required="true" name="prev_school" id="prev_school" tabindex="1" class="form-control" placeholder="Sekolah Asal" value="<?=$registrant->getPreviousSchool();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">NISN :</label>
            <div class="col-sm-8">
                <input type="text" name="nisn" id="nisn" tabindex="1" class="form-control" placeholder="NISN" value="<?=$registrant->getNisn();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Email/No.Hp :</label>
            <div class="col-sm-8">
                <input type="text" name="cp" id="cp" tabindex="1" class="form-control" placeholder="Email" value="<?=$registrant->getCp();?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label ">Program :</label>
            <div class="col-sm-8">
                <select class="form-control" name="program" >
                    <option value="reguler"  
                        <?php if(!empty($registrant->getProgram())):?>
                            <?php if($registrant->getProgram()=='reguler'): ?>
                                    selected="true"
                            <?php endif;?>
                        <?php endif;?>>
                        Reguler
                    </option>
                    <option value="tahfidz"  
                        <?php if(!empty($registrant->getProgram())):?>
                            <?php if($registrant->getProgram()=='tahfidz'): ?>
                                    selected="true"
                            <?php endif;?>
                        <?php endif;?>>
                        Tahfidz
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
                <button type="button" id="btn-ok" onclick="aksiOk()" class="btn btn-primary">OK</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <h3 class="col-md-12">Status</h3>
        <div class="col-md-12">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <td>
                            No.
                        </td>
                        <td>
                            Data
                        </td>
                        <td>
                            Status
                        </td>
                        <td>
                            Aksi
                        </td>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Data Pendaftar
                        </td>
                        <td>
                            <?php echo ($status ['data'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary <?php echo ($registrant->getFinalized())?'disabled':'';?>" href="<?=base_url().$id;?>/detail/"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Foto Pendaftaran
                        </td>
                        <td>
                            <?php echo ($status ['foto'] > 0)?
                            'Sudah Diunggah <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Diunggah <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-info <?php echo ($registrant->getFinalized())?'disabled':'';?>" data-toggle="modal" data-target="#ModalImport">
                                <span class="glyphicon glyphicon-upload"></span>
                                Upload Foto
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Data Ayah
                        </td>
                        <td>
                            <?php echo ($status ['father'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary <?php echo ($registrant->getFinalized())?'disabled':'';?>" href="<?=base_url().$id;?>/data/father/"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            Data Ibu
                        </td>
                        <td>
                            <?php echo ($status ['mother'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                           <a class="btn btn-xs btn-primary <?php echo ($registrant->getFinalized())?'disabled':'';?>" href="<?=base_url().$id;?>/data/father/"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5
                        </td>
                        <td>
                            Data Wali (Hanya yang bersama Wali)
                        </td>
                        <td>
                            <?php echo ($status ['guardian'] > 0)?
                            'Sudah Lengkap <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Dilengkapi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                          <a class="btn btn-xs btn-primary <?php echo ($registrant->getFinalized())?'disabled':'';?>" href="<?=base_url().$id;?>/data/father/"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            6
                        </td>
                        <td>
                            Mengisi Surat Pernyataan
                        </td>
                        <td>
                            <?php echo ($registrant->getCompleted())?
                            'Sudah Diisi <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Diisi <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        <td>
                          <a class="btn btn-xs btn-primary <?php echo ($registrant->getFinalized())?'disabled':'';?>" href="<?=base_url().$id;?>/surat/"><span class="glyphicon glyphicon-edit">Edit</a>
                        </td>
                    </tr>
<!--                    <tr> Dibatalkan karena skemanya berbeda
                        <td>
                            7
                        </td>
                        <td>
                            Kuitansi Pembayaran
                        </td>
                        <td>
                            <? php 
                            switch ($status ['payment']) :
                            case -1: echo 'File yang diupload salah <span class="glyphicon glyphicon-alert"></span>'; break;
                            case 0: echo 'Belum Diupload <span class="glyphicon glyphicon-remove-sign"></span>'; break;
                            case 1: echo 'Menunggu Verifikasi <span class="glyphicon glyphicon-refresh"></span>'; break;
                            case 2: echo 'Sudah Diverifikasi <span class="glyphicon glyphicon-ok-sign"></span>'; break;
                            endswitch;
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#uploadKwitansi">
                                <span class="glyphicon glyphicon-upload"></span>
                                Upload Kwitansi
                            </a>
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                            7
                        </td>
                        <td>
                            Finalisasi Data
                        </td>
                        <td>
                            <?php echo ($registrant->getFinalized())?
                            'Sudah Finalisasi Data <span class="glyphicon glyphicon-ok-sign"></span>'
                            :'Belum Finalisasi Data <span class="glyphicon glyphicon-remove-sign"></span>';?>
                        </td>
                        
                        <td>
                            <a class="btn btn-xs btn-warning <?php echo ($registrant->getCompleted() && $foto_uploaded)?'':'disabled';?>" data-toggle="modal" data-target="#ModalFinalized">
                                <span class="glyphicon glyphicon-registration-mark"></span>
                                Finalisasi
                            </a>
                        </td>
                    </tr>
                    <?php if ($registrant->getFinalized()) :?>
                    <tr>
                        <td colspan="4">
                            <a class="btn btn-lg btn-success" href="<?=  base_url().'pendaftar/print_data_pendaftaran/'.$id;?>" download="Berkas Pendaftaran <?php $id?>.pdf">Download Berkas Pendaftaran</a>
                        </td>
                    </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if(!empty($img_receipt)):?>
    <div class="row">
        <h3>Kwitansi Pembayaran</h3>
    </div>
    <div class="row">
        <img class="foto-kwitansi img-rounded" src="<?=$img_receipt;?>" alt="foto-profil">
    </div>
    <?php endif;?>
</div>

<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=base_url();?>pendaftar/upload_foto/<?=$registrant->getId()?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>File berupa Foto Berwarna degan proporsi 4x3</label>
                        <input type="file" id="file" name="file" required="true">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalFinalized" tabindex="-1" role="dialog" aria-labelledby="ModalFinalized" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalFinalizedLabel>">Finalisasi Data</h4>
            </div>
            <div class="modal-body">
                <h3 style="align-content: center"><span class=" glyphicon glyphicon-warning-sign"></span></h3>
                <p>
                    Finalisasi data akan menyebabkan Anda tidak bisa lagi <strong>mengubah</strong> data yang anda masukkan! <br/>
                    Apakah anda yakin Untuk melakukan Finalisasi data?
                </p>
                <a href="<?=  base_url().'pendaftar/finalisasi/'.$id.'/true'?>" class="btn btn-primary">OK</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadKwitansi" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" class="form-horizontal" action="<?=base_url();?>pendaftar/upload_receipt/<?=$registrant->getId()?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <label>File berupa Hasil Scan atau Foto dari Kwitansi Pembayaran</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-4">
                            <input type="file" id="file" name="file" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Jumlah :</label>
                        <div class="col-sm-6">
                            <input type="text" required="true" name="amount" class="form-control" placeholder="Jumlah" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal Pembayaran :</label>
                        <div class="col-sm-6">
                            <input class="form-control datepicker" type="text" required="true" 
                                   data-date-format="dd-mm-yyyy" name="payment_date" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-upload">&nbsp;Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function aksiOk()
{
    $('#btn-ok').text('saving...'); //change button text
    $('#btn-ok').attr('disabled',true); //set button disable 
    var url;

    url = '<?php echo base_url().'pendaftar/ajax_edit_profil/'.$id;?>';

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('.form-profil').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#alert-div').append('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Edit Data Profil Berhasil</p>'+
                    '</div>'
                );
                $('#reg-id').text(data.profile.id);
                $('#reg-name').text(data.profile.name);
                $('#uname').text(data.profile.name);
                $('#reg-gender').text(data.profile.gender);
                $('#reg-prevschool').text(data.profile.prev_school);
                $('#reg-nisn').text(data.profile.nisn);
                $('#reg-cp').text(data.profile.cp);
                $('#reg-program').text(data.profile.program);
                $("#editProfil").modal('hide');
                
            }
            else
            {
                $('#alert-div').append('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Maaf Penyimpanan Data Gagal</p>'+
                    '</div>');
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
                $("#editProfil").modal('hide');
            }
            $('#btn-ok').text('save'); //change button text
            $('#btn-ok').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btn-ok').text('save'); //change button text
            $('#btn-ok').attr('disabled',false); //set button enable 

        }
    });
}
</script>