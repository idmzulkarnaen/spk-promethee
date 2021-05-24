<?php echo $this->session->flashdata("pesan"); ?>
<?php foreach ($tampil as $row) : ?>     
        <?php $id_alternatif= $row->id_alternatif; ?>
        <?php $id_rekrutmen= $row->id_rekrutmen; ?>
        <?php $nama_alternatif= $row->nama_alternatif; ?>
        <?php $universitas= $row->universitas; ?>
        <?php $tempat_lahir= $row->tempat_lahir; ?>
        <?php $tgl_lahir= $row->tgl_lahir; ?>
        <?php $posjab= $row->posjab; ?>
        <?php $alamat= $row->alamat; ?>
        <?php $telp= $row->telp; ?>
<?php endforeach; ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Form Tambah Pelamar</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_pelamar/ubah_proses");?>" >
					
						<div class="form-group">
							
							<div class="col-sm-10">
								<input type="hidden" class="form-control" name="id_alternatif" value="<?=$id_alternatif ?>">
							</div>							
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Pelamar</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nama_alternatif" 
								value="<?php 
								if(isset($nama_alternatif)){
									echo $nama_alternatif;
								}?>" placeholder="Nama Pelamar...">
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Rekrutmen</label>
							<div class="col-sm-10">
								<select class="form-control" id="kode" name="id_rekrutmen" required="">
									<?php 
										foreach ($rrekrutmen as $row) {
											echo "<option ";
											if ( $id_rekrutmen == $row->id_rekrutmen) echo "selected";
											echo " value='$row->id_rekrutmen'>$row->nama_rekrutmen</option>";
										}
									?></select>
							</div>							
						</div>
						<div class="form-group">							
							<label class="col-sm-2 control-label">Posisi Jabatan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="posjab" 
								value="<?php 
								if(isset($posjab)){
									echo $posjab;
								}?>" 
								placeholder="Posisi Jabatan yang dipilih...">
							</div>								
						</div>

						<div class="form-group">							
							<label class="col-sm-2 control-label">Telp</label>
							<div class="col-sm-10">
								<input type="text" maxlength="13" onkeypress="return hanyaAngka(event)" class="form-control" name="telp" placeholder="No telp/ no hp..." value="<?php 
								if(isset($telp)){
									echo $telp;
								}?>">
							</div>								
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat Lahir</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="tempat_lahir" 
								value="<?php 
								if(isset($tempat_lahir)){
									echo $tempat_lahir;
								}?>" >
							</div>							
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal Lahir</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="datepicker" name="tgl_lahir" 
								value="<?php 
								if(isset($tgl_lahir)){
									echo $tgl_lahir;
								}?>" >
							</div>							
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Alamat</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="alamat"    placeholder="alamat..." rows="3"><?php  
									if (isset($alamat)) {
									    echo trim($alamat);    
									}else{

									}
								?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Sekolah Asal</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="universitas" 
								value="<?php 
								if(isset($universitas)){
									echo $universitas;
								}?>" placeholder="Sekolah Asal...">
							</div>							
						</div>

						

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Ubah</button>
							
						</div>
					</form>	
				</div>		
			</div>
		</div>
	</div>
</div>
<script>
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}
</script>