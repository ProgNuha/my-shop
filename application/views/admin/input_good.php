<div class="container-fluid">
    <button class="btn btn-sm btn-primary mt-4 mb-3" data-toggle="modal" data-target="#add_goods">
        <i class="fas fa-plus fa-sm"></i>
        Add Good
    </button>

    <table class="table table-bordered">
        <tr>
            <th>NO</th>
            <th>NAMA BARANG</th>
            <th>HARGA</th>
            <th>STOCK</th>
            <th>INFO</th>
            <th colspan="3">AKSI</th>
        </tr>

        <?php $no = 1?>
        <?php foreach ($goods as $good) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $good->name?></td>
            <td><?php echo number_format($good->price)?></td>
            <td><?php echo number_format($good->stock)?></td>
            <td><?php echo $good->info?></td>
            <td>
                <div class="btn btn-sm btn-success">
                <i class="fas fa-search-plus"></i>
                </div>
                <div class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
                </div>
                <div class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="add_goods" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Add Goods</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url().'admin/input_good/action'?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"> 
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price"> 
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock"> 
                    </div>
                    <div class="form-group">
                        <label>Info</label>
                        <input type="text" class="form-control" name="info"> 
                    </div>
                    <div class="form-group">
                        <label>Upload</label><br>
                        <input type="file" class="form-control" name="filepath"> 
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add good</button>
                </form>
            </div>
        </div>
    </div>
</div>