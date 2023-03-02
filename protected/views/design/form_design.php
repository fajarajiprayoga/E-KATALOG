<?php
$q_chasis = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CHASIS WHERE ID_CHASIS = '$idchasis'")->queryAll();
$row = count($q_chasis);

if($row == 0){} else {
?>
<section class="py-2">
    <div class="row">
        <a class="btn btn-primary design" style="color: white;" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>">Back</a>
        <div>
        <?php if(!Yii::app()->user->isSales()) { ?>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-sort"></i> Add
            </a>
        <?php } ?>
        </div>
    </div>
    <?php if(!Yii::app()->user->isSales()) { ?>
    <div class="collapse py-2" id="collapseAdd">
        <div class="card-header">
            <h6 class="text-uppercase mb-0">Add Design</h6>
        </div>
      <div class="card card-body">
            <div class="row py-2">
                <form id="form-data">
                    <div class="row">
                        <input type="hidden" name="idchasis" id="idchasis" value="<?php echo $idchasis; ?>">
                        <input type="hidden" name="departemen" id="departemen" value="<?php echo $dept; ?>">
                        <div class="col-md-6">
                            <label>Deskripsi : </label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-2">
                            <label>Version : </label>
                            <input type="text" name="version" id="version" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-2">
                            <label>File : </label>
                            <input type="file" name="fileupload" id="fileupload" class="form-control form-control-sm">
                        </div>
                        
                        <div class="col-md-2">
                            <div class="custom-control custom-checkbox">
                                <label>Last Version : </label>
                                <input id="customCheck1" type="checkbox" name="lastVersion" class="custom-control-input lastVersion">
                                <label for="customCheck1" class="custom-control-label"><span style="font-size: 7pt; color: gray;">Checklist if last</span></label>
                            </div> 
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <input type="button" class="uploaddesign" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" class="btn btn-primary btn-sm" value="Upload">
                    </div>
                </form>
            </div>
      </div>
    </div>
    <?php } ?>
</section>
<section class="py-2">
<div class="col-lg-12 py-2">
    <div class="card">
        <div class="card-body">
            <table style="width: 100%">
                <tr>
                    <th>Produk</th>
                    <th>:</th>
                    <th><?php echo $produk; ?></th>
                </tr>
                <tr>
                    <th>Class</th>
                    <th>:</th>
                    <th><?php echo $clas; ?></th>
                </tr>
                <tr>
                    <th>Model</th>
                    <th>:</th>
                    <th><?php echo $model; ?></th>
                </tr>
                <tr>
                    <th>Type</th>
                    <th>:</th>
                    <th><?php echo $type; ?></th>
                </tr>
                <tr>
                    <th>Chasis</th>
                    <th>:</th>
                    <th><?php echo $chasis; ?></th>
                </tr>
            </table>
        </div>
    </div>
</div>    
</section>
<section class="py-1">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="text-uppercase mb-0">DESIGN</h6>
            </div>
            <div class="card-body">
                <div style="overflow-x:auto; position: relative;">
                    <table id="myTable" style="width:100%">
                        <thead>
                          <tr align="center">
                            <th width="20px">No</th>
                            <th>File</th>
                            <th>File Version</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $arr = array();
                                $q_design = Yii::app()->dbOracle->createCommand("SELECT
                                                                        TO_CHAR(CREATED_AT,'DD/MM/YYYY') CREATE_AT,
                                                                        FILE_NAME,
                                                                        FILE_VERSION,
                                                                        ISLASTVERSION,
                                                                        FILE_DESKRIPSI,
                                                                        ID_DESIGN,
                                                                        ISHIDE
                                                                        FROM KATALOG_DESIGN WHERE ID_CHASIS = '$idchasis'ORDER BY FILE_DESKRIPSI, ISLASTVERSION ASC")->queryAll();
                                foreach($q_design as $rowdesign){
                    
                                    $iddesign = $arr[]=$rowdesign['ID_DESIGN'];
                                    $filename = $arr[]=$rowdesign['FILE_NAME'];
                                    $format = explode(".", $filename);

                                    if($arr[]=$rowdesign['ISLASTVERSION'] == "X"){
                                        $backgroundcolor = "#ADD8E6";
                                    } else {
                                        $backgroundcolor = "white";
                                    }
                                    $arr = array();
                                    
                                    $qdatakatalog = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DESIGN WHERE ID_DESIGN = '$iddesign'")->queryAll();
                                    foreach($qdatakatalog as $datakatalog){
                                        $data['filename'] = $arr[]=$datakatalog['FILE_NAME'];
                                        $data['islastversion'] = $arr[]=$datakatalog['ISLASTVERSION'];
                                    }
                                    ?>
                                    <tr style="text-align: center; background-color: <?php echo $backgroundcolor; ?>;">
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $arr[]=$rowdesign['FILE_DESKRIPSI']; ?></td>
                                        <td><?php echo $arr[]=$rowdesign['FILE_VERSION']; ?></td>
                                        <td><?php echo $arr[]=$rowdesign['CREATE_AT']; ?></td>
                                        <td>
                                        <?php if(!Yii::app()->user->isSales()) { ?>
                                            <i class="fas fa-edit formeditdesign" attr-dept="<?php echo $dept; ?>" attr-iddesign="<?php echo $iddesign; ?>" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" style="font-size: 13pt; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt deletedesign" attr-dept="<?php echo $dept; ?>" attr-iddesign="<?php echo $iddesign; ?>" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" style="font-size: 13pt; cursor: pointer;"></i>
                                        <?php  } ?>                           
                                            <a href="FILE/DESIGN/<?php echo $arr[]=$rowdesign['FILE_NAME']; ?>" target="_blank" view><i class="fas fa-eye"></i></a>                 
                                            <a href="FILE/DESIGN/<?php echo $arr[]=$rowdesign['FILE_NAME']; ?>" target="_blank" download><i class="fas fa-download"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    
                                }
                            ?>
                        </tbody>
                   </table>
                </div>
        </div>
        </div>
      </div>
</section>
<script>
$('#myTable').DataTable({
    "ordering": false,
});
</script>
<?php } ?>