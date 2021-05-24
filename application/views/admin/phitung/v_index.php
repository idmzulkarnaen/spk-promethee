<?php echo $this->session->flashdata("pesan"); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Hitung dengan metode PROMETHEE</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_proses_hitung/tampilkan");?>" >
					
						

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Rekrutmen</label>
							<div class="col-sm-10">
								<select  class="form-control" id="tipe"  name="id_rekrutmen" required="">
									<?php 
										foreach ($tampil as $row) {
											echo "
											<option 
											value='$row->id_rekrutmen'>$row->nama_rekrutmen
											</option>";
										}
									?>
								</select>
							</div>							
						</div>


						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Tampilkan</button>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>	
</div>