<div class="container-fluid">
    <div class="col-md-12"  id="insert">
    <h4>Data Penjualan</h4>
    <button type="submit" class = "btn btn-success">Export to Excel</button>
    <br>
    <!-- <button type="submit" class = "btn btn-success">Import</button> -->
    <table class="table table-striped">
        <thead>
            <tr class="align-content-center">
                <th>No Trx</th>
                <th>Tgl</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>No HP</th>
                <th>Total</th>
                <th>Status</th>
                <th>Set Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($status as $stat):
        ?>
            <tr>
                <td><?php echo $stat->code?></td>
                <td><?php echo $stat->date?></td>
                <td><?php echo $stat->name?></td>
                <td><?php echo $stat->address?></td>
                <td><?php echo $stat->city?></td>
                <td><?php echo $stat->nohp?></td>
                <td><?php echo $stat->total?></td>
                <td><?php echo $stat->status?></td>
                <td>
                    <?php if ($stat->status == 'Belum bayar'){ ?>
                            <form action="<?php echo site_url('admin/c_admin/setStatus') ?> " method="post">
                                <input type="hidden" name="code" value="<?php echo $stat->code; ?>">
                                <input type="hidden" name="status" value="Sudah bayar">
                                <button type="submit" class = "btn btn-primary">Bayar</button>
                            </form>

                        <?php 
                            
                        }else if ($stat->status == 'Sudah bayar'){ ?>

                        <form action="<?php echo site_url('admin/c_admin/setStatus') ?> " method="post">
                            <input type="hidden" name="code" value="<?php echo $stat->code;; ?>">
                            <input type="hidden" name="status" value="Sudah kirim">
                            <button type="submit"class = "btn btn-primary">Kirim</button>
                        </form>

                        <?php } ?>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
        
        </tbody>
    </table>
</div>




