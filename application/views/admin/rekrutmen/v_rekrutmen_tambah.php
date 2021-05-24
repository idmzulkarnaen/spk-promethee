<?php echo $this->session->flashdata("pesan"); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Form Tambah Rekrutmen</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_rekrutmen/tambah_proses");?>" >
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="10" class="form-control" name="kode" placeholder="Kode Jabatan (AMPU)..." required="">
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_rekrutmen" placeholder="Nama Rekrutmen (AMPU 2018)..." required="">
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="datepicker" name="tanggal" placeholder="Tanggal..." required>
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kuota</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" min="1" max="100" name="kuota" placeholder="Jumlah orang yang dibutuhkan..." required>
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan"   placeholder="keterangan..." rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </form>                        
                </div>    
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
