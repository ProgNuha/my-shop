<div class="container-fluid">
    <div class="col-md-4">
    <h4>Shopping Cart</h4>
    <table class="table table-striped">
        <thead>
            <tr class="align-content-center">
                <th>Produk</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>
                    <button type="button" class="destroy_cart btn btn-danger btn-xs">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody id="detail_cart">
            
        </tbody>
            
    </table>

    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#buyer-form">
        Checkout
    </button>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="buyer-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pembeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <form <?php echo form_open(base_url('selling/insert'));?> method="post">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-label-group">
                                <input type="text" id="name" class="form-control" placeholder="Nama" required="required" autofocus="autofocus">
                                <label for="nama">Nama</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-label-group">
                                <input type="text" id="nohp" class="form-control" placeholder="No HP" required="required" autofocus="autofocus">
                                <label for="nohp">No HP</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-label-group">
                                <input type="text" id="alamat" class="form-control" placeholder="Alamat" required="required" autofocus="autofocus">
                                <label for="alamat">Alamat</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-label-group">
                                <input type="text" id="kota" class="form-control" placeholder="Kota" required="required" autofocus="autofocus">
                                <label for="kota">Kota</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-label-group">
                                <input type="text" id="kodepos" class="form-control" placeholder="Kode Pos" required="required" autofocus="autofocus">
                                <label for="kodepos">Kode Pos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" href="<?php echo base_url();?>index.php/selling/insert" class="btn btn-primary insert_selling" type="submit" value="submit">Save</a>
                <!-- <a type="button" href="index.php/sell/insert" class="btn btn-primary insert_selling" type="submit" value="submit">Save</a> -->
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.4.1.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url();?>index.php/cart/load_cart");

        //Delete Item Cart
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

        //Destrpoy Cart
        $(document).on('click','.destroy_cart',function(){
            $.ajax({
                url : "<?php echo base_url();?>cart/destroy_cart",
                method : "POST",
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>