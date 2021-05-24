<?php echo $this->session->flashdata("pesan"); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Form Tambah Seleksi</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="<?=base_url("admin/c_rekrutmen/tambah_prosesseleksi/");?>" >
                        <input type="hidden" name="id_rekrutmen" value="<?=$id_rekrutmen?>">
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_seleksi" placeholder="Nama Seleksi..." required="">
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kuota</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" min="1" max="100" name="kuota" placeholder="Jumlah orang yang diloloskan..." required>
                            </div>                          
                        </div>

                        <input type="hidden" name="jk" id="jk" value="1">

                        <div class="form-group">
                          <label class="col-sm-2 control-label">Kriteria</label>
                          <div class="col-sm-10" id="mkriteria">

                            <div class="row" id="k1" style="margin-bottom: 5px">
                            
                                <div class="col-xs-10">
                                    <select class="form-control" data-placeholder="Pilih krietria"  name="kriteria[]" >
                                        <option>Pilih Kriteria..</option>
                                        <?php
                                        foreach ($rkriteria as $r) {
                                            echo "<option value='$r->id_kriteria'>$r->nama_kriteria</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <input type="hidden" class="form-control" min="1" max="5" name="bobot[]" step='any' placeholder="tingkat kepentingan kriteria..." value="1">
                                <div class="col-xs-2 text-right">
                                    <button type="button" class="btn btn-danger" onclick="hapus(1)"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg> Hapus</button>
                                </div>
                            </div>
                            
                            
                          </div>

                          <div class="col-sm-offset-2 col-sm-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-default" onclick="tambah()" style="display: block !important;width: 100%;margin-top: 10px"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Tambah Kriteria</button>
                                </div>
                            </div>
                          </div>


                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <hr>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>                        
                </div>    
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><em>Keterangan</em></div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li>Kriteria</li>
                            <ul>                            
                                <li>Kriteria harus dibuat terlebih dahulu di menu kriteria</li>
                                <li>jika dalam tingkat kepentingan kriteria sama, maka nilai disamakan</li>
                            </ul>
                        
                    </ul>
                </div>                  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function tambah(){
        var jk = $('#jk').val();
        jk++;
        $('#jk').val(jk);
        var option = "<?php foreach ($rkriteria as $r) {echo "<option value='$r->id_kriteria'>$r->nama_kriteria</option>"; }?>";
        $('#mkriteria').append('<div class="row" id="k'+jk+'"  style="margin-bottom: 5px"><div class="col-xs-10"><select class="form-control" data-placeholder="Pilih krietria"  name="kriteria[]" ><option>Pilih Kriteria..</option>'+option+'</select></div><input type="hidden"  class="form-control" min="1" max="5" name="bobot[]" step="any" placeholder="Tingkat kepentingan kriteria..." value="1" ><div class="col-xs-2 text-right"><button type="button" class="btn btn-danger" onclick="hapus('+jk+')"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg> Hapus</button></div></div>');

    }

    function hapus(no){
        $('#k'+no).remove();
    }

    $(function () {
        $(".select2").select2();
    });
</script>