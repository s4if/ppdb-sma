<?php

/* 
 * The MIT License
 *
 * Copyright 2016 s4if.
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
    <small>Beranda</small>
</h1>
<ol class="breadcrumb">
    <li class="active">
        Beranda
    </li>
</ol>
<div class="jumbotron">
    <?php if($registrant->getFinalized()) :?>
    <h1>Selamat, anda telah menyelesaikan pendaftaran!</h1>
    <p>
        Terimakasih telah mendaftar di SMAIT Ihsanul Fikri.<br/>
        Tes akan dilaksanakan tanggal 20 Februari 2016<br/>
        Hasil tes akan diumumkan tanggal 27 Februari 2016<br/>
        Stay Tuned! <small>Yang kurang Kartu Pendaftaran... T.T</small>
    </p>
    <?php elseif(is_null($registrant->getPaymentData())) :?>
    <h1>Selamat Datang di Sistem PPDB SMAIT Ihsanul Fikri Mungkid</h1>
    <p>
        Ini adalah sistem pendaftaran peserta didik baru (PPDB) SMAIT Ihsanul Fikri Mungkid.
        Sebelum anda mengisi data pribadi, silahkan membayar dulu biaya pendaftaran peserta 
        sebesar <strong>Rp. 250.000,-</strong> ditambah nomor unik (Contoh = 250.123) di rekening 
        BNI Syariah dengan No. xxxx atas nama xxx.
        <br /> Kode unik bisa diminta dengan mengeklik tombol :
    </p>
    <p><a class="btn btn-primary" id="btn-gen" role="button" onclick="kodeUnik()">Minta kode unik</a></p>
    <h1 id="kode-unik"></h1>
    <hr />
    <p>
        Setelah transfer selesai, upload hasil scan / foto kuitansi pembayaran untuk diferifikasi
        oleh panitia pada tombol dibawah ini.
    </p>
    <a class="btn btn-warning" data-toggle="modal" data-target="#uploadKwitansi" id="btn-kwitansi" disabled="true">
        <span class="glyphicon glyphicon-upload"></span>
        Upload Kwitansi
    </a>
    <?php else :?>
    <h1>Selamat, Anda telah menyelesaikan tahap pertama!</h1>
    <p>
        Terimakasih anda telah membayar biaya pembayaran. Silahkan anda bisa mengisi data
        dan menyelesaikan pendaftaran dengan mengeklik tombol dibawah :
    </p>
    <a class="btn btn-success" href="<?=  base_url().$id.'/formulir'?>">Isi data</a>
    <?php endif;?>
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
                            <input type="text" required="true" name="amount" class="form-control" 
                                   pattern="^[1-9]([0-9]{1,20}$)" title="Hanya angka!"
                                   placeholder="Jumlah" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal Pembayaran :</label>
                        <div class="col-sm-6">
                            <input class="form-control datepicker" type="text" required="true" 
                                   data-date-format="dd-mm-yyyy" name="payment_date" value="<?= date('d-m-Y')?>">
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
function kodeUnik()
{
    $('#btn-gen').text('meminta...'); //change button text
    $('#btn-gen').attr('disabled',true); //set button disable 
    var url;

    url = '<?php echo base_url().'pendaftar/generate_kodeunik/'.$id.'/'.$registrant->getGender();?>';

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#alert-div').append('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Kode unik berhasil dibuat</p>'+
                    '</div>'
                );
                $('#kode-unik').text(data.kode);
                $('#btn-gen').text('Berhasil');
                $('#btn-kwitansi').attr('disabled', false);
            }
            else
            {
                $('#alert-div').append('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Permintaan kode unik gagal</p>'+
                    '</div>');
                $('#btn-ok').attr('disabled',false); //set button enable
                $('#btn-gen').text('Gagal'); //change button text
            }
            
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btn-gen').text('Minta Kode Unik'); //change button text
            $('#btn-gen').attr('disabled',false); //set button enable 

        }
    });
}
</script>