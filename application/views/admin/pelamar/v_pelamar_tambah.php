<?php echo $this->session->flashdata("pesan"); ?>


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Form Tambah Pelamar</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_pelamar/tambah_proses");?>" >
					
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Pelamar</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nama_alternatif" placeholder="Nama Pelamar..." required="">
							</div>														
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama rekrutmen</label>
							<div class="col-sm-10">
								<select class="form-control" id="kode" name="id_rekrutmen" required="">
									<?php 
										foreach ($tampil as $row) {
											echo "<option value='$row->id_rekrutmen'>$row->nama_rekrutmen</option>";
										}
									?></select>
							</div>							
						</div>

						<div class="form-group">							
							<label class="col-sm-2 control-label">Posisi Jabatan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="posjab" placeholder="Posisi Jabatan yang dipilih...">
							</div>								
						</div>

						<div class="form-group">							
							<label class="col-sm-2 control-label">Telp</label>
							<div class="col-sm-10">
								<input type="text" minlength="9" maxlength="13" onkeypress="return hanyaAngka(event)" class="form-control" name="telp" placeholder="No telp/ no hp..." required="">
							</div>								
						</div>

						<div class="form-group">							
							<label class="col-sm-2 control-label">Tempat Lahir</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir...">
							</div>								
						</div>
						<div class="form-group">							
							<label class="col-sm-2 control-label">Tanggal lahir</label>
							<div class="col-sm-10">								
								<input type="text" class="form-control" id="datepicker" name="tgl_lahir" placeholder="Tanggal Lahir..." required="">
							</div>								
						</div>
						<div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="alamat"  placeholder="alamat..." rows="3" required=""></textarea>
                            </div>
                        </div>

						<div class="form-group">							
							<label class="col-sm-2 control-label">Sekolah Asal</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="universitas" placeholder="Sekolah Asal...">
							</div>								
						</div>

						<div class="form-group">
							<button type="submit"  class="btn btn-primary">Tambah</button>
							<button type="reset" class="btn btn-default">Reset</button>
						</div>
						
					</div>
					
				</form>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->


<script>
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

  return false;
  return true;
}
</script>
