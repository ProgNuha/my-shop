
<div class="container-fluid">
    <div class="row">
        <table class="table table-borderless">
            <!-- <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Kota Tujuan</th>
                    <th>Alamat</th>
                    <th>Kode Pos</th> 
                    <th>Total</th> 
                </tr>
            </thead> -->
            <tbody>
            
            <?php foreach ($pembeli as $key => $pembeliItem){?>
            <tr>
            <td><?php echo $key?></td>
            <td><?php echo $pembeliItem?></td>
            </tr>    
            <?php }?>
            <tr>
            <td>Ongkos Kirim</td>
            <td><?php echo $ongkir?></td>
            </tr>
            <tr>
            <td>Total</td>
            <td><?php echo $ongkir+$pembeli['total']?></td>
            </tr>                                                                             
            </tbody>           
        </table>   
        <form action="<?php echo site_url('selling/checkout_submit') ?>" method="post">
        <?php foreach ($pembeli as $key => $pembeliItem){?>
            <input type="hidden" name="<?php echo $key?>" value='<?php echo $pembeliItem ?>'>
        <?php }?>
        <input type="hidden" name="total" value='<?php echo $ongkir+$pembeli['total']?>'>
        <button type="submit" class='btn btn-primary'>Check Out</button>
        
        </form>
    </div>
</div>