<?php echo $this->session->flashdata("pesan"); ?>


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Form Tambah Kriteria</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_kriteria/tambah_proses");?>" >
					
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Kriteria</label>
							<div class="col-sm-10">
								<input type="text" style="width: 400px" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria..." required>
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">kaidah</label>
							<div class="col-sm-10">
								<select class="form-control" id="kode" style="width: 150px" name="min_max" required="">						
									<option value="max">Maksimal</option>
									<option value="min">Minimal</option>
										
								</select>
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Tipe Kriteria</label>
							<div class="col-sm-10">
								<select onchange="ubahtipe();" class="form-control" id="tipe" style="width: 150px" name="id_tipe_preferensi" required="">
									<?php 
										foreach ($tampil as $row) {
											echo "<option value='$row->id_tipe_preferensi'>$row->nama_tipe_preferensi</option>";
										}
									?>
								</select>
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Selisih parameter (Q)</label>
							<div class="col-sm-10">
								<input type="number" style="width: 400px" class="form-control" min="0" max="2000" id="q" name="q" step='any' disabled="">
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Selisih parameter (P)</label>
							<div class="col-sm-10">
								<input type="number" style="width: 400px" class="form-control" min="0" max="2000" id="p" name="p" step='any' disabled="">
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Gausian</label>
							<div class="col-sm-10">
								<input type="number" id="s" style="width: 400px" class="form-control" min="0" max="2000" name="s" step='any' disabled="">
							</div>							
						</div>

						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">Tambah</button>
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</div>
						
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><em>Keterangan</em></div>
			<div class="panel-body">
				<div class="col-sm-12">
					<ul class="list-unstyled">
						<li>Kaidah</li>
							<ul>							
								<li>maksimal: semakin besar semakin baik</li>
								<li>minimal: semakin kecil semakin baik</li>
							</ul>
						<br>
						<li>biasa (tipe preferensi)</li>
							<ul>							
								<li>kasus ilustrasinya: dapat dilihat dari perlombaan renang, seorang peserta dengan peserta lainnya akan memiliki peringkat yang mutlak berbeda walaupun hanya dengan selisih nilai (waktu) yang teramat kecil, dan memiliki peringkat yang sama jika hanya jika waktu tempuhnya sama atau selisih nilai diantaranya sebesar nol.
								</li>
								
							</ul>
						<li>quasi (tipe preferensi)</li>
							<ul>
								<li>harus menentukan nilai selisih antar pelamar (q). jika selisih lebih dari q maka pelamar tersebut lebih baik dari pelamar yang dibandingkan.</li>
							</ul>
						<li>linear (tipe preferensi)</li>
							<ul>
								<li>Kasus Ilustrasi: nilai akademik seseorang dengan orang lain apabila nilai akademik seseorang berselisih di bawah 40, apabila diatas 40 poin maka orang itu mutlak lebih unggul dibandingkan orang lain.</li>
							</ul>
					</ul>
				</div>					
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	function ubahtipe(){
		var a = $('#tipe').val();
		
		if(a==1){
			$('#q').attr('disabled','disabled');
			$('#p').attr('disabled','disabled');
			$('#s').attr('disabled','disabled');
		}else if(a==2){
			$('#q').removeAttr('disabled');
			$('#p').attr('disabled','disabled');
			$('#s').attr('disabled','disabled');
		}else if(a==3){
			$('#q').attr('disabled','disabled');
			$('#p').removeAttr('disabled');
			$('#s').attr('disabled','disabled');
		}else if(a==4){
			$('#q').removeAttr('disabled');
			$('#p').removeAttr('disabled');
			$('#s').attr('disabled','disabled');
		}else if(a==5){
			$('#q').removeAttr('disabled');
			$('#p').removeAttr('disabled');
			$('#s').attr('disabled','disabled');
		}else if(a==6){
			$('#q').attr('disabled','disabled');
			$('#p').attr('disabled','disabled');
			$('#s').removeAttr('disabled');
		}else{
			$('#q').removeAttr('disabled');
			$('#p').removeAttr('disabled');
			$('#s').removeAttr('disabled');
		}
	}
</script>

