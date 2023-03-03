<?php
$q_chasis = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CHASIS WHERE ID_CHASIS = '$idchasis'")->queryAll();
$row = count($q_chasis);

if($row == 0){} else {
?>
<section class="py-2">
    <div class="row">
        <a class="btn btn-primary skrb" style="color: white;" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>">Back</a>
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
            <h6 class="text-uppercase mb-0">Add Skrb</h6>
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
                        <input type="button" class="uploadskrb" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" class="btn btn-primary btn-sm" value="Upload">
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
                <h6 class="text-uppercase mb-0">SKRB <?php if($dept == 0) { echo 'SALES'; }else{ echo 'ENGINEERING'; }?></h6>
            </div>
            <div class="card-body">
                <div class="row">
                <?php
                        if($dept == '0'){
                            $dir = 'SALES';
                        } else {
                            $dir = 'ENG';
                        }
                        
                        $no=1;
                        $arr = array();
                        $q_skrb = Yii::app()->dbOracle->createCommand("SELECT
                                                                TO_CHAR(CREATED_AT,'DD/MM/YYYY') CREATE_AT,
                                                                FILE_NAME,
                                                                FILE_VERSION,
                                                                ISLASTVERSION,
                                                                FILE_DESKRIPSI,
                                                                ID_SKRB_$dir,
                                                                ISHIDE
                                                                FROM KATALOG_SKRB_$dir WHERE ID_CHASIS = '$idchasis' ORDER BY ISLASTVERSION ASC")->queryAll();
                        foreach($q_skrb as $rowskrb){
                            $no++;
                            $idskrbsales = $arr[]=$rowskrb['ID_SKRB_'.$dir];
                            $filename = $arr[]=$rowskrb['FILE_NAME'];
                            $format = explode(".", $filename);
                            
                            if($arr[]=$rowskrb['ISLASTVERSION'] == "X"){
                                $backgroundcolor = "#ADD8E6";
                            } else {
                                $backgroundcolor = "#D3D3D3";
                            }
                            
                            $arr = array();
                            $qdatakatalog = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_SKRB_$dir WHERE ID_SKRB_$dir = '$idskrbsales'")->queryAll();
                            foreach($qdatakatalog as $datakatalog){
                                $data['filename'] = $arr[]=$datakatalog['FILE_NAME'];
                                $data['islastversion'] = $arr[]=$datakatalog['ISLASTVERSION'];
                            }
                            
                            if($format[1] == "jpg" || $format[1] == "JPG"){
                                ?>
                                    <div class="card col-md-6">
                                        <div class="card-header" style="background-color: <?php echo $backgroundcolor; ?>;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <th><?php echo $arr[]=$rowskrb['FILE_VERSION']; ?></th>
                                                    <th><?php echo $arr[]=$rowskrb['FILE_DESKRIPSI']; ?></th>
                                                    <?php if(!Yii::app()->user->isSales()) { ?>
                                                    <th><i class="fas fa-edit formeditskrb" attr-dept="<?php echo $dept; ?>" attr-idskrbsales="<?php echo $idskrbsales; ?>" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" style="font-size: 13pt; cursor: pointer;"></i></th>
                                                    <th><i class="fas fa-trash-alt deleteskrb" attr-dept="<?php echo $dept; ?>" attr-idskrbsales="<?php echo $idskrbsales; ?>" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" style="font-size: 13pt; cursor: pointer;"></i></th>
                                                    <?php } ?>
                                                    <th><a href="FILE/SKRB/<?php echo $dir; ?>/<?php echo $data['filename']; ?>" target="_blank" download><i class="fas fa-download"></i></a></th>
                                                </tr>
                                            </table>
                                        </div>
                                        <figure>
                                            <img class="img-fluid" width='100%' src="FILE/SKRB/<?php echo $dir; ?>/<?php echo $filename; ?>">
                                        </figure>
                                    </div>
                                <?php 
                            } else {
                                ?>
                                    <div class="card col-md-6">
                                        <div class="card-header" style="background-color: #D3D3D3;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <th><?php echo $arr[]=$rowskrb['FILE_VERSION']; ?></th>
                                                    <th><?php echo $arr[]=$rowskrb['FILE_DESKRIPSI']; ?></th>
                                                    <?php if(!Yii::app()->user->isSales()) { ?>
                                                    <th><i class="fas fa-edit formeditskrb" attr-idskrbsales="<?php echo $idskrbsales; ?>" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" style="font-size: 13pt; cursor: pointer;"></i></th>
                                                    <th><i class="fas fa-trash-alt deleteskrb" attr-source="<?php echo $arr[]=$rowskrb['FILE_NAME']; ?>" attr-dept="<?php echo $dept; ?>" attr-idskrbsales="<?php echo $idskrbsales; ?>" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" style="font-size: 13pt; cursor: pointer;"></i></th>
                                                    <?php } ?>
                                                    <th><i class="fas fa-download downloadskrb" attr-filename="<?php echo $filename; ?>" attr-departemen="<?php echo $dept; ?>" style="font-size: 13pt; cursor: pointer;"></i></th>
                                                </tr>
                                            </table>
                                        </div>
                                        <figure>
                                            <embed type="application/pdf" src="FILE/SKRB/<?php echo $dir; ?>/<?php echo $filename; ?>" class="img-fluid" style="width:100%; height:350px;">
                                        </figure>
                                    </div>
                                <?php 
                            }
                        }
                ?>
                </div>
            </div>
        </div>
        </div>
      </div>
</section>
<?php } ?>