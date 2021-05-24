<?php echo $this->session->flashdata("pesan"); ?>

<?php foreach ($tampil as $row) {     
         $id_rekrutmen 	= $row->id_rekrutmen;  
		 $nama_rekrutmen 	= $row->nama_rekrutmen;
		 $tanggal 		= $row->tanggal;
		 $keterangan 	= $row->keterangan; 
		 $kode 			= $row->kode; 
		 $kuota			= $row->kuota; 
} ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Form Ubah Jabatan</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<form role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_rekrutmen/ubah_proses");?>" >
					
						<div class="form-group">
							<label class="col-sm-2 control-label">Kode</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="kode" 
								value="<?php 
								if(isset($kode)){
									echo $kode;
								}?>" 
								placeholder="Kode Jabatan..." >
							</div>							
						</div>

						<div class="form-group">							
							<div class="col-sm-10">
								<input type="hidden" style="width: 400px" class="form-control" name="id_rekrutmen" value="<?php 
								if(isset($id_rekrutmen)){
									echo $id_rekrutmen;
								}?>" required>
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nama_rekrutmen"
								value="<?php 
								if(isset($nama_rekrutmen)){
									echo $nama_rekrutmen;
								}?>"
								placeholder="Nama Rekrutmen..." required>
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal</label>
							<div class="col-sm-10">
								<input type="text" id="datepicker" class="form-control" name="tanggal"
								value="<?php 
								if(isset($tanggal)){
									echo $tanggal;
								}?>" 
								placeholder="tanggal..." required>
							</div>							
						</div>

						<div class="form-group">
                            <label class="col-sm-2 control-label">Kuota</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" min="1" max="100" name="kuota" placeholder="Jumlah orang yang dibutuhkan..." required value="<?php
                                if(isset($kuota)){
									echo $kuota;
								}?>">
                            </div>                          
                        </div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Keterangan</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="keterangan"    placeholder="keterangan..." rows="3"><?php  
									if (isset($keterangan)) {
									    echo trim($keterangan);    
									}else{

									}
								?></textarea>
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
		