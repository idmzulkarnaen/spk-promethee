<?php echo $this->session->flashdata("pesan"); ?>
<?php 
	foreach ($rpenilaian as $row) {
		$nilai=$row->nilai;
	}


	function hitungpreference($value,$sub){
        if($sub['type']==1){      //-- usual`
            return $value==0?0:1;
        }elseif($sub['type']==2){ //-- quasi
            return $value<=$sub['q']?0:1; 
        }elseif($sub['type']==3){ //-- linear
            return $value==0?0:($value>$sub['p']?1:abs($value/$sub['p']));
        }elseif($sub['type']==4){ //-- linear quasi-- level
        	$value = abs($value);
            return $value<=$sub['q']?0:($value>$sub['p']?1:0.5);
        }elseif($sub['type']==5){ //-- level-- linear quasi 
        	$value = abs($value);
            return $value<=$sub['q']?0:($value>$sub['p']?1:($value-$sub['q'])/($sub['p']-$sub['q']));
        }elseif($sub['type']==6){ //-- gaussian
            return $value==0?0:1-exp(-1*pow($value,2)/(2*pow($sub['s'],2)));
        }
    } 

    //1.  p : 0 .. d==0, p : 1..d!=0
    //2.  p : 0 .. d<=q, p : 1 .. d > q
    //3.  p : 0 .. d==0, p : 1 .. d > p , p : d/p
    //4.  p : 0 .. d < q, p : 1 .. d > p, p : d/p-q
    //5.  p : 0 .. d == q, p : 1 .. d > p, p :0,5
    //6.  p : 0 .. d == 0,    

