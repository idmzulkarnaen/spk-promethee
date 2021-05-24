<?php echo $this->session->flashdata("pesan"); ?>
<?php foreach ($tampilkan as $row) {
        $nama=$row->nama_admin;
        $username=$row->username;
    }

?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">ubah akun</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_auth/sua_proses");?>" >
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" required="">
                            </div>                          
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required="">
                            </div>                          
                        </div>

                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            
                        </div>
                    </form>                        
                </div>    
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Ubah Password</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_auth/sup_proses");?>" >
                    
                        


                        <div class="form-group">
                            <label class="col-sm-2 control-label">password lama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pwdlama"  required="">
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password baru</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pwdbaru"  required="">
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ulangi password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pwdulangi"  required="">
                            </div>                          
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                            
                        </div>
                    </form>                        
                </div>    
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
