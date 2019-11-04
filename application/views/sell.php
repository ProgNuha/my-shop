<div class="container-fluid">
    <div class="row">
        <form action="<?php echo site_url('selling/displayReceipt'); ?>" method="post">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-label-group">
                        <input type="text" name="name" class="form-control" placeholder="Nama" required="required" autofocus="autofocus">
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
                        <input type="text" name="nohp" class="form-control" placeholder="No HP" required="required" autofocus="autofocus">
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
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required="required" autofocus="autofocus">
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
                        <input type="text" name="kota" class="form-control" placeholder="Kota" required="required" autofocus="autofocus">
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
                        <input type="text" name="kodepos" class="form-control" placeholder="Kode Pos" required="required" autofocus="autofocus">
                        <label for="kodepos">Kode Pos</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kota Tujuan</label>
                <select name="kotatujuan" id="kotatujuan">
                <?php foreach ($kota as $item){?>
                <option value="<?php echo $item->city_id ?>"><?php echo $item->city_name ?> </option>
                <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>