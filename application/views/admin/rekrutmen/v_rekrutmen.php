<?php echo $this->session->flashdata("pesan"); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading" align="left">            
                <a href="<?php echo base_url("admin/c_rekrutmen/tambah");?>" class="btn btn-primary btn-sm"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Tambah</a>          
			</div>
			
			<div class="panel-body">
				<table  class="table table-hover table-striped">
                    <thead>
                        <tr>
                        	<th>No</th>
                        	<th data-field="id"  data-sortable="true">Kode</th>
                        	<th data-field="nama"  data-sortable="true">Nama rekrutmen</th>
                            <th data-field="tahun"  data-sortable="true">Tangal</th>
                            <!-- <th data-field="kuota"  data-sortable="true">Kuota</th> -->
                        	<th data-field="keterangan"  data-sortable="true">Keterangan</th>
                        	<th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    foreach ($tampil as $row): ?>
                         <tr style="cursor:pointer" <?php echo "onclick='location=\"".base_url('admin/c_rekrutmen/seleksi/'.$row->id_rekrutmen)."\";'";?>>
                         	<td> <?=$no++ ?></td>
                         	<td> <?=$row->kode ?></td>
                         	<td> <?=$row->nama_rekrutmen ?></td>
                            <td> <?=tanggal($row->tanggal) ?></td>
                            <!-- <td> <?=$row->kuota." orang" ?></td> -->
                         	<td> <?php echo substr($row->keterangan, 0,5)."..."; ?></td>
                         	<td>
                                <a href="<?=base_url('admin/c_rekrutmen/ubah/'.$row->id_rekrutmen)?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Ubah</a>

                                <a href="<?=base_url('admin/c_rekrutmen/hapus/'.$row->id_rekrutmen)?>" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda yakin mau dihapus ?')"><span class="glyphicon glyphicon-trash"></span>&nbsp; &nbsp;Hapus</a> 
                            </td>
                         </tr>
                    <?php endforeach; ?>                                        
                    </tbody>
                </table>
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
                        <li>Setelah Rekrutmen dibuat klik nama rekrutmen yang dibuat untuk masuk tahap seleksi</li>                                                 
                    </ul>
                </div>                  
            </div>
        </div>
    </div>
</div>
