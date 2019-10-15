<div class="container-fluid">
    <div class="col-md-4"  id="insert">
        <a type="button" href="<?php echo base_url();?>index.php/selling/show" class="btn btn-primary" type="submit" value="submit">Cek Status</a>
        <a type="button" href="<?php echo base_url();?>index.php/sell/insert" class="btn btn-primary insert_selling" type="submit" value="submit">Record</a>
    </div>
    
</div>





<script type="text/javascript">
    $('#insert').load("<?php echo base_url();?>index.php/selling/insert");
</script>