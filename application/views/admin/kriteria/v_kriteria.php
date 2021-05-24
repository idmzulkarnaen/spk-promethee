<?php echo $this->session->flashdata("pesan"); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" align="left">            
                <a href="<?php echo base_url("admin/c_kriteria/tambah");?>" class="btn btn-primary btn-sm"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Tambah</a>          
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
                            <th data-field="Kriteria"  data-sortable="true">Kriteria</th>
                            <th data-field="Min"  data-sortable="true">Min/Max</th>
                            <th data-field="Tipe"  data-sortable="true">Tipe Preferensi</th>
                            <th data-field="Nilaimin"  data-sortable="true">selisih Min (Q)</th>
                            <th data-field="Nilaimax"  data-sortable="true">selisih Max (P)</th>
                            <th data-field="Gausian"  data-sortable="true">Gausian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    foreach ($relasi as $row): ?>
                         <tr>
                            <td> <?=$no++ ?></td>
                            <td> <?=$row->nama_kriteria ?></td>
                            <td> <?=ucwords($row->min_max) ?></td>
                            <td> <?=$row->nama_tipe_preferensi?></td>
                            <td> <?=$row->q?></td>
                            <td> <?=$row->p?></td>
                            <td> <?=$row->s?></td>
                            <td>
                                <a href="<?=base_url('admin/c_kriteria/ubah/'.$row->id_kriteria)?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Ubah</a>

                                <a href="<?=base_url('admin/c_kriteria/hapus/'.$row->id_kriteria)?>" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda yakin mau dihapus ?')"><span class="glyphicon glyphicon-trash"></span>&nbsp; &nbsp;Hapus</a> 
                            </td>
                         </tr>
                    <?php endforeach; ?>                                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

