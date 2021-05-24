<?php echo $this->session->flashdata("pesan"); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" align="left">            
                <a href="<?php echo base_url("admin/c_pelamar/tambah");?>" class="btn btn-primary btn-sm"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Tambah</a>          
            </div>
            
            <div class="panel-body">
                <table 
                data-toggle="table" 
                data-url="tables/data1.json"  
                data-show-refresh="true" 
                data-show-toggle="true" 
                data-show-columns="true" 
                data-search="true" 
                data-select-item-name="toolbar1" 
                data-pagination="true" 
                data-sort-name="name" 
                data-sort-order="desc">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th data-field="Nama pelamar"  data-sortable="true">Nama Pelamar</th>
                            <th data-field="Tanggal Lahir"  data-sortable="true">Tempat Tanggal Lahir</th>
                             <th data-field="telp"  data-sortable="true">Telp</th>
                            <th data-field="Universitas"  data-sortable="true">Universitas</th>
                            <th data-field="posjab"  data-sortable="true">Posisi Jabatan</th>
                           
                            <th data-field="Nama"  data-sortable="true">Nama Rekrutmen</th>                         
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    foreach ($relasi as $row): ?>
                         <tr>
                            <td> <?=$no++ ?></td>
                            <td> <?=$row->nama_alternatif ?></td>
                            <td><?=$row->tempat_lahir?>,&nbsp;<?=tanggal($row->tgl_lahir)?></td>
                            <td> <?=$row->telp?></td>
                            <td> <?=$row->universitas?></td>
                            <td> <?=$row->posjab?></td>
                            <td> <?=$row->nama_rekrutmen?></td>
                            <td>
                                <a href="<?=base_url('admin/c_pelamar/ubah/'.$row->id_alternatif)?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Ubah</a>

                                <a href="<?=base_url('admin/c_pelamar/hapus/'.$row->id_alternatif)?>" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda yakin mau dihapus ?')"><span class="glyphicon glyphicon-trash"></span>&nbsp; &nbsp;Hapus</a> 
                            </td>
                         </tr>
                    <?php endforeach; ?>                                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

