<div class="container-fluid">
    <div class="col-md-4"  id="insert">
    <h4>Status</h4>
    <table class="table table-striped">
        <thead>
            <tr class="align-content-center">
                <th>No Trx</th>
                <th>Tgl</th>
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
                <td><?php echo $stat->status?></td>
                <td>
                    <?php if ($stat->status == 'Belum bayar'){ ?>
                            <form action="<?php echo site_url('Selling/setStatus') ?> " method="post">
                                <input type="hidden" name="code" value="<?php echo $stat->code; ?>">
                                <input type="hidden" name="status" value="Sudah bayar">
                                <button type="submit" class = "btn btn-primary">Bayar</button>
                            </form>

                        <?php 
                            
                        }else if ($stat->status == 'Sudah bayar'){ ?>

                        <form action="<?php echo site_url('Selling/setStatus') ?> " method="post">
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




