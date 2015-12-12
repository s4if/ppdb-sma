<a class="btn btn-sm btn-success" href="<?=base_url();?>admin/registrant/<?=$registrant['id'];?>">
    <span class="glyphicon glyphicon-chevron-right"></span>
</a>
<a id="btnDelRegistrant<?=$registrant['id'];?>" class="btn btn-sm btn-danger">
    <span class="glyphicon glyphicon-remove"></span>
</a>
<script type="text/javascript">
    $("#btnDelRegistrant<?=$registrant['id'];?>").click(function (){
        $("#btnDelOk").attr("href", "<?=base_url().'admin/hapus_registrant/'.$registrant['id'];?>");
        $("#deleteRegistrant").modal("toggle");
    });
</script>