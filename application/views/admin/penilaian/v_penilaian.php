<?php echo $this->session->flashdata("pesan"); ?>
<?php 
	foreach ($rpenilaian as $row) {
		$nilai=$row->nilai;
	}
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Form Penilaian</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_penilaian/tampilkan");?>" >
									
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Rekrutmen</label>
							<div class="col-sm-10">
								<select  class="form-control" id="tipe"  name="id_rekrutmen" required="">
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
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Tampilkan</button>
							</div>
						</div>						
					</div>					
				</form>
			</div>
		</div>
	</div>
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
					    		$aktif = array();
					    		foreach ($rrekrutmen as $row) {
					    			$cek = $this->Model_crud->cekData("tb_seleksi_kriteria a join tb_penilaian b on a.id_seleksi_kriteria = b.id_seleksi_kriteria","where id_seleksi='$row->id_seleksi'");
					    			if($cek>0){
					    				array_push($aktif, $i);
					    			}
					    								    			
					      			$i++;
					    		}

					    		$i = 0;
					    		$open = 0;
					    		$mak = 0 ;
					    		foreach ($aktif as $a) {
					    			if($a>$mak)$mak = $a;
					    		}
					    		foreach ($rrekrutmen as $row) {
					    			$no = $i+1;
					    			echo "<li class=' ";
					    			if(($mak==0 && $i==0) || 
					    				($mak==$i || (count($rrekrutmen)-1)==$mak)){
					    				echo "current ";
					    				$open = $i;			    				
					    			}

					    			if(count($aktif)>0){
					    				foreach ($aktif as $a) {
					    					if($a==$i)echo "active ";
					    				}
					    				
					    			}

					    			echo " ' data-target='step-$i' id='li$i'>
									        <a href='#$i'>
									          <span class='number'>$no</span>
									          <span class='desc'>
									            <label>$row->nama_seleksi</label>
									            <span class=''>Account details</span>
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
					    $i = 0;
					    foreach ($rrekrutmen as $row) {
					    	$rkriteria = $this->Model_crud->ambilData("tb_seleksi_kriteria a join tb_kriteria b on a.id_kriteria = b.id_kriteria","*","id_seleksi='$row->id_seleksi'");
							$rpelamar = $this->Model_crud->ambilData("tb_alternatif","*","id_rekrutmen='$row->id_rekrutmen' and level >= '$i' ORDER BY nama_alternatif ASC");
					    	echo "
					      <div class='tsf-step step-$i ";
					      if($i == $open)echo " active";
					      echo " '>
					        <div class='tsf-step-content'>
					        	<div id='notif$i'></div>
					        	";
					       if(count($rpelamar)>0){
					       	echo "
					        	<form class='form-horizontal'  method='POST' enctype='multipart/form-data' action='".base_url('admin/c_penilaian/reset')."' id='formreset$i'>
					        		<input type='hidden' name='idr' value='";
						            if(isset($id) ) echo $id;
						            echo" '>
						            <input type='hidden' name='level' value='$i'>
						            <input type='hidden' name='ids' value='$row->id_seleksi'>
						            <button type='submit' class='btn btn-default pull-right' onclick='return confirm(\"Beneran mau reset nich ?\");'>Reset</button>
						           
					        	</form> <br> <br>
					        	<form class='form-horizontal'  method='POST' enctype='multipart/form-data' action='javascript:savenilai($i);' id='formnilai$i'>
						            <input type='hidden' name='id' value='";
						            if(isset($id) ) echo $id;
						            echo" '>
						            <table class='table table-bordered'>
						              <thead>
						                <tr>
						                  <th rowspan='2' class='text-center'>No</th>
						                  <th rowspan='2' class='text-center'>ID Pelamar</th>
						                  <th rowspan='2' class='text-center'>Pelamar</th>
						                  <th colspan='";
						                  echo count($rkriteria);
						                  echo "class='text-center'>Nilai Kriteria</th>
						                </tr>
						                <tr >";
						                foreach ($rkriteria as $row) {
						                      echo 
						                      "<th  class='text-center'>$row->nama_kriteria</th>";
						                    }
						                echo "</tr>
						              </thead>
						              <tbody>";
						              $no=1;
						                  foreach ($rpelamar as $ro) {
						                    echo "<tr>
						                        <td>$no</td>
						                        <td>$ro->id_alternatif</td>
						                        <td>$ro->nama_alternatif</td>";

						                        foreach ($rkriteria as $r) {
						                          $cek = $this->Model_crud->ambilData("tb_penilaian a join tb_seleksi_kriteria b on a.id_seleksi_kriteria = b.id_seleksi_kriteria","*","a.id_alternatif = '
						                            ".$ro->id_alternatif."' and b.id_seleksi_kriteria='".$r->id_seleksi_kriteria."'");
						                          if(count($cek)>0){
						                            foreach ($cek as $key) {
						                            }
						                            $nilai = $key->nilai;
						                          }else{
						                            $nilai = '';
						                          }
						                          echo "<td><input type='number'  style='min-width:80px'
						                            name='nilai[]' step='any' value='$nilai' min='0' max='100'  class='form-control' />

						                            <input type='hidden' name='alternatif[]' value='$ro->id_alternatif'/>
						                            <input type='hidden' name='kriteria[]' value='$r->id_seleksi_kriteria'/>
						                          </td>";
						                        }
						                        $no++;

						            		echo "</tr>";
						                  }
						            echo "
						              </tbody>
						              
						            </table>
						            <div class='form-group'>
						            	<div class='col-sm-12'>
						              		<button type='submit' class='btn btn-llg btn-success'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'/></svg>  Simpan</button>
						              	</div>
						            </div>          
						        </form>";
						    }else{
						    	echo "<div class='text-center' style='margin:100px 0 ;'>
					 	  	<h1 style='font-size:80px;'>😪</h1>
					 	  	<h3>Tidak dapat input nilai...<br>Belum ada hasil untuk seleksi sebeleumnya</h3>
					 	  	</div>";
						    }
						echo "
					        </div>
					      </div>
					      ";
					      $i++;
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
					        <svg class="glyph stroked arrow left"><use xlink:href="#stroked-arrow-left"/></svg> Sebeleumnya
					      </button>
					      <!-- END PREV BUTTTON-->
					      
					      <!-- BEGIN NEXT BUTTTON-->
					      <button type="button" data-type="next" id="btnnext" class="btn btn-primary btn-right tsf-wizard-btn" onclick="nextstep();">
					        NEXT <svg class="glyph stroked arrow right"><use xlink:href="#stroked-arrow-right"/></svg>
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


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><em>Keterangan</em></div>
			<div class="panel-body">
				<div class="col-sm-12">
					<ul class="list-unstyled">
						<li>aturan</li>
							<ul>							
								<li>harus mengisi nilai</li>
								<li>untuk dapat melanjutkan tahap selanjutnya harus masuk ke menu laporan</li>
							</ul>
						<br>						
					</ul>
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

    function reset(id){
        var data = $('#formreset'+id).serialize();
        $.ajax({
            url   : '<?php echo base_url('admin/c_penilaian/reset');?>',
            data  : data,
            type  : 'POST',
            dataType: 'html',
            success : function(pesan){
                $("#notif"+id).html(pesan);
            },
            error : function(pesan){
                $("#notif"+id).html(pesan);
            }
        });
    }

    

</script>