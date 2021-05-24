<?php echo $this->session->flashdata("pesan"); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading" align="left">            
                <a href="<?php echo base_url("admin/c_rekrutmen/tambahseleksi/".$id_rekrutmen);?>" class="btn btn-primary btn-sm"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Tambah Seleksi</a>          
			</div>
			
			<div class="panel-body">
				<table  class="table table-hover table-striped">
                    <thead>
                        <tr>
                        	<th>Urutan seleksi</th>
                        	<th data-field="nama"  data-sortable="true">Nama seleksi</th>
                            <th data-field="kuota"  data-sortable="true">Kuota diloloskan</th>
                        	<th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    foreach ($tampil as $row): ?>
                         <tr >
                         	<td> <?=$no++ ?></td>
                         	<td> <?=$row->nama_seleksi ?></td>
                            <td> <?=$row->kuota." orang" ?></td>
                         	<td>
                                <a href="<?=base_url('admin/c_rekrutmen/ubahseleksi/'.$row->id_seleksi)?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Ubah</a>

                                <a href="<?=base_url('admin/c_rekrutmen/hapusseleksi?ids='.$row->id_seleksi.'&idr='.$row->id_rekrutmen)?>" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda yakin mau dihapus ?')"><span class="glyphicon glyphicon-trash"></span>&nbsp; &nbsp;Hapus</a> 
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
                        <li>Buatlah urutan seleksi</li>
                            <ul>                            
                                <li>Seleksi yang dibuat pertama berarti bahwa seleksi tersebut tahap 1, bila dibuat kedua maka tahap kedua dan seterusnya</li>
                                <li>Buatlah seleksi pelamar yang diloloskan secara menurun</li>
                            </ul>
                        
                    </ul>
                </div>                  
            </div>
        </div>
    </div>
</div>

