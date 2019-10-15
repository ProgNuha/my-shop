<div class="container">
  <div class="row text-center mt-3">
    
  <?php foreach ($goods as $good) : ?>
      <div class="col-3">
        <div class="card mt-4">
        <img src="<?php echo base_url().$good->filepath?>" class="card-img-top" alt="image" height="200" width="2x00">
        <div class="card-body">
          <?php
            echo form_open(base_url('cart/add_to_cart'));
          ?>
            <h5 class="card-title">
            <span class="center">
                <?php echo $good->name?></h5>
            </span>
            <span class="badge badge-pill badge-success mb-3"> <?php echo number_format($good->price)?> </span><br>
            <a href="" class="btn btn-success">Detail</a>
            <button class="btn btn-primary add_cart" type="submit" value="submit"
            data-produkid="<?php echo $good->code;?>" data-produknama="<?php echo $good->name;?>" data-produkharga="<?php echo $good->price;?>">
              +<i class="fas fa-shopping-cart"></i>
            </button>
        </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.4.1.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var produk_id    = $(this).data("produkid");
            var produk_nama  = $(this).data("produknama");
            var produk_harga = $(this).data("produkharga");
            var quantity     = 1;
            $.ajax({
                url : "<?php echo base_url();?>index.php/cart/add_to_cart",
                method : "POST",
                data : {produk_id: produk_id, produk_nama: produk_nama, produk_harga: produk_harga, quantity: quantity},
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url();?>index.php/cart/load_cart");

        //Hapus Item Cart
        $(document).on('click','.delete_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url();?>cart/delete_cart",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        //Add buyer form
        $('#buyer_form').load("<?php echo base_url();?>index.php/cart/buyer_form");
        
    });
</script>