?>

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
								<select  class="form-control" id="tipe" style="width: 150px" name="id_rekrutmen" required="">
									<?php 
										foreach ($tampil as $row) {
											echo "<option ";
											if(isset($id) && $id==$row->id_rekrutmen) echo "selected";
											echo " value='$row->id_rekrutmen'>$row->nama_rekrutmen
											</option>";
										}
									?>
								</select>
							</div>							
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-primary">Tampilkan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- /.row biar ga pusing tampil proses PROMETHEE-->
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Penilaian Pelamar</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<div class="tsf-wizard tsf-wizard-1">

					  <!-- BEGIN NAV STEP-->
					  <div class="tsf-nav-step">
					   <!-- BEGIN STEP INDICATOR-->
					    <ul class="gsi-step-indicator triangle gsi-style-1  gsi-transition ">
					    	<?php
					    		$i = 0;
					    		$aktif = array();;
					    		foreach ($rrekrutmen as $row) {
					    			$cek = $this->Model_crud->cekData("tb_seleksi_kriteria a join tb_penilaian b on a.id_seleksi_kriteria = b.id_seleksi_kriteria","where id_seleksi='$row->id_seleksi'");
					    			if($cek>0){
					    				array_push($aktif, $i);
					    			}
					    			
					      			$i++;
					    		}


					    		$i = 0;
					    		$open = 0;
					    		foreach ($rrekrutmen as $row) {
					    			$no = $i+1;
					    			echo "<li class='";
					    			if(in_array($i, $aktif)){
					    				echo "active ";
					    			}
					    			if((count($aktif)-1==0 && $i==0) || (max($aktif))==$i || (count($rrekrutmen)-1)==max($aktif)-1){
					    				echo "current ";
					    				$open = $i;					    				
					    			}

					    			echo "' data-target='step-$i' id='li$i'>
									        <a href='#$i'>
									          <span class='number'>$no</span>
									          <span class='desc'>
									            <label>$row->nama_seleksi</label>
									            <span class=''>$row->kuota orang</span>
									          </span>
									        </a>
									      </li>";
					      			$i++;
					    		}
					    	?>
					      
					      
					    </ul>
							<!-- END STEP INDICATOR-->
						</div>
						<!-- END NAV STEP-->

						<!-- BEGIN STEP CONTAINER -->
						<div class="tsf-container">
					    <!-- BEGIN CONTENT-->
					    <div class="tsf-content">
					                       
					      <!-- BEGIN STEP 1-->
					    <?php
					    $step = 0;
					    foreach ($rrekrutmen as $row) {
					    	$kuota = $row->kuota;
					    	$seleksi = $row->nama_seleksi;
					    	$rkriteria = $this->Model_crud->ambilData("tb_seleksi_kriteria a join tb_kriteria b on a.id_kriteria = b.id_kriteria join tb_tipe_preferensi c on b.id_tipe_preferensi = c.id_tipe_preferensi","*","id_seleksi='$row->id_seleksi'");
							$rpelamar = $this->Model_crud->ambilData("tb_alternatif","*","id_rekrutmen='$id' and level >= '$step' ORDER BY nama_alternatif DESC");
					    	$jkriteria = count($rkriteria);
					    	echo "
					      	<div class='tsf-step step-$step ";
					      	if($step == $open)echo " active";
					      	echo " '>
					        <div class='tsf-step-content'>";
					        $ceknilai = $this->Model_crud->cekData("tb_penilaian a join tb_seleksi_kriteria b on a.id_seleksi_kriteria = b.id_seleksi_kriteria"," where b.id_seleksi='$row->id_seleksi'");
					        if(count($rpelamar)>0 && $ceknilai>0){
					    ?>

						<br>
						<div class="collapse" id="collapseExample<?php echo $step;?>">
				  			<div class="well">
				  				<div class="panel panel-default">
									<div class="panel-heading">Perhitungan</div>
									<div class="panel-body">
										<div class="col-sm-12">
											<table class="table table-bordered" >
												<thead>
													<tr>
														<th rowspan="2" class='text-center'>No</th>
														<th rowspan="2" class='text-center'>ID Pelamar</th>
														<th rowspan="2" class='text-center'>Pelamar</th>
														<th colspan="<?php echo $jkriteria;?>"  style="text-align: center;">Nilai Kriteria</th>
													</tr>
													<tr >
														<?php
															foreach ($rkriteria as $row) {
																echo 
																"<th 
																class='text-center'>
																$row->nama_kriteria<br>
																$row->nama_tipe_preferensi<br>
																$row->min_max, q=$row->q, p=$row->p, s=$row->s<br>
																</th>";
															}
														?>
													</tr>
												</thead>
												<tbody>
													<?php 
														$no=1;
														$n = array();
														foreach ($rpelamar as $row) {
															echo "<tr>
																	<td class='text-center'>$no</td>
																	<td class='text-center'>$row->id_alternatif</td>
																	<td>$row->nama_alternatif</td>";

																	foreach ($rkriteria as $r) {
																		$cek = $this->Model_crud->ambilData("tb_penilaian","*","id_alternatif = '
																			".$row->id_alternatif."' and id_seleksi_kriteria='".$r->id_seleksi_kriteria."'");
																		if(count($cek)>0){
																			foreach ($cek as $key) {
																			}
																			$nilai = $key->nilai;
																		}else{
																			$nilai = 0;
																		}
																		echo "<td class='text-center'>$nilai</td>";

																		$n[$row->id_alternatif][$r->id_seleksi_kriteria] = $nilai; 
																	}
																	$no++;
														}

														//print_r($n);
															echo "</tr>";									
													?>
												</tbody>							
											</table>

										</div>
									</div>
								</div>


								<h4>Perhitungan pada setiap kriteria</h4>
								<?php
									$tip = array();
									$jumlahaleternatif = array();
									$entering = array();
									$leaving = array();
									$net = array();
									foreach ($rkriteria as $r) {
										echo "<div class='panel panel-default'>
											    <div class='panel-heading' >
											      <h4 class='panel-title'>
											        <a data-toggle='collapse' href='#collapse$r->id_seleksi_kriteria' aria-expanded='false' aria-controls='collapse$r->id_seleksi_kriteria'>
											          $r->nama_kriteria
											        </a>
											      </h4>
											    </div>
											    <div id='collapse$r->id_seleksi_kriteria' class='panel-collapse collapse' >
											      <div class='panel-body'>
											       
											      <div class='col-sm-12'>
													<table class='table table-bordered' >
														<thead>
															<tr>
																<th colspan='2' class='text-center'>Harga</th>
																<th rowspan='2' class='text-center'>a</th>    
																<th rowspan='2' class='text-center'>b</th>
																<th rowspan='2' class='text-center'>d (jarak)</th>
																<th rowspan='2' class='text-center'>|d|</th>
																<th rowspan='2' class='text-center'>P</th>
																<th rowspan='2' class='text-center'>IP</th>
															</tr>
															<tr>
																<th class='text-center'>a</th>
																<th  class='text-center'>b</th>
															</tr>
														</thead>
														<tbody>";
										$i = 1;
										$sub = array();
										$sub['type'] = $r->id_tipe_preferensi;
										$sub['p'] = $r->p;
										$sub['q'] = $r->q;
										$sub['s'] = $r->s;
										foreach ($rpelamar as $a1) {
											if($i==1){
								    			$idk = "'".$a1->id_alternatif."'";
								    		}else{
								    			$idk = $idk.",'".$a1->id_alternatif."'";
								    		}

								    		$rpelamar2 = $this->Model_crud->ambilData("tb_alternatif","*","id_rekrutmen='$id' and level >= '$step' and id_alternatif not in ($idk) ORDER BY id_alternatif ASC");
						    				foreach ($rpelamar2 as $a2) {
						    					$d1 = $n[$a1->id_alternatif][$r->id_seleksi_kriteria] - $n[$a2->id_alternatif][$r->id_seleksi_kriteria];
						    					$abs1 = abs($d1);
						    					$d2 = $n[$a2->id_alternatif][$r->id_seleksi_kriteria] - $n[$a1->id_alternatif][$r->id_seleksi_kriteria];
						    					$abs2 = abs($d2);

						    					if($r->min_max=='min'){
						    						if($d1<$d2){    							
								    					$p1 = hitungpreference($d1,$sub);
								    					$p2 = hitungpreference(0,$sub);
						    						}else{    							
								    					$p1 = hitungpreference(0,$sub);
								    					$p2 = hitungpreference($d2,$sub);
						    						}
						    					}else{
						    						if($d1>$d2){    							
								    					$p1 = hitungpreference($d1,$sub);
								    					$p2 = hitungpreference(0,$sub);
						    						}else{    							
								    					$p1 = hitungpreference(0,$sub);
								    					$p2 = hitungpreference($d2,$sub);
						    						}
						    					}

						    					$ip1 = $p1*$r->bobot;
						    					$ip2 = $p2*$r->bobot;

						    					echo "<tr><td>$a1->nama_alternatif</td><td>$a2->nama_alternatif</td><td>".$n[$a1->id_alternatif][$r->id_seleksi_kriteria]."</td><td>".$n[$a2->id_alternatif][$r->id_seleksi_kriteria]."</td><td>$d1</td><td>$abs1</td><td>".$p1."</td><td>".$ip1."</td></tr>
						    						<tr><td>$a2->nama_alternatif</td><td>$a1->nama_alternatif</td><td>".$n[$a2->id_alternatif][$r->id_seleksi_kriteria]."</td><td>".$n[$a1->id_alternatif][$r->id_seleksi_kriteria]."</td><td>$d2</td><td>$abs2</td><td>".$p2."</td><td>".$ip2."</td></tr>";
						    					if(isset($tip[$a1->id_alternatif][$a2->id_alternatif])){
						    						$tip[$a1->id_alternatif][$a2->id_alternatif] = $tip[$a1->id_alternatif][$a2->id_alternatif]+$ip1;
						    					}else{
						    						$tip[$a1->id_alternatif][$a2->id_alternatif] = $ip1;
						    					}


						    					if(isset($tip[$a2->id_alternatif][$a1->id_alternatif])){
						    						$tip[$a2->id_alternatif][$a1->id_alternatif] = $tip[$a2->id_alternatif][$a1->id_alternatif]+$ip2;
						    					}else{
						    						$tip[$a2->id_alternatif][$a1->id_alternatif] = $ip2;
						    					}

						    					
						    				}

						    				$i++;
										}


										echo "			</tbody>
													</table>
													</div>

											      </div>
											    </div>
											  </div>";


									}
									?>


								<div class="panel panel-default">
									<div class="panel-heading"></div>
									<div class="panel-body">
										<div class="col-sm-12">
											<h4>Total Indeks Preferensi</h4>
												<table class="table table-bordered" style="max-width:280px">
													
													<tbody>
														<?php 
															$i = 1;
															foreach ($rpelamar as $a1) {
																if($i==1){
													    			$idk = "'".$a1->id_alternatif."'";
													    		}else{
													    			$idk = $idk.",'".$a1->id_alternatif."'";
													    		}

													    		$rpelamar2 = $this->Model_crud->ambilData("tb_alternatif","*","id_rekrutmen='$id' and level >= '$step' and id_alternatif not in ($idk) ORDER BY id_alternatif ASC");
											    				foreach ($rpelamar2 as $a2) {
											    					$tip[$a2->id_alternatif][$a1->id_alternatif] = $tip[$a2->id_alternatif][$a1->id_alternatif]/$jkriteria;
											    					$tip[$a1->id_alternatif][$a2->id_alternatif] = $tip[$a1->id_alternatif][$a2->id_alternatif]/$jkriteria;
											    					

											    					echo "<tr><td>$a1->nama_alternatif</td><td>$a2->nama_alternatif</td><td>".$tip[$a1->id_alternatif][$a2->id_alternatif]."</td></tr>
											    						<tr><td>$a2->nama_alternatif</td><td>$a1->nama_alternatif</td><td>".$tip[$a2->id_alternatif][$a1->id_alternatif]."</td></tr>";
											    				}

											    				$i++;
															}									
														?>
													</tbody>							
												</table>

												<br>
												


						  
										</div>

										<div class="col-sm-12">
											<table class="table table-bordered" >
												
												<tbody>
													<?php 

													echo "<tr><td>Alternatif</td>";
													foreach ($rpelamar as $kolom) {
														echo "<td>$kolom->nama_alternatif</td>";
													}
													echo "<td>Jumlah</td><td>Leaving</td></tr>";

													foreach ($rpelamar as $baris) {
														$jumlah = 0 ;
														echo "<tr><td>$baris->nama_alternatif</td>";
											    		foreach ($rpelamar as $kolom) {
											    			echo "<td>";
											    			if(isset($tip[$baris->id_alternatif][$kolom->id_alternatif])){
											    				echo $tip[$baris->id_alternatif][$kolom->id_alternatif];
											    				$jumlah = $jumlah + $tip[$baris->id_alternatif][$kolom->id_alternatif];
											    			}else{
											    				echo "0";
											    				$tip[$baris->id_alternatif][$kolom->id_alternatif] = 0;
											    			} 
											    			echo "</td>";

											    			if(isset($jumlahaleternatif[$kolom->id_alternatif])){
											    				$jumlahaleternatif[$kolom->id_alternatif] = $jumlahaleternatif[$kolom->id_alternatif] + $tip[$baris->id_alternatif][$kolom->id_alternatif];
											    			}else{
											    				$jumlahaleternatif[$kolom->id_alternatif] = $tip[$baris->id_alternatif][$kolom->id_alternatif];
											    			}



											    		}
														$i++;
														$leaving[$baris->id_alternatif] = $jumlah/(count($rpelamar)-1); 
														echo "<td>$jumlah</td><td>".round($leaving[$baris->id_alternatif], 5)."</td></tr>";
													}

													echo "<tr><td>Jumlah</td>";
													foreach ($rpelamar as $kolom) {
														echo "<td>".$jumlahaleternatif[$kolom->id_alternatif]."</td>";
													}
													echo "<td colspan='2'></td></tr>";

													echo "<tr><td>Entering</td>";
													foreach ($rpelamar as $kolom) {
														$entering[$kolom->id_alternatif] = $jumlahaleternatif[$kolom->id_alternatif]/(count($rpelamar)-1); 
														echo "<td>".round($entering[$kolom->id_alternatif],5)."</td>";
													}
													echo "<td colspan='2'></td></tr>";								
													?>
												</tbody>							
											</table>
											<br>
										</div>

										<div class="col-sm-6">
											<table class="table table-bordered" >
												
												<tbody>
													<?php 

													echo "<tr><td>Alternatif</td><td>Leaving Flow</td><td>Entering Flow</td><td>Net Flow</td></tr>";

													foreach ($rpelamar as $baris) {
														$net[$baris->id_alternatif][0] = $leaving[$baris->id_alternatif] - $entering[$baris->id_alternatif]; 
														$net[$baris->id_alternatif][1] = $baris->nama_alternatif;
														$net[$baris->id_alternatif][2] = $baris->id_alternatif;
														
														echo "<tr><td>$baris->nama_alternatif</td><td>".round($leaving[$baris->id_alternatif], 5)."</td><td>".round($entering[$baris->id_alternatif], 5)."</td><td>".round($net[$baris->id_alternatif][0], 5)."</td></tr>";

													}
							
													?>
												</tbody>							
											</table>
											<br>
										</div>

										<div class="col-sm-6">
											<table class="table table-bordered" >
												<thead>
													<tr><th>Peringkat</th><th>Pelamar</th><th>Net Flow</th></tr>
												</thead>
												
												<tbody>
													<?php 
													foreach ($rpelamar as $baris) {
														foreach ($rpelamar as $kolom) {
															if($net[$kolom->id_alternatif][0]<$net[$baris->id_alternatif][0]){
																$temp0 = $net[$kolom->id_alternatif][0];
																$net[$kolom->id_alternatif][0] = $net[$baris->id_alternatif][0];
																$net[$baris->id_alternatif][0] = $temp0;

																$temp1 = $net[$kolom->id_alternatif][1];
																$net[$kolom->id_alternatif][1] = $net[$baris->id_alternatif][1];
																$net[$baris->id_alternatif][1] = $temp1;

																$temp2 = $net[$kolom->id_alternatif][2];
																$net[$kolom->id_alternatif][2] = $net[$baris->id_alternatif][2];
																$net[$baris->id_alternatif][2] = $temp2;

																
															}
														}
													}

													$no = 1;
													foreach ($rpelamar as $baris) {
														echo "<tr><td>$no</td><td>".$net[$baris->id_alternatif][1]."</td><td>".round($net[$baris->id_alternatif][0], 5)."</td></tr>";
														$no++;
													}
							
													?>
												</tbody>							
											</table>
											<br>
										</div>
									</div>
								</div>

							</div>
						</div>

						<form action="<?php echo base_url('admin/c_proses_hitung/exportexcel');?>" method="post" >
						<input type='hidden' value='<?php echo $seleksi;?>' name='seleksi' />
						<input type='hidden' value='<?php echo $step?>' name='tahap' />
						<input type='hidden' value='<?php echo $id?>' name='idr' />
						<div class="panel panel-default">
							<div class="panel-heading">Daftar Pelamar Lolos Seleksi <?php echo $seleksi;?>
								<a href="<?php echo base_url('admin/c_proses_hitung/cetak?seleksi='.$seleksi.'&tahap='.$step.'&idr='.$id);?>" target="_blank" class="btn btn-warning  pull-right" style="margin:10px 12px 0 0 ;">Cetak PDF</a>
								<button class="btn btn-success pull-right"  type="submit" style="margin:10px 12px 0 0 ;">
								  Cetak Excel
								</button>
								<button class="btn btn-primary pull-right" type="button" style="margin:10px 12px 0 0 ;" data-toggle="collapse" data-target="#collapseExample<?php echo $step;?>" aria-expanded="false" aria-controls="collapseExample<?php echo $step;?>">
								  Tampilkan Perhitungan
								</button>
								
							</div>
							<div class="panel-body">
								<div class="col-sm-12">
									<table class="table table-bordered" >
										<thead>
											<tr><th>Peringkat</th><th>Pelamar</th><th>Tanggal Lahir</th><th>Telp</th><th>Posisi Jabatan</th><th>Perguruan Tinggi</th><th>Score</th></tr>
										</thead>
										
										<tbody>
											<?php 
											$apelamar = array();
											$no = 1;
											foreach ($rpelamar as $baris) {

												$tgllahir = "";
												$posjab = "";
												$telp = "";
												$pt = "";

												$rdata = $this->Model_crud->ambilData("tb_alternatif","*"," id_alternatif='".$net[$baris->id_alternatif][2]."'");

												foreach ($rdata as $d) {
													$tgllahir = tanggal($d->tgl_lahir);
													$posjab = $d->posjab;
													$telp = $d->telp;
													$pt = $d->universitas;
												}


												if($no<=$kuota){
													echo "<tr>
													<td>$no</td>
													<td>".$net[$baris->id_alternatif][1]." </td>
													<td>$tgllahir </td>
													<td>$telp </td>
													<td>$posjab </td>
													<td>$pt  </td>
													<td>".round($net[$baris->id_alternatif][0], 5)." </td>
													</tr>";

													$cek = $this->Model_crud->cekData("tb_alternatif","where id_alternatif='".$net[$baris->id_alternatif][2]."' and level>'$step'");
													if($cek==0){
														$data['level'] = $step+1;
														$this->Model_crud->update("tb_alternatif", $data , "id_alternatif", $net[$baris->id_alternatif][2]);
													}
												}
												$no++;
											}
							
											?>
										</tbody>							
									</table>
								</div>
							</div>
						</div>
						</form>
					    <?php
					 	  }else{
					 	  	echo "<div class='text-center' style='margin:100px 0 ;'>
					 	  	<h1 style='font-size:80px;'>🧐</h1>
					 	  	<h3>Belum ada hasil untuk seleksi $row->nama_seleksi </h3>
					 	  	</div>";
					 	  }
					      echo "  
					        </div>
					      </div>
					      ";
					      $step++;
					    }
					    ?>
					      <!-- END STEP 2-->
					    <!--</form>-->
					    </div>
					    <!-- END CONTENT-->

					    
					    <!-- BEGIN CONTROLS-->
					    <div class="tsf-controls ">
					      <!-- BEGIN PREV BUTTTON-->
					      <button type="button" data-type="prev" id="btnprev" class="btn btn-default btn-left tsf-wizard-btn" onclick="prevstep();">
					        <svg class="glyph stroked arrow left"><use xlink:href="#stroked-arrow-left"/></svg> Sebelumnya
					      </button>
					      <!-- END PREV BUTTTON-->
					      
					      <!-- BEGIN NEXT BUTTTON-->
					      <button type="button" data-type="next" id="btnnext" class="btn btn-primary btn-right tsf-wizard-btn" onclick="nextstep();">
					        Selanjutnya <svg class="glyph stroked arrow right"><use xlink:href="#stroked-arrow-right"/></svg>
					      </button>

					         <!-- END NEXT BUTTTON-->
					    </div>
					       <!-- END CONTROLS-->
					  </div>
					     <!-- END STEP CONTAINER -->
					</div>

				</div>
			</div>
		</div>

	</div>
</div>	


<script type="text/javascript">
	var jdata = <?php echo count($rrekrutmen)-1;?>;
	var curr = <?php echo $open;?>;
	if(jdata==curr) $('#btnnext').hide();
	if(curr==0) $('#btnprev').hide();	

	

	function nextstep(){
		curr++;
		$('#btnprev').show();
		if(jdata==curr) $('#btnnext').hide();		
		$('.tsf-step').removeClass('active');		
		$('.step-'+curr).addClass('active');
		$('.gsi-step-indicator li').removeClass('current');
		$('#li'+curr).addClass('current');

	}

	function prevstep(){
		curr--;
		$('#btnnext').show();
		if(curr==0) $('#btnprev').hide();		
		$('.tsf-step').removeClass('active');
		$('.step-'+curr).addClass('active');
		$('.gsi-step-indicator li').removeClass('current');
		$('#li'+curr).addClass('current');

	}

	function savenilai(id){
        var data = $('#formnilai'+id).serialize();
        $.ajax({
            url   : '<?php echo base_url('admin/c_penilaian/simpannilai');?>',
            data  : data,
            type  : 'POST',
            dataType: 'html',
            success : function(pesan){
                $("#notif"+id).html(pesan);
                $("#li"+id).addClass("current");
            },
            error : function(pesan){
                $("#notif"+id).html(pesan);
            }
        });
    }

</script>