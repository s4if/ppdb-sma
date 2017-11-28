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
            <label class="col-sm-4 control-label"> <?=$mapel_name;?> (KKM) :</label>
            <div class="col-sm-3">
                <input type="number" required name="kkm_<?=$kode;?>_<?=$i;?>" class="form-control" placeholder="kkm" value="">
            </div>
            <div class="col-sm-1"><b>Nilai :</b></div>
            <div class="col-sm-3">
                <input type="number" required name="nilai_<?=$kode;?>_<?=$i;?>" class="form-control" placeholder="nilai" value="">
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

<script type="text/javascript">
    $(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".wrapper"); //Fields wrapper
        var point_acv       = $(".insert_acv"); //Fields wrapper
        var add_btn_acv  = $(".add_btn_acv"); //Add button ID

        var id_acv = 1;
        var x_acv = 1; //initlal text box count
        $(add_btn_acv).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_acv < max_fields){ //max input box allowed
                x_acv++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required name="achievements[]" class="form-control" placeholder="Prestasi" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
                    '<a class="remove_btn_acv btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_acv).before(inpt);
                id_acv++;
            }
        });

        $(wrapper).on("click",".remove_btn_acv", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_acv--;
        });
        
        //Hobby
        var point_hby       = $(".insert_hby"); //Fields wrapper
        var add_btn_hby  = $(".add_btn_hby"); //Add button ID

        var id_hby = 1;
        var x_hby = 1; //initlal text box count
        $(add_btn_hby).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_hby < max_fields){ //max input box allowed
                x_hby++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required name="hobbies[]" class="form-control" placeholder="Masukkan Hobi" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
                    '<a class="remove_btn_hby btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_hby).before(inpt);
                id_hby++;
            }
        });

        $(wrapper).on("click",".remove_btn_hby", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_hby--;
        });
        
        //Hospital Sheets
        var point_hs       = $(".insert_hs"); //Fields wrapper
        var add_btn_hs  = $(".add_btn_hs"); //Add button ID

        var id_hs = 1;
        var x_hs = 1; //initlal text box count
        $(add_btn_hs).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_hs < max_fields){ //max input box allowed
                x_hs++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required name="hospital_sheets[]" class="form-control" placeholder="Masukkan Riwayat Penyakit" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
                    '<a class="remove_btn_hs btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_hs).before(inpt);
                id_hs++;
            }
        });

        $(wrapper).on("click",".remove_btn_hs", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_hs--;
        });
        
        //Physical Abnormalities
        var point_pa       = $(".insert_pa"); //Fields wrapper
        var add_btn_pa  = $(".add_btn_pa"); //Add button ID

        var id_pa = 1;
        var x_pa = 1; //initlal text box count
        $(add_btn_pa).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_pa < max_fields){ //max input box allowed
                x_pa++; //text box increment
                var inpt = '<div class="form-group">'+
                    '<div class="col-sm-offset-4 col-sm-4">'+
                    '<input type="text" required name="physical_abnormalities[]" class="form-control" placeholder="Kelainan Jasmani" value="">'+
                    '</div>'+
                    '<div class="col-sm-4">'+
                    '<a class="remove_btn_pa btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>'+
                    '</div>'+
                    '</div>';
                $(point_pa).before(inpt);
                id_pa++;
            }
        });

        $(wrapper).on("click",".remove_btn_pa", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); x_pa--;
        });
        
    });
function save()
{
    $('.form-group').removeClass('has-error'); // clear error class
    $('.btn-save').text('Menyimpan...'); //change button text
    $('.btn-save').attr('disabled',true); //set button disable 
    var url;

    url = '<?php echo base_url().'pendaftar/ajax_edit_all/'.$id;?>';

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('.form-data').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#alert-div').empty();
                $('#alert-div').append('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Data Berhasil Disimpan</p>'+
                    '</div>'
                );
                $('.btn-next').removeClass('hidden');
                btnNext = $('.btn-next');
                $('.insert-lanjut').after(btnNext[0]);
                $('#modal-alert-success').modal('toggle');
            }
            else
            {
                $('#alert-div').empty();
                $('#alert-div').append('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert"><p>'+
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                    'Close</span></button>'+
                    '<p>Maaf Penyimpanan Data Gagal</p>'+
                    '</div>');
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
//                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
                $('#modal-alert-failed').modal('toggle');
            }
            $('.btn-save').text('Simpan'); //change button text
            $('.btn-save').prepend('<span class="glyphicon glyphicon-floppy-save">&nbsp;');
            $('.btn-save').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Maaf, Terjadi kesalahan! Silahkan cek kembali isian anda!');
            $('.btn-save').text('Simpan'); //change button text
            $('.btn-save').prepend('<span class="glyphicon glyphicon-floppy-save">&nbsp;');
            $('.btn-save').attr('disabled',false); //set button enable 

        }
    });
}
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

$(document).ready(function () {
<?php
$default = base_url().'assets/images/default.png';
if($default == $img_link){ ?>
    $('#ModalImport').modal('show');
<?php }?>
});
</script>
